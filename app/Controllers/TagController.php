<?php

namespace App\Controllers;

use App\Models\Tag;
use App\Core\View;

class TagController
{
    /**
     * Display all tags with statistics
     */
    public function index()
    {
        $this->checkAuth();

        $tags = Tag::getPopular(100); // Get all tags with usage count
        $stats = Tag::getStats();

        View::render('tags/index.php', [
            'tags' => $tags,
            'stats' => $stats
        ], 'layouts/admin.php');
    }

    /**
     * Show create tag form
     */
    public function create()
    {
        $this->checkAuth();
        View::render('tags/form.php', [], 'layouts/admin.php');
    }

    /**
     * Store new tag
     */
    public function store()
    {
        $this->checkAuth();

        $name = trim($_POST['name']);
        $color = $_POST['color'] ?? '#3B82F6';

        if (empty($name)) {
            $_SESSION['error'] = "Tag name is required!";
            header("Location: /admin/tags/create");
            exit;
        }

        if (strlen($name) < 2) {
            $_SESSION['error'] = "Tag name must be at least 2 characters long!";
            header("Location: /admin/tags/create");
            exit;
        }

        if (strlen($name) > 50) {
            $_SESSION['error'] = "Tag name cannot be longer than 50 characters!";
            header("Location: /admin/tags/create");
            exit;
        }

        // Check if tag already exists
        $existing = Tag::findByName($name);
        if ($existing) {
            $_SESSION['error'] = "Tag '{$name}' already exists!";
            header("Location: /admin/tags/create");
            exit;
        }

        $tagId = Tag::create($name, $color);

        if ($tagId) {
            $_SESSION['success'] = "Tag '{$name}' created successfully!";
        } else {
            $_SESSION['error'] = "Failed to create tag!";
        }

        header("Location: /admin/tags");
        exit;
    }

    /**
     * Show edit tag form
     */
    public function edit($id)
    {
        $this->checkAuth();

        $tag = Tag::find($id);
        if (!$tag) {
            $_SESSION['error'] = "Tag not found!";
            header("Location: /admin/tags");
            exit;
        }

        View::render('tags/edit.php', ['tag' => $tag], 'layouts/admin.php');
    }

    /**
     * Update tag
     */
    public function update($id)
    {
        $this->checkAuth();

        $tag = Tag::find($id);
        if (!$tag) {
            $_SESSION['error'] = "Tag not found!";
            header("Location: /admin/tags");
            exit;
        }

        $name = trim($_POST['name']);
        $color = $_POST['color'] ?? $tag['color'];

        if (empty($name)) {
            $_SESSION['error'] = "Tag name is required!";
            header("Location: /admin/tags/{$id}/edit");
            exit;
        }

        if (strlen($name) < 2) {
            $_SESSION['error'] = "Tag name must be at least 2 characters long!";
            header("Location: /admin/tags/{$id}/edit");
            exit;
        }

        if (strlen($name) > 50) {
            $_SESSION['error'] = "Tag name cannot be longer than 50 characters!";
            header("Location: /admin/tags/{$id}/edit");
            exit;
        }

        // Check if another tag with same name exists
        $existing = Tag::findByName($name);
        if ($existing && $existing['id'] != $id) {
            $_SESSION['error'] = "Another tag with name '{$name}' already exists!";
            header("Location: /admin/tags/{$id}/edit");
            exit;
        }

        $result = Tag::update($id, $name, $color);

        if ($result) {
            $_SESSION['success'] = "Tag '{$name}' updated successfully!";
        } else {
            $_SESSION['error'] = "Failed to update tag!";
        }

        header("Location: /admin/tags");
        exit;
    }

    /**
     * Delete tag
     */
    public function delete($id)
    {
        $this->checkAuth();

        $tag = Tag::find($id);
        if (!$tag) {
            $_SESSION['error'] = "Tag not found!";
            header("Location: /admin/tags");
            exit;
        }

        $result = Tag::delete($id);

        if ($result) {
            $_SESSION['success'] = "Tag '{$tag['name']}' deleted successfully!";
        } else {
            $_SESSION['error'] = "Failed to delete tag!";
        }

        header("Location: /admin/tags");
        exit;
    }

    /**
     * AJAX endpoint for tag search (for autocomplete)
     */
    public function search()
    {
        $this->checkAuth();

        $query = $_GET['q'] ?? '';
        $limit = (int)($_GET['limit'] ?? 10);

        if (strlen($query) < 2) {
            echo json_encode([]);
            return;
        }

        $tags = Tag::search($query, $limit);

        header('Content-Type: application/json');
        echo json_encode($tags);
    }

    /**
     * AJAX endpoint to get popular tags
     */
    public function popular()
    {
        $limit = (int)($_GET['limit'] ?? 20);
        $tags = Tag::getPopular($limit);

        header('Content-Type: application/json');
        echo json_encode($tags);
    }

    /**
     * Bulk delete unused tags
     */
    public function cleanupUnused()
    {
        $this->checkAuth();

        $db = \App\Core\Database::getInstance();

        // Get unused tags
        $stmt = $db->query("SELECT id, name FROM tags WHERE id NOT IN (SELECT DISTINCT tag_id FROM image_tags)");
        $unusedTags = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        if (empty($unusedTags)) {
            $_SESSION['info'] = "No unused tags found!";
            header("Location: /admin/tags");
            exit;
        }

        // Delete unused tags
        $deletedCount = 0;
        foreach ($unusedTags as $tag) {
            if (Tag::delete($tag['id'])) {
                $deletedCount++;
            }
        }

        if ($deletedCount > 0) {
            $_SESSION['success'] = "Deleted {$deletedCount} unused tag(s)!";
        } else {
            $_SESSION['error'] = "Failed to delete unused tags!";
        }

        header("Location: /admin/tags");
        exit;
    }

    /**
     * Merge tags (combine multiple tags into one)
     */
    public function merge()
    {
        $this->checkAuth();

        $sourceTagIds = $_POST['source_tags'] ?? [];
        $targetTagId = $_POST['target_tag'] ?? null;

        if (empty($sourceTagIds) || !$targetTagId) {
            $_SESSION['error'] = "Please select source tags and target tag!";
            header("Location: /admin/tags");
            exit;
        }

        $db = \App\Core\Database::getInstance();
        $db->beginTransaction();

        $mergedCount = 0;

        foreach ($sourceTagIds as $sourceTagId) {
            if ($sourceTagId == $targetTagId) continue;

            // Move all image associations to target tag
            $stmt = $db->prepare("UPDATE IGNORE image_tags SET tag_id = ? WHERE tag_id = ?");
            $stmt->execute([$targetTagId, $sourceTagId]);

            // Remove any duplicate associations
            $stmt = $db->prepare("DELETE FROM image_tags WHERE tag_id = ?");
            $stmt->execute([$sourceTagId]);

            // Delete the source tag
            if (Tag::delete($sourceTagId)) {
                $mergedCount++;
            }
        }

        $db->commit();

        if ($mergedCount > 0) {
            $_SESSION['success'] = "Successfully merged {$mergedCount} tag(s)!";
        } else {
            $_SESSION['error'] = "Failed to merge tags!";
        }

        header("Location: /admin/tags");
        exit;
    }

    /**
     * Show tag details with associated images
     */
    public function show($id)
    {
        $this->checkAuth();

        $tag = Tag::find($id);
        if (!$tag) {
            $_SESSION['error'] = "Tag not found!";
            header("Location: /admin/tags");
            exit;
        }

        $page = max(1, (int)($_GET['page'] ?? 1));
        $images = \App\Models\Image::getByTag($id, $page, 20);
        $totalImages = \App\Models\Image::getTagCount($id);
        $totalPages = ceil($totalImages / 20);

        View::render('tags/show.php', [
            'tag' => $tag,
            'images' => $images,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalImages' => $totalImages
        ], 'layouts/admin.php');
    }

    /**
     * Export tags as CSV
     */
    public function export()
    {
        $this->checkAuth();

        $tags = Tag::getPopular(1000); // Get all tags

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="tags_export_' . date('Y-m-d') . '.csv"');

        $output = fopen('php://output', 'w');

        // CSV headers
        fputcsv($output, ['ID', 'Name', 'Slug', 'Color', 'Usage Count', 'Created At']);

        foreach ($tags as $tag) {
            fputcsv($output, [
                $tag['id'],
                $tag['name'],
                $tag['slug'],
                $tag['color'],
                $tag['usage_count'] ?? 0,
                $tag['created_at']
            ]);
        }

        fclose($output);
        exit;
    }

    /**
     * Check authentication
     */
    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
