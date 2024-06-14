# DocuChat Model Fine-Tuning

This project provides tools to fine-tune a BERT-based multilingual model for text classification and document search tasks.

## Overview

The project includes scripts and configurations to:
- Upload documents
- Extract text from various document formats
- Generate embeddings using a BERT-based model
- Fine-tune the model on specific tasks

## Directory Structure

DocuChat/

**backend/**: Contains the backend code and scripts for the project.
  - **app.py**: Main Flask app for handling requests.
  - **download_models.py**: Script to download models.
  - **fine_tune_model.py**: Script to fine-tune the model.
  - **models/**: Directory to store models.
  - **project_embeddings/**: Directory to store project embeddings.
  - **static/uploads/**: Directory to store uploaded files.
  - **templates/**: HTML templates.
  
- **vendor/**: Contains third-party libraries and frameworks.
  - **bootstrap/**: Bootstrap CSS and JS.
  - **font-awesome/**: FontAwesome CSS and JS.
  - **jquery/**: jQuery library.
  
- **public/**: Contains public assets.
  - **css/styles.css**: Custom styles.
  - **img/DocuChat-wide-Logo2.png**: Logo.
  - **img/types/**: File type icons.

## Installation

1. Clone the repository:

```bash
git clone https://github.com/LebToki/DocuChat.git
cd DocuChat/backend
```

Set up a virtual environment and install dependencies:
```bash
python -m venv .venv
source .venv/bin/activate # On Windows, use `.venv\\Scripts\\activate`
pip install -r requirements.txt
```
Download the model:
```bash
python download_models.py
```

Run the Flask app:

```bash
python app.py
```
The api is now available at http://localhost:5000/


Browse to your PHP Client installation
```php
https://localhost/DocuChat/frontend/
```

### Usage
- Upload Documents

- Navigate to upload.php to upload documents.
- Supported formats: PDF, DOCX, XLSX, PPTX, PPT, TXT.
- Manage Projects. Navigate to manage.php to create, delete, and manage projects.
- Generate embeddings for documents in a project.
- Ask Questions . Navigate to chat.php to interact with the documents.

- Fine-Tuning
The fine_tune_model.py script can be used to fine-tune the model on specific text data:
```
python fine_tune_model.py
```
Modify the texts and labels variables in fine_tune_model.py to include your data.
or simply use the manage.php visual interface

# Scripts

## app.py
Main Flask app for handling requests:

- Upload documents
- Generate embeddings
- Ask questions
- Manage projects

## download_models.py
Script to download and save models:

- Downloads model and tokenizer from the Hugging Face hub.
- Saves them in the models directory.

## fine_tune_model.py
Script to fine-tune the model:

- Fine-tunes on provided text data and labels.
- Saves the fine-tuned model in the fine-tuned-model directory.

# LICENSE
