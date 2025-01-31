<?php
require_once __DIR__ . '/auth_system.php';

// Перевіряємо, чи сесія ще не була запущена
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (Auth::login($username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        $error_message = "Невірний логін або пароль.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вхід</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <form method="POST" class="w-25 mx-auto border p-4 rounded shadow text-center">
        <h2 class="mb-4">Вхід</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger text-center w-100">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <input type="text" class="form-control mb-3 text-center" name="username" placeholder="Ім'я користувача" required>
        <input type="password" class="form-control mb-3 text-center" name="password" placeholder="Пароль" required>
        <button type="submit" class="btn btn-primary w-100">Увійти</button>
        
        <p class="mt-3">Не маєте акаунту? <a href="register.php">Зареєструватися</a></p>
    </form>
</body>
</html>
