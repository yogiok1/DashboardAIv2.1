#!/bin/bash

# Setup script untuk Python FastAPI service

echo "=========================================="
echo "🚀 Setting up RAG Chatbot Service"
echo "=========================================="

# Check Python version
echo "📌 Checking Python version..."
python3 --version

# Create virtual environment
echo "📦 Creating virtual environment..."
python3 -m venv venv

# Activate virtual environment
echo "✅ Activating virtual environment..."
source venv/bin/activate

# Upgrade pip
echo "⬆️  Upgrading pip..."
pip install --upgrade pip

# Install dependencies
echo "📥 Installing dependencies..."
pip install -r requirements.txt

# Create .env if not exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file..."
    cp .env.example .env
    echo "⚠️  Please update .env file with your configuration"
fi

# Create chroma_data directory
echo "📁 Creating ChromaDB directory..."
mkdir -p chroma_data

echo ""
echo "=========================================="
echo "✅ Setup Complete!"
echo "=========================================="
echo ""
echo "📋 Next steps:"
echo "1. Update .env file with your vLLM API endpoint"
echo "2. Activate virtual environment: source venv/bin/activate"
echo "3. Index PDFs: python indexer.py --group-id 1"
echo "4. Start service: python main.py"
echo ""
