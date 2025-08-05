<?php

namespace App\Controllers;

use App\Models\Image;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Tag;
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
        $popularTags = Tag::getPopular(10);
        View::render('images/form.php', [
            'categories' => $categories,
            'popularTags' => $popularTags
        ], 'layouts/admin.php');
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

        $result = Image::store($title, $filename, null, $slug, $category_id, $meta_title, $meta_description);

        if ($result['status']) {
            $imageId = $result['id'];

            // Handle tags
            if (!empty($_POST['manual_tags'])) {
                $tagIds = Tag::processTagsFromInput($_POST['manual_tags']);
                if (!empty($tagIds)) {
                    Tag::setForImage($imageId, $tagIds);
                }
            }
        }

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
        $tags_input = $_POST['manual_tags'] ?? '';

        $pdfFiles = $_FILES['pdf_files'];
        $thumbFiles = $_FILES['thumb_files'] ?? null;

        $totalFiles = count($pdfFiles['name']);
        $results = [];

        // Process tags once for all images
        $tagIds = [];
        if (!empty($tags_input)) {
            $tagIds = Tag::processTagsFromInput($tags_input);
        }

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
            $result = Image::store($title, $pdfName, $thumbName, $slug, $category_id, $meta_title, $meta_description);

            if ($result['status'] && !empty($tagIds)) {
                Tag::setForImage($result['id'], $tagIds);
            }

            $results[] = ['pdf' => $pdfName, 'preview' => $thumbName];
        }

        echo json_encode(['status' => 'success', 'uploaded' => $results]);
    }

    public function edit($id)
    {
        $this->checkAuth();
        $image = Image::find($id);
        $categories = Category::all();
        $popularTags = Tag::getPopular(10);
        $imageTags = Tag::getByImageId($id);

        if (!$image) {
            http_response_code(404);
            echo "Image not found";
            exit;
        }

        View::render('images/edit.php', [
            'image' => $image,
            'categories' => $categories,
            'popularTags' => $popularTags,
            'imageTags' => $imageTags
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
        Image::updateImage(
            $id,
            $title,
            $filename,
            $preview,
            $slug,
            $category_id,
            $meta_title,
            $meta_description
        );

        // Handle tags
        if (isset($_POST['manual_tags'])) {
            $tagIds = Tag::processTagsFromInput($_POST['manual_tags']);
            Tag::setForImage($id, $tagIds);
        }

        header("Location: /admin/images");
    }

    public function checkSlug()
    {
        $slug = $_GET['slug'];
        $id = $_GET['id'] ?? null;
        $unique = Image::isSlugUnique($slug, $id);
        header('Content-Type: application/json');
        echo json_encode(['unique' => $unique]);
    }

    public function delete($id)
    {
        $this->checkAuth();

        // Remove all tag associations first
        Tag::removeAllFromImage($id);

        // Then delete the image
        Image::delete($id);

        header("Location: /admin/images");
        exit;
    }

    public function detail($slug)
    {
        $image = Image::findBySlug($slug);
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

        // Get tags for this image
        $imageTags = Tag::getByImageId($image['id']);

        View::render('frontend/detail.php', [
            'image' => $image,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'relatedImages' => $relatedImages,
            'imageTags' => $imageTags
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
        $image = Image::find($id);
        if (!$image) {
            echo "Image not found";
            exit;
        }

        $file = __DIR__ . "/../../public/uploads/" . $image['filename'];
        if (!file_exists($file)) {
            echo "File not found";
            exit;
        }

        Image::incrementDownload($id);

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
