# RAG Chatbot Service

FastAPI-based microservice untuk RAG (Retrieval-Augmented Generation) chatbot menggunakan ChromaDB dan vLLM.

## Features

- 🤖 RAG-powered chatbot dengan ChromaDB
- 📄 PDF extraction dan indexing
- 🔄 Streaming responses via SSE
- 🎯 Multi-group proposal selection
- 🧮 Sentence-transformers untuk embedding

## Setup

1. **Install dependencies:**
   ```bash
   ./setup.sh
   ```

2. **Configure environment:**
   Edit `.env` file dengan konfigurasi vLLM API Anda

3. **Index PDFs:**
   ```bash
   source venv/bin/activate
   
   # Index specific group
   python indexer.py --group-id 1
   
   # Index all groups
   python indexer.py --all
   
   # Force re-index
   python indexer.py --group-id 1 --force
   ```

4. **Start service:**
   ```bash
   python main.py
   ```

## API Endpoints

### Health Check
```bash
GET /health
```

### Chat (with streaming)
```bash
POST /chat
Content-Type: application/json

{
  "message": "Apa tema utama dari proposal ini?",
  "proposal_group_ids": [1, 2],
  "conversation_history": [
    {
      "role": "user",
      "content": "Halo"
    },
    {
      "role": "assistant",
      "content": "Halo! Ada yang bisa saya bantu?"
    }
  ]
}
```

### Query Documents
```bash
POST /query
Content-Type: application/json

{
  "query": "artificial intelligence",
  "proposal_group_ids": [1, 2],
  "top_k": 5
}
```

### Collection Info
```bash
GET /collection/info
```

## Environment Variables

| Variable | Description | Default |
|----------|-------------|---------|
| PORT | Service port | 8000 |
| HOST | Service host | 0.0.0.0 |
| CHROMA_DB_PATH | ChromaDB storage path | ./chroma_data |
| COLLECTION_NAME | ChromaDB collection name | proposal_documents |
| EMBEDDING_MODEL | Sentence-transformers model | all-MiniLM-L6-v2 |
| PDF_STORAGE_PATH | PDF files location | ../storage/app/proposals |
| VLLM_API_BASE | vLLM API base URL | http://localhost:8001/v1 |
| VLLM_API_KEY | vLLM API key | - |

## Project Structure

```
python-services/
├── main.py              # FastAPI application
├── indexer.py           # PDF indexing script
├── requirements.txt     # Python dependencies
├── setup.sh            # Setup script
├── .env                # Configuration
└── chroma_data/        # ChromaDB storage
```

## Testing

```bash
# Test health
curl http://localhost:8000/health

# Test query
curl -X POST http://localhost:8000/query \
  -H "Content-Type: application/json" \
  -d '{
    "query": "penelitian AI",
    "proposal_group_ids": [1],
    "top_k": 3
  }'

# Test chat (streaming)
curl -X POST http://localhost:8000/chat \
  -H "Content-Type: application/json" \
  -d '{
    "message": "Jelaskan proposal ini",
    "proposal_group_ids": [1],
    "conversation_history": []
  }'
```
