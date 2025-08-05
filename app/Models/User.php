<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    public static function findByUsername($username)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
