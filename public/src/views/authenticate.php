<?php
session_start();
$user = getenv('DOCUCHAT_USER') ?: 'admin';
$pass = getenv('DOCUCHAT_PASS') ?: 'password';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($username === $user && $password === $pass) {
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid credentials';
        header('Location: login.php');
        exit;
    }
}
header('Location: login.php');
