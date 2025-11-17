<?php require_once "auth.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DocuChat - AI-Powered Document Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/styles.css">
    <style>
        .hero-section {
            text-align: center;
            padding: 4rem 0;
            background: linear-gradient(135deg, rgba(1, 183, 198, 0.1) 0%, rgba(1, 183, 198, 0.05) 100%);
            border-radius: 16px;
            margin-bottom: 3rem;
        }

        .feature-card {
            height: 100%;
            transition: var(--transition);
        }

        .feature-card:hover {
            transform: translateY(-4px);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .quick-action-card {
            cursor: pointer;
            transition: var(--transition);
        }

        .quick-action-card:hover {
            transform: scale(1.05);
            border-color: var(--primary-color);
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
        <div class="hero-section">
            <h1 class="text-gradient mb-3">Welcome to DocuChat</h1>
            <p class="lead text-secondary mb-4">AI-Powered Document Chat System</p>
            <p class="text-secondary">Upload documents, ask questions, and get intelligent answers powered by advanced NLP models</p>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card quick-action-card" onclick="window.location.href='chat.php'">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-comments"></i>
                        </div>
                        <h5 class="card-title">Chat with Documents</h5>
                        <p class="text-secondary">Ask questions about your uploaded documents and get AI-powered answers</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Start Chatting
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card quick-action-card" onclick="window.location.href='upload.php'">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <h5 class="card-title">Upload Documents</h5>
                        <p class="text-secondary">Add PDF, DOCX, PPTX, and other document formats to your projects</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Upload Now
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card quick-action-card" onclick="window.location.href='manage.php'">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h5 class="card-title">Manage Projects</h5>
                        <p class="text-secondary">Organize your documents into projects and manage embeddings</p>
                        <button class="btn btn-primary">
                            <i class="fas fa-arrow-right me-2"></i>Manage
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Features</h3>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h6>AI-Powered</h6>
                        <p class="text-secondary small">Advanced NLP models for intelligent document understanding</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h6>Multiple Formats</h6>
                        <p class="text-secondary small">Support for PDF, DOCX, PPTX, XLSX, and TXT files</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h6>Smart Search</h6>
                        <p class="text-secondary small">Find relevant information using semantic search</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        <h6>Project Management</h6>
                        <p class="text-secondary small">Organize documents into projects for better management</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
