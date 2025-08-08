<?php
session_start();

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

require_once __DIR__ . '/../app/Helpers.php';
require_once __DIR__ . '/../app/ImageHelper.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\CategoryController;
use App\Controllers\ImageController;
use App\Controllers\SettingController;
use App\Controllers\UserController;
use App\Controllers\PageController;
use App\Middleware\Auth;
use App\Middleware\Role;

$router = new Router();

// Auth
$router->add('GET', '/login', [AuthController::class, 'showLogin']);
$router->add('POST', '/login', [AuthController::class, 'login']);
$router->add('GET', '/logout', [AuthController::class, 'logout']);

// Admin role
$router->add('GET', '/dashboard/settings', [SettingController::class, 'index'], [Role::class, 'adminOnly']);
$router->add('POST', '/dashboard/settings', [SettingController::class, 'update'], [Role::class, 'adminOnly']);

$router->add('GET', '/dashboard/users', [UserController::class, 'index'], [Role::class, 'adminOnly']);
$router->add('POST', '/dashboard/users', [UserController::class, 'store'], [Role::class, 'adminOnly']);
$router->add('GET', '/dashboard/users/delete/{id}', [UserController::class, 'delete'], [Role::class, 'adminOnly']);

$router->add('GET', '/dashboard/pages', [PageController::class, 'index'], [Role::class, 'adminOnly']);
$router->add('GET', '/dashboard/pages/create', [PageController::class, 'create'], [Role::class, 'adminOnly']);
$router->add('POST', '/dashboard/pages', [PageController::class, 'store'], [Role::class, 'adminOnly']);
$router->add('GET', '/dashboard/pages/delete/{id}', [PageController::class, 'delete'], [Role::class, 'adminOnly']);
$router->add('GET', '/dashboard/pages/edit/{id}', [PageController::class, 'edit'], [Role::class, 'adminOnly']);
$router->add('POST', '/dashboard/pages/update/{id}', [PageController::class, 'update'], [Role::class, 'adminOnly']);

// API routes for admin
$router->add('GET', '/dashboard/categories/children/(\d+)', [CategoryController::class, 'getChildren'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/categories/search', [CategoryController::class, 'search'], [Role::class, 'editorOrAdmin']);
$router->add('POST', '/dashboard/categories/sort-order', [CategoryController::class, 'updateSortOrder'], [Role::class, 'editorOrAdmin']);

// Keep existing admin category management routes
$router->add('GET', '/dashboard/categories', [CategoryController::class, 'index'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/categories/create', [CategoryController::class, 'create'], [Role::class, 'editorOrAdmin']);
$router->add('POST', '/dashboard/categories/store', [CategoryController::class, 'store'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/categories/edit/{id}', [CategoryController::class, 'edit'], [Role::class, 'editorOrAdmin']);
$router->add('POST', '/dashboard/categories/update/{id}', [CategoryController::class, 'update'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/categories/delete/{id}', [CategoryController::class, 'delete'], [Role::class, 'editorOrAdmin']);

$router->add('GET', '/dashboard/images', [ImageController::class, 'index'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/images/create', [ImageController::class, 'create'], [Role::class, 'editorOrAdmin']);
$router->add('POST', '/dashboard/images/multiple', [ImageController::class, 'storeMultiple'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/images/edit/{id}', [ImageController::class, 'edit'], [Role::class, 'editorOrAdmin']);
$router->add('POST', '/dashboard/images/update/{id}', [ImageController::class, 'update'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/images/check-slug', [ImageController::class, 'checkSlug'], [Role::class, 'editorOrAdmin']);
$router->add('GET', '/dashboard/images/delete/{id}', [ImageController::class, 'delete'], [Role::class, 'editorOrAdmin']);

$router->add('GET', '/dashboard', [DashboardController::class, 'index'], [Auth::class, 'handle']);
$router->add('GET', '/dashboard/change-password', [AuthController::class, 'showChangePassword'], [Auth::class, 'handle']);
$router->add('POST', '/dashboard/change-password', [AuthController::class, 'changePassword'], [Auth::class, 'handle']);

// Frontend static page
$router->add('GET', '/page/{slug}', [PageController::class, 'showPages']);
$router->add('GET', '/{slug}', [PageController::class, 'show']);

// Frontend
$router->add('GET', '/', [ImageController::class, 'home']);
$router->add('GET', '/image/([\w-]+)', [ImageController::class, 'detail']);
// $router->add('GET', '/category/([\w-]+)', [CategoryController::class, 'show']);
$router->add('GET', '/download/(\d+)', [ImageController::class, 'download']);

// Single category (parent or child): /animals or /cats  
$router->add('GET', '/category/([\w-]+)', [CategoryController::class, 'show']);

// Parent/Child category: /animals/cats
$router->add('GET', '/([\w-]+)/([\w-]+)', [CategoryController::class, 'showChild']);


$router->run();
