<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Image
{
    public static function all()
    {
        $db = Database::getInstance();
        $sql = "SELECT i.*, 
                       c.name as category_name, 
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id 
                LEFT JOIN categories p ON c.parent_id = p.id
                ORDER BY i.created_at DESC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.*, 
                                     c.name as category_name, 
                                     c.slug as category_slug,
                                     p.name as parent_category_name,
                                     p.slug as parent_category_slug
                              FROM images i 
                              LEFT JOIN categories c ON i.category_id = c.id 
                              LEFT JOIN categories p ON c.parent_id = p.id
                              WHERE i.slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function store($title, $filename, $preview, $slug, $category_id, $meta_title = null, $meta_description = null)
    {
        $db = Database::getInstance();

        // Unique slug handling
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

        $imageId = $db->lastInsertId();
        return ['status' => true, 'slug' => $slug, 'id' => $imageId];
    }

    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT i.*, 
                                     c.name as category_name, 
                                     c.slug as category_slug,
                                     p.name as parent_category_name,
                                     p.slug as parent_category_slug
                              FROM images i 
                              LEFT JOIN categories c ON i.category_id = c.id 
                              LEFT JOIN categories p ON c.parent_id = p.id
                              WHERE i.id = ?");
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
        $stmt = $db->prepare("SELECT filename, preview FROM images WHERE id=?");
        $stmt->execute([$id]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            // Delete main file
            if ($image['filename']) {
                @unlink(__DIR__ . "/../../public/uploads/" . $image['filename']);
            }
            // Delete preview file
            if ($image['preview']) {
                @unlink(__DIR__ . "/../../public/uploads/" . $image['preview']);
            }
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
        $stmt = $db->prepare("SELECT i.*, 
                                     c.name as category_name,
                                     c.slug as category_slug,
                                     p.name as parent_category_name,
                                     p.slug as parent_category_slug
                              FROM images i 
                              LEFT JOIN categories c ON i.category_id = c.id
                              LEFT JOIN categories p ON c.parent_id = p.id
                              WHERE i.category_id = ? 
                              ORDER BY i.created_at DESC");
        $stmt->execute([$category_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get images for a category, including child categories if it's a parent category
     * This is the key method for showing parent category images with child category content
     */
    public static function getByCategoryWithChildren($categoryId, $categoryLevel, $search = '', $page = 1, $perPage = 12)
    {
        $db = Database::getInstance();
        $offset = ($page - 1) * $perPage;
        $perPage = (int)$perPage;
        $offset = (int)$offset;

        if ($categoryLevel == 0) {
            // Parent category - get images from this category AND all child categories
            $sql = "SELECT i.*, 
                           c.name as category_name,
                           c.slug as category_slug,
                           p.name as parent_category_name,
                           p.slug as parent_category_slug
                    FROM images i 
                    LEFT JOIN categories c ON i.category_id = c.id
                    LEFT JOIN categories p ON c.parent_id = p.id
                    WHERE (c.id = ? OR c.parent_id = ?)";

            $params = [$categoryId, $categoryId];

            if ($search) {
                $sql .= " AND i.title LIKE ?";
                $params[] = "%$search%";
            }

            $sql .= " ORDER BY i.created_at DESC LIMIT $perPage OFFSET $offset";
        } else {
            // Child category - get images only from this category
            $sql = "SELECT i.*, 
                           c.name as category_name,
                           c.slug as category_slug,
                           p.name as parent_category_name,
                           p.slug as parent_category_slug
                    FROM images i 
                    LEFT JOIN categories c ON i.category_id = c.id
                    LEFT JOIN categories p ON c.parent_id = p.id
                    WHERE i.category_id = ?";

            $params = [$categoryId];

            if ($search) {
                $sql .= " AND i.title LIKE ?";
                $params[] = "%$search%";
            }

            $sql .= " ORDER BY i.created_at DESC LIMIT $perPage OFFSET $offset";
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get total count for category with children support
     */
    public static function getCountByCategoryWithChildren($categoryId, $categoryLevel, $search = '')
    {
        $db = Database::getInstance();

        if ($categoryLevel == 0) {
            // Parent category - count images from this category AND all child categories
            $sql = "SELECT COUNT(*) as total
                    FROM images i 
                    LEFT JOIN categories c ON i.category_id = c.id
                    WHERE (c.id = ? OR c.parent_id = ?)";

            $params = [$categoryId, $categoryId];

            if ($search) {
                $sql .= " AND i.title LIKE ?";
                $params[] = "%$search%";
            }
        } else {
            // Child category - count images only from this category
            $sql = "SELECT COUNT(*) as total
                    FROM images i 
                    WHERE i.category_id = ?";

            $params = [$categoryId];

            if ($search) {
                $sql .= " AND i.title LIKE ?";
                $params[] = "%$search%";
            }
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public static function getRelated($categoryId, $excludeId, $limit = 4)
    {
        $db = Database::getInstance();
        $limit = (int)$limit; // Ensure it's an integer
        $stmt = $db->prepare("SELECT i.*, 
                                     c.name as category_name,
                                     c.slug as category_slug,
                                     p.name as parent_category_name,
                                     p.slug as parent_category_slug
                              FROM images i 
                              LEFT JOIN categories c ON i.category_id = c.id
                              LEFT JOIN categories p ON c.parent_id = p.id
                              WHERE i.category_id = ? AND i.id != ? 
                              ORDER BY RAND() LIMIT $limit");
        $stmt->execute([$categoryId, $excludeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Search images by title and tags
     */
    public static function search($query, $categoryId = null, $page = 1, $perPage = 12)
    {
        $db = Database::getInstance();
        $offset = ($page - 1) * $perPage;
        $perPage = (int)$perPage;
        $offset = (int)$offset;

        $sql = "SELECT DISTINCT i.*, 
                       c.name as category_name, 
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id
                LEFT JOIN categories p ON c.parent_id = p.id
                LEFT JOIN image_tags it ON i.id = it.image_id
                LEFT JOIN tags t ON it.tag_id = t.id
                WHERE (i.title LIKE ? OR t.name LIKE ?)";

        $params = ["%$query%", "%$query%"];

        if ($categoryId) {
            $sql .= " AND i.category_id = ?";
            $params[] = $categoryId;
        }

        $sql .= " ORDER BY i.created_at DESC LIMIT $perPage OFFSET $offset";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get images by tag
     */
    public static function getByTag($tagId, $page = 1, $perPage = 12)
    {
        $db = Database::getInstance();
        $offset = ($page - 1) * $perPage;
        $perPage = (int)$perPage;
        $offset = (int)$offset;

        $sql = "SELECT i.*, 
                       c.name as category_name, 
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id
                LEFT JOIN categories p ON c.parent_id = p.id
                JOIN image_tags it ON i.id = it.image_id
                WHERE it.tag_id = ?
                ORDER BY i.created_at DESC 
                LIMIT $perPage OFFSET $offset";

        $stmt = $db->prepare($sql);
        $stmt->execute([$tagId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get total count for search results
     */
    public static function getSearchCount($query, $categoryId = null)
    {
        $db = Database::getInstance();

        $sql = "SELECT COUNT(DISTINCT i.id) as total
                FROM images i 
                LEFT JOIN image_tags it ON i.id = it.image_id
                LEFT JOIN tags t ON it.tag_id = t.id
                WHERE (i.title LIKE ? OR t.name LIKE ?)";

        $params = ["%$query%", "%$query%"];

        if ($categoryId) {
            $sql .= " AND i.category_id = ?";
            $params[] = $categoryId;
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Get total count for tag results
     */
    public static function getTagCount($tagId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT COUNT(*) as total FROM image_tags WHERE tag_id = ?");
        $stmt->execute([$tagId]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    /**
     * Get images with full information including tags (for admin listing)
     */
    public static function getAllWithTags()
    {
        $db = Database::getInstance();
        $sql = "SELECT i.*, 
                       c.name as category_name,
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug,
                       GROUP_CONCAT(t.name ORDER BY t.name ASC SEPARATOR ', ') as tags
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id
                LEFT JOIN categories p ON c.parent_id = p.id
                LEFT JOIN image_tags it ON i.id = it.image_id
                LEFT JOIN tags t ON it.tag_id = t.id
                GROUP BY i.id
                ORDER BY i.created_at DESC";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get recent images for dashboard
     */
    public static function getRecent($limit = 10)
    {
        $db = Database::getInstance();
        $limit = (int)$limit;
        $sql = "SELECT i.*, 
                       c.name as category_name,
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id
                LEFT JOIN categories p ON c.parent_id = p.id
                ORDER BY i.created_at DESC 
                LIMIT $limit";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get popular images by download count
     */
    public static function getPopular($limit = 10)
    {
        $db = Database::getInstance();
        $limit = (int)$limit;
        $sql = "SELECT i.*, 
                       c.name as category_name,
                       c.slug as category_slug,
                       p.name as parent_category_name,
                       p.slug as parent_category_slug
                FROM images i 
                LEFT JOIN categories c ON i.category_id = c.id
                LEFT JOIN categories p ON c.parent_id = p.id
                WHERE i.downloads > 0
                ORDER BY i.downloads DESC, i.created_at DESC
                LIMIT $limit";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get statistics for dashboard
     */
    public static function getStats()
    {
        $db = Database::getInstance();

        $totalImages = $db->query("SELECT COUNT(*) FROM images")->fetchColumn();
        $totalDownloads = $db->query("SELECT SUM(downloads) FROM images")->fetchColumn() ?: 0;
        $imagesThisMonth = $db->query("SELECT COUNT(*) FROM images WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")->fetchColumn();
        $imagesThisWeek = $db->query("SELECT COUNT(*) FROM images WHERE WEEK(created_at) = WEEK(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())")->fetchColumn();

        return [
            'total' => $totalImages,
            'downloads' => $totalDownloads,
            'this_month' => $imagesThisMonth,
            'this_week' => $imagesThisWeek
        ];
    }
}
