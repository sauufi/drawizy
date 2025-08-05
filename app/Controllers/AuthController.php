<?php

namespace App\Controllers;

use App\Models\User;
use App\Core\View;

class AuthController
{
    public function showLogin()
    {
        View::render('auth/login.php', [], 'layouts/admin.php');
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            $_SESSION['role'] = $user['role'];  // simpan role
            header("Location: /admin");
            exit;
        } else {
            View::render('auth/login.php', ['error' => 'Username atau password salah'], 'layouts/admin.php');
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: /login");
        exit;
    }

    public function showChangePassword()
    {
        \App\Core\View::render('auth/change-password.php', [], 'layouts/admin.php');
    }

    public function changePassword()
    {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($new !== $confirm) {
            \App\Core\View::render('auth/change-password.php', ['error' => 'Password baru tidak cocok'], 'layouts/admin.php');
            return;
        }

        $db = \App\Core\Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        $stmt->execute([$_SESSION['user']]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($current, $user['password'])) {
            \App\Core\View::render('auth/change-password.php', ['error' => 'Password lama salah'], 'layouts/admin.php');
            return;
        }

        $hashed = password_hash($new, PASSWORD_BCRYPT);
        $stmt = $db->prepare("UPDATE users SET password=? WHERE username=?");
        $stmt->execute([$hashed, $_SESSION['user']]);

        \App\Core\View::render('auth/change-password.php', ['success' => 'Password berhasil diubah'], 'layouts/admin.php');
    }
}
