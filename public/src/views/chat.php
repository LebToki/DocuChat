<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat with Document - DocuChat</title>
	<link rel="stylesheet" href="../../../../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../../vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" href="../../../public/css/styles.css">
	<style>
      .chat-container {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
          background-color: #f8f9fa;
          border-radius: 10px;
      }

      .user-message,
      .bot-message {
          margin-bottom: 15px;
          padding: 10px 15px;
          border-radius: 10px;
          max-width: 75%;
      }

      .user-message {
          background-color: #2F2F2F;
          text-align: right;
          margin-left: auto;
      }

      .bot-message {
          background-color: #0D0D0D;
          text-align: left;
          margin-right: auto;
      }

      .message-content {
          margin: 0;
      }
	</style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<div class="container-fluid">
		<a class="navbar-brand" href="./../../../../index.php">
			<img src="./../../../public/img/DocuChat-wide-Logo2.png" alt="DocuChat Logo" style="width: 200px;"><br>
		</a>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				
				<li class="nav-item">
					<a class="nav-link" href="chat.php">Chat with Document</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="upload.php">Upload Document</a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link" href="manage.php">Manage Projects</a>
				</li>
				
			</ul>
		</div>
	</div>
</nav>
<div class="container mt-5">
	<h1>Chat with Document</h1>
	
	<div id="chatbox" class="chat-container"></div>
	<form id="chat-form" class="mb-4">
		<div class="mb-3">
			<label for="project" class="form-label">Select Project</label>
			<select class="form-select" id="project" name="project" required>
				<!-- Options will be populated dynamically -->
			</select>
		</div>
		<div class="mb-3">
			<label for="user-input" class="form-label">Your Question</label>
			<input type="text" class="form-control" id="user-input" placeholder="Type your message..." required>
		</div>
		<button type="submit" class="btn btn-primary">Ask</button>
	</form>
</div>
<script src="../../../../vendor/jquery/jquery.js"></script>
<script src="../../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
    function appendMessage(message, messageType) {
        const messageElement = document.createElement('div');
        messageElement.classList.add(messageType);
        const messageContent = document.createElement('p');
        messageContent.classList.add('message-content');
        messageContent.textContent = message;
        messageElement.appendChild(messageContent);
        document.getElementById('chatbox').appendChild(messageElement);
        messageElement.scrollIntoView();
    }

    function loadProjects() {
        fetch('http://localhost:8080/projects')
            .then(response => response.json())
            .then(data => {
                const projectSelect = document.getElementById('project');
                projectSelect.innerHTML = '';
                data.projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.project;
                    option.textContent = project.project;
                    projectSelect.appendChild(option);
                });
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        loadProjects();

        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();

            const userMessage = document.getElementById('user-input').value;
            const project = document.getElementById('project').value;

            appendMessage(userMessage, 'user-message');
            document.getElementById('user-input').value = '';

            fetch('http://localhost:8080/ask', {
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
                    appendMessage(data.response, 'bot-message');
                })
                .catch(error => console.error('Error:', error));
        });
    });
</script>
</body>

</html>
