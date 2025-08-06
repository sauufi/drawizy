<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page;

class PageController
{
    public function index()
    {
        $pages = Page::all();
        View::render('pages/index.php', ['pages' => $pages], 'layouts/admin.php');
    }

    public function create()
    {
        View::render('pages/create.php', [], 'layouts/admin.php');
    }

    public function store()
    {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $slug = $this->slugify($title);

        Page::create($title, $slug, $content);
        header("Location: /dashboard/pages");
    }

    public function delete($id)
    {
        Page::delete($id);
        header("Location: /dashboard/pages");
    }

    public function show($slug)
    {
        // Path ke file static page
        $filePath = __DIR__ . '/../../views/frontend/pages/' . basename($slug) . '.php';

        if (file_exists($filePath)) {
            // Render file statis langsung
            View::render('frontend/pages/' . basename($slug) . '.php', [], 'layouts/frontend.php');
            return;
        } else {
            View::render('frontend/pages/404.php', [], 'layouts/frontend.php');
        }
    }

    public function showPages($slug)
    {
        $page = Page::findBySlug($slug);
        if (!$page) {
            http_response_code(404);
            echo "Page not found";
            exit;
        }
        View::render('frontend/page.php', ['page' => $page], 'layouts/frontend.php');
    }

    public function edit($id)
    {
        $page = \App\Models\Page::find($id);
        if (!$page) {
            http_response_code(404);
            echo "Page not found";
            exit;
        }
        \App\Core\View::render('pages/edit.php', ['page' => $page], 'layouts/admin.php');
    }

    public function update($id)
    {
        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $content = $_POST['content'];
        $newSlug = \App\Models\Page::updatePage($id, $title, $slug, $content);
        $_SESSION['message'] = "Page updated successfully (slug: {$newSlug})";
        header("Location: /dashboard/pages");
    }


    private function slugify($text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }
}
