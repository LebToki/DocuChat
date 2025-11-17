
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
        .action-section {
            background: var(--dark-surface);
            border: 1px solid var(--dark-border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .project-card {
            transition: var(--transition);
            height: 100%;
        }

        .project-card:hover {
            transform: translateY(-4px);
        }

        .project-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .project-stats {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--dark-border);
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .stat-item i {
            color: var(--primary-color);
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            background: var(--dark-surface-hover);
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: var(--transition);
        }

        .file-item:hover {
            background: rgba(1, 183, 198, 0.1);
        }

        .file-item img {
            width: 32px;
            height: 32px;
        }

        .file-item-name {
            flex: 1;
            font-weight: 500;
            color: var(--text-primary);
        }

        .file-actions {
            display: flex;
            gap: 0.5rem;
        }

        .file-actions button {
            padding: 0.25rem 0.5rem;
            background: transparent;
            border: 1px solid var(--dark-border);
            color: var(--text-secondary);
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
        }

        .file-actions button:hover {
            color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-box input {
            padding-left: 2.5rem;
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

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .project-actions {
            display: flex;
            gap: 0.5rem;
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
                        <a class="nav-link" href="chat.php">Chat with Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Upload Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="manage.php">Manage Projects</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="text-gradient mb-2">Manage Projects</h1>
                <p class="text-secondary">Create, organize, and manage your document projects</p>
            </div>
        </div>

        <!-- Create Project Section -->
        <div class="action-section">
            <h5 class="mb-3">
                <i class="fas fa-plus-circle me-2" style="color: var(--primary-color);"></i>Create New Project
            </h5>
            <div class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" id="new-project" placeholder="Enter project name..." required>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary w-100" onclick="createProject()">
                        <i class="fas fa-plus me-2"></i>Create Project
                    </button>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="action-section">
            <h5 class="mb-3">
                <i class="fas fa-bolt me-2" style="color: var(--warning-color);"></i>Quick Actions
            </h5>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="existing-projects" class="form-label">Select Project</label>
                    <select class="form-select" id="existing-projects">
                        <option value="">Loading...</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="form-label d-block">&nbsp;</label>
                    <div class="action-buttons">
                        <button class="btn btn-danger" onclick="deleteProject()">
                            <i class="fas fa-trash me-2"></i>Delete Project
                        </button>
                        <button class="btn btn-success" onclick="generateEmbeddings()">
                            <i class="fas fa-brain me-2"></i>Generate Embeddings
                        </button>
                        <button class="btn btn-warning" id="fine-tune-button">
                            <i class="fas fa-cog me-2"></i>Fine-Tune Model
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div class="mb-4">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="form-control" id="search-projects" placeholder="Search projects...">
            </div>
        </div>

        <!-- Projects List -->
        <div id="projects-list" class="row">
            <!-- Project cards will be populated dynamically -->
        </div>

        <!-- Empty State -->
        <div id="empty-state" class="empty-state" style="display: none;">
            <i class="fas fa-folder-open"></i>
            <p>No projects found. Create your first project to get started!</p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../../public/js/utils.js"></script>
    <script>
        const BACKEND_URL = '<?php echo BACKEND_URL; ?>';
        let allProjects = [];

        function getFileTypeIcon(filename) {
            const ext = filename.split('.').pop().toLowerCase();
            const iconMap = {
                'pdf': './../../../public/img/types/pdf.png',
                'doc': './../../../public/img/types/doc.png',
                'docx': './../../../public/img/types/docx.png',
                'xls': './../../../public/img/types/xls.png',
                'xlsx': './../../../public/img/types/xls.png',
                'ppt': './../../../public/img/types/ppt.png',
                'pptx': './../../../public/img/types/pptx.png',
                'txt': './../../../public/img/types/txt.png'
            };
            return iconMap[ext] || './../../../public/img/types/default.png';
        }

        function createProject() {
            const projectName = document.getElementById("new-project").value.trim();
            if (!projectName) {
                Toast.warning('Please enter a project name');
                return;
            }

            const button = event.target;
            LoadingState.show(button, 'Creating...');

            fetch(`${BACKEND_URL}/projects`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project: projectName }),
            })
            .then(response => response.json())
            .then(data => {
                LoadingState.hide(button);
                if (data.status === 'success') {
                    Toast.success('Project created successfully!');
                    document.getElementById("new-project").value = '';
                    loadProjects();
                } else {
                    Toast.error(data.status || 'Failed to create project');
                }
            })
            .catch(error => {
                LoadingState.hide(button);
                console.error('Error:', error);
                Toast.error('Failed to create project');
            });
        }

        function deleteProject() {
            const projectName = document.getElementById("existing-projects").value;
            if (!projectName) {
                Toast.warning('Please select a project');
                return;
            }

            if (!confirm(`Are you sure you want to delete "${projectName}"? This action cannot be undone.`)) {
                return;
            }

            fetch(`${BACKEND_URL}/projects`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project: projectName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Toast.success('Project deleted successfully!');
                    loadProjects();
                } else {
                    Toast.error(data.status || 'Failed to delete project');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Toast.error('Failed to delete project');
            });
        }

        function generateEmbeddings() {
            const projectName = document.getElementById("generate-embeddings-projects").value;
            if (!projectName) {
                Toast.warning('Please select a project');
                return;
            }

            const button = event.target;
            LoadingState.show(button, 'Generating...');

            fetch(`${BACKEND_URL}/projects/${projectName}/generate_embeddings`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                LoadingState.hide(button);
                if (data.status === 'success') {
                    Toast.success('Embeddings generated successfully!');
                } else {
                    Toast.error(data.status || data.message || 'Failed to generate embeddings');
                }
            })
            .catch(error => {
                LoadingState.hide(button);
                console.error('Error:', error);
                Toast.error('Failed to generate embeddings');
            });
        }

        function deleteFile(projectName, fileName) {
            if (!confirm(`Delete "${fileName}" from "${projectName}"?`)) {
                return;
            }

            fetch(`${BACKEND_URL}/projects/${projectName}/files`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ file: fileName }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Toast.success('File deleted successfully!');
                    loadProjects();
                } else {
                    Toast.error(data.status || 'Failed to delete file');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Toast.error('Failed to delete file');
            });
        }

        function filterProjects(searchTerm) {
            const filtered = allProjects.filter(project => 
                project.project.toLowerCase().includes(searchTerm.toLowerCase()) ||
                project.files.some(file => file.toLowerCase().includes(searchTerm.toLowerCase()))
            );
            renderProjects(filtered);
        }

        function renderProjects(projects) {
            const projectsList = document.getElementById('projects-list');
            const emptyState = document.getElementById('empty-state');
            
            if (projects.length === 0) {
                projectsList.innerHTML = '';
                emptyState.style.display = 'block';
                return;
            }

            emptyState.style.display = 'none';
            projectsList.innerHTML = '';

            projects.forEach(project => {
                const card = document.createElement('div');
                card.classList.add('col-md-6', 'col-lg-4', 'mb-4');
                card.innerHTML = `
                    <div class="card project-card">
                        <div class="card-header">
                            <div class="project-header">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-folder me-2" style="color: var(--primary-color);"></i>
                                    ${project.project}
                                </h5>
                                <div class="project-actions">
                                    <button class="btn btn-sm btn-primary" onclick="selectProject('${project.project}')" title="Select">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="project-stats">
                                <div class="stat-item">
                                    <i class="fas fa-file"></i>
                                    <span>${project.files.length} ${project.files.length === 1 ? 'file' : 'files'}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            ${project.files.length > 0 ? `
                                <div style="max-height: 300px; overflow-y: auto;">
                                    ${project.files.map(file => `
                                        <div class="file-item">
                                            <img src="${getFileTypeIcon(file)}" alt="File Icon">
                                            <span class="file-item-name">${file}</span>
                                            <div class="file-actions">
                                                <button type="button" onclick="deleteFile('${project.project}', '${file}')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            ` : `
                                <div class="text-center text-secondary py-3">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">No files uploaded yet</p>
                                </div>
                            `}
                        </div>
                    </div>
                `;
                projectsList.appendChild(card);
            });
        }

        function selectProject(projectName) {
            document.getElementById('existing-projects').value = projectName;
            document.getElementById('generate-embeddings-projects').value = projectName;
            Toast.info(`Selected project: ${projectName}`);
        }

        function loadProjects() {
            fetch(`${BACKEND_URL}/projects`)
            .then(response => response.json())
            .then(data => {
                allProjects = data.projects || [];
                
                const projectSelect = document.getElementById('existing-projects');
                const generateEmbeddingsSelect = document.getElementById('generate-embeddings-projects');
                
                projectSelect.innerHTML = '';
                generateEmbeddingsSelect.innerHTML = '';
                
                if (allProjects.length > 0) {
                    allProjects.forEach(project => {
                        const option = document.createElement('option');
                        option.value = project.project;
                        option.textContent = `${project.project} (${project.files.length} files)`;
                        projectSelect.appendChild(option);
                        generateEmbeddingsSelect.appendChild(option.cloneNode(true));
                    });
                } else {
                    projectSelect.innerHTML = '<option value="">No projects available</option>';
                    generateEmbeddingsSelect.innerHTML = '<option value="">No projects available</option>';
                }

                renderProjects(allProjects);
            })
            .catch(error => {
                console.error('Error loading projects:', error);
                Toast.error('Failed to load projects');
            });
        }

        // Fine-tune button handler
        document.getElementById('fine-tune-button').addEventListener('click', function() {
            const projectName = document.getElementById('generate-embeddings-projects').value;
            if (!projectName) {
                Toast.warning('Please select a project');
                return;
            }

            if (!confirm(`Fine-tune model for "${projectName}"? This may take a while.`)) {
                return;
            }

            const button = this;
            LoadingState.show(button, 'Fine-tuning...');
            button.disabled = true;

            fetch(`${BACKEND_URL}/fine_tune`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ project_name: projectName })
            })
            .then(response => response.json())
            .then(data => {
                LoadingState.hide(button);
                button.disabled = false;
                if (data.status === 'success') {
                    Toast.success('Model fine-tuned successfully!');
                } else {
                    Toast.error(data.message || 'Failed to fine-tune model');
                }
            })
            .catch(error => {
                LoadingState.hide(button);
                button.disabled = false;
                console.error('Error:', error);
                Toast.error('Failed to fine-tune model');
            });
        });

        // Search functionality
        document.getElementById('search-projects').addEventListener('input', debounce(function(e) {
            filterProjects(e.target.value);
        }, 300));

        // Enter key to create project
        document.getElementById('new-project').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                createProject();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            loadProjects();
        });
    </script>
</body>

</html>
