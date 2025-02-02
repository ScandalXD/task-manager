<?php
require_once __DIR__ . '/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    public static function register($username, $password) {
        global $pdo;

        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            return false; 
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $hashedPassword]);
    }

    public static function login($username, $password) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            return true;
        }
        return false;
    }

    public static function logout() {
        session_destroy();
        header("Location: login.php");
        exit();
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public static function getUserById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateUsername($id, $new_name) {
        global $pdo;

        
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$new_name]);
        if ($stmt->fetch()) {
            return false; 
        }

        $stmt = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
        if ($stmt->execute(['username' => $new_name, 'id' => $id])) {
            $_SESSION['username'] = $new_name; 
            return true;
        }
        return false;
    }

    public static function updatePassword($id, $old_password, $new_password) {
        global $pdo;
    
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$user) {
            return false; 
        }
    
        if (!password_verify($old_password, $user['password'])) {
            return false; 
        }
    
        $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        
        if ($stmt->execute(['password' => $hashedPassword, 'id' => $id])) {
            return true;
        } else {
            return false;
        }
    }

    

}
