<?php
require_once __DIR__ . '/auth_system.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_name = trim($_POST['username']);
    if (Auth::updateUsername($_SESSION['user_id'], $new_name)) {
        header("Location: profile.php?success=1");
    } else {
        header("Location: profile.php?error=1");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Name</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <form method="POST" class="w-25 mx-auto border p-4 rounded shadow">
        <h2 class="mb-4 text-center">Change Name</h2>
        <input type="text" class="form-control mb-3 text-center" name="username" placeholder="New Name" required>
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </form>
</body>
</html>
