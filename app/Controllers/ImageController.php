<?php

namespace App\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Setting;
use App\Core\View;

class ImageController
{
    public function index()
    {
        $this->checkAuth();
        $images = Image::all();
        View::render('images/index.php', ['images' => $images], 'layouts/admin.php');
    }

    public function create()
    {
        $this->checkAuth();
        $categories = Category::all();
        View::render('images/form.php', ['categories' => $categories], 'layouts/admin.php');
    }

    public function store()
    {
        $this->checkAuth();
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $slug = $this->slugify($title);
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;

        $file = $_FILES['image'];
        $filename = time() . "_" . basename($file['name']);
        move_uploaded_file($file['tmp_name'], __DIR__ . "/../../public/uploads/" . $filename);

        \App\Models\Image::store($title, $filename, $slug, $category_id, $meta_title, $meta_description);
        header("Location: /admin/images");
        exit;
    }


    public function storeMultiple()
    {
        $this->checkAuth();

        if (!isset($_FILES['pdf_files'])) {
            echo json_encode(['status' => 'error', 'message' => 'No PDF files uploaded']);
            return;
        }

        $category_id = $_POST['category_id'];
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;

        $pdfFiles = $_FILES['pdf_files'];
        $thumbFiles = $_FILES['thumb_files'] ?? null;

        $totalFiles = count($pdfFiles['name']);
        $results = [];

        for ($i = 0; $i < $totalFiles; $i++) {
            // Extract title from PDF filename
            $title = pathinfo($pdfFiles['name'][$i], PATHINFO_FILENAME);
            $slug = $this->slugify($title);
            $title = $this->slugifytitle($title);

            // Save PDF file
            $pdfName = time() . "_" . basename($pdfFiles['name'][$i]);
            move_uploaded_file($pdfFiles['tmp_name'][$i], __DIR__ . "/../../public/uploads/" . $pdfName);

            // Save thumbnail if provided (match index)
            $thumbName = null;
            if ($thumbFiles && !empty($thumbFiles['name'][$i])) {
                $thumbName = time() . "_" . basename($thumbFiles['name'][$i]);
                move_uploaded_file($thumbFiles['tmp_name'][$i], __DIR__ . "/../../public/uploads/" . $thumbName);
            }

            // Store record with SEO meta
            \App\Models\Image::store($title, $pdfName, $thumbName, $slug, $category_id, $meta_title, $meta_description);

            $results[] = ['pdf' => $pdfName, 'preview' => $thumbName];
        }

        echo json_encode(['status' => 'success', 'uploaded' => $results]);
    }


    public function edit($id)
    {
        $this->checkAuth();
        $image = \App\Models\Image::find($id);
        $categories = \App\Models\Category::all();
        if (!$image) {
            http_response_code(404);
            echo "Image not found";
            exit;
        }
        \App\Core\View::render('images/edit.php', [
            'image' => $image,
            'categories' => $categories
        ], 'layouts/admin.php');
    }

    public function update($id)
    {
        $this->checkAuth();

        $title = $_POST['title'];
        $slug = $_POST['slug'];
        $category_id = $_POST['category_id'];
        $meta_title = $_POST['meta_title'] ?? null;
        $meta_description = $_POST['meta_description'] ?? null;

        // Handle PDF file upload (optional)
        $filename = $_POST['existing_filename'];
        if (!empty($_FILES['pdf_file']['name'])) {
            $filename = time() . "_" . basename($_FILES['pdf_file']['name']);
            move_uploaded_file($_FILES['pdf_file']['tmp_name'], __DIR__ . "/../../public/uploads/" . $filename);
        }

        // Handle thumbnail upload (optional)
        $preview = $_POST['existing_preview'];
        if (!empty($_FILES['thumb_file']['name'])) {
            $preview = time() . "_" . basename($_FILES['thumb_file']['name']);
            move_uploaded_file($_FILES['thumb_file']['tmp_name'], __DIR__ . "/../../public/uploads/" . $preview);
        }

        // Update DB (auto slug uniqueness already handled in model)
        \App\Models\Image::updateImage(
            $id,
            $title,
            $filename,
            $preview,
            $slug,
            $category_id,
            $meta_title,
            $meta_description
        );

        header("Location: /admin/images");
    }


    public function checkSlug()
    {
        $slug = $_GET['slug'];
        $id = $_GET['id'] ?? null;
        $unique = \App\Models\Image::isSlugUnique($slug, $id);
        header('Content-Type: application/json');
        echo json_encode(['unique' => $unique]);
    }

    public function delete($id)
    {
        $this->checkAuth();
        Image::delete($id);
        header("Location: /admin/images");
        exit;
    }

    public function detail($slug)
    {
        $image = \App\Models\Image::findBySlug($slug);
        if (!$image) {
            http_response_code(404);
            echo "Gambar tidak ditemukan";
            exit;
        }

        $setting = Setting::get();
        $meta_title = $image['meta_title'] ?: $image['title'] . " - " . $setting['site_title'];
        $meta_description = $image['meta_description'] ?: substr(strip_tags($image['title']), 0, 150);

        // Ambil 4 gambar terkait berdasarkan kategori
        $relatedImages = Image::getRelated($image['category_id'], $image['id']);

        View::render('frontend/detail.php', [
            'image' => $image,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'relatedImages' => $relatedImages
        ], 'layouts/frontend.php');
    }

    public function home()
    {
        $db = \App\Core\Database::getInstance();

        // Ambil keyword pencarian
        $search = $_GET['q'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        // Hitung total data
        $countQuery = "SELECT COUNT(*) as total FROM images";
        $where = '';
        $params = [];

        if ($search) {
            $where = " WHERE title LIKE ?";
            $params[] = "%$search%";
        }

        $stmt = $db->prepare($countQuery . $where);
        $stmt->execute($params);
        $total = $stmt->fetch()['total'];
        $totalPages = ceil($total / $perPage);

        // Ambil data sesuai halaman
        $sql = "SELECT * FROM images $where ORDER BY created_at DESC LIMIT $perPage OFFSET $offset";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll();

        \App\Core\View::render('frontend/home.php', [
            'images' => $images,
            'search' => $search,
            'currentPage' => $page,
            'totalPages' => $totalPages
        ], 'layouts/frontend.php');
    }


    public function download($id)
    {
        $image = \App\Models\Image::find($id);
        if (!$image) {
            echo "Image not found";
            exit;
        }

        $file = __DIR__ . "/../../public/uploads/" . $image['filename'];
        if (!file_exists($file)) {
            echo "File not found";
            exit;
        }

        \App\Models\Image::incrementDownload($id);

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf'); // because filename is PDF
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }

    private function slugify($text)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
    }
    private function slugifytitle($text)
    {
        return trim(preg_replace('/[^A-Za-z0-9]+/', ' ', $text));
    }

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
