<?php
session_start(); 

require_once __DIR__ . '/auth_system.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user = Auth::getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <h2 class="mb-4">My Profile</h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <a href="update_name.php" class="btn btn-primary">Change Name</a>
        <a href="update_password.php" class="btn btn-warning">Change Password</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>

        <form method="POST" action="delete_account.php" class="mt-3">
            <button type="submit" name="delete_account" class="btn btn-danger">Delete Account</button>
        </form>
    </div>
</body>
</html>
