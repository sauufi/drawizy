<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Tag
{
    /**
     * Get all tags ordered by name
     */
    public static function all()
    {
        $db = Database::getInstance();
        $sql = "SELECT * FROM tags ORDER BY name ASC";
        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find tag by ID
     */
    public static function find($id)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM tags WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find tag by slug
     */
    public static function findBySlug($slug)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM tags WHERE slug = ?");
        $stmt->execute([$slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Find tag by name (case insensitive)
     */
    public static function findByName($name)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM tags WHERE LOWER(name) = LOWER(?)");
        $stmt->execute([$name]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new tag
     */
    public static function create($name, $color = '#3B82F6')
    {
        $db = Database::getInstance();
        $slug = self::generateSlug($name);

        $stmt = $db->prepare("INSERT INTO tags (name, slug, color) VALUES (?, ?, ?)");
        $stmt->execute([$name, $slug, $color]);

        return $db->lastInsertId();
    }

    /**
     * Find or create a tag by name
     */
    public static function findOrCreate($name, $color = '#3B82F6')
    {
        $existing = self::findByName($name);
        if ($existing) {
            return $existing['id'];
        }

        return self::create($name, $color);
    }

    /**
     * Generate unique slug for tag
     */
    public static function generateSlug($name)
    {
        $baseSlug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));
        $slug = $baseSlug;
        $counter = 1;

        $db = Database::getInstance();

        while (true) {
            $stmt = $db->prepare("SELECT COUNT(*) FROM tags WHERE slug = ?");
            $stmt->execute([$slug]);

            if ($stmt->fetchColumn() == 0) {
                break;
            }

            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Get tags for a specific image
     */
    public static function getByImageId($imageId)
    {
        $db = Database::getInstance();
        $sql = "SELECT t.* FROM tags t 
                JOIN image_tags it ON t.id = it.tag_id 
                WHERE it.image_id = ? 
                ORDER BY t.name ASC";

        $stmt = $db->prepare($sql);
        $stmt->execute([$imageId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Add tag to image
     */
    public static function addToImage($imageId, $tagId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT IGNORE INTO image_tags (image_id, tag_id) VALUES (?, ?)");
        return $stmt->execute([$imageId, $tagId]);
    }

    /**
     * Remove tag from image
     */
    public static function removeFromImage($imageId, $tagId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM image_tags WHERE image_id = ? AND tag_id = ?");
        return $stmt->execute([$imageId, $tagId]);
    }

    /**
     * Remove all tags from image
     */
    public static function removeAllFromImage($imageId)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM image_tags WHERE image_id = ?");
        return $stmt->execute([$imageId]);
    }

    /**
     * Set tags for image (replaces all existing tags)
     */
    public static function setForImage($imageId, $tagIds)
    {
        $db = Database::getInstance();

        // Start transaction
        $db->beginTransaction();

        // Remove all existing tags
        self::removeAllFromImage($imageId);

        // Add new tags
        if (!empty($tagIds)) {
            $stmt = $db->prepare("INSERT INTO image_tags (image_id, tag_id) VALUES (?, ?)");
            foreach ($tagIds as $tagId) {
                $stmt->execute([$imageId, $tagId]);
            }
        }

        // Commit transaction
        $db->commit();

        return true;
    }

    /**
     * Process tags from form input (comma-separated string)
     */
    public static function processTagsFromInput($tagsString)
    {
        if (empty(trim($tagsString))) {
            return [];
        }

        $tagNames = array_map('trim', explode(',', $tagsString));
        $tagNames = array_filter($tagNames); // Remove empty values
        $tagNames = array_unique($tagNames); // Remove duplicates

        $tagIds = [];
        $colors = ['#EC4899', '#F97316', '#8B5CF6', '#06B6D4', '#10B981', '#F59E0B', '#84CC16', '#EF4444', '#0EA5E9', '#F472B6'];

        foreach ($tagNames as $index => $tagName) {
            $color = $colors[$index % count($colors)];
            $tagIds[] = self::findOrCreate($tagName, $color);
        }

        return $tagIds;
    }

    /**
     * Get popular tags with usage count
     */
    public static function getPopular($limit = 20)
    {
        $db = Database::getInstance();
        $limit = (int)$limit; // Ensure it's an integer
        $sql = "SELECT t.*, COUNT(it.image_id) as usage_count 
                FROM tags t 
                LEFT JOIN image_tags it ON t.id = it.tag_id 
                GROUP BY t.id 
                ORDER BY usage_count DESC, t.name ASC 
                LIMIT $limit";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Search tags by name
     */
    public static function search($query, $limit = 10)
    {
        $db = Database::getInstance();
        $limit = (int)$limit; // Ensure it's an integer
        $stmt = $db->prepare("SELECT * FROM tags WHERE name LIKE ? ORDER BY name ASC LIMIT $limit");
        $stmt->execute(["%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Delete tag and remove all associations
     */
    public static function delete($id)
    {
        $db = Database::getInstance();

        // Start transaction
        $db->beginTransaction();

        // Remove from image_tags
        $stmt = $db->prepare("DELETE FROM image_tags WHERE tag_id = ?");
        $stmt->execute([$id]);

        // Remove the tag
        $stmt = $db->prepare("DELETE FROM tags WHERE id = ?");
        $result = $stmt->execute([$id]);

        // Commit transaction
        $db->commit();

        return $result;
    }

    /**
     * Update tag
     */
    public static function update($id, $name, $color = null)
    {
        $db = Database::getInstance();

        if ($color) {
            $stmt = $db->prepare("UPDATE tags SET name = ?, color = ? WHERE id = ?");
            return $stmt->execute([$name, $color, $id]);
        } else {
            $stmt = $db->prepare("UPDATE tags SET name = ? WHERE id = ?");
            return $stmt->execute([$name, $id]);
        }
    }

    /**
     * Get tag statistics
     */
    public static function getStats()
    {
        $db = Database::getInstance();

        $totalTags = $db->query("SELECT COUNT(*) FROM tags")->fetchColumn();
        $usedTags = $db->query("SELECT COUNT(DISTINCT tag_id) FROM image_tags")->fetchColumn();
        $unusedTags = $totalTags - $usedTags;

        return [
            'total' => $totalTags,
            'used' => $usedTags,
            'unused' => $unusedTags
        ];
    }
}
