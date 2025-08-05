<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-full p-3">
                <i class="fas fa-tags text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Coloring Category</h1>
                <p class="text-gray-600">Manage categories of coloring pictures for kids</p>
            </div>
        </div>
        <div class="hidden md:flex space-x-2">
            <div class="text-4xl animate-bounce">🎨</div>
            <div class="text-4xl animate-pulse">🖍️</div>
            <div class="text-4xl animate-bounce" style="animation-delay: 0.5s;">✏️</div>
        </div>
    </div>
</div>

<!-- Add New Category Button -->
<div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-6 mb-8 kids-shadow">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="bg-white rounded-full p-3 kids-shadow">
                <i class="fas fa-plus text-pink-500 text-xl"></i>
            </div>
            <div class="text-white">
                <h3 class="text-lg font-semibold">Create a New Category</h3>
                <p class="text-purple-100">Add interesting coloring themes for children</p>
            </div>
        </div>
        <a href="/admin/categories/create"
            class="bg-white text-purple-600 px-6 py-3 rounded-2xl font-semibold hover:bg-purple-50 transition-all duration-300 transform hover:scale-105 kids-shadow flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Add Category</span>
        </a>
    </div>
</div>

<!-- Categories List -->
<div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-purple-400">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6">
        <div class="flex items-center space-x-3">
            <div class="bg-white rounded-full p-2">
                <i class="fas fa-list text-purple-500 text-lg"></i>
            </div>
            <div class="text-white">
                <h2 class="text-xl font-bold">Category List</h2>
                <p class="text-purple-100">All categories of coloring pictures available</p>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-purple-100 to-pink-100">
                <tr>
                    <th class="p-4 text-left font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tag text-purple-500"></i>
                            <span>Category Name</span>
                        </div>
                    </th>
                    <th class="p-4 text-left font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-link text-blue-500"></i>
                            <span>Slug</span>
                        </div>
                    </th>
                    <th class="p-4 text-center font-semibold text-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-cogs text-green-500"></i>
                            <span>Action</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                <?php foreach ($categories as $index => $c): ?>
                    <tr class="hover:bg-gradient-to-r hover:from-purple-50 hover:to-pink-50 transition-all duration-300 group">
                        <td class="p-4">
                            <div class="flex items-center space-x-3">
                                <!-- Color indicator -->
                                <div class="w-4 h-4 rounded-full <?=
                                                                    $index % 6 == 0 ? 'bg-pink-400' : ($index % 6 == 1 ? 'bg-blue-400' : ($index % 6 == 2 ? 'bg-green-400' : ($index % 6 == 3 ? 'bg-yellow-400' : ($index % 6 == 4 ? 'bg-purple-400' : 'bg-red-400'))))
                                                                    ?> group-hover:scale-110 transition-transform"></div>

                                <!-- Category name with emoji -->
                                <div>
                                    <div class="font-medium text-gray-800 text-lg">
                                        <?php
                                        // Add fun emojis based on category name
                                        $name = htmlspecialchars($c['name']);
                                        $emoji = '';
                                        if (stripos($name, 'animal') !== false || stripos($name, 'hewan') !== false) $emoji = '🐾';
                                        elseif (stripos($name, 'flower') !== false || stripos($name, 'bunga') !== false) $emoji = '🌸';
                                        elseif (stripos($name, 'car') !== false || stripos($name, 'mobil') !== false) $emoji = '🚗';
                                        elseif (stripos($name, 'princess') !== false || stripos($name, 'putri') !== false) $emoji = '👸';
                                        elseif (stripos($name, 'nature') !== false || stripos($name, 'alam') !== false) $emoji = '🌿';
                                        else $emoji = '🎨';
                                        ?>
                                        <span class="mr-2"><?= $emoji ?></span>
                                        <?= $name ?>
                                    </div>
                                    <div class="text-sm text-gray-500">Coloring categories</div>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-hashtag text-gray-400 text-sm"></i>
                                <code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono text-gray-700">
                                    <?= htmlspecialchars($c['slug']) ?>
                                </code>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- Edit Button -->
                                <a href="/admin/categories/edit/<?= $c['id'] ?>"
                                    class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded-xl hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 text-sm font-medium kids-shadow">
                                    <i class="fas fa-edit mr-1"></i>
                                    Edit
                                </a>

                                <!-- Delete Button -->
                                <a href="/admin/categories/delete/<?= $c['id'] ?>"
                                    class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-all duration-300 transform hover:scale-105 text-sm font-medium kids-shadow"
                                    onclick="return confirm('🗑️ Are you sure you want to delete this category?\n\nAll images in this category will also be affected!')">
                                    <i class="fas fa-trash mr-1"></i>
                                    Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                <!-- Empty state if no categories -->
                <?php if (empty($categories)): ?>
                    <tr>
                        <td colspan="3" class="p-12 text-center">
                            <div class="flex flex-col items-center space-y-4">
                                <div class="text-6xl opacity-50">🎨</div>
                                <div class="text-gray-500">
                                    <h3 class="text-lg font-semibold mb-2">No categories yet</h3>
                                    <p>Start by creating the first category for coloring pictures!</p>
                                </div>
                                <a href="/admin/categories/create"
                                    class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-2xl font-semibold hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                                    <i class="fas fa-plus mr-2"></i>
                                    Create the First Category
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Stats -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= count($categories) ?></div>
                <div class="text-pink-100">Total Categories</div>
            </div>
            <div class="text-3xl opacity-80">📁</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold">
                    <?php
                    // Count active categories (you can modify this logic based on your needs)
                    echo count(array_filter($categories, function ($cat) {
                        return !empty($cat['name']);
                    }));
                    ?>
                </div>
                <div class="text-blue-100">Active Category</div>
            </div>
            <div class="text-3xl opacity-80">✅</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold">∞</div>
                <div class="text-green-100">Creativity</div>
            </div>
            <div class="text-3xl opacity-80">🌟</div>
        </div>
    </div>
</div>

<!-- Fun Footer Message -->
<div class="mt-8 bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-6 text-center text-white kids-shadow">
    <div class="flex items-center justify-center space-x-2 text-lg font-semibold">
        <span>🎨</span>
        <span>Creativity starts with organized categories!</span>
        <span>🖍️</span>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .hover-bounce:hover {
        transform: translateY(-2px);
        transition: transform 0.2s ease-in-out;
    }

    /* Fun animation for table rows */
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    tbody tr {
        animation: slideInUp 0.3s ease-out;
    }

    tbody tr:nth-child(1) {
        animation-delay: 0.1s;
    }

    tbody tr:nth-child(2) {
        animation-delay: 0.2s;
    }

    tbody tr:nth-child(3) {
        animation-delay: 0.3s;
    }

    tbody tr:nth-child(4) {
        animation-delay: 0.4s;
    }

    tbody tr:nth-child(5) {
        animation-delay: 0.5s;
    }

    /* Hover effect for action buttons */
    .group:hover .fas {
        animation: bounce 1s infinite;
    }

    @keyframes bounce {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-3px);
        }

        60% {
            transform: translateY(-2px);
        }
    }
</style>