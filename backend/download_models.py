import os
from transformers import AutoModel, AutoTokenizer

def download_model(model_name, model_dir):
    # Ensure the directory exists
    if not os.path.exists(model_dir):
        os.makedirs(model_dir)

    # Download and save the tokenizer and model
    print(f"Downloading and saving {model_name} tokenizer and model to {model_dir}...")
    tokenizer = AutoTokenizer.from_pretrained(model_name)
    model = AutoModel.from_pretrained(model_name)

    tokenizer.save_pretrained(model_dir)
    model.save_pretrained(model_dir)

    print(f"{model_name} downloaded and saved successfully.")

if __name__ == "__main__":
    models_to_download = [
        "bert-base-multilingual-cased",  # Example model
        # Add more model names here
    ]

    base_model_dir = "models"

    for model_name in models_to_download:
        model_dir = os.path.join(base_model_dir, model_name.replace("/", "_"))
        download_model(model_name, model_dir)
