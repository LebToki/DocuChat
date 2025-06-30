<?php
// Global configuration for the frontend
// Use BACKEND_URL environment variable if set, otherwise default to localhost
define('BACKEND_URL', getenv('BACKEND_URL') ?: 'http://localhost:8080');
?>
