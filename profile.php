<?php
require_once __DIR__ . '/auth_system.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Мій профіль</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <h2 class="mb-4">Мій профіль</h2>
        <p><strong>Ім'я користувача:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <a href="update_name.php" class="btn btn-primary">Змінити ім'я</a>
        <a href="update_password.php" class="btn btn-warning">Змінити пароль</a>
        <a href="logout.php" class="btn btn-danger">Вийти</a>
    </div>
</body>
</html>
