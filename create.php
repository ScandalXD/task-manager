<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Додати завдання</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Додати завдання</h2>
    <form method="POST" action="/taskController.php">
        <div class="mb-3">
            <label class="form-label">Назва</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Опис</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Створити</button>
        <a href="index.php" class="btn btn-secondary">Назад</a>
    </form>
</div>
</body>
</html>
