<?php
require_once __DIR__ . '/auth_system.php';
require_once __DIR__ . '/Task.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


Task::deleteUserTasks($user_id);


$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);


session_destroy();
header("Location: login.php");
exit();
?>
