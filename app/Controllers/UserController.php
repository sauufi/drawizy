<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class UserController
{
    public function index()
    {
        $db = Database::getInstance();
        $users = $db->query("SELECT id, username, role FROM users")->fetchAll();
        View::render('users/index.php', ['users' => $users], 'layouts/admin.php');
    }

    public function store()
    {
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = $_POST['role'];
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?,?,?)");
        $stmt->execute([$username, $password, $role]);
        header("Location: /dashboard/users");
    }

    public function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM users WHERE id=?");
        $stmt->execute([$id]);
        header("Location: /dashboard/users");
    }
}
