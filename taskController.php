<?php
require_once __DIR__ . '/Task.php';
require_once __DIR__ . '/auth_system.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    Task::createTask($_SESSION['user_id'], $_POST['title'], $_POST['description']);
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    Task::deleteTask($_POST['id'], $_SESSION['user_id']);
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    Task::updateTask($_POST['id'], $_SESSION['user_id'], $_POST['title'], $_POST['description']);
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    Task::updateStatus($_POST['id'], $_SESSION['user_id'], $_POST['status']);
    header("Location: index.php");
    exit();
}
?>
