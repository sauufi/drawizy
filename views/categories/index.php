<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-full p-3">
                <i class="fas fa-sitemap text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Hierarchical Categories</h1>
                <p class="text-gray-600">Manage parent and child categories for better organization</p>
            </div>
        </div>
        <div class="hidden md:flex space-x-2">
            <div class="text-4xl animate-bounce">🎨</div>
            <div class="text-4xl animate-pulse">📁</div>
            <div class="text-4xl animate-bounce" style="animation-delay: 0.5s;">🌳</div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= $stats['total'] ?></div>
                <div class="text-blue-100">Total Categories</div>
            </div>
            <div class="text-3xl opacity-80">📊</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= $stats['parents'] ?></div>
                <div class="text-green-100">Parent Categories</div>
            </div>
            <div class="text-3xl opacity-80">🌳</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= $stats['children'] ?></div>
                <div class="text-purple-100">Child Categories</div>
            </div>
            <div class="text-3xl opacity-80">🔗</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= $stats['with_images'] ?></div>
                <div class="text-pink-100">With Images</div>
            </div>
            <div class="text-3xl opacity-80">🖼️</div>
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
                <h3 class="text-lg font-semibold">Create New Category</h3>
                <p class="text-purple-100">Add parent categories or subcategories to organize your content</p>
            </div>
        </div>
        <a href="/dashboard/categories/create"
            class="bg-white text-purple-600 px-6 py-3 rounded-2xl font-semibold hover:bg-purple-50 transition-all duration-300 transform hover:scale-105 kids-shadow flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Add Category</span>
        </a>
    </div>
</div>

<!-- Categories Tree List -->
<div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-purple-400">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-sitemap text-purple-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Category Hierarchy</h2>
                    <p class="text-purple-100">Organized in parent-child structure</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <button onclick="expandAll()" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all">
                    <i class="fas fa-expand-alt mr-1"></i> Expand All
                </button>
                <button onclick="collapseAll()" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all">
                    <i class="fas fa-compress-alt mr-1"></i> Collapse All
                </button>
            </div>
        </div>
    </div>

    <!-- Tree Container -->
    <div class="p-6">
        <div class="space-y-4" id="categoryTree">
            <?php
            $currentParent = null;
            foreach ($categories as $index => $c):
                // Check if this is a parent category (level 0)
                if ($c['level'] == 0):
                    $currentParent = $c['id'];
                    $hasChildren = false;
                    // Check if this parent has children
                    foreach ($categories as $child) {
                        if ($child['parent_id'] == $c['id']) {
                            $hasChildren = true;
                            break;
                        }
                    }
            ?>
                    <!-- Parent Category -->
                    <div class="parent-category border-2 border-gray-200 rounded-2xl hover:border-purple-300 transition-all">
                        <div class="flex items-center justify-between p-4 cursor-pointer" onclick="toggleChildren('parent-<?= $c['id'] ?>')">
                            <div class="flex items-center space-x-4">
                                <!-- Expand/Collapse Icon -->
                                <?php if ($hasChildren): ?>
                                    <button class="toggle-btn text-purple-500 hover:text-purple-700 transition-colors">
                                        <i class="fas fa-chevron-right transform transition-transform duration-200" id="icon-parent-<?= $c['id'] ?>"></i>
                                    </button>
                                <?php else: ?>
                                    <div class="w-4"></div>
                                <?php endif; ?>

                                <!-- Category Icon & Info -->
                                <div class="flex items-center space-x-3">
                                    <div class="w-6 h-6 rounded-full bg-gradient-to-r from-purple-400 to-pink-400"></div>
                                    <div>
                                        <div class="font-semibold text-gray-800 text-lg flex items-center">
                                            <?php
                                            // Add emoji based on category name
                                            $name = $c['name'];
                                            $emoji = '';
                                            if (stripos($name, 'animal') !== false) $emoji = '🐾';
                                            elseif (stripos($name, 'cartoon') !== false) $emoji = '🎭';
                                            elseif (stripos($name, 'nature') !== false) $emoji = '🌿';
                                            elseif (stripos($name, 'holiday') !== false) $emoji = '🎉';
                                            elseif (stripos($name, 'fantasy') !== false) $emoji = '🦄';
                                            elseif (stripos($name, 'vehicle') !== false) $emoji = '🚗';
                                            elseif (stripos($name, 'space') !== false) $emoji = '🚀';
                                            elseif (stripos($name, 'dinosaur') !== false) $emoji = '🦕';
                                            elseif (stripos($name, 'food') !== false) $emoji = '🍎';
                                            elseif (stripos($name, 'music') !== false) $emoji = '🎵';
                                            elseif (stripos($name, 'sport') !== false) $emoji = '⚽';
                                            elseif (stripos($name, 'people') !== false) $emoji = '👥';
                                            elseif (stripos($name, 'sea') !== false) $emoji = '🌊';
                                            elseif (stripos($name, 'insect') !== false) $emoji = '🦋';
                                            elseif (stripos($name, 'robot') !== false) $emoji = '🤖';
                                            elseif (stripos($name, 'myth') !== false) $emoji = '⚡';
                                            elseif (stripos($name, 'farm') !== false) $emoji = '🚜';
                                            elseif (stripos($name, 'weather') !== false) $emoji = '🌤️';
                                            elseif (stripos($name, 'mandala') !== false) $emoji = '🔮';
                                            elseif (stripos($name, 'learning') !== false) $emoji = '📚';
                                            else $emoji = '🎨';
                                            ?>
                                            <span class="text-2xl mr-2"><?= $emoji ?></span>
                                            <?= htmlspecialchars($name) ?>
                                            <span class="ml-2 text-sm bg-purple-100 text-purple-600 px-2 py-1 rounded-full">Parent</span>
                                        </div>
                                        <div class="text-sm text-gray-500 mt-1">
                                            <i class="fas fa-link mr-1"></i><?= htmlspecialchars($c['slug']) ?>
                                            <span class="ml-3">
                                                <i class="fas fa-images mr-1"></i><?= $c['total_image_count'] ?> images total
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center space-x-2">
                                <a href="/<?= $c['slug'] ?>" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition-all" title="View Category">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                <a href="/dashboard/categories/edit/<?= $c['id'] ?>"
                                    class="text-green-500 hover:text-green-700 p-2 rounded-lg hover:bg-green-50 transition-all" title="Edit Category">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="/dashboard/categories/delete/<?= $c['id'] ?>"
                                    class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-all" title="Delete Category"
                                    onclick="return confirm('⚠️ Delete this parent category?\n\nAll child categories will become parent categories.\nImages will remain in their current child categories.')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Children Container -->
                        <?php if ($hasChildren): ?>
                            <div class="children-container hidden pl-12 pr-4 pb-4" id="children-parent-<?= $c['id'] ?>">
                                <div class="border-l-2 border-purple-200 pl-4 space-y-2">
                                    <?php foreach ($categories as $child): ?>
                                        <?php if ($child['parent_id'] == $c['id']): ?>
                                            <!-- Child Category -->
                                            <div class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl border border-purple-100 hover:border-purple-300 transition-all">
                                                <div class="flex items-center space-x-3">
                                                    <div class="w-4 h-4 rounded-full bg-gradient-to-r from-blue-400 to-green-400"></div>
                                                    <div>
                                                        <div class="font-medium text-gray-700 flex items-center">
                                                            <?php
                                                            // Child category emoji
                                                            $childName = strtolower($child['name']);
                                                            $childEmoji = '';
                                                            if (stripos($childName, 'cat') !== false) $childEmoji = '🐱';
                                                            elseif (stripos($childName, 'dog') !== false) $childEmoji = '🐶';
                                                            elseif (stripos($childName, 'wild') !== false) $childEmoji = '🦁';
                                                            elseif (stripos($childName, 'farm') !== false) $childEmoji = '🐄';
                                                            elseif (stripos($childName, 'baby') !== false) $childEmoji = '🐣';
                                                            elseif (stripos($childName, 'sea') !== false) $childEmoji = '🐠';
                                                            elseif (stripos($childName, 'disney') !== false) $childEmoji = '🏰';
                                                            elseif (stripos($childName, 'anime') !== false) $childEmoji = '⚡';
                                                            elseif (stripos($childName, 'superhero') !== false) $childEmoji = '🦸';
                                                            elseif (stripos($childName, 'flower') !== false) $childEmoji = '🌸';
                                                            elseif (stripos($childName, 'tree') !== false) $childEmoji = '🌳';
                                                            elseif (stripos($childName, 'landscape') !== false) $childEmoji = '🏞️';
                                                            elseif (stripos($childName, 'christmas') !== false) $childEmoji = '🎄';
                                                            elseif (stripos($childName, 'halloween') !== false) $childEmoji = '🎃';
                                                            elseif (stripos($childName, 'easter') !== false) $childEmoji = '🐰';
                                                            elseif (stripos($childName, 'birthday') !== false) $childEmoji = '🎂';
                                                            else $childEmoji = '📄';
                                                            ?>
                                                            <span class="text-lg mr-2"><?= $childEmoji ?></span>
                                                            <?= htmlspecialchars($child['name']) ?>
                                                            <span class="ml-2 text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">Child</span>
                                                        </div>
                                                        <div class="text-xs text-gray-500 mt-1">
                                                            <i class="fas fa-link mr-1"></i><?= htmlspecialchars($child['slug']) ?>
                                                            <span class="ml-2">
                                                                <i class="fas fa-images mr-1"></i><?= $child['direct_image_count'] ?> images
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Child Actions -->
                                                <div class="flex items-center space-x-1">
                                                    <a href="/<?= $c['slug'] ?>/<?= $child['slug'] ?>" target="_blank"
                                                        class="text-blue-500 hover:text-blue-700 p-1 rounded hover:bg-blue-50 transition-all text-sm" title="View Child Category">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                    <a href="/dashboard/categories/edit/<?= $child['id'] ?>"
                                                        class="text-green-500 hover:text-green-700 p-1 rounded hover:bg-green-50 transition-all text-sm" title="Edit Child Category">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="/dashboard/categories/delete/<?= $child['id'] ?>"
                                                        class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition-all text-sm" title="Delete Child Category"
                                                        onclick="return confirm('Delete child category \'<?= htmlspecialchars($child['name']) ?>\'?\n\nImages in this category will be moved to the parent category.')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endif; ?>
            <?php endforeach; ?>

            <!-- Empty State -->
            <?php if (empty($categories)): ?>
                <div class="text-center py-12">
                    <div class="text-6xl opacity-50 mb-4">🎨</div>
                    <div class="text-gray-500">
                        <h3 class="text-lg font-semibold mb-2">No categories yet</h3>
                        <p>Start by creating your first category for coloring pictures!</p>
                    </div>
                    <a href="/dashboard/categories/create"
                        class="inline-block mt-4 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-2xl font-semibold hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-plus mr-2"></i>
                        Create First Category
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Quick Actions Panel -->
<div class="mt-8 bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-1">
    <div class="bg-white rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                    <i class="fas fa-lightning-bolt text-white"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Quick Actions</h3>
                    <p class="text-gray-600 text-sm">Manage your category structure efficiently</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="/dashboard/categories/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
                    <i class="fas fa-plus mr-1"></i> Add Category
                </a>
                <button onclick="exportCategories()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-all">
                    <i class="fas fa-download mr-1"></i> Export
                </button>
                <button onclick="showBulkActions()" class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-purple-600 transition-all">
                    <i class="fas fa-cogs mr-1"></i> Bulk Actions
                </button>
            </div>
        </div>
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

    .parent-category {
        transition: all 0.3s ease;
    }

    .parent-category:hover {
        transform: translateY(-1px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .children-container {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            max-height: 0;
        }

        to {
            opacity: 1;
            max-height: 500px;
        }
    }

    .toggle-btn .fa-chevron-right.rotated {
        transform: rotate(90deg);
    }
</style>

<script>
    function toggleChildren(parentId) {
        const childrenContainer = document.getElementById('children-' + parentId);
        const icon = document.getElementById('icon-' + parentId);

        if (childrenContainer) {
            if (childrenContainer.classList.contains('hidden')) {
                childrenContainer.classList.remove('hidden');
                icon.classList.add('rotated');
            } else {
                childrenContainer.classList.add('hidden');
                icon.classList.remove('rotated');
            }
        }
    }

    function expandAll() {
        document.querySelectorAll('.children-container').forEach(container => {
            container.classList.remove('hidden');
        });
        document.querySelectorAll('.toggle-btn .fa-chevron-right').forEach(icon => {
            icon.classList.add('rotated');
        });
    }

    function collapseAll() {
        document.querySelectorAll('.children-container').forEach(container => {
            container.classList.add('hidden');
        });
        document.querySelectorAll('.toggle-btn .fa-chevron-right').forEach(icon => {
            icon.classList.remove('rotated');
        });
    }

    function exportCategories() {
        // Implementation for exporting categories
        alert('Export functionality - to be implemented');
    }

    function showBulkActions() {
        // Implementation for bulk actions
        alert('Bulk actions functionality - to be implemented');
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Add some interactive animations
        const cards = document.querySelectorAll('.parent-category, .bg-gradient-to-br');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transform = 'translateY(-2px)';
                setTimeout(() => {
                    card.style.transform = 'translateY(0)';
                }, 200);
            }, index * 50);
        });
    });
</script>