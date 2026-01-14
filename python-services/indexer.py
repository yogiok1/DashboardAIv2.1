"""
PDF Indexer untuk ChromaDB
Script ini akan mengekstrak teks dari PDF dan meng-index ke ChromaDB
"""

import os
import sys
from pathlib import Path
from typing import List
import chromadb
from chromadb.config import Settings
from sentence_transformers import SentenceTransformer
from PyPDF2 import PdfReader
from dotenv import load_dotenv
import hashlib

# Load environment variables
load_dotenv()

# Configuration
CHROMA_DB_PATH = os.getenv("CHROMA_DB_PATH", "./chroma_data")
COLLECTION_NAME = os.getenv("COLLECTION_NAME", "proposal_documents")
EMBEDDING_MODEL_NAME = os.getenv("EMBEDDING_MODEL", "all-MiniLM-L6-v2")
PDF_STORAGE_PATH = os.getenv("PDF_STORAGE_PATH", "../storage/app/proposals")


def get_file_hash(file_path: str) -> str:
    """Generate hash for file to detect changes"""
    hasher = hashlib.md5()
    with open(file_path, 'rb') as f:
        buf = f.read()
        hasher.update(buf)
    return hasher.hexdigest()


def extract_text_from_pdf(pdf_path: str) -> str:
    """Extract text content from PDF file"""
    try:
        reader = PdfReader(pdf_path)
        text_parts = []
        
        for page_num, page in enumerate(reader.pages):
            text = page.extract_text()
            if text.strip():
                text_parts.append(f"[Page {page_num + 1}]\n{text}")
        
        return "\n\n".join(text_parts)
    except Exception as e:
        print(f"Error extracting text from {pdf_path}: {str(e)}")
        return ""


def chunk_text(text: str, chunk_size: int = 1000, overlap: int = 200) -> List[str]:
    """Split text into overlapping chunks for better context retrieval"""
    if not text:
        return []
    
    chunks = []
    start = 0
    text_length = len(text)
    
    while start < text_length:
        end = start + chunk_size
        chunk = text[start:end]
        
        # Try to end at sentence boundary
        if end < text_length:
            last_period = chunk.rfind('.')
            last_newline = chunk.rfind('\n')
            split_point = max(last_period, last_newline)
            
            if split_point > chunk_size * 0.5:  # Only split if we're past halfway
                chunk = chunk[:split_point + 1]
                end = start + split_point + 1
        
        chunks.append(chunk.strip())
        start = end - overlap
    
    return chunks


def index_pdf_to_chromadb(
    pdf_path: str,
    proposal_group_id: int,
    collection,
    embedding_model,
    force_reindex: bool = False
):
    """Index a single PDF file to ChromaDB"""
    
    filename = os.path.basename(pdf_path)
    file_hash = get_file_hash(pdf_path)
    
    # Check if already indexed (unless force_reindex)
    if not force_reindex:
        try:
            existing = collection.get(
                where={
                    "$and": [
                        {"filename": filename},
                        {"proposal_group_id": proposal_group_id}
                    ]
                }
            )
            if existing['ids']:
                existing_hash = existing['metadatas'][0].get('file_hash', '')
                if existing_hash == file_hash:
                    print(f"  ✓ Already indexed: {filename} (unchanged)")
                    return True
                else:
                    # File changed, delete old entries
                    collection.delete(ids=existing['ids'])
                    print(f"  🔄 Re-indexing (file changed): {filename}")
        except:
            pass
    
    # Extract text from PDF
    print(f"  📄 Extracting text from: {filename}")
    text = extract_text_from_pdf(pdf_path)
    
    if not text:
        print(f"  ⚠️  No text extracted from: {filename}")
        return False
    
    # Chunk text
    chunks = chunk_text(text, chunk_size=1000, overlap=200)
    print(f"  ✂️  Split into {len(chunks)} chunks")
    
    # Generate embeddings and store
    print(f"  🧮 Generating embeddings...")
    for i, chunk in enumerate(chunks):
        embedding = embedding_model.encode(chunk).tolist()
        
        doc_id = f"{proposal_group_id}_{filename}_{i}_{file_hash[:8]}"
        
        collection.add(
            ids=[doc_id],
            embeddings=[embedding],
            documents=[chunk],
            metadatas=[{
                "proposal_group_id": proposal_group_id,
                "filename": filename,
                "chunk_index": i,
                "total_chunks": len(chunks),
                "file_hash": file_hash,
                "file_path": pdf_path
            }]
        )
    
    print(f"  ✅ Indexed: {filename} ({len(chunks)} chunks)")
    return True


def index_proposal_group(proposal_group_id: int, force_reindex: bool = False):
    """Index all PDFs for a specific proposal group"""
    
    print(f"\n{'='*60}")
    print(f"📦 Indexing Proposal Group ID: {proposal_group_id}")
    print(f"{'='*60}")
    
    # Initialize ChromaDB
    print("🔌 Connecting to ChromaDB...")
    chroma_client = chromadb.PersistentClient(
        path=CHROMA_DB_PATH,
        settings=Settings(anonymized_telemetry=False)
    )
    
    # Get or create collection
    try:
        collection = chroma_client.get_collection(name=COLLECTION_NAME)
        print(f"✓ Using collection: {COLLECTION_NAME}")
    except:
        collection = chroma_client.create_collection(
            name=COLLECTION_NAME,
            metadata={"description": "Proposal documents for RAG"}
        )
        print(f"✓ Created collection: {COLLECTION_NAME}")
    
    # Load embedding model
    print(f"🤖 Loading embedding model: {EMBEDDING_MODEL_NAME}")
    embedding_model = SentenceTransformer(EMBEDDING_MODEL_NAME)
    
    # Find PDF files for this proposal group
    # Assuming folder structure: PDF_STORAGE_PATH/group_{id}/
    group_folder = Path(PDF_STORAGE_PATH) / f"group_{proposal_group_id}"
    
    if not group_folder.exists():
        # Try alternative: direct files in PDF_STORAGE_PATH
        group_folder = Path(PDF_STORAGE_PATH)
        print(f"⚠️  Group folder not found, searching in: {group_folder}")
    
    pdf_files = list(group_folder.glob("*.pdf"))
    
    if not pdf_files:
        print(f"❌ No PDF files found in: {group_folder}")
        return False
    
    print(f"📚 Found {len(pdf_files)} PDF files")
    
    # Index each PDF
    success_count = 0
    for pdf_path in pdf_files:
        try:
            if index_pdf_to_chromadb(
                str(pdf_path),
                proposal_group_id,
                collection,
                embedding_model,
                force_reindex
            ):
                success_count += 1
        except Exception as e:
            print(f"  ❌ Error indexing {pdf_path}: {str(e)}")
    
    print(f"\n{'='*60}")
    print(f"✅ Indexing complete: {success_count}/{len(pdf_files)} files indexed")
    print(f"{'='*60}\n")
    
    return success_count > 0


def index_all_groups(force_reindex: bool = False):
    """Index all proposal groups found in PDF storage"""
    
    pdf_storage = Path(PDF_STORAGE_PATH)
    
    if not pdf_storage.exists():
        print(f"❌ PDF storage path not found: {pdf_storage}")
        return
    
    # Find all group folders
    group_folders = [d for d in pdf_storage.iterdir() if d.is_dir() and d.name.startswith("group_")]
    
    if not group_folders:
        print(f"❌ No group folders found in: {pdf_storage}")
        return
    
    print(f"\n🔍 Found {len(group_folders)} proposal groups")
    
    for group_folder in group_folders:
        try:
            # Extract group ID from folder name (e.g., "group_1" -> 1)
            group_id = int(group_folder.name.split("_")[1])
            index_proposal_group(group_id, force_reindex)
        except Exception as e:
            print(f"❌ Error processing {group_folder}: {str(e)}")


if __name__ == "__main__":
    import argparse
    
    parser = argparse.ArgumentParser(description="Index PDF proposals to ChromaDB")
    parser.add_argument(
        "--group-id",
        type=int,
        help="Index specific proposal group ID"
    )
    parser.add_argument(
        "--all",
        action="store_true",
        help="Index all proposal groups"
    )
    parser.add_argument(
        "--force",
        action="store_true",
        help="Force re-index even if already indexed"
    )
    
    args = parser.parse_args()
    
    if args.group_id:
        index_proposal_group(args.group_id, args.force)
    elif args.all:
        index_all_groups(args.force)
    else:
        print("Usage:")
        print("  Index specific group: python indexer.py --group-id 1")
        print("  Index all groups:     python indexer.py --all")
        print("  Force re-index:       python indexer.py --group-id 1 --force")
