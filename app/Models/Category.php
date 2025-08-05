<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Category
{
    public static function isSlugUnique($slug, $ignoreId = null)
    {
        $db = Database::getInstance();
        if ($ignoreId) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM categories WHERE slug=? AND id!=?");
            $stmt->execute([$slug, $ignoreId]);
        } else {
            $stmt = $db->prepare("SELECT COUNT(*) FROM categories WHERE slug=?");
            $stmt->execute([$slug]);
        }
        return $stmt->fetchColumn() == 0;
    }

    public static function generateUniqueSlug($baseSlug, $ignoreId = null)
    {
        $slug = $baseSlug;
        $i = 1;
        while (!self::isSlugUnique($slug, $ignoreId)) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }
        return $slug;
    }

    public static function store($name, $slug, $description)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO categories (name, slug, description) VALUES (?,?,?)");
        return $stmt->execute([$name, $slug, $description]);
    }

    public static function updateCategory($id, $name, $slug, $description)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE categories SET name=?, slug=?, description=? WHERE id=?");
        return $stmt->execute([$name, $slug, $description, $id]);
    }

    public static function deleteCategory($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }

    public static function all()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM categories ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findByLimit()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM categories ORDER BY id ASC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM categories WHERE slug=?");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
