# DocuChat Model Fine-Tuning

## Introducing DocuChat

In today's fast-paced world, managing and interacting with various documents can be a daunting task. Imagine having a tool that not only simplifies this process but also enhances it using the power of Artificial Intelligence. Enter DocuChat, an innovative solution designed to revolutionize the way we handle documents.
DocuChat is a document-based chatbot that leverages advanced NLP models to provide intelligent responses based on the content of uploaded documents. This project consists of a PHP frontend and a Python backend.

## What is DocuChat?
DocuChat is a groundbreaking project that leverages the capabilities of Generative AI to analyze, interact with, and retrieve information from various types of documents, including PDFs, DOCX, PPT, and more. Whether you're a hobbyist, a beginner, or a professional, DocuChat offers a seamless and efficient way to manage your document needs.

# For Hobbyists and Beginners
Are you new to the world of Natural Language Processing (NLP) and AI? 

DocuChat is the perfect starting point for you. With a user-friendly interface and straightforward setup, you can quickly dive into the exciting world of AI and document management. Here's what you can expect:

- Easy Setup: 
Follow our simple installation guide to get started.

- Interactive Learning: 
Experiment with different document types and see how AI analyzes and retrieves information.

- Community Support: 
Join our growing community of hobbyists and beginners to share experiences, ask questions, and learn together.

# For Professionals
If you're a professional looking for a robust and reliable document management solution, DocuChat has got you covered. With advanced features and customizable options, you can tailor the tool to meet your specific needs. Here’s how DocuChat can benefit you:

- Efficiency: 
Save time by letting AI handle the heavy lifting of document analysis and information retrieval.

- Accuracy: 
Ensure precise and relevant information extraction with our fine-tuned models.

- Scalability: 
Easily integrate DocuChat into your existing workflows and scale it as your document management needs grow.

## Get Involved
We invite contributors and sponsors to join us in enhancing DocuChat. Your support and contributions can help us bring even more exciting features and improvements to the project. Whether you're a developer, a researcher, or a sponsor, there's a place for you in the DocuChat community.

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

- **public/**: Frontend code and assets.
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
