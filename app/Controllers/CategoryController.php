<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Setting;
use App\Core\View;

class CategoryController
{
    public function index()
    {
        $this->checkAuth();
        $categories = Category::all();
        View::render('categories/index.php', ['categories' => $categories], 'layouts/admin.php');
    }

    public function create()
    {
        $this->checkAuth();
        View::render('categories/form.php', [], 'layouts/admin.php');
    }

    public function store()
    {
        $this->checkAuth();
        $name = $_POST['name'];
        $slug = $_POST['slug'] ?: $this->slugify($name);
        $slug = Category::generateUniqueSlug($slug);
        $description = $_POST['description'] ?? '';

        Category::store($name, $slug, $description);
        header("Location: /admin/categories");
        exit;
    }

    public function edit($id)
    {
        $this->checkAuth();
        $category = Category::find($id);
        View::render('categories/edit.php', ['category' => $category], 'layouts/admin.php');
    }

    public function update($id)
    {
        $this->checkAuth();
        $name = $_POST['name'];
        $slug = $_POST['slug'] ?: $this->slugify($name);
        $slug = Category::generateUniqueSlug($slug, $id);
        $description = $_POST['description'] ?? '';

        Category::updateCategory($id, $name, $slug, $description);
        header("Location: /admin/categories");
        exit;
    }

    public function delete($id)
    {
        $this->checkAuth();
        Category::deleteCategory($id);
        header("Location: /admin/categories");
        exit;
    }

    public function show($slug)
    {
        $category = \App\Models\Category::findBySlug($slug);
        if (!$category) {
            http_response_code(404);
            echo "Kategori tidak ditemukan";
            exit;
        }

        $setting = Setting::get();
        $meta_title = "Free " . $category['name'] . " Coloring Pages - " . $setting['site_title'];
        $meta_description = (function ($text) {
            $pos = strpos($text, '.');
            return trim(substr($text, 0, $pos !== false ? $pos : 150)) . ".";
        })(strip_tags($category['description'] ?? $category['name']));

        $db = \App\Core\Database::getInstance();
        $search = $_GET['q'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $params = [$category['id']];
        $where = "category_id=?";
        if ($search) {
            $where .= " AND title LIKE ?";
            $params[] = "%$search%";
        }

        $stmt = $db->prepare("SELECT COUNT(*) as total FROM images WHERE $where");
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        $totalPages = ceil($total / $perPage);

        $sql = "SELECT * FROM images WHERE $where ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll();

        \App\Core\View::render('frontend/category.php', [
            'category' => $category,
            'images' => $images,
            'search' => $search,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description
        ], 'layouts/frontend.php');
    }

    private function slugify($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
