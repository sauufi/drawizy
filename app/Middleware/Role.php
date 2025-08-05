<?php

namespace App\Middleware;

class Role
{
    public static function adminOnly()
    {
        if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            echo "Akses ditolak (Admin Only)";
            exit;
        }
    }

    public static function editorOrAdmin()
    {
        if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'editor'])) {
            http_response_code(403);
            echo "Akses ditolak (Editor or Admin Only)";
            exit;
        }
    }
}
