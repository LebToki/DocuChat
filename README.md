# 🚀 DocuChat - AI-Powered Document Chat System

<div align="center">

![DocuChat](https://img.shields.io/badge/DocuChat-AI%20Powered-blue?style=for-the-badge)
![Python](https://img.shields.io/badge/Python-3.11+-green?style=for-the-badge&logo=python)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple?style=for-the-badge&logo=php)
![License](https://img.shields.io/badge/License-MIT-yellow?style=for-the-badge)

**Transform your documents into an intelligent conversation partner**

[Features](#-features) • [Installation](#-installation) • [Usage](#-usage) • [Contributing](#-contributing)

</div>

---

## ✨ Overview

DocuChat is a cutting-edge **Retrieval-Augmented Generation (RAG)** system that transforms static documents into interactive, AI-powered knowledge bases. Upload your documents, ask questions, and get intelligent answers powered by advanced NLP models.

Whether you're a researcher analyzing papers, a student studying materials, or a professional managing documentation, DocuChat makes document interaction seamless and intelligent.

---

## 🌟 Features

### 🎨 Modern UI/UX
- **Beautiful Dark Theme** - Eye-friendly dark mode with modern gradients
- **Responsive Design** - Works perfectly on desktop, tablet, and mobile
- **Smooth Animations** - Polished transitions and micro-interactions
- **Intuitive Navigation** - Clean, user-friendly interface

### 💬 Enhanced Chat Interface
- **Real-time Chat** - Interactive conversation with your documents
- **Typing Indicators** - Visual feedback while AI processes your query
- **Message History** - View and manage your conversation history
- **Copy to Clipboard** - One-click copy for any message
- **Export Conversations** - Download chat history as text files
- **Markdown Support** - Rich text formatting in responses

### 📤 Advanced File Upload
- **Drag & Drop** - Intuitive file upload with drag-and-drop support
- **File Preview** - See file details before uploading
- **Progress Tracking** - Real-time upload progress indicators
- **Multiple Formats** - Support for PDF, DOCX, PPTX, XLSX, TXT
- **File Type Icons** - Visual file type identification

### 📁 Project Management
- **Organize Documents** - Group files into projects
- **Search Functionality** - Quickly find projects and files
- **Project Statistics** - View file counts and project details
- **Bulk Operations** - Manage multiple files efficiently
- **Quick Actions** - Generate embeddings and fine-tune models with one click

### 🤖 AI Capabilities
- **Semantic Search** - Find relevant information using embeddings
- **BERT-based Models** - Advanced NLP for document understanding
- **Fine-tuning Support** - Customize models for your specific use case
- **Multi-language Support** - Handle documents in multiple languages
- **Context-Aware Responses** - Answers based on document content

### 🔔 User Experience Enhancements
- **Toast Notifications** - Beautiful, non-intrusive notifications
- **Loading States** - Clear feedback during operations
- **Error Handling** - User-friendly error messages
- **Keyboard Shortcuts** - Power user features
- **Empty States** - Helpful guidance when no data exists

---

## 🛠️ Technology Stack

### Backend
- **Python 3.11+** - Core language
- **Flask** - Web framework
- **Transformers** - Hugging Face models
- **FAISS** - Vector similarity search
- **BERT** - Multilingual language model
- **PyTorch** - Deep learning framework

### Frontend
- **PHP 7.4+** - Server-side scripting
- **Bootstrap 5** - UI framework
- **JavaScript (ES6+)** - Interactive features
- **Font Awesome** - Icons
- **jQuery** - DOM manipulation

---

## 📦 Installation

### Prerequisites

- Python 3.11 or higher
- PHP 7.4 or higher
- Web server (Apache/Nginx) or PHP built-in server
- pip (Python package manager)
- Composer (for PHP dependencies, if needed)

### Step 1: Clone the Repository

```bash
git clone https://github.com/LebToki/DocuChat.git
cd DocuChat
```

### Step 2: Backend Setup

```bash
# Navigate to backend directory
cd backend

# Create virtual environment
python -m venv .venv

# Activate virtual environment
# On Linux/Mac:
source .venv/bin/activate
# On Windows:
.venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt

# Download required models
python download_models.py

# Set environment variables
export SECRET_KEY="your-secret-key-here"
export BACKEND_URL="http://localhost:8080"
export DOCUCHAT_USER="admin"
export DOCUCHAT_PASS="password"

# Run the Flask backend
python app.py
```

The backend will start on `http://localhost:8080`

### Step 3: Frontend Setup

```bash
# Navigate back to project root
cd ..

# Configure backend URL in config.php
# Edit public/src/views/config.php or set BACKEND_URL environment variable

# Using PHP built-in server
php -S localhost:8000 -t public

# Or configure with your web server (Apache/Nginx)
# Point document root to the 'public' directory
```

### Step 4: Docker Setup (Alternative)

```bash
# Build and run with Docker Compose
docker-compose up --build
```

---

## 🚀 Usage

### 1. Create a Project

1. Navigate to **Manage Projects**
2. Enter a project name
3. Click **Create Project**

### 2. Upload Documents

1. Go to **Upload Document**
2. Select your project
3. Drag & drop or browse for files
4. Supported formats: PDF, DOCX, PPTX, XLSX, TXT

### 3. Generate Embeddings

1. In **Manage Projects**, select your project
2. Click **Generate Embeddings**
3. Wait for processing to complete

### 4. Chat with Documents

1. Go to **Chat with Document**
2. Select your project
3. Type your question
4. Get AI-powered answers!

### 5. Fine-tune Model (Optional)

1. Select a project with documents
2. Click **Fine-Tune Model**
3. Wait for training to complete

---

## 📖 API Endpoints

### Projects
- `GET /projects` - List all projects
- `POST /projects` - Create a new project
- `DELETE /projects` - Delete a project

### Files
- `POST /upload` - Upload a document
- `DELETE /projects/<project_name>/files` - Delete a file

### Embeddings
- `POST /projects/<project_name>/generate_embeddings` - Generate embeddings

### Chat
- `POST /ask` - Ask a question about documents

### Model
- `POST /fine_tune` - Fine-tune the model

---

## 🎯 Use Cases

- **Research** - Analyze academic papers and research documents
- **Education** - Interactive study materials and Q&A
- **Business** - Document knowledge bases and FAQs
- **Legal** - Contract and legal document analysis
- **Technical** - API documentation and technical guides
- **Personal** - Organize and query personal documents

---

## 🏗️ Project Structure

```
DocuChat/
├── backend/
│   ├── app.py                 # Flask application
│   ├── download_models.py      # Model download script
│   ├── fine_tune_model.py     # Model fine-tuning script
│   ├── models/                # Stored models
│   ├── project_embeddings/    # Project embeddings
│   ├── static/
│   │   └── uploads/           # Uploaded files
│   └── requirements.txt       # Python dependencies
├── public/
│   ├── css/
│   │   └── styles.css         # Main stylesheet
│   ├── js/
│   │   ├── scripts.js         # Main JavaScript
│   │   └── utils.js           # Utility functions
│   ├── img/                   # Images and icons
│   └── src/
│       └── views/             # PHP views
├── docker-compose.yml         # Docker configuration
├── Dockerfile.backend         # Backend Dockerfile
├── Dockerfile.frontend        # Frontend Dockerfile
└── README.md                  # This file
```

---

## 🔧 Configuration

### Environment Variables

```bash
# Backend
SECRET_KEY=your-secret-key-here
BACKEND_URL=http://localhost:8080
DOCUCHAT_USER=admin
DOCUCHAT_PASS=password
ALLOWED_ORIGINS=*

# Frontend (in config.php)
BACKEND_URL=http://localhost:8080
```

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/amazing-feature`)
3. **Commit your changes** (`git commit -m 'Add some amazing feature'`)
4. **Push to the branch** (`git push origin feature/amazing-feature`)
5. **Open a Pull Request**

### Contribution Guidelines

- Follow the existing code style
- Add comments for complex logic
- Update documentation as needed
- Write clear commit messages
- Test your changes thoroughly

---

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 🙏 Acknowledgments

- **Hugging Face** - For the Transformers library and models
- **Facebook AI Research** - For FAISS
- **Bootstrap** - For the UI framework
- **Font Awesome** - For icons

---

## 📞 Support

- **Issues** - [GitHub Issues](https://github.com/LebToki/DocuChat/issues)
- **Discussions** - [GitHub Discussions](https://github.com/LebToki/DocuChat/discussions)

---

## 🌟 Star History

If you find this project useful, please consider giving it a ⭐ on GitHub!

---

<div align="center">

**Made with ❤️ by the DocuChat Team**

[⬆ Back to Top](#-docuchat---ai-powered-document-chat-system)

</div>
