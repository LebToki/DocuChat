document.addEventListener('DOMContentLoaded', function() {
    const modelBadge = document.getElementById('model-badge');
    const modelSelect = document.getElementById('model-select');
    const projectSelect = document.getElementById('project-select');
    const chatForm = document.getElementById('chat-form');
    const userInput = document.getElementById('user-input');
    const fileButton = document.getElementById('file-button');
    const filePreview = document.getElementById('file-preview');
    let uploadedFile = null;

    function updateModelStatus() {
        axios.get('/src/Models/models.json')
            .then(function(response) {
                const models = response.data;
                if (models && models.length > 0) {
                    modelSelect.innerHTML = '';
                    models.forEach(function(model) {
                        const option = document.createElement('option');
                        option.value = model.name;
                        option.textContent = model.name;
                        modelSelect.appendChild(option);
                    });

                    const defaultModel = localStorage.getItem('defaultModel') || models[0].name;
                    modelBadge.textContent = `${defaultModel} (Loading...)`;
                    modelSelect.value = defaultModel;
                    checkModelStatus(defaultModel);
                } else {
                    modelBadge.textContent = 'No models available';
                }
            })
            .catch(function(error) {
                modelBadge.textContent = 'Error loading models';
                console.error('Failed to fetch models:', error);
            });
    }

    function checkModelStatus(model) {
        axios.post('/src/Controllers/ChatController.php', { message: '', model: model })
            .then(function(response) {
                const data = response.data;
                if (data.error) {
                    modelBadge.textContent = `${model} (Loading...)`;
                } else {
                    modelBadge.textContent = `${model} (Ready)`;
                }
            })
            .catch(function(error) {
                modelBadge.textContent = 'Error checking model status';
                console.error('Error during POST request:', error);
            });
    }

    modelSelect.addEventListener('change', function() {
        const selectedModel = modelSelect.value;
        localStorage.setItem('defaultModel', selectedModel);
        modelBadge.textContent = `${selectedModel} (Loading...)`;
        checkModelStatus(selectedModel);
    });

    updateModelStatus();

    chatForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const userMessage = userInput.value.trim();
        const projectName = projectSelect.value;
        if (userMessage || uploadedFile) {
            if (userMessage) {
                appendMessage(userMessage, 'user-message');
                userInput.value = '';
            }
            const formData = new FormData();
            formData.append('message', userMessage);
            formData.append('model', modelSelect.value);
            if (uploadedFile) {
                formData.append('file', uploadedFile);
            }

            axios.post(`/projects/${encodeURIComponent(projectName)}/generate_embeddings`, formData)
                .then(function(response) {
                    appendBotMessage(response.data.response);
                    filePreview.style.display = 'none';
                    uploadedFile = null;
                })
                .catch(function(error) {
                    appendMessage('Error: ' + error.message, 'bot-message');
                });
        }
    });

    function appendMessage(message, messageType) {
        const messageElement = document.createElement('div');
        messageElement.classList.add(messageType);
        messageElement.innerHTML = message;
        document.getElementById('chatbox').appendChild(messageElement);
        messageElement.scrollIntoView();
    }

    function appendBotMessage(response) {
        const responseContainer = document.createElement('div');
        responseContainer.classList.add('response-container');

        const contextText = document.createElement('div');
        contextText.innerHTML = 'Based on the embeddings, the best match for your question is:';
        responseContainer.appendChild(contextText);

        const responseElement = document.createElement('div');
        responseElement.classList.add('bot-message');
        responseElement.innerHTML = formatResponse(response);
        responseContainer.appendChild(responseElement);

        document.getElementById('chatbox').appendChild(responseContainer);
        responseContainer.scrollIntoView();
    }

    function formatResponse(response) {
        if (response.includes('Key Cast:')) {
            const listItems = response.split('Key Cast:')[1].trim().split(', ').map(item => `<li>${item}</li>`).join('');
            return `<ul>${listItems}</ul>`;
        }
        return response;
    }

    fileButton.addEventListener('click', function() {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,text/plain';
        fileInput.style.display = 'none';
        fileInput.addEventListener('change', function() {
            const file = fileInput.files[0];
            if (file) {
                filePreview.style.display = 'flex';
                filePreview.innerHTML = `<span>${file.name}</span><button class="delete-file">Delete</button>`;
                uploadedFile = file;
            }
        });
        document.body.appendChild(fileInput);
        fileInput.click();
    });

    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('delete-file')) {
            filePreview.style.display = 'none';
            uploadedFile = null;
        }
    });
});
