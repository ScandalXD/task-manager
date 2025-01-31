<?php
require_once __DIR__ . '/db.php';

class Task {
    public static function getAllTasks() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function getTaskById($id, $user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id AND user_id = :user_id");
        $stmt->execute(['id' => $id, 'user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public static function getUserTasks($user_id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createTask($user_id, $title, $description) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)");
        return $stmt->execute(['user_id' => $user_id, 'title' => $title, 'description' => $description]);
    }

    public static function deleteTask($id, $user_id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
        return $stmt->execute(['id' => $id, 'user_id' => $user_id]);
    }

    public static function updateTask($id, $user_id, $title, $description) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tasks SET title = :title, description = :description WHERE id = :id AND user_id = :user_id");
        return $stmt->execute(['title' => $title, 'description' => $description, 'id' => $id, 'user_id' => $user_id]);
    }

    public static function updateStatus($id, $user_id, $status) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE tasks SET status = :status WHERE id = :id AND user_id = :user_id");
        return $stmt->execute(['status' => $status, 'id' => $id, 'user_id' => $user_id]);
    }
}
?>
