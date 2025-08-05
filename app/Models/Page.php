<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Page
{
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM pages ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pages WHERE slug=? LIMIT 1");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($title, $slug, $content)
    {
        $db = Database::getInstance();

        // Auto-suffix slug if duplicate
        $baseSlug = $slug;
        $i = 1;
        while (true) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM pages WHERE slug=?");
            $stmt->execute([$slug]);
            if ($stmt->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $stmt = $db->prepare("INSERT INTO pages (title, slug, content) VALUES (?,?,?)");
        $stmt->execute([$title, $slug, $content]);

        return ['status' => true, 'slug' => $slug];
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM pages WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function updatePage($id, $title, $slug, $content)
    {
        $db = Database::getInstance();

        // Ensure slug is unique except for current record
        $baseSlug = $slug;
        $i = 1;
        while (true) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM pages WHERE slug=? AND id!=?");
            $stmt->execute([$slug, $id]);
            if ($stmt->fetchColumn() == 0) break;
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        $stmt = $db->prepare("UPDATE pages SET title=?, slug=?, content=? WHERE id=?");
        $stmt->execute([$title, $slug, $content, $id]);
        return $slug; // return final slug in case it changed
    }


    public static function delete($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM pages WHERE id=?");
        return $stmt->execute([$id]);
    }
}
