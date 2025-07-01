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
      .container {
          max-width: 600px;
      }
      #file-preview {
          display: none;
          align-items: center;
      }
      #file-preview img {
          width: 40px;
          margin-right: 10px;
      }
      .delete-file {
          cursor: pointer;
          color: red;
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
					<a class="nav-link" href="manage.php">Manage Projects</a>
				</li>
                                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
			
			</ul>
		</div>
	</div>
</nav>
<div class="container mt-5">
	<h1>Upload Document</h1>
	<form id="upload-form">
		<div class="mb-3">
			<label for="project" class="form-label">Project Name</label>
			<select class="form-select" id="project" name="project" required>
				<!-- Project options will be populated by JavaScript -->
			</select>
		</div>
		<div class="mb-3">
			<label for="file" class="form-label">Document</label>
			<input type="file" class="form-control" id="file" name="file" required>
		</div>
		<button type="submit" class="btn btn-primary">Upload</button>
	</form>
	<div id="file-preview" class="mt-3">
		<img src="./../../../public/img/types/default.png" alt="File Icon">
		<span id="file-name"></span>
		<span class="delete-file">X</span>
	</div>
	<div id="upload-status" class="mt-3"></div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch and populate projects
        $.get('<?php echo BACKEND_URL; ?>/projects', function(data) {
            var projectSelect = $('#project');
            projectSelect.empty();
            data.projects.forEach(function(project) {
                projectSelect.append(new Option(project.project, project.project));
            });
        });

        $('#file').on('change', function() {
            var file = this.files[0];
            if (file) {
                $('#file-name').text(file.name);
                $('#file-preview').show();
            }
        });

        $('#file-preview').on('click', '.delete-file', function() {
            $('#file').val('');
            $('#file-name').text('');
            $('#file-preview').hide();
        });

        $('#upload-form').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '<?php echo BACKEND_URL; ?>/upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#upload-status').html('<div class="alert alert-success">Document uploaded successfully.</div>');
                },
                error: function(response) {
                    $('#upload-status').html('<div class="alert alert-danger">Failed to upload document.</div>');
                }
            });
        });
    });
</script>
</body>

</html>
