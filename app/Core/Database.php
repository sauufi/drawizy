<?php

namespace App\Core;

use PDO;

class Database
{
    private static $instance = null;

    public static function getInstance()
    {
        if (!self::$instance) {
            $config = include __DIR__ . '/../../config.php';
            $dbConfig = $config['db'];

            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['name']};charset=utf8mb4";
            self::$instance = new PDO($dsn, $dbConfig['user'], $dbConfig['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
}
