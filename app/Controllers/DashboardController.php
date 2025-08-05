<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Database;

class DashboardController
{
    public function index()
    {
        $this->checkAuth();
        $db = \App\Core\Database::getInstance();

        $imageCount = $db->query("SELECT COUNT(*) as c FROM images")->fetch()['c'];
        $categoryCount = $db->query("SELECT COUNT(*) as c FROM categories")->fetch()['c'];
        $downloadCount = $db->query("SELECT SUM(downloads) as t FROM images")->fetch()['t'] ?? 0;

        // Statistik kategori
        $stats = $db->query("
            SELECT c.name, COUNT(i.id) as total 
            FROM categories c 
            LEFT JOIN images i ON i.category_id = c.id 
            GROUP BY c.id
        ")->fetchAll();

        \App\Core\View::render('dashboard/index.php', [
            'imageCount' => $imageCount,
            'categoryCount' => $categoryCount,
            'downloadCount' => $downloadCount,
            'stats' => $stats
        ], 'layouts/admin.php');
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
