<?php
require_once __DIR__ . '/auth_system.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $_POST['username']]);
    if ($stmt->fetchColumn() > 0) {
        $error = "Користувач з таким ім'ям вже існує!";
    } else {
        if (Auth::register($_POST['username'], $_POST['password'])) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Помилка реєстрації.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Реєстрація</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container text-center">
        <h2 class="mb-4">Реєстрація</h2>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"> <?php echo $error; ?> </div>
        <?php endif; ?>
        <form method="POST" class="w-25 mx-auto border p-4 rounded shadow">
            <div class="mb-3 text-start">
                <label class="form-label">Ім'я користувача:</label>
                <input type="text" class="form-control text-center" name="username" required>
            </div>
            <div class="mb-3 text-start">
                <label class="form-label">Пароль:</label>
                <input type="password" class="form-control text-center" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Зареєструватися</button>
        </form>
        <p class="mt-3">Вже маєте акаунт? <a href="login.php">Увійти</a></p>
    </div>
</body>
</html>
