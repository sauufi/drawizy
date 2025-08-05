<!-- Header Section -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="bg-gradient-to-r from-pink-400 to-purple-400 rounded-full p-3">
                <i class="fas fa-images text-white text-2xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Coloring Images Management</h1>
                <p class="text-gray-600">Manage your collection of beautiful coloring pages</p>
            </div>
        </div>
        <div class="hidden md:flex space-x-2">
            <div class="text-4xl animate-bounce">🎨</div>
            <div class="text-4xl animate-pulse">🖼️</div>
            <div class="text-4xl animate-bounce" style="animation-delay: 0.5s;">✨</div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold"><?= count($images) ?></div>
                <div class="text-pink-100">Total Images</div>
            </div>
            <div class="text-3xl opacity-80">🖼️</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold">
                    <?php
                    $totalDownloads = 0;
                    foreach ($images as $img) {
                        $totalDownloads += $img['downloads'];
                    }
                    echo number_format($totalDownloads);
                    ?>
                </div>
                <div class="text-blue-100">Total Downloads</div>
            </div>
            <div class="text-3xl opacity-80">📥</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold">
                    <?php
                    $categories = [];
                    foreach ($images as $img) {
                        if ($img['category_name'] && !in_array($img['category_name'], $categories)) {
                            $categories[] = $img['category_name'];
                        }
                    }
                    echo count($categories);
                    ?>
                </div>
                <div class="text-green-100">Categories Used</div>
            </div>
            <div class="text-3xl opacity-80">📁</div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white kids-shadow">
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold">
                    <?php
                    $recentCount = 0;
                    $oneWeekAgo = date('Y-m-d H:i:s', strtotime('-1 week'));
                    foreach ($images as $img) {
                        if ($img['created_at'] >= $oneWeekAgo) {
                            $recentCount++;
                        }
                    }
                    echo $recentCount;
                    ?>
                </div>
                <div class="text-purple-100">Added This Week</div>
            </div>
            <div class="text-3xl opacity-80">⭐</div>
        </div>
    </div>
</div>

<!-- Add New Images Button -->
<div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-6 mb-8 kids-shadow">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <div class="bg-white rounded-full p-3 kids-shadow">
                <i class="fas fa-upload text-pink-500 text-xl"></i>
            </div>
            <div class="text-white">
                <h3 class="text-lg font-semibold">Upload New Coloring Pages</h3>
                <p class="text-purple-100">Add beautiful new images to your collection</p>
            </div>
        </div>
        <a href="/admin/images/create"
            class="bg-white text-purple-600 px-6 py-3 rounded-2xl font-semibold hover:bg-purple-50 transition-all duration-300 transform hover:scale-105 kids-shadow flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Upload Images</span>
        </a>
    </div>
</div>

<!-- Images List -->
<div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-pink-400">
    <!-- Header -->
    <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-images text-pink-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Coloring Images Collection</h2>
                    <p class="text-pink-100">All your beautiful coloring pages in one place</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <select id="categoryFilter" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all">
                    <option value="">All Categories</option>
                    <?php
                    $uniqueCategories = [];
                    foreach ($images as $img) {
                        if ($img['category_name'] && !in_array($img['category_name'], $uniqueCategories)) {
                            $uniqueCategories[] = $img['category_name'];
                        }
                    }
                    sort($uniqueCategories);
                    foreach ($uniqueCategories as $cat):
                    ?>
                        <option value="<?= htmlspecialchars($cat) ?>"><?= htmlspecialchars($cat) ?></option>
                    <?php endforeach; ?>
                </select>
                <button onclick="toggleView()" id="viewToggle" class="bg-white bg-opacity-20 text-white px-4 py-2 rounded-lg hover:bg-opacity-30 transition-all">
                    <i class="fas fa-th mr-1"></i> Grid View
                </button>
            </div>
        </div>
    </div>

    <!-- Table View -->
    <div id="tableView" class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b-2 border-pink-200">
                <tr>
                    <th class="p-4 text-left font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-image text-pink-500"></i>
                            <span>Preview</span>
                        </div>
                    </th>
                    <th class="p-4 text-left font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-tag text-blue-500"></i>
                            <span>Title</span>
                        </div>
                    </th>
                    <th class="p-4 text-left font-semibold text-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-folder text-green-500"></i>
                            <span>Category</span>
                        </div>
                    </th>
                    <th class="p-4 text-center font-semibold text-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-download text-purple-500"></i>
                            <span>Downloads</span>
                        </div>
                    </th>
                    <th class="p-4 text-center font-semibold text-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-calendar text-orange-500"></i>
                            <span>Added</span>
                        </div>
                    </th>
                    <th class="p-4 text-center font-semibold text-gray-700">
                        <div class="flex items-center justify-center space-x-2">
                            <i class="fas fa-cogs text-gray-500"></i>
                            <span>Actions</span>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($images as $index => $img): ?>
                    <tr class="border-b border-gray-100 hover:bg-purple-50 transition-colors duration-200 image-row" data-category="<?= htmlspecialchars($img['category_name']) ?>">
                        <!-- Preview Image -->
                        <td class="p-4">
                            <div class="relative group">
                                <div class="w-20 h-20 rounded-xl overflow-hidden shadow-md border-2 border-gray-200 group-hover:border-pink-300 transition-all">
                                    <img src="/uploads/<?= $img['preview'] ?>"
                                        alt="<?= htmlspecialchars($img['title']) ?>"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <!-- Hover overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                </div>
                            </div>
                        </td>

                        <!-- Title -->
                        <td class="p-4">
                            <div>
                                <div class="font-semibold text-gray-800 hover:text-purple-600 transition-colors">
                                    <?= htmlspecialchars($img['title']) ?>
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    <i class="fas fa-link mr-1"></i>
                                    <span class="font-mono"><?= htmlspecialchars($img['slug']) ?></span>
                                </div>
                            </div>
                        </td>

                        <!-- Category -->
                        <td class="p-4">
                            <?php if ($img['category_name']): ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                    <i class="fas fa-folder mr-1"></i>
                                    <?= htmlspecialchars($img['category_name']) ?>
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    No Category
                                </span>
                            <?php endif; ?>
                        </td>

                        <!-- Downloads -->
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center">
                                <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-semibold text-sm">
                                    <i class="fas fa-download mr-1"></i>
                                    <?= number_format($img['downloads']) ?>
                                </div>
                            </div>
                        </td>

                        <!-- Date Added -->
                        <td class="p-4 text-center">
                            <div class="text-sm text-gray-600">
                                <?= date('M j, Y', strtotime($img['created_at'])) ?>
                            </div>
                            <div class="text-xs text-gray-500">
                                <?= date('H:i', strtotime($img['created_at'])) ?>
                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="p-4">
                            <div class="flex items-center justify-center space-x-2">
                                <!-- View -->
                                <a href="/image/<?= $img['slug'] ?>" target="_blank"
                                    class="text-blue-500 hover:text-blue-700 p-2 rounded-lg hover:bg-blue-50 transition-all tooltip"
                                    title="View Image Page">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>

                                <!-- Edit -->
                                <a href="/admin/images/edit/<?= $img['id'] ?>"
                                    class="text-green-500 hover:text-green-700 p-2 rounded-lg hover:bg-green-50 transition-all tooltip"
                                    title="Edit Image">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Download PDF -->
                                <a href="/download/<?= $img['id'] ?>" target="_blank"
                                    class="text-purple-500 hover:text-purple-700 p-2 rounded-lg hover:bg-purple-50 transition-all tooltip"
                                    title="Download PDF">
                                    <i class="fas fa-file-pdf"></i>
                                </a>

                                <!-- Delete -->
                                <a href="/admin/images/delete/<?= $img['id'] ?>"
                                    class="text-red-500 hover:text-red-700 p-2 rounded-lg hover:bg-red-50 transition-all tooltip"
                                    title="Delete Image"
                                    onclick="return confirm('🗑️ Delete this coloring page?\n\nTitle: <?= htmlspecialchars($img['title']) ?>\nCategory: <?= htmlspecialchars($img['category_name']) ?>\nDownloads: <?= $img['downloads'] ?>\n\nThis action cannot be undone!')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Grid View (Hidden by default) -->
    <div id="gridView" class="hidden p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($images as $img): ?>
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 hover:border-pink-300 transition-all duration-300 transform hover:-translate-y-2 hover:shadow-xl image-card" data-category="<?= htmlspecialchars($img['category_name']) ?>">
                    <!-- Image -->
                    <div class="relative overflow-hidden rounded-t-2xl">
                        <img src="/uploads/<?= $img['preview'] ?>"
                            alt="<?= htmlspecialchars($img['title']) ?>"
                            class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex space-x-2">
                                    <a href="/image/<?= $img['slug'] ?>" target="_blank"
                                        class="bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                    <a href="/admin/images/edit/<?= $img['id'] ?>"
                                        class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition-colors">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/download/<?= $img['id'] ?>" target="_blank"
                                        class="bg-purple-500 text-white p-2 rounded-lg hover:bg-purple-600 transition-colors">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Download Badge -->
                        <div class="absolute top-3 right-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-download mr-1"></i><?= number_format($img['downloads']) ?>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 mb-2 line-clamp-2">
                            <?= htmlspecialchars($img['title']) ?>
                        </h3>

                        <div class="flex items-center justify-between text-sm text-gray-500 mb-3">
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-1"></i>
                                <?= date('M j', strtotime($img['created_at'])) ?>
                            </span>
                            <?php if ($img['category_name']): ?>
                                <span class="bg-purple-100 text-purple-700 px-2 py-1 rounded-full text-xs">
                                    <?= htmlspecialchars($img['category_name']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-2">
                            <a href="/admin/images/edit/<?= $img['id'] ?>"
                                class="flex-1 bg-blue-500 text-white text-center py-2 rounded-lg hover:bg-blue-600 transition-colors text-sm font-semibold">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <a href="/admin/images/delete/<?= $img['id'] ?>"
                                onclick="return confirm('Delete this image?')"
                                class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Empty State -->
<?php if (empty($images)): ?>
    <div class="bg-white kids-shadow rounded-3xl p-12 text-center border-t-4 border-pink-400">
        <div class="text-6xl opacity-50 mb-4">🎨</div>
        <div class="text-gray-500">
            <h3 class="text-xl font-semibold mb-2">No coloring images yet</h3>
            <p class="mb-6">Start building your beautiful collection by uploading your first coloring page!</p>
        </div>
        <a href="/admin/images/create"
            class="inline-block bg-gradient-to-r from-pink-500 to-purple-500 text-white px-8 py-4 rounded-2xl font-semibold hover:from-pink-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
            <i class="fas fa-upload mr-2"></i>
            Upload First Image
        </a>
    </div>
<?php endif; ?>

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
                    <p class="text-gray-600 text-sm">Manage your coloring images efficiently</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="/admin/images/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-all">
                    <i class="fas fa-plus mr-1"></i> Add Images
                </a>
                <button onclick="exportImages()" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-all">
                    <i class="fas fa-download mr-1"></i> Export List
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

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .tooltip {
        position: relative;
    }

    .tooltip:hover::after {
        content: attr(title);
        position: absolute;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
    }

    .image-row:hover {
        transform: translateX(5px);
        transition: transform 0.2s ease;
    }

    .image-card {
        transition: all 0.3s ease;
    }

    .image-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
</style>

<script>
    let currentView = 'table';

    function toggleView() {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const toggleBtn = document.getElementById('viewToggle');

        if (currentView === 'table') {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            toggleBtn.innerHTML = '<i class="fas fa-list mr-1"></i> Table View';
            currentView = 'grid';
        } else {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            toggleBtn.innerHTML = '<i class="fas fa-th mr-1"></i> Grid View';
            currentView = 'table';
        }
    }

    function filterByCategory() {
        const selectedCategory = document.getElementById('categoryFilter').value;
        const tableRows = document.querySelectorAll('.image-row');
        const gridCards = document.querySelectorAll('.image-card');

        // Filter table rows
        tableRows.forEach(row => {
            const category = row.dataset.category;
            if (selectedCategory === '' || category === selectedCategory) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Filter grid cards
        gridCards.forEach(card => {
            const category = card.dataset.category;
            if (selectedCategory === '' || category === selectedCategory) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    }

    function exportImages() {
        // Implementation for exporting images list
        alert('Export functionality - to be implemented');
    }

    function showBulkActions() {
        // Implementation for bulk actions
        alert('Bulk actions functionality - to be implemented');
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        // Add category filter event listener
        document.getElementById('categoryFilter').addEventListener('change', filterByCategory);

        // Add some interactive animations
        const cards = document.querySelectorAll('.bg-gradient-to-br, .image-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transform = 'translateY(-2px)';
                setTimeout(() => {
                    card.style.transform = 'translateY(0)';
                }, 200);
            }, index * 50);
        });

        // Enhanced tooltips
        const tooltipElements = document.querySelectorAll('.tooltip');
        tooltipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1)';
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });
</script>