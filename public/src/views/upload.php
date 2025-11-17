<?php require_once "auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Upload Document - DocuChat</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../../../public/css/styles.css">
	<style>
      .upload-container {
          max-width: 800px;
          margin: 0 auto;
      }

      .file-upload-area {
          border: 2px dashed var(--dark-border);
          border-radius: 16px;
          padding: 4rem 2rem;
          text-align: center;
          transition: var(--transition);
          cursor: pointer;
          background: var(--dark-surface);
          position: relative;
      }

      .file-upload-area:hover {
          border-color: var(--primary-color);
          background: rgba(1, 183, 198, 0.05);
      }

      .file-upload-area.dragover {
          border-color: var(--primary-color);
          background: rgba(1, 183, 198, 0.1);
          transform: scale(1.02);
      }

      .file-upload-icon {
          font-size: 4rem;
          color: var(--primary-color);
          margin-bottom: 1rem;
      }

      .file-preview-card {
          background: var(--dark-surface);
          border: 1px solid var(--dark-border);
          border-radius: 12px;
          padding: 1.5rem;
          margin-top: 1.5rem;
          display: none;
      }

      .file-preview-card.show {
          display: block;
          animation: slideIn 0.3s ease-out;
      }

      .file-info {
          display: flex;
          align-items: center;
          gap: 1rem;
      }

      .file-icon-wrapper {
          width: 60px;
          height: 60px;
          display: flex;
          align-items: center;
          justify-content: center;
          background: rgba(1, 183, 198, 0.1);
          border-radius: 12px;
      }

      .file-icon-wrapper img {
          width: 40px;
          height: 40px;
      }

      .file-details {
          flex: 1;
      }

      .file-name {
          font-weight: 600;
          color: var(--text-primary);
          margin-bottom: 0.25rem;
      }

      .file-size {
          font-size: 0.875rem;
          color: var(--text-secondary);
      }

      .file-actions {
          display: flex;
          gap: 0.5rem;
      }

      .progress-wrapper {
          margin-top: 1rem;
          display: none;
      }

      .progress-wrapper.show {
          display: block;
      }

      .progress {
          height: 8px;
          border-radius: 4px;
          background: var(--dark-surface-hover);
      }

      .progress-bar {
          background: var(--gradient-primary);
          transition: width 0.3s ease;
      }

      .supported-formats {
          margin-top: 1rem;
          font-size: 0.875rem;
          color: var(--text-secondary);
      }

      .format-badge {
          display: inline-block;
          padding: 0.25rem 0.5rem;
          background: rgba(1, 183, 198, 0.1);
          border-radius: 6px;
          margin: 0.25rem;
          font-size: 0.75rem;
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
					<a class="nav-link active" href="upload.php">Upload Document</a>
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
	<div class="upload-container">
		<div class="d-flex justify-content-between align-items-center mb-4">
			<div>
				<h1 class="text-gradient mb-2">Upload Document</h1>
				<p class="text-secondary">Add documents to your projects for AI-powered chat</p>
			</div>
		</div>

		<form id="upload-form">
			<div class="mb-4">
				<label for="project" class="form-label">
					<i class="fas fa-folder me-2"></i>Select Project
				</label>
				<select class="form-select" id="project" name="project" required>
					<option value="">Loading projects...</option>
				</select>
				<small class="text-secondary mt-1 d-block">
					Don't have a project? <a href="manage.php" style="color: var(--primary-color);">Create one first</a>
				</small>
			</div>

			<div class="file-upload-area" id="upload-area">
				<input type="file" class="d-none" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt" required>
				<div class="file-upload-icon">
					<i class="fas fa-cloud-upload-alt"></i>
				</div>
				<div>
					<strong style="color: var(--text-primary);">Drag & drop your file here</strong>
					<p class="text-secondary mt-2 mb-0">or click to browse</p>
				</div>
				<div class="supported-formats mt-3">
					<span>Supported formats:</span>
					<span class="format-badge">PDF</span>
					<span class="format-badge">DOCX</span>
					<span class="format-badge">XLSX</span>
					<span class="format-badge">PPTX</span>
					<span class="format-badge">TXT</span>
				</div>
			</div>

			<div class="file-preview-card" id="file-preview">
				<div class="file-info">
					<div class="file-icon-wrapper">
						<img id="file-icon" src="./../../../public/img/types/default.png" alt="File Icon">
					</div>
					<div class="file-details">
						<div class="file-name" id="file-name"></div>
						<div class="file-size" id="file-size"></div>
					</div>
					<div class="file-actions">
						<button type="button" class="btn btn-sm btn-danger" onclick="removeFile()">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
				<div class="progress-wrapper" id="progress-wrapper">
					<div class="progress">
						<div class="progress-bar" role="progressbar" id="progress-bar" style="width: 0%"></div>
					</div>
					<small class="text-secondary mt-1 d-block text-center" id="progress-text">Uploading...</small>
				</div>
			</div>

			<button type="submit" class="btn btn-primary btn-lg w-100 mt-4" id="upload-button">
				<i class="fas fa-upload me-2"></i>Upload Document
			</button>
		</form>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../public/js/utils.js"></script>
<script>
    const BACKEND_URL = '<?php echo BACKEND_URL; ?>';
    let selectedFile = null;

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

    function updateFilePreview(file) {
        selectedFile = file;
        const previewCard = document.getElementById('file-preview');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const fileIcon = document.getElementById('file-icon');

        fileName.textContent = file.name;
        fileSize.textContent = formatFileSize(file.size);
        fileIcon.src = getFileTypeIcon(file.name);
        
        previewCard.classList.add('show');
    }

    function removeFile() {
        selectedFile = null;
        document.getElementById('file').value = '';
        document.getElementById('file-preview').classList.remove('show');
        document.getElementById('progress-wrapper').classList.remove('show');
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

    $(document).ready(function() {
        loadProjects();

        const uploadArea = document.getElementById('upload-area');
        const fileInput = document.getElementById('file');

        // Click to upload
        uploadArea.addEventListener('click', () => fileInput.click());

        // File input change
        fileInput.addEventListener('change', function(e) {
            if (this.files.length > 0) {
                updateFilePreview(this.files[0]);
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFilePreview(files[0]);
            }
        });

        // Form submission
        $('#upload-form').submit(function(event) {
            event.preventDefault();
            
            if (!selectedFile) {
                Toast.warning('Please select a file');
                return;
            }

            const project = $('#project').val();
            if (!project) {
                Toast.warning('Please select a project');
                return;
            }

            const formData = new FormData();
            formData.append('file', selectedFile);
            formData.append('project', project);

            const progressWrapper = document.getElementById('progress-wrapper');
            const progressBar = document.getElementById('progress-bar');
            const progressText = document.getElementById('progress-text');
            const uploadButton = document.getElementById('upload-button');

            progressWrapper.classList.add('show');
            LoadingState.show(uploadButton, 'Uploading...');
            uploadButton.disabled = true;

            // Simulate progress (since we can't track actual upload progress easily)
            let progress = 0;
            const progressInterval = setInterval(() => {
                progress += 10;
                if (progress <= 90) {
                    progressBar.style.width = progress + '%';
                }
            }, 200);

            $.ajax({
                url: `${BACKEND_URL}/upload`,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    clearInterval(progressInterval);
                    progressBar.style.width = '100%';
                    progressText.textContent = 'Upload complete!';
                    
                    setTimeout(() => {
                        Toast.success('Document uploaded successfully!');
                        removeFile();
                        loadProjects(); // Reload to show updated file count
                    }, 500);
                },
                error: function(xhr) {
                    clearInterval(progressInterval);
                    progressWrapper.classList.remove('show');
                    const errorMsg = xhr.responseJSON?.message || 'Failed to upload document';
                    Toast.error(errorMsg);
                },
                complete: function() {
                    LoadingState.hide(uploadButton);
                    uploadButton.disabled = false;
                    setTimeout(() => {
                        progressWrapper.classList.remove('show');
                        progressBar.style.width = '0%';
                        progressText.textContent = 'Uploading...';
                    }, 1000);
                }
            });
        });
    });
</script>
</body>

</html>
