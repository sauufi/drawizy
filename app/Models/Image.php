<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Image
{
    public static function all()
    {
        $db = Database::getInstance();
        $sql = "SELECT i.*, c.name as category_name 
                FROM images i 
                LEFT JOIN categories c ON i.category_id=c.id 
                ORDER BY i.created_at DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.*, c.name as category_name, c.slug as category_slug
                              FROM images i 
                              LEFT JOIN categories c ON i.category_id=c.id 
                              WHERE i.slug=?");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function store($title, $filename, $preview, $slug, $category_id, $meta_title = null, $meta_description = null)
    {
        $db = Database::getInstance();

        // Unique slug handling (already done before)
        $baseSlug = $slug;
        $i = 1;
        while (true) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM images WHERE slug=?");
            $stmt->execute([$slug]);
            if ($stmt->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $stmt = $db->prepare("INSERT INTO images (title, filename, preview, slug, category_id, meta_title, meta_description) 
                              VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$title, $filename, $preview, $slug, $category_id, $meta_title, $meta_description]);
        return ['status' => true, 'slug' => $slug];
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM images WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateImage($id, $title, $filename, $preview, $slug, $category_id, $meta_title, $meta_description)
    {
        $db = Database::getInstance();

        // Unique slug except current record
        $baseSlug = $slug;
        $i = 1;
        while (true) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM images WHERE slug=? AND id!=?");
            $stmt->execute([$slug, $id]);
            if ($stmt->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $stmt = $db->prepare("UPDATE images 
                              SET title=?, filename=?, preview=?, slug=?, category_id=?, meta_title=?, meta_description=? 
                              WHERE id=?");
        $stmt->execute([$title, $filename, $preview, $slug, $category_id, $meta_title, $meta_description, $id]);
        return $slug;
    }


    public static function isSlugUnique($slug, $ignoreId = null)
    {
        $db = Database::getInstance();
        if ($ignoreId) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM images WHERE slug=? AND id!=?");
            $stmt->execute([$slug, $ignoreId]);
        } else {
            $stmt = $db->prepare("SELECT COUNT(*) FROM images WHERE slug=?");
            $stmt->execute([$slug]);
        }
        return $stmt->fetchColumn() == 0;
    }


    public static function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT filename FROM images WHERE id=?");
        $stmt->execute([$id]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($image) {
            @unlink(__DIR__ . "/../../public/uploads/" . $image['filename']);
        }
        $stmt = $db->prepare("DELETE FROM images WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function incrementDownload($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE images SET downloads = downloads + 1 WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function findByCategory($category_id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM images WHERE category_id=? ORDER BY created_at DESC");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getRelated($categoryId, $excludeId, $limit = 4)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM images WHERE category_id=? AND id != ? ORDER BY RAND() LIMIT $limit");
        $stmt->execute([$categoryId, $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
