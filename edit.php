<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/Task.php';

if (!isset($_SESSION['user_id'])) {
    die('Помилка: Користувач не авторизований.');
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('Помилка: ID не передано.');
}

$id = intval($_GET['id']); 
$task = Task::getTaskById($id, $_SESSION['user_id']);

if (!$task) {
    die('Помилка: Завдання не знайдено.');
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Edit task</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit task</h2>
    <form action="taskController.php" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']); ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Name:</label>
            <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($task['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" name="description" id="description" required><?= htmlspecialchars($task['description']); ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Save</button>
    </form>
    <a href="index.php" class="btn btn-secondary mt-3">Back</a>
</div>
</body>
</html>
