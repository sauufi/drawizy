<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Category
{
    /**
     * Check if slug is unique (excluding current category)
     */
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

    /**
     * Generate unique slug with auto-increment if needed
     */
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

    /**
     * Create new category with hierarchy support
     */
    public static function store($name, $slug, $description, $parentId = null)
    {
        $db = Database::getInstance();

        // Determine level based on parent
        $level = $parentId ? 1 : 0;

        // Get next sort order for this level
        $sortOrder = self::getNextSortOrder($parentId);

        $stmt = $db->prepare("INSERT INTO categories (name, slug, description, parent_id, level, sort_order) VALUES (?,?,?,?,?,?)");
        return $stmt->execute([$name, $slug, $description, $parentId, $level, $sortOrder]);
    }

    /**
     * Update category with hierarchy support
     */
    public static function updateCategory($id, $name, $slug, $description, $parentId = null)
    {
        $db = Database::getInstance();

        // Determine level based on parent
        $level = $parentId ? 1 : 0;

        $stmt = $db->prepare("UPDATE categories SET name=?, slug=?, description=?, parent_id=?, level=? WHERE id=?");
        return $stmt->execute([$name, $slug, $description, $parentId, $level, $id]);
    }

    /**
     * Delete category and handle children
     */
    public static function deleteCategory($id)
    {
        $db = Database::getInstance();

        // First, update any child categories to become parent categories
        $db->prepare("UPDATE categories SET parent_id = NULL, level = 0 WHERE parent_id = ?")->execute([$id]);

        // Then delete the category
        $stmt = $db->prepare("DELETE FROM categories WHERE id=?");
        return $stmt->execute([$id]);
    }

    /**
     * Get all categories (flat list)
     */
    public static function all()
    {
        $db = Database::getInstance();
        return $db->query("SELECT * FROM categories ORDER BY COALESCE(parent_id, id), sort_order")->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get categories with hierarchy information
     */
    public static function getAllWithHierarchy()
    {
        $db = Database::getInstance();
        $sql = "SELECT 
                    c.*,
                    p.name as parent_name,
                    p.slug as parent_slug,
                    CASE 
                        WHEN p.name IS NOT NULL THEN CONCAT(p.name, ' > ', c.name)
                        ELSE c.name 
                    END as full_path,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as direct_image_count,
                    CASE 
                        WHEN c.level = 0 THEN (
                            SELECT COUNT(*) FROM images i 
                            JOIN categories child ON i.category_id = child.id 
                            WHERE child.parent_id = c.id OR child.id = c.id
                        )
                        ELSE (SELECT COUNT(*) FROM images WHERE category_id = c.id)
                    END as total_image_count
                FROM categories c
                LEFT JOIN categories p ON c.parent_id = p.id
                ORDER BY COALESCE(p.sort_order, c.sort_order), c.sort_order";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get only parent categories (level 0)
     */
    public static function getParents()
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    (SELECT COUNT(*) FROM categories WHERE parent_id = c.id) as child_count,
                    (SELECT COUNT(*) FROM images i 
                     JOIN categories child ON i.category_id = child.id 
                     WHERE child.parent_id = c.id OR child.id = c.id) as total_image_count
                FROM categories c 
                WHERE c.level = 0 
                ORDER BY c.sort_order";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get child categories for a specific parent
     */
    public static function getChildren($parentId)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as image_count
                FROM categories c 
                WHERE c.parent_id = ? 
                ORDER BY c.sort_order";

        $stmt = $db->prepare($sql);
        $stmt->execute([$parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get categories for navigation (limited number for header)
     */
    public static function findByLimit($limit = 10)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    (SELECT COUNT(*) FROM images i 
                     JOIN categories child ON i.category_id = child.id 
                     WHERE child.parent_id = c.id OR child.id = c.id) as total_image_count
                FROM categories c 
                WHERE c.level = 0 
                ORDER BY c.sort_order 
                LIMIT ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find category by ID
     */
    public static function find($id)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    p.name as parent_name,
                    p.slug as parent_slug,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as image_count
                FROM categories c
                LEFT JOIN categories p ON c.parent_id = p.id
                WHERE c.id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find category by slug (with parent context)
     */
    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    p.name as parent_name,
                    p.slug as parent_slug,
                    p.id as parent_id,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as image_count
                FROM categories c
                LEFT JOIN categories p ON c.parent_id = p.id
                WHERE c.slug = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find category by parent slug and child slug (for URLs like /animals/cats)
     */
    public static function findByParentAndChildSlug($parentSlug, $childSlug)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    p.name as parent_name,
                    p.slug as parent_slug,
                    p.id as parent_id,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as image_count
                FROM categories c
                JOIN categories p ON c.parent_id = p.id
                WHERE p.slug = ? AND c.slug = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$parentSlug, $childSlug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get category tree structure for admin interface
     */
    public static function getTree()
    {
        $db = Database::getInstance();

        // Get all categories
        $categories = $db->query("SELECT * FROM categories ORDER BY COALESCE(parent_id, id), sort_order")->fetchAll(PDO::FETCH_ASSOC);

        // Build tree structure
        $tree = [];
        $indexed = [];

        // First pass - index all categories
        foreach ($categories as $category) {
            $indexed[$category['id']] = $category;
            $indexed[$category['id']]['children'] = [];
        }

        // Second pass - build tree
        foreach ($indexed as $category) {
            if ($category['parent_id'] === null) {
                $tree[] = $category;
            } else {
                $indexed[$category['parent_id']]['children'][] = $category;
            }
        }

        return $tree;
    }

    /**
     * Get breadcrumb trail for a category
     */
    public static function getBreadcrumb($categoryId)
    {
        $db = Database::getInstance();
        $breadcrumb = [];

        $sql = "SELECT c.id, c.name, c.slug, c.parent_id
                FROM categories c
                WHERE c.id = ?";

        $currentId = $categoryId;

        while ($currentId) {
            $stmt = $db->prepare($sql);
            $stmt->execute([$currentId]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($category) {
                array_unshift($breadcrumb, $category);
                $currentId = $category['parent_id'];
            } else {
                break;
            }
        }

        return $breadcrumb;
    }

    /**
     * Get next sort order for a given parent
     */
    private static function getNextSortOrder($parentId = null)
    {
        $db = Database::getInstance();

        if ($parentId) {
            $stmt = $db->prepare("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM categories WHERE parent_id = ?");
            $stmt->execute([$parentId]);
        } else {
            $stmt = $db->prepare("SELECT COALESCE(MAX(sort_order), 0) + 1 FROM categories WHERE parent_id IS NULL");
            $stmt->execute();
        }

        return $stmt->fetchColumn();
    }

    /**
     * Update sort order for categories
     */
    public static function updateSortOrder($categoryId, $newOrder)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("UPDATE categories SET sort_order = ? WHERE id = ?");
        return $stmt->execute([$newOrder, $categoryId]);
    }

    /**
     * Check if category has children
     */
    public static function hasChildren($categoryId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) FROM categories WHERE parent_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Get category statistics
     */
    public static function getStats()
    {
        $db = Database::getInstance();

        $stats = [];

        // Total categories
        $stats['total'] = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();

        // Parent categories
        $stats['parents'] = $db->query("SELECT COUNT(*) FROM categories WHERE level = 0")->fetchColumn();

        // Child categories
        $stats['children'] = $db->query("SELECT COUNT(*) FROM categories WHERE level = 1")->fetchColumn();

        // Categories with images
        $stats['with_images'] = $db->query("SELECT COUNT(DISTINCT category_id) FROM images WHERE category_id IS NOT NULL")->fetchColumn();

        return $stats;
    }

    /**
     * Search categories by name
     */
    public static function search($query, $limit = 20)
    {
        $db = Database::getInstance();
        $sql = "SELECT c.*,
                    p.name as parent_name,
                    p.slug as parent_slug,
                    CASE 
                        WHEN p.name IS NOT NULL THEN CONCAT(p.name, ' > ', c.name)
                        ELSE c.name 
                    END as full_path,
                    (SELECT COUNT(*) FROM images WHERE category_id = c.id) as image_count
                FROM categories c
                LEFT JOIN categories p ON c.parent_id = p.id
                WHERE c.name LIKE ? OR c.description LIKE ?
                ORDER BY c.level, c.name
                LIMIT ?";

        $searchTerm = "%{$query}%";
        $stmt = $db->prepare($sql);
        $stmt->execute([$searchTerm, $searchTerm, $limit]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
