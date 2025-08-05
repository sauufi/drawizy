<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Setting
{
    public static function get()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM settings LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($title, $desc, $logo)
    {
        $db = Database::getInstance();
        $sql = "UPDATE settings SET site_title=?, site_description=?, site_logo=? WHERE id=1";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$title, $desc, $logo]);
    }
}
