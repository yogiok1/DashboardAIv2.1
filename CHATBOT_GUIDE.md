# 🤖 RAG Chatbot System - Complete Guide

## 📋 Arsitektur Sistem

```
┌─────────────┐      ┌──────────────┐      ┌───────────────┐      ┌──────────┐
│   Browser   │ ───> │   Laravel    │ ───> │ Python FastAPI│ ───> │  vLLM    │
│  (Livewire) │ <─── │  (Backend)   │ <─── │  (ChromaDB)   │ <─── │  API     │
└─────────────┘      └──────────────┘      └───────────────┘      └──────────┘
                             │
                             v
                     ┌──────────────┐
                     │  PostgreSQL  │
                     │   (Groups)   │
                     └──────────────┘
```

## 🚀 Setup & Installation

### 1. Python Service Setup

```bash
cd /var/www/DashboardAIv2/python-services
./setup.sh
```

### 2. Konfigurasi Environment

Edit file `.env` di folder `python-services`:

```env
# FastAPI Service Configuration
PORT=8000
HOST=0.0.0.0

# ChromaDB Configuration
CHROMA_DB_PATH=./chroma_data
COLLECTION_NAME=proposal_documents

# Embedding Model
EMBEDDING_MODEL=all-MiniLM-L6-v2

# PDF Storage Path
PDF_STORAGE_PATH=../storage/app/proposals

# OpenAI/vLLM API Configuration
VLLM_API_BASE=http://YOUR_VLLM_SERVER:8001/v1
VLLM_API_KEY=your-api-key-here
```

⚠️ **PENTING:** Update `VLLM_API_BASE` dengan URL vLLM server Anda!

### 3. Index PDF ke ChromaDB

Sebelum menggunakan chatbot, Anda perlu index PDF proposals:

```bash
cd /var/www/DashboardAIv2/python-services
source venv/bin/activate

# Index specific group
python indexer.py --group-id 1

# Index all groups
python indexer.py --all

# Force re-index (if files changed)
python indexer.py --group-id 1 --force
```

### 4. Start Python Service

```bash
cd /var/www/DashboardAIv2/python-services
./start.sh
```

Service akan berjalan di `http://localhost:8000`

**Untuk production, gunakan supervisor atau systemd:**

```bash
# Buat systemd service file
sudo nano /etc/systemd/system/rag-chatbot.service
```

Isi dengan:
```ini
[Unit]
Description=RAG Chatbot Service
After=network.target

[Service]
Type=simple
User=www-data
WorkingDirectory=/var/www/DashboardAIv2/python-services
ExecStart=/var/www/DashboardAIv2/python-services/venv/bin/python main.py
Restart=always

[Install]
WantedBy=multi-user.target
```

Kemudian:
```bash
sudo systemctl daemon-reload
sudo systemctl enable rag-chatbot
sudo systemctl start rag-chatbot
sudo systemctl status rag-chatbot
```

## 📖 Cara Menggunakan

### 1. Akses Chatbot

Buka: `http://72.61.215.182/chatbot`

### 2. Pilih Grup Proposal

- Klik tombol **"+"** di header chatbot
- Modal akan muncul dengan list grup proposal
- Pilih satu atau beberapa grup proposal
- Atau klik **"Pilih Semua"** untuk select all
- Klik **"Tutup"**

### 3. Mulai Chat

- Ketik pertanyaan Anda di input box
- Tekan Enter atau klik tombol kirim
- Chatbot akan:
  1. Query ChromaDB untuk konteks relevan dari PDF proposals
  2. Stream response dari vLLM API
  3. Tampilkan jawaban secara real-time

### 4. Fitur-fitur

- ✅ **Multi-group selection**: Pilih beberapa grup sekaligus
- ✅ **Streaming responses**: Jawaban muncul real-time
- ✅ **Context-aware**: Menggunakan RAG dari PDF proposals
- ✅ **Conversation history**: Menyimpan konteks percakapan
- ✅ **Clear chat**: Hapus history chat

## 🔧 API Endpoints (Python Service)

### Health Check
```bash
GET http://localhost:8000/health
```

### Chat (Streaming)
```bash
POST http://localhost:8000/chat
Content-Type: application/json

{
  "message": "Apa tema utama dari proposal ini?",
  "proposal_group_ids": [1, 2],
  "conversation_history": [
    {"role": "user", "content": "Halo"},
    {"role": "assistant", "content": "Halo! Ada yang bisa saya bantu?"}
  ]
}
```

### Query Documents (Testing RAG)
```bash
POST http://localhost:8000/query
Content-Type: application/json

{
  "query": "artificial intelligence",
  "proposal_group_ids": [1, 2],
  "top_k": 5
}
```

### Collection Info
```bash
GET http://localhost:8000/collection/info
```

Response:
```json
{
  "collection_name": "proposal_documents",
  "total_documents": 150,
  "embedding_model": "all-MiniLM-L6-v2"
}
```

## 📁 Struktur Folder

```
DashboardAIv2/
├── python-services/           # Python FastAPI service
│   ├── main.py               # Main FastAPI app
│   ├── indexer.py            # PDF indexing script
│   ├── requirements.txt      # Python dependencies
│   ├── setup.sh             # Setup script
│   ├── start.sh             # Start script
│   ├── .env                 # Configuration
│   ├── venv/                # Virtual environment
│   └── chroma_data/         # ChromaDB storage
│
├── app/
│   └── Livewire/
│       └── ChatbotInterface.php  # Chatbot component
│
├── resources/
│   └── views/
│       ├── admin/
│       │   └── chatbot.blade.php     # Chatbot page
│       └── livewire/
│           └── chatbot-interface.blade.php  # Chatbot UI
│
└── storage/
    └── app/
        └── proposals/        # PDF storage
            ├── group_1/
            ├── group_2/
            └── ...
```

## 🐛 Troubleshooting

### 1. Python Service Not Starting

```bash
# Check logs
cd /var/www/DashboardAIv2/python-services
source venv/bin/activate
python main.py
```

### 2. ChromaDB Error

```bash
# Clear and recreate collection
curl -X POST http://localhost:8000/collection/clear
```

### 3. PDF Not Indexed

```bash
# Check PDF path
ls -la /var/www/DashboardAIv2/storage/app/proposals/

# Re-index with force flag
python indexer.py --group-id 1 --force
```

### 4. vLLM Connection Error

- Check vLLM server is running
- Verify `VLLM_API_BASE` in `.env`
- Test connection:
  ```bash
  curl http://YOUR_VLLM_SERVER:8001/v1/models
  ```

### 5. CORS Error

Jika ada error CORS, pastikan Python service mengizinkan domain Laravel:

Edit `main.py`:
```python
app.add_middleware(
    CORSMiddleware,
    allow_origins=["http://72.61.215.182", "https://yourdomain.com"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
```

## 📊 Monitoring

### Check Service Status
```bash
# Systemd
sudo systemctl status rag-chatbot

# Manual
ps aux | grep "python main.py"

# Logs
tail -f /var/www/DashboardAIv2/python-services/logs/app.log
```

### Check ChromaDB Size
```bash
curl http://localhost:8000/collection/info
```

### Monitor Memory Usage
```bash
htop
# Filter by 'python'
```

## 🔒 Security Notes

1. **API Key**: Pastikan `VLLM_API_KEY` aman di `.env`
2. **Firewall**: Port 8000 sebaiknya tidak exposed ke public
3. **Reverse Proxy**: Gunakan nginx untuk proxy ke Python service
4. **Rate Limiting**: Implement rate limiting di Laravel

## 🎯 Next Steps / Improvements

- [ ] Add authentication untuk API endpoints
- [ ] Implement caching untuk RAG queries
- [ ] Add logging dan monitoring (Sentry, etc)
- [ ] Implement feedback system untuk improve RAG
- [ ] Add multi-language support
- [ ] Export chat history feature
- [ ] Add file upload untuk indexing on-the-fly

## 📞 Support

Jika ada masalah, check:
1. Python service logs
2. Laravel logs: `storage/logs/laravel.log`
3. Browser console untuk frontend errors

---

**Happy Chatting! 🚀**
