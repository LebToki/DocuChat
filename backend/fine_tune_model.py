import os
from transformers import AutoTokenizer, AutoModelForSequenceClassification, Trainer, TrainingArguments
from datasets import load_dataset, Dataset

class ModelFineTuner:
    def __init__(self, model_name='bert-base-multilingual-cased', output_dir='./fine-tuned-model'):
        self.model_name = model_name
        self.output_dir = output_dir
        self.tokenizer = AutoTokenizer.from_pretrained(self.model_name)
        self.model = AutoModelForSequenceClassification.from_pretrained(self.model_name, num_labels=2)
        self.training_args = TrainingArguments(
            output_dir='./results',
            eval_strategy="epoch",
            learning_rate=2e-5,
            per_device_train_batch_size=8,
            per_device_eval_batch_size=8,
            num_train_epochs=3,
            weight_decay=0.01,
        )

    def preprocess_function(self, examples):
        return self.tokenizer(examples['text'], truncation=True, padding=True)

    def fine_tune(self, texts, labels):
        dataset = Dataset.from_dict({"text": texts, "label": labels})
        tokenized_dataset = dataset.map(self.preprocess_function, batched=True)

        trainer = Trainer(
            model=self.model,
            args=self.training_args,
            train_dataset=tokenized_dataset,
            eval_dataset=tokenized_dataset,
        )

        trainer.train()
        self.save_model()

    def save_model(self):
        self.model.save_pretrained(self.output_dir)
        self.tokenizer.save_pretrained(self.output_dir)

if __name__ == "__main__":
    texts = ["Your text data here..."]  # Replace with your actual data
    labels = [0]  # Replace with actual labels if available
    fine_tuner = ModelFineTuner()
    fine_tuner.fine_tune(texts, labels)
