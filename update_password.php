<?php
require_once __DIR__ . '/auth_system.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old_password = $_POST['old_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';

    if (empty($old_password) || empty($new_password)) {
        $error_message = "Всі поля мають бути заповнені!";
    } else {
        if (Auth::updatePassword($_SESSION['user_id'], $old_password, $new_password)) {
            header("Location: profile.php?password_success=1");
            exit();
        } else {
            $error_message = "Помилка: старий пароль неправильний або інша помилка.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Змінити пароль</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <form method="POST" class="w-25 mx-auto border p-4 rounded shadow">
        <h2 class="mb-4 text-center">Змінити пароль</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger text-center">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <input type="password" class="form-control mb-3 text-center" name="old_password" placeholder="Старий пароль" required>
        <input type="password" class="form-control mb-3 text-center" name="new_password" placeholder="Новий пароль" required>
        <button type="submit" class="btn btn-warning w-100">Оновити</button>
    </form>
</body>
</html>
