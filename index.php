<?php
require_once __DIR__ . '/Task.php';
require_once __DIR__ . '/auth_system.php';

$tasks = [];
if (Auth::isLoggedIn()) {
    $tasks = Task::getUserTasks($_SESSION['user_id']);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .task-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Task Manager</a>
        <div>
            <?php if (Auth::isLoggedIn()): ?>
                <a href="profile.php" class="btn btn-info me-2">Profile</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary me-2">Sign in</a>
                <a href="register.php" class="btn btn-secondary">Sign Up</a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="task-container">
        <h2 class="mb-4 text-center">List of tasks</h2>

        <?php if (Auth::isLoggedIn()): ?>
            <a href="create.php" class="btn btn-success mb-3 w-100">Add Task</a>
            <ul class="list-group">
                <?php foreach ($tasks as $task): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5><?php echo htmlspecialchars($task['title']); ?></h5>
                            <p><?php echo htmlspecialchars($task['description']); ?></p>
                            <p><strong>Статус:</strong> <?php echo ($task['status'] === 'completed') ? 'Виконано' : 'В процесі'; ?></p>
                        </div>
                        <div>
                            <form method="POST" action="/taskController.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <select name="status" class="form-select d-inline w-auto">
                                    <option value="in_progress" <?php if ($task['status'] === 'in_progress') echo 'selected'; ?>>In process</option>
                                    <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Done</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-secondary">Update</button>
                            </form>
                            <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn btn-primary">Edit</a>
                            <form method="POST" action="/taskController.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger">Remove</button>
                            </form>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-center">Please, <a href="login.php">log in</a> or <a href="register.php">register</a> to view your tasks.</p>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
