#!/bin/bash

# Start FastAPI RAG Service
cd "$(dirname "$0")"

echo "=========================================="
echo "🚀 Starting RAG Chatbot Service"
echo "=========================================="

# Activate virtual environment
source venv/bin/activate

# Start the service
python main.py
