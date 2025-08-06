<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Setting;
use App\Core\View;

class CategoryController
{
    /**
     * Display categories list in admin (with hierarchy)
     */
    public function index()
    {
        $this->checkAuth();

        // Get categories with hierarchy information
        $categories = Category::getAllWithHierarchy();
        $stats = Category::getStats();

        View::render('categories/index.php', [
            'categories' => $categories,
            'stats' => $stats
        ], 'layouts/admin.php');
    }

    /**
     * Show create category form
     */
    public function create()
    {
        $this->checkAuth();

        // Get parent categories for dropdown
        $parentCategories = Category::getParents();

        View::render('categories/form.php', [
            'parentCategories' => $parentCategories
        ], 'layouts/admin.php');
    }

    /**
     * Store new category
     */
    public function store()
    {
        $this->checkAuth();

        $name = $_POST['name'];
        $slug = $_POST['slug'] ?: $this->slugify($name);
        $slug = Category::generateUniqueSlug($slug);
        $description = $_POST['description'] ?? '';
        $parentId = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;

        Category::store($name, $slug, $description, $parentId);

        $_SESSION['success'] = "Category '{$name}' created successfully!";
        header("Location: /dashboard/categories");
        exit;
    }

    /**
     * Show edit category form
     */
    public function edit($id)
    {
        $this->checkAuth();

        $category = Category::find($id);
        if (!$category) {
            $_SESSION['error'] = "Category not found!";
            header("Location: /dashboard/categories");
            exit;
        }

        // Get parent categories for dropdown (exclude current category and its children)
        $parentCategories = $this->getValidParentCategories($id);

        View::render('categories/edit.php', [
            'category' => $category,
            'parentCategories' => $parentCategories
        ], 'layouts/admin.php');
    }

    /**
     * Update category
     */
    public function update($id)
    {
        $this->checkAuth();

        $name = $_POST['name'];
        $slug = $_POST['slug'] ?: $this->slugify($name);
        $slug = Category::generateUniqueSlug($slug, $id);
        $description = $_POST['description'] ?? '';
        $parentId = !empty($_POST['parent_id']) ? (int)$_POST['parent_id'] : null;

        // Prevent circular references
        if ($parentId && $this->wouldCreateCircularReference($id, $parentId)) {
            $_SESSION['error'] = "Cannot set parent category - this would create a circular reference!";
            header("Location: /dashboard/categories/edit/{$id}");
            exit;
        }

        Category::updateCategory($id, $name, $slug, $description, $parentId);

        $_SESSION['success'] = "Category '{$name}' updated successfully!";
        header("Location: /dashboard/categories");
        exit;
    }

    /**
     * Delete category
     */
    public function delete($id)
    {
        $this->checkAuth();

        $category = Category::find($id);
        if (!$category) {
            $_SESSION['error'] = "Category not found!";
            header("Location: /dashboard/categories");
            exit;
        }

        // Check if category has children
        if (Category::hasChildren($id)) {
            $_SESSION['warning'] = "Category '{$category['name']}' has child categories. They will become parent categories.";
        }

        Category::deleteCategory($id);
        $_SESSION['success'] = "Category '{$category['name']}' deleted successfully!";
        header("Location: /dashboard/categories");
        exit;
    }

    /**
     * Show category on frontend (single category view)
     * Handles both parent categories and child categories
     */
    public function show($slug)
    {
        $category = Category::findBySlug($slug);
        if (!$category) {
            http_response_code(404);
            View::render('frontend/pages/404.php', [], 'layouts/frontend.php');
            return;
        }

        $this->renderCategoryPage($category);
    }

    /**
     * Show child category on frontend (parent/child URL structure)
     * URL: /animals/cats
     */
    public function showChild($parentSlug, $childSlug)
    {
        $category = Category::findByParentAndChildSlug($parentSlug, $childSlug);
        if (!$category) {
            http_response_code(404);
            View::render('frontend/pages/404.php', [], 'layouts/frontend.php');
            return;
        }

        $this->renderCategoryPage($category);
    }

    /**
     * Render category page with images and pagination
     */
    private function renderCategoryPage($category)
    {
        $setting = Setting::get();

        // Generate meta data
        $meta_title = "Free " . $category['name'] . " Coloring Pages";
        if ($category['parent_name']) {
            $meta_title = "Free " . $category['parent_name'] . " " . $category['name'] . " Coloring Pages";
        }
        $meta_title .= " - " . $setting['site_title'];

        $meta_description = $this->generateMetaDescription($category);

        // Get images with pagination
        $db = \App\Core\Database::getInstance();
        $search = $_GET['q'] ?? '';
        $page = max(1, (int)($_GET['page'] ?? 1));
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        // Build query conditions
        if ($category['level'] == 0) {
            // Parent category - get images from this category AND all child categories
            $conditions = ["(c.id = ? OR c.parent_id = ?)"];
            $params = [$category['id'], $category['id']];

            if ($search) {
                $conditions[] = "i.title LIKE ?";
                $params[] = "%$search%";
            }

            $whereClause = "WHERE " . implode(" AND ", $conditions);

            // Get total count for parent category
            $stmt = $db->prepare("SELECT COUNT(DISTINCT i.id) as total 
                                FROM images i 
                                LEFT JOIN categories c ON i.category_id = c.id 
                                {$whereClause}");
            $stmt->execute($params);
            $total = $stmt->fetch()['total'];
            $totalPages = ceil($total / $perPage);

            // Get images for current page
            $sql = "SELECT i.*, 
                           c.name as category_name,
                           c.slug as category_slug,
                           p.name as parent_category_name,
                           p.slug as parent_category_slug
                    FROM images i 
                    LEFT JOIN categories c ON i.category_id = c.id
                    LEFT JOIN categories p ON c.parent_id = p.id
                    {$whereClause}
                    ORDER BY i.created_at DESC 
                    LIMIT {$perPage} OFFSET {$offset}";
        } else {
            // Child category - get images only from this category
            $conditions = ["category_id = ?"];
            $params = [$category['id']];

            if ($search) {
                $conditions[] = "title LIKE ?";
                $params[] = "%$search%";
            }

            $whereClause = "WHERE " . implode(" AND ", $conditions);

            // Get total count
            $stmt = $db->prepare("SELECT COUNT(*) as total FROM images {$whereClause}");
            $stmt->execute($params);
            $total = $stmt->fetch()['total'];
            $totalPages = ceil($total / $perPage);

            // Get images for current page
            $sql = "SELECT * FROM images {$whereClause} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}";
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        $images = $stmt->fetchAll();

        // Get related categories with first images for parent categories
        $relatedCategories = [];
        if ($category['level'] == 0) {
            // For parent categories, get child categories WITH their first images
            $relatedCategories = Category::getChildrenWithFirstImage($category['id']);
        } else {
            // For child categories, get sibling categories
            $relatedCategories = Category::getChildren($category['parent_id']);
        }

        // Get breadcrumb
        $breadcrumb = Category::getBreadcrumb($category['id']);

        View::render('frontend/category.php', [
            'category' => $category,
            'images' => $images,
            'search' => $search,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'meta_title' => $meta_title,
            'meta_description' => $meta_description,
            'relatedCategories' => $relatedCategories, // Now includes first_image_preview for parent categories
            'breadcrumb' => $breadcrumb
        ], 'layouts/frontend.php');
    }

    /**
     * API endpoint to get child categories for AJAX
     */
    public function getChildren($parentId)
    {
        header('Content-Type: application/json');
        $children = Category::getChildren($parentId);
        echo json_encode($children);
    }

    /**
     * API endpoint for category search (admin)
     */
    public function search()
    {
        $this->checkAuth();
        header('Content-Type: application/json');

        $query = $_GET['q'] ?? '';
        if (strlen($query) < 2) {
            echo json_encode([]);
            return;
        }

        $results = Category::search($query);
        echo json_encode($results);
    }

    /**
     * Update category sort order via AJAX
     */
    public function updateSortOrder()
    {
        $this->checkAuth();
        header('Content-Type: application/json');

        $categoryId = (int)$_POST['category_id'];
        $newOrder = (int)$_POST['sort_order'];

        $success = Category::updateSortOrder($categoryId, $newOrder);
        echo json_encode(['success' => $success]);
    }

    /**
     * Get valid parent categories (excluding current category and its descendants)
     */
    private function getValidParentCategories($excludeId)
    {
        $allParents = Category::getParents();

        // Filter out the current category and any that would create circular references
        return array_filter($allParents, function ($category) use ($excludeId) {
            return $category['id'] != $excludeId && !$this->isDescendantOf($category['id'], $excludeId);
        });
    }

    /**
     * Check if setting parentId would create a circular reference
     */
    private function wouldCreateCircularReference($categoryId, $parentId)
    {
        if (!$parentId) return false;

        // Check if parentId is a descendant of categoryId
        return $this->isDescendantOf($parentId, $categoryId);
    }

    /**
     * Check if categoryId is a descendant of ancestorId
     */
    private function isDescendantOf($categoryId, $ancestorId)
    {
        $db = \App\Core\Database::getInstance();

        $currentId = $categoryId;
        while ($currentId) {
            $stmt = $db->prepare("SELECT parent_id FROM categories WHERE id = ?");
            $stmt->execute([$currentId]);
            $result = $stmt->fetch();

            if (!$result) break;

            $currentId = $result['parent_id'];
            if ($currentId == $ancestorId) {
                return true;
            }
        }

        return false;
    }

    /**
     * Generate meta description from category info
     */
    private function generateMetaDescription($category)
    {
        if (!empty($category['description'])) {
            $description = strip_tags($category['description']);
            $pos = strpos($description, '.');
            return trim(substr($description, 0, $pos !== false ? $pos : 150)) . ".";
        }

        $desc = "Free " . $category['name'] . " coloring pages for kids.";
        if ($category['parent_name']) {
            $desc = "Free " . $category['parent_name'] . " " . $category['name'] . " coloring pages for kids.";
        }

        return $desc . " Print and download beautiful coloring sheets for creative fun!";
    }

    /**
     * Create URL-friendly slug
     */
    private function slugify($text)
    {
        $text = strtolower(trim($text));
        $text = preg_replace('/[^a-z0-9]+/', '-', $text);
        return trim($text, '-');
    }

    /**
     * Check if user is authenticated
     */
    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
    }
}
