# DocuChat Model Fine-Tuning

DocuChat is a document-based chatbot that leverages advanced NLP models to provide intelligent responses based on the content of uploaded documents. This project consists of a PHP frontend and a Python backend.

## Overview

The project includes scripts and configurations to:
- Upload documents
- Extract text from various document formats
- Generate embeddings using a BERT-based model
- Fine-tune the model on specific tasks

## Project Structure

**backend/**: Contains the backend code and scripts for the project.
- **app.py**: Main Flask app for handling requests.
- **download_models.py**: Script to download models.
- **fine_tune_model.py**: Script to fine-tune the model.
- **models/**: Directory to store models.
  - **bert-base-multilingual-cased/**: Directory for the bert-base-multilingual-cased model.
- **project_embeddings/**: Directory to store project embeddings.
  - **YourProjectName/**: Your Own Projects Embeddings will be created here
- **results/**: Directory to store fine-tuning results.
- **static/**: Directory for static files.
  - **embeddings/**: Directory to store generated embeddings.
- **YourProjectName/**: Your Own Projects Embeddings will be created here
  - **uploads/**: Directory to store uploaded files.
  - **YourProjectName/**: Your Own Projects Embeddings will be created here

- **templates/**: HTML templates.
- **__pycache__/**: Python cache files.

**frontend/**: Contains the frontend code and assets.
- **public/**: Public assets for the frontend.
  - **css/**: Custom styles.
  - **img/**: Images for the frontend.
    - **types/**: File type icons.
  - **js/**: JavaScript files.
  - **src/**: Source files for the frontend.
    - **views/**: Views for the frontend.

**vendor/**: Contains third-party libraries and frameworks.
- **bootstrap/**: Bootstrap CSS and JS.
- **font-awesome/**: FontAwesome CSS and JS.
- **jquery/**: jQuery library.

## Requirements

### Backend (Python)
- Python 3.11
- Flask
- Flask-CORS
- pdfminer.six
- python-docx
- openpyxl
- python-pptx
- transformers
- faiss
- langdetect
- torch

### Frontend (PHP)
- PHP 7.4+
- Bootstrap
- FontAwesome
- jQuery

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


## Browse to your PHP Client installation
or if you are using a pretty url then use the local domain template and browse to the correct project domain using your browser.
```php
https://localhost/DocuChat/frontend/
```

## Setup Simplified Steps

### Backend

1. Create a virtual environment and activate it:
   ```sh
   python -m venv .venv
   source .venv/bin/activate  # On Windows, use `.venv\Scripts\activate`
   ```
# Install the required Python packages:

```sh
pip install -r requirements.txt
```
# Download the necessary models by running:

```sh
python backend/download_models.py
```
# Run the Flask app:

```sh
python backend/app.py
```
# Frontend
Ensure you have a local server setup (e.g., XAMPP, Laragon).

Place the PHP files in the appropriate directory of your server.
Open the project in your browser.

# Usage
- Upload documents through the frontend interface.
- Ask questions related to the uploaded documents.
- The backend will process the documents, generate embeddings, and provide relevant responses based on the content.

# Fine-Tuning
To fine-tune the model, run the following script:
```
python backend/fine_tune_model.py

```
# Contributing
Contributions are welcome! Please submit a pull request or open an issue for any improvements or bugs.
