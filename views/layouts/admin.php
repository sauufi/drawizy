<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - CMS Coloring Pages</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/drawizy.png">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .kids-shadow {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .hover-bounce:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease-in-out;
        }

        .colorful-card {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border-left: 4px solid;
        }

        .stats-icon {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 50%, #fecfef 100%);
        }

        .nav-item {
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 8px 16px;
            margin: 0 4px;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 min-h-screen">
    <!-- Navigation -->
    <nav class="gradient-bg shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-full p-2 kids-shadow">
                        <i class="fas fa-palette text-purple-600 text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-xl">Kids Coloring CMS</h1>
                        <p class="text-purple-100 text-sm">Admin Dashboard</p>
                    </div>
                </div>

                <?php if (isset($_SESSION['user']) && $currentPath !== '/login'): ?>
                    <div class="flex items-center space-x-2">
                        <a href="/admin" class="nav-item text-white hover:text-yellow-200">
                            <i class="fas fa-home mr-2"></i>Dashboard
                        </a>
                        <a href="/dashboard/categories" class="nav-item text-white hover:text-yellow-200">
                            <i class="fas fa-tags mr-2"></i>Categories
                        </a>
                        <a href="/dashboard/images" class="nav-item text-white hover:text-yellow-200">
                            <i class="fas fa-images mr-2"></i>Images
                        </a>
                        <a href="/dashboard/change-password" class="nav-item text-white hover:text-yellow-200">
                            <i class="fas fa-key mr-2"></i>Password
                        </a>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="/dashboard/settings" class="nav-item text-white hover:text-yellow-200">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <a href="/dashboard/pages" class="nav-item text-white hover:text-yellow-200">
                                <i class="fas fa-file-alt mr-2"></i>Pages
                            </a>
                            <a href="/dashboard/users" class="nav-item text-white hover:text-yellow-200">
                                <i class="fas fa-users mr-2"></i>Users
                            </a>
                        <?php endif; ?>
                        <a href="/logout" class="nav-item text-red-200 hover:text-red-100 hover:bg-red-500 hover:bg-opacity-20">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <!-- Welcome Header -->
        <div class="mb-8 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Welcome Back! 🎨</h2>
            <p class="text-gray-600 text-lg">Let's create something colorful today!</p>
        </div>

        <?= $content ?>
    </div>

    <!-- Floating Elements for Fun -->
    <div class="fixed top-20 right-10 animate-bounce opacity-20 pointer-events-none">
        <i class="fas fa-star text-yellow-400 text-3xl"></i>
    </div>
    <div class="fixed bottom-20 left-10 animate-pulse opacity-20 pointer-events-none">
        <i class="fas fa-heart text-pink-400 text-2xl"></i>
    </div>
    <div class="fixed top-1/2 right-20 animate-bounce opacity-20 pointer-events-none" style="animation-delay: 1s;">
        <i class="fas fa-rainbow text-purple-400 text-2xl"></i>
    </div>
</body>

</html>