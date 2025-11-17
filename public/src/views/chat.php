
<?php require_once "auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat with Document - DocuChat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../../public/css/styles.css">
	<style>
      .chat-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          padding: 1rem 1.5rem;
          border-bottom: 1px solid var(--dark-border);
          background: var(--dark-surface);
      }

      .chat-actions {
          display: flex;
          gap: 0.5rem;
      }

      .chat-actions button {
          padding: 0.5rem;
          background: transparent;
          border: 1px solid var(--dark-border);
          color: var(--text-secondary);
          border-radius: 8px;
          cursor: pointer;
          transition: var(--transition);
      }

      .chat-actions button:hover {
          color: var(--primary-color);
          border-color: var(--primary-color);
          background: rgba(1, 183, 198, 0.1);
      }

      #chatbox {
          display: flex;
          flex-direction: column;
      }

      #messages {
          flex: 1;
          overflow-y: auto;
          padding: 1.5rem;
      }

      .message-wrapper {
          display: flex;
          margin-bottom: 1rem;
          animation: slideIn 0.3s ease-out;
      }

      .message-wrapper.user {
          justify-content: flex-end;
      }

      .message-wrapper.bot {
          justify-content: flex-start;
      }

      .user-message, .bot-message {
          position: relative;
          padding: 1rem 1.25rem;
          border-radius: 16px;
          max-width: 75%;
          word-wrap: break-word;
      }

      .user-message {
          background: var(--gradient-primary);
          color: white;
          border-bottom-right-radius: 4px;
          box-shadow: var(--shadow-md);
      }

      .bot-message {
          background: var(--dark-surface-hover);
          color: var(--text-primary);
          border: 1px solid var(--dark-border);
          border-bottom-left-radius: 4px;
      }

      .message-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 0.5rem;
      }

      .message-content {
          margin: 0;
          line-height: 1.6;
      }

      .message-actions {
          display: flex;
          gap: 0.5rem;
          margin-top: 0.5rem;
          opacity: 0;
          transition: var(--transition);
      }

      .message-wrapper:hover .message-actions {
          opacity: 1;
      }

      .message-actions button {
          padding: 0.25rem 0.5rem;
          background: rgba(255, 255, 255, 0.1);
          border: none;
          border-radius: 6px;
          color: inherit;
          cursor: pointer;
          font-size: 0.875rem;
          transition: var(--transition);
      }

      .message-actions button:hover {
          background: rgba(255, 255, 255, 0.2);
      }

      .typing-indicator {
          display: none;
          padding: 1rem 1.25rem;
          color: var(--text-secondary);
      }

      .typing-indicator.active {
          display: block;
      }

      .typing-dots {
          display: inline-block;
      }

      .typing-dots span {
          display: inline-block;
          width: 8px;
          height: 8px;
          border-radius: 50%;
          background: var(--text-secondary);
          margin: 0 2px;
          animation: typing 1.4s infinite;
      }

      .typing-dots span:nth-child(2) {
          animation-delay: 0.2s;
      }

      .typing-dots span:nth-child(3) {
          animation-delay: 0.4s;
      }

      @keyframes typing {
          0%, 60%, 100% {
              transform: translateY(0);
          }
          30% {
              transform: translateY(-10px);
          }
      }

      .empty-state {
          text-align: center;
          padding: 3rem;
          color: var(--text-secondary);
      }

      .empty-state i {
          font-size: 4rem;
          margin-bottom: 1rem;
          opacity: 0.5;
      }

      .chat-input-container {
          padding: 1.5rem;
          border-top: 1px solid var(--dark-border);
          background: var(--dark-surface);
      }

      .input-group-text {
          background: var(--dark-surface-hover);
          border: 1px solid var(--dark-border);
          color: var(--text-secondary);
      }
	</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="./../../../../index.php">
			<img src="./../../../public/img/DocuChat-wide-Logo2.png" alt="DocuChat Logo" style="width: 200px;"><br>
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="chat.php">Chat with Document</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="upload.php">Upload Document</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="manage.php">Manage Projects</a>
				</li>
				<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container mt-5">
	<div class="d-flex justify-content-between align-items-center mb-4">
		<div>
			<h1 class="text-gradient mb-2">Chat with Document</h1>
			<p class="text-secondary">Ask questions about your uploaded documents</p>
		</div>
	</div>
	
	<div class="mb-3">
		<label for="project" class="form-label">
			<i class="fas fa-folder me-2"></i>Select Project
		</label>
		<select class="form-select" id="project" name="project" required>
			<option value="">Loading projects...</option>
		</select>
	</div>

	<div id="chatbox" class="card">
		<div class="chat-header">
			<div>
				<strong>Chat</strong>
				<span class="badge bg-primary ms-2" id="message-count">0 messages</span>
			</div>
			<div class="chat-actions">
				<button type="button" onclick="clearChat()" title="Clear Chat">
					<i class="fas fa-trash"></i>
				</button>
				<button type="button" onclick="exportChat()" title="Export Chat">
					<i class="fas fa-download"></i>
				</button>
			</div>
		</div>
		<div id="messages"></div>
		<div class="typing-indicator" id="typing-indicator">
			<div class="typing-dots">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<span class="ms-2">AI is thinking...</span>
		</div>
		<div class="chat-input-container">
			<form id="chat-form">
				<div class="input-group">
					<input type="text" class="form-control" id="user-input" placeholder="Type your question here... (Press Enter to send)" autocomplete="off">
					<button type="submit" class="btn btn-primary" id="send-button">
						<i class="fas fa-paper-plane"></i> Send
					</button>
				</div>
				<small class="text-secondary mt-2 d-block">
					<i class="fas fa-keyboard me-1"></i>Press Enter to send, Shift+Enter for new line
				</small>
			</form>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../public/js/utils.js"></script>
<script>
    let chatHistory = [];
    const BACKEND_URL = '<?php echo BACKEND_URL; ?>';

    function appendMessage(message, messageType, rawHtml = false) {
        const messagesContainer = document.getElementById('messages');
        
        // Remove empty state if exists
        const emptyState = messagesContainer.querySelector('.empty-state');
        if (emptyState) emptyState.remove();

        const messageWrapper = document.createElement('div');
        messageWrapper.className = `message-wrapper ${messageType === 'user-message' ? 'user' : 'bot'}`;
        
        const messageElement = document.createElement('div');
        messageElement.classList.add(messageType);
        
        const messageHeader = document.createElement('div');
        messageHeader.className = 'message-header';
        messageHeader.innerHTML = `
            <span style="font-size: 0.75rem; opacity: 0.8;">
                ${messageType === 'user-message' ? '<i class="fas fa-user me-1"></i>You' : '<i class="fas fa-robot me-1"></i>DocuChat'}
            </span>
            <span class="message-time" style="font-size: 0.75rem; opacity: 0.7;">${formatTime()}</span>
        `;
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        if (rawHtml) {
            messageContent.innerHTML = message;
        } else {
            messageContent.textContent = message;
        }
        
        const messageActions = document.createElement('div');
        messageActions.className = 'message-actions';
        messageActions.innerHTML = `
            <button type="button" onclick="copyMessage(this)" title="Copy">
                <i class="fas fa-copy"></i>
            </button>
        `;
        
        messageElement.appendChild(messageHeader);
        messageElement.appendChild(messageContent);
        messageElement.appendChild(messageActions);
        messageWrapper.appendChild(messageElement);
        messagesContainer.appendChild(messageWrapper);
        
        // Scroll to bottom
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
        
        // Update message count
        updateMessageCount();
        
        // Store in history
        chatHistory.push({ type: messageType, content: message, time: new Date() });
        
        return messageWrapper;
    }

    function copyMessage(button) {
        const messageContent = button.closest('.message-wrapper').querySelector('.message-content');
        const text = messageContent.textContent || messageContent.innerText;
        copyToClipboard(text);
    }

    function updateMessageCount() {
        const count = document.querySelectorAll('.message-wrapper').length;
        document.getElementById('message-count').textContent = `${count} ${count === 1 ? 'message' : 'messages'}`;
    }

    function clearChat() {
        if (confirm('Are you sure you want to clear the chat history?')) {
            document.getElementById('messages').innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-comments"></i>
                    <p>No messages yet. Start a conversation!</p>
                </div>
            `;
            chatHistory = [];
            updateMessageCount();
            Toast.info('Chat cleared');
        }
    }

    function exportChat() {
        const messages = Array.from(document.querySelectorAll('.message-wrapper'));
        if (messages.length === 0) {
            Toast.warning('No messages to export');
            return;
        }
        exportChatHistory(messages);
    }

    function showTypingIndicator() {
        document.getElementById('typing-indicator').classList.add('active');
    }

    function hideTypingIndicator() {
        document.getElementById('typing-indicator').classList.remove('active');
    }

    function loadProjects() {
        fetch(`${BACKEND_URL}/projects`)
            .then(response => response.json())
            .then(data => {
                const projectSelect = document.getElementById('project');
                projectSelect.innerHTML = '';
                
                if (data.projects && data.projects.length > 0) {
                    data.projects.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.project;
                        option.textContent = `${project.project} (${project.files.length} files)`;
                        projectSelect.appendChild(option);
                    });
                } else {
                    projectSelect.innerHTML = '<option value="">No projects available. Create one first!</option>';
                }
            })
            .catch(error => {
                console.error('Error loading projects:', error);
                Toast.error('Failed to load projects');
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadProjects();

        // Initialize empty state
        document.getElementById('messages').innerHTML = `
            <div class="empty-state">
                <i class="fas fa-comments"></i>
                <p>No messages yet. Start a conversation!</p>
            </div>
        `;

        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const sendButton = document.getElementById('send-button');

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();
            sendMessage();
        });

        // Handle Enter key (Shift+Enter for new line)
        userInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            const userMessage = userInput.value.trim();
            const project = document.getElementById('project').value;

            if (!userMessage) {
                Toast.warning('Please enter a message');
                return;
            }

            if (!project) {
                Toast.warning('Please select a project');
                return;
            }

            // Append user message
            appendMessage(userMessage, 'user-message');
            userInput.value = '';
            
            // Disable input
            userInput.disabled = true;
            sendButton.disabled = true;
            LoadingState.show(sendButton, 'Sending...');
            showTypingIndicator();

            // Send to backend
            fetch(`${BACKEND_URL}/ask`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    question: userMessage,
                    project: project
                })
            })
                .then(response => response.json())
                .then(data => {
                    hideTypingIndicator();
                    if (data.response) {
                        appendMessage(data.response, 'bot-message', true);
                    } else {
                        Toast.error('No response received');
                    }
                })
                .catch(error => {
                    hideTypingIndicator();
                    console.error('Error:', error);
                    Toast.error('Failed to get response. Please try again.');
                })
                .finally(() => {
                    userInput.disabled = false;
                    sendButton.disabled = false;
                    LoadingState.hide(sendButton);
                    userInput.focus();
                });
        }

        // Focus input on load
        userInput.focus();
    });
</script>
</body>

</html>
