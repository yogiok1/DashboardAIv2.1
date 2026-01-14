from fastapi import FastAPI, HTTPException, Query
from fastapi.middleware.cors import CORSMiddleware
from fastapi.responses import StreamingResponse
from pydantic import BaseModel
from typing import List, Optional
import os
import json
import chromadb
from chromadb.config import Settings
from sentence_transformers import SentenceTransformer
import asyncio
from dotenv import load_dotenv
import httpx
from pathlib import Path

# Load environment variables
load_dotenv()

app = FastAPI(title="RAG Chatbot Service", version="1.0.0")

# CORS configuration untuk Laravel
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Di production, ganti dengan domain spesifik
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Configuration from environment
CHROMA_DB_PATH = os.getenv("CHROMA_DB_PATH", "./chroma_data")
COLLECTION_NAME = os.getenv("COLLECTION_NAME", "proposal_documents")
EMBEDDING_MODEL_NAME = os.getenv("EMBEDDING_MODEL", "all-MiniLM-L6-v2")
PDF_STORAGE_PATH = os.getenv("PDF_STORAGE_PATH", "../storage/app/proposals")
VLLM_API_BASE = os.getenv("VLLM_API_BASE", "http://localhost:8001/v1")
VLLM_API_KEY = os.getenv("VLLM_API_KEY", "")

# Initialize embedding model
print(f"Loading embedding model: {EMBEDDING_MODEL_NAME}")
embedding_model = SentenceTransformer(EMBEDDING_MODEL_NAME)

# Initialize ChromaDB client
chroma_client = chromadb.PersistentClient(
    path=CHROMA_DB_PATH,
    settings=Settings(anonymized_telemetry=False)
)

# Get or create collection
try:
    collection = chroma_client.get_collection(name=COLLECTION_NAME)
    print(f"Using existing collection: {COLLECTION_NAME}")
except:
    collection = chroma_client.create_collection(
        name=COLLECTION_NAME,
        metadata={"description": "Proposal documents for RAG"}
    )
    print(f"Created new collection: {COLLECTION_NAME}")


# Pydantic models
class ChatMessage(BaseModel):
    role: str  # 'user' or 'assistant'
    content: str


class ChatRequest(BaseModel):
    message: str
    proposal_group_ids: List[int]
    conversation_history: Optional[List[ChatMessage]] = []


class QueryRequest(BaseModel):
    query: str
    proposal_group_ids: List[int]
    top_k: int = 5


class IndexRequest(BaseModel):
    proposal_group_id: int
    force_reindex: bool = False


# Helper functions
def get_embedding(text: str) -> List[float]:
    """Generate embedding for text using sentence-transformers"""
    return embedding_model.encode(text).tolist()


def query_chromadb(query_text: str, proposal_group_ids: List[int], top_k: int = 5):
    """Query ChromaDB for relevant documents"""
    query_embedding = get_embedding(query_text)
    
    # Filter by proposal_group_ids
    where_filter = {"proposal_group_id": {"$in": proposal_group_ids}} if proposal_group_ids else None
    
    results = collection.query(
        query_embeddings=[query_embedding],
        n_results=top_k,
        where=where_filter
    )
    
    return results


async def stream_chat_completion(
    messages: List[dict],
    context: str
):
    """Stream chat completion from vLLM API"""
    
    # Build system message with context
    system_message = {
        "role": "system",
        "content": f"""Anda adalah asisten AI untuk menilai proposal penelitian. 
Gunakan konteks berikut untuk menjawab pertanyaan:

KONTEKS:
{context}

Berikan jawaban yang akurat berdasarkan konteks yang diberikan. Jika informasi tidak ada dalam konteks, katakan dengan jelas."""
    }
    
    # Prepare messages for API
    api_messages = [system_message] + messages
    
    payload = {
        "model": "gpt-3.5-turbo",  # Model name sesuai vLLM config
        "messages": api_messages,
        "stream": True,
        "temperature": 0.7,
        "max_tokens": 2000
    }
    
    headers = {
        "Content-Type": "application/json",
    }
    
    if VLLM_API_KEY:
        headers["Authorization"] = f"Bearer {VLLM_API_KEY}"
    
    try:
        async with httpx.AsyncClient(timeout=60.0) as client:
            async with client.stream(
                "POST",
                f"{VLLM_API_BASE}/chat/completions",
                json=payload,
                headers=headers
            ) as response:
                if response.status_code != 200:
                    error_text = await response.aread()
                    yield f"data: {json.dumps({'error': f'API Error: {error_text.decode()}'})}\n\n"
                    return
                
                async for line in response.aiter_lines():
                    if line.strip():
                        if line.startswith("data: "):
                            yield f"{line}\n\n"
    except Exception as e:
        yield f"data: {json.dumps({'error': f'Stream error: {str(e)}'})}\n\n"


# API Endpoints
@app.get("/")
async def root():
    return {
        "service": "RAG Chatbot Service",
        "status": "running",
        "endpoints": {
            "health": "/health",
            "chat": "/chat",
            "query": "/query",
            "index": "/index",
            "collection_info": "/collection/info"
        }
    }


@app.get("/health")
async def health_check():
    """Health check endpoint"""
    return {
        "status": "healthy",
        "chroma_db": "connected",
        "collection": COLLECTION_NAME,
        "embedding_model": EMBEDDING_MODEL_NAME
    }


@app.post("/chat")
async def chat(request: ChatRequest):
    """
    Main chat endpoint with streaming support.
    Returns RAG-enhanced responses with context from selected proposal groups.
    """
    try:
        # Validate proposal_group_ids
        if not request.proposal_group_ids or len(request.proposal_group_ids) == 0:
            raise HTTPException(
                status_code=400,
                detail="Proposal group IDs required. Please select at least one proposal group."
            )
        
        # Query ChromaDB for relevant context
        query_results = query_chromadb(
            request.message,
            request.proposal_group_ids,
            top_k=5
        )
        
        # Build context from query results
        context_parts = []
        if query_results['documents'] and len(query_results['documents'][0]) > 0:
            for i, doc in enumerate(query_results['documents'][0]):
                metadata = query_results['metadatas'][0][i]
                context_parts.append(f"[Document {i+1} - {metadata.get('filename', 'Unknown')}]:\n{doc}")
        
        context = "\n\n".join(context_parts) if context_parts else "No relevant context found."
        
        # Build messages for chat
        messages = []
        for msg in request.conversation_history:
            messages.append({
                "role": msg.role,
                "content": msg.content
            })
        messages.append({
            "role": "user",
            "content": request.message
        })
        
        # Return streaming response
        return StreamingResponse(
            stream_chat_completion(messages, context),
            media_type="text/event-stream"
        )
        
    except HTTPException as he:
        raise he
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Chat error: {str(e)}")


@app.post("/query")
async def query_documents(request: QueryRequest):
    """
    Query ChromaDB for relevant documents without chat completion.
    Useful for testing RAG retrieval.
    """
    try:
        results = query_chromadb(
            request.query,
            request.proposal_group_ids,
            top_k=request.top_k
        )
        
        return {
            "query": request.query,
            "proposal_group_ids": request.proposal_group_ids,
            "results": {
                "documents": results['documents'][0] if results['documents'] else [],
                "metadatas": results['metadatas'][0] if results['metadatas'] else [],
                "distances": results['distances'][0] if results['distances'] else []
            }
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Query error: {str(e)}")


@app.get("/collection/info")
async def collection_info():
    """Get information about the ChromaDB collection"""
    try:
        count = collection.count()
        return {
            "collection_name": COLLECTION_NAME,
            "total_documents": count,
            "embedding_model": EMBEDDING_MODEL_NAME
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error getting collection info: {str(e)}")


@app.post("/collection/clear")
async def clear_collection():
    """Clear all documents from the collection (use with caution!)"""
    try:
        global collection
        chroma_client.delete_collection(name=COLLECTION_NAME)
        collection = chroma_client.create_collection(
            name=COLLECTION_NAME,
            metadata={"description": "Proposal documents for RAG"}
        )
        return {
            "status": "success",
            "message": "Collection cleared successfully"
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Error clearing collection: {str(e)}")


if __name__ == "__main__":
    import uvicorn
    port = int(os.getenv("PORT", 8000))
    host = os.getenv("HOST", "0.0.0.0")
    
    print(f"\n{'='*60}")
    print(f"🚀 Starting RAG Chatbot Service")
    print(f"{'='*60}")
    print(f"📍 Server: http://{host}:{port}")
    print(f"📚 Collection: {COLLECTION_NAME}")
    print(f"🤖 Embedding Model: {EMBEDDING_MODEL_NAME}")
    print(f"💾 ChromaDB Path: {CHROMA_DB_PATH}")
    print(f"📄 PDF Path: {PDF_STORAGE_PATH}")
    print(f"🔗 vLLM API: {VLLM_API_BASE}")
    print(f"{'='*60}\n")
    
    uvicorn.run(app, host=host, port=port)
