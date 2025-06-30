
<?php require_once "auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Projects - DocuChat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <style>
        .file-container {
            position: relative;
        }

        .file-container .delete-file {
            position: absolute;
            top: 0;
            right: 0;
            color: red;
            cursor: pointer;
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
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>Manage Projects</h1>
        <div class="mb-3">
            <label for="new-project" class="form-label">New Project Name</label>
            <input type="text" class="form-control" id="new-project" required>
            <button class="btn btn-primary mt-2" onclick="createProject()">Create Project</button>
        </div>
        <div class="mb-3">
            <label for="existing-projects" class="form-label">Existing Projects</label>
            <select class="form-select" id="existing-projects">
                <!-- Options will be populated dynamically -->
            </select>
            <button class="btn btn-danger mt-2" onclick="deleteProject()">Delete Project</button>
        </div>
        <div class="mb-3">
            <label for="project" class="form-label">Select Project to Generate Embeddings</label>
            <select class="form-select" id="generate-embeddings-projects">
                <!-- Options will be populated dynamically -->
            </select>
            <button class="btn btn-success mt-2" onclick="generateEmbeddings()">Generate Embeddings</button>
        </div>
        <div class="mb-3">
            <button id="fine-tune-button" class="btn btn-warning mt-2">Fine-Tune Model</button>
        </div>
        <script>
            document.getElementById('fine-tune-button').addEventListener('click', function() {
                const projectName = document.getElementById('generate-embeddings-projects').value;
                fetch('<?php echo BACKEND_URL; ?>/fine_tune', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ project: projectName })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Model fine-tuned successfully.');
                    } else {
                        alert('Error fine-tuning model: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error fine-tuning model.');
                });
            });
        </script>
        <div id="manage-status" class="mt-3"></div>
        <div id="projects-list" class="row mt-5">
            <!-- Project cards will be populated dynamically -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function createProject() {
            var projectName = document.getElementById("new-project").value;
            fetch('<?php echo BACKEND_URL; ?>/projects', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project: projectName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    $('#manage-status').html('<div class="alert alert-success">Project created successfully.</div>');
                    loadProjects();
                } else {
                    $('#manage-status').html('<div class="alert alert-danger">' + data.status + '</div>');
                }
            });
        }

        function deleteProject() {
            var projectName = document.getElementById("existing-projects").value;
            fetch('<?php echo BACKEND_URL; ?>/projects', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project: projectName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    $('#manage-status').html('<div class="alert alert-success">Project deleted successfully.</div>');
                    loadProjects();
                } else {
                    $('#manage-status').html('<div class="alert alert-danger">' + data.status + '</div>');
                }
            });
        }

        function generateEmbeddings() {
            var projectName = document.getElementById("generate-embeddings-projects").value;
            fetch(`<?php echo BACKEND_URL; ?>/projects/${projectName}/generate_embeddings`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'Embeddings regenerated for project') {
                    $('#manage-status').html('<div class="alert alert-success">Embeddings generated successfully.</div>');
                } else {
                    $('#manage-status').html('<div class="alert alert-danger">' + data.status + '</div>');
                }
            });
        }

        function deleteFile(projectName, fileName) {
            fetch(`<?php echo BACKEND_URL; ?>/projects/${projectName}/files`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ file: fileName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    $('#manage-status').html('<div class="alert alert-success">File deleted successfully.</div>');
                    loadProjects();
                } else {
                    $('#manage-status').html('<div class="alert alert-danger">' + data.status + '</div>');
                }
            });
        }

        function loadProjects() {
            fetch('<?php echo BACKEND_URL; ?>/projects')
            .then(response => response.json())
            .then(data => {
                const projectSelect = document.getElementById('existing-projects');
                const generateEmbeddingsSelect = document.getElementById('generate-embeddings-projects');
                const projectsList = document.getElementById('projects-list');
                projectSelect.innerHTML = '';
                generateEmbeddingsSelect.innerHTML = '';
                projectsList.innerHTML = '';
                data.projects.forEach(project => {
                    const option = document.createElement('option');
                    option.value = project.project;
                    option.textContent = project.project;
                    projectSelect.appendChild(option);
                    generateEmbeddingsSelect.appendChild(option.cloneNode(true));

                    const card = document.createElement('div');
                    card.classList.add('col-md-4', 'mb-4');
                    card.innerHTML = `
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">${project.project}</h5>
                            </div>
                            <div class="card-body">
                                ${project.files.map(file => `
                                    <div class="file-container d-flex align-items-center mb-2">
                                        <img src="${getFileTypeIcon(file)}" alt="File Icon" class="me-2" style="width: 30px; height: 30px;">
                                        <span>${file}</span>
                                        <span class="delete-file" onclick="deleteFile('${project.project}', '${file}')">&times;</span>
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;
                    projectsList.appendChild(card);
                });
            });
        }

        function getFileTypeIcon(filename) {
            const ext = filename.split('.').pop().toLowerCase();
            switch (ext) {
                case 'pdf': return './../../../public/img/types/pdf.png';
                case 'docx': return './../../../public/img/types/docx.png';
                case 'xlsx': return './../../../public/img/types/xlsx.png';
                case 'ppt': return './../../../public/img/types/ppt.png';
                case 'pptx': return './../../../public/img/types/pptx.png';
                case 'txt': return './../../../public/img/types/txt.png';
                default: return './../../../public/img/types/default.png';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadProjects();
        });
    </script>
</body>

</html>
