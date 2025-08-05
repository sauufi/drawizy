<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-400 to-green-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-edit text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Category</h1>
    <p class="text-gray-600">Update your category information and hierarchy! 🎨</p>
</div>

<!-- Main Form Container -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-blue-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-500 to-green-500 p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-sitemap text-blue-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Edit Category Form</h2>
                    <p class="text-blue-100">Update category information and hierarchy</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form action="/admin/categories/update/<?= $category['id'] ?>" method="post" class="space-y-6" id="categoryEditForm">

                <!-- Current Category Info -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border-2 border-amber-200">
                    <div class="flex items-center space-x-2 mb-3">
                        <i class="fas fa-info-circle text-amber-500"></i>
                        <h3 class="font-semibold text-gray-700">Current Category Information</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-hashtag text-blue-500"></i>
                            <span class="text-gray-600">ID: #<?= $category['id'] ?></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-calendar text-green-500"></i>
                            <span class="text-gray-600">Created: <?= date('M j, Y', strtotime($category['created_at'])) ?></span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-images text-purple-500"></i>
                            <span class="text-gray-600">Images: <?= $category['image_count'] ?? 0 ?></span>
                        </div>
                    </div>
                    <?php if ($category['parent_name']): ?>
                        <div class="mt-3 p-3 bg-white rounded-lg border border-amber-200">
                            <div class="text-sm">
                                <span class="text-gray-600">Currently under:</span>
                                <span class="font-semibold text-blue-600"><?= htmlspecialchars($category['parent_name']) ?></span>
                                <span class="text-gray-500">></span>
                                <span class="font-semibold text-purple-600"><?= htmlspecialchars($category['name']) ?></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="mt-3 p-3 bg-white rounded-lg border border-amber-200">
                            <div class="text-sm">
                                <span class="text-gray-600">Current type:</span>
                                <span class="font-semibold text-green-600">Parent Category</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Category Type Selection -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-layer-group text-indigo-500"></i>
                        <span>Category Type</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Parent Category Option -->
                        <div class="relative">
                            <input type="radio" id="type_parent" name="category_type" value="parent" class="sr-only"
                                <?= empty($category['parent_id']) ? 'checked' : '' ?> onchange="toggleParentSelection()">
                            <label for="type_parent" class="flex items-center p-4 border-2 border-purple-200 rounded-2xl cursor-pointer hover:border-purple-400 transition-all duration-300 category-type-option">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                        <i class="fas fa-home text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">Parent Category</div>
                                        <div class="text-sm text-gray-600">Top-level category (e.g., Animals, Cartoons)</div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <!-- Child Category Option -->
                        <div class="relative">
                            <input type="radio" id="type_child" name="category_type" value="child" class="sr-only"
                                <?= !empty($category['parent_id']) ? 'checked' : '' ?> onchange="toggleParentSelection()">
                            <label for="type_child" class="flex items-center p-4 border-2 border-blue-200 rounded-2xl cursor-pointer hover:border-blue-400 transition-all duration-300 category-type-option">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-green-400 rounded-full flex items-center justify-center">
                                        <i class="fas fa-sitemap text-white"></i>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800">Child Category</div>
                                        <div class="text-sm text-gray-600">Subcategory (e.g., Cats, Dogs under Animals)</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Parent Category Selection -->
                <div class="group <?= empty($category['parent_id']) ? 'hidden' : '' ?>" id="parentSelection">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-arrow-up text-blue-500"></i>
                        <span>Parent Category</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="parent_id" id="parentSelect"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-lg appearance-none">
                            <option value="">Choose a parent category...</option>
                            <?php if (isset($parentCategories)): ?>
                                <?php foreach ($parentCategories as $parent): ?>
                                    <option value="<?= $parent['id'] ?>" <?= $parent['id'] == $category['parent_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($parent['name']) ?>
                                        (<?= $parent['total_image_count'] ?> images)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-layer-group text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    <div id="parentChangeWarning" class="hidden mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mt-1"></i>
                            <div class="text-sm text-yellow-700">
                                <strong>Warning:</strong> Changing the parent category will affect the URL structure and may break existing links.
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                        This category will appear under the selected parent category
                    </p>
                </div>

                <!-- Category Name Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-tag text-blue-500"></i>
                        <span>Category Name</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            name="name"
                            id="categoryName"
                            value="<?= htmlspecialchars($category['name']) ?>"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-lg"
                            placeholder="Example: Cute Animals, Beautiful Flowers, Cool Cars..."
                            required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-edit text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-lightbulb text-yellow-400 mr-1"></i>
                        Use a fun and easy-to-understand name for kids
                    </p>
                </div>

                <!-- URL Slug Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-link text-green-500"></i>
                        <span>URL Slug</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            name="slug"
                            id="categorySlug"
                            value="<?= htmlspecialchars($category['slug']) ?>"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 font-mono text-gray-600"
                            placeholder="category-url-slug">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-hashtag text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                        </div>
                    </div>
                    <div id="slugChangeWarning" class="hidden mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                            <div class="text-sm text-red-700">
                                <strong>Important:</strong> Changing the slug will change the URL and may break existing bookmarks and search engine links.
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-green-400 mr-1"></i>
                        URL-friendly version of the category name
                    </p>
                </div>

                <!-- Description Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-align-left text-purple-500"></i>
                        <span>Description</span>
                    </label>
                    <div class="relative">
                        <textarea name="description"
                            id="categoryDescription"
                            rows="4"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 resize-none"
                            placeholder="Tell us about this category... For example: 'A collection of cute animal pictures that kids love to color'"><?= htmlspecialchars($category['description']) ?></textarea>
                        <div class="absolute left-4 top-4">
                            <i class="fas fa-comment-dots text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-heart text-pink-400 mr-1"></i>
                        An attractive description will help parents choose a category for their child.
                    </p>
                </div>

                <!-- URL Preview Section -->
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl p-6 border-2 border-dashed border-indigo-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-globe text-indigo-500"></i>
                        <h3 class="font-semibold text-gray-700">URL Preview</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="bg-white rounded-xl p-4 kids-shadow">
                            <div class="text-sm text-gray-600 mb-2">Current URL:</div>
                            <div class="font-mono text-gray-500 text-lg" id="currentUrl">
                                <?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>/<?= $category['parent_slug'] ? $category['parent_slug'] . '/' : '' ?><?= $category['slug'] ?>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 kids-shadow">
                            <div class="text-sm text-gray-600 mb-2">New URL will be:</div>
                            <div class="font-mono text-indigo-600 text-lg" id="newUrl">
                                <?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>/<?= $category['parent_slug'] ? $category['parent_slug'] . '/' : '' ?><?= $category['slug'] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="bg-gradient-to-br from-blue-50 to-green-50 rounded-2xl p-6 border-2 border-dashed border-blue-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-eye text-blue-500"></i>
                        <h3 class="font-semibold text-gray-700">Category Preview</h3>
                    </div>
                    <div class="bg-white rounded-xl p-4 kids-shadow">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 bg-blue-400 rounded-full" id="previewColorDot"></div>
                            <div>
                                <div class="font-medium text-gray-800" id="previewName">
                                    <span class="mr-2">🎨</span>
                                    <span><?= htmlspecialchars($category['name']) ?></span>
                                </div>
                                <div class="text-sm text-gray-500" id="previewHierarchy">
                                    <?= $category['parent_name'] ? $category['parent_name'] . ' > ' . $category['name'] : 'Parent Category: ' . $category['name'] ?>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600" id="previewDescription">
                            <?= htmlspecialchars($category['description']) ?: 'Category description will be displayed here...' ?>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/admin/categories"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Categories</span>
                    </a>

                    <div class="flex space-x-3">
                        <button type="button" onclick="resetForm()"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset Changes</span>
                        </button>

                        <button type="submit"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-2xl hover:from-blue-600 hover:to-green-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Update Category</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Impact Warning Modal -->
<div id="impactModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-8 max-w-md mx-auto kids-shadow">
        <div class="text-center">
            <div class="text-6xl mb-4">⚠️</div>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Confirm Changes</h3>
            <div id="modalContent" class="text-gray-600 mb-6"></div>
            <div class="flex space-x-3 justify-center">
                <button onclick="closeModal()" class="px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all">
                    Cancel
                </button>
                <button onclick="confirmChanges()" class="px-6 py-3 bg-red-500 text-white rounded-2xl hover:bg-red-600 transition-all">
                    Confirm Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tips Section -->
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-blue-400 via-green-500 to-teal-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-blue-400 to-green-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Tips for Editing Categories</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="space-y-2">
                    <h4 class="font-semibold text-blue-600">Hierarchy Changes:</h4>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Think about URL structure impact</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Consider existing bookmarks and SEO</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Test changes on staging first</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <h4 class="font-semibold text-green-600">Best Practices:</h4>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Keep names consistent with content</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Update descriptions to match images</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Preview changes before saving</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .category-type-option {
        transition: all 0.3s ease;
    }

    .category-type-option:has(input:checked) {
        border-color: #3B82F6;
        background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 100%);
        transform: scale(1.02);
    }

    .group:focus-within {
        transform: scale(1.01);
        transition: transform 0.2s ease-in-out;
    }

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

    .group {
        animation: slideInUp 0.5s ease-out;
    }

    .group:nth-child(1) {
        animation-delay: 0.1s;
    }

    .group:nth-child(2) {
        animation-delay: 0.2s;
    }

    .group:nth-child(3) {
        animation-delay: 0.3s;
    }

    .group:nth-child(4) {
        animation-delay: 0.4s;
    }

    .group:nth-child(5) {
        animation-delay: 0.5s;
    }

    .group:nth-child(6) {
        animation-delay: 0.6s;
    }

    button:hover,
    a:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 0 6px 10px rgba(0, 0, 0, 0.1);
    }

    #parentSelection {
        transition: all 0.3s ease;
    }

    #parentSelection.show {
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            max-height: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            max-height: 300px;
            transform: translateY(0);
        }
    }

    .warning-highlight {
        animation: pulse 2s infinite;
    }

    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.7;
        }
    }
</style>

<script>
    // Store original values for comparison
    const originalValues = {
        name: '<?= htmlspecialchars($category['name']) ?>',
        slug: '<?= htmlspecialchars($category['slug']) ?>',
        description: `<?= htmlspecialchars($category['description']) ?>`,
        parent_id: '<?= $category['parent_id'] ?? '' ?>'
    };

    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('categoryName');
        const slugInput = document.getElementById('categorySlug');
        const descriptionInput = document.getElementById('categoryDescription');
        const parentSelect = document.getElementById('parentSelect');
        const previewName = document.getElementById('previewName');
        const previewHierarchy = document.getElementById('previewHierarchy');
        const previewDescription = document.getElementById('previewDescription');
        const newUrl = document.getElementById('newUrl');
        const previewColorDot = document.getElementById('previewColorDot');

        // Function to create slug from name
        function createSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }

        // Function to get emoji based on category name
        function getCategoryEmoji(name) {
            const lowerName = name.toLowerCase();
            if (lowerName.includes('animal') || lowerName.includes('hewan')) return '🐾';
            if (lowerName.includes('cat')) return '🐱';
            if (lowerName.includes('dog')) return '🐶';
            if (lowerName.includes('flower') || lowerName.includes('bunga')) return '🌸';
            if (lowerName.includes('car') || lowerName.includes('mobil')) return '🚗';
            if (lowerName.includes('princess') || lowerName.includes('putri')) return '👸';
            if (lowerName.includes('nature') || lowerName.includes('alam')) return '🌿';
            if (lowerName.includes('food') || lowerName.includes('makanan')) return '🍎';
            if (lowerName.includes('space') || lowerName.includes('luar angkasa')) return '🚀';
            if (lowerName.includes('sea') || lowerName.includes('laut')) return '🌊';
            if (lowerName.includes('cartoon')) return '🎭';
            if (lowerName.includes('holiday')) return '🎉';
            if (lowerName.includes('fantasy')) return '🦄';
            if (lowerName.includes('robot')) return '🤖';
            if (lowerName.includes('dinosaur')) return '🦕';
            if (lowerName.includes('superhero')) return '🦸';
            if (lowerName.includes('disney')) return '🏰';
            return '🎨';
        }

        // Update preview and warnings
        function updatePreview() {
            const name = nameInput.value.trim();
            const parentValue = parentSelect.value;
            const parentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';
            const description = descriptionInput.value.trim();
            const slug = slugInput.value.trim();

            if (name) {
                const emoji = getCategoryEmoji(name);
                previewName.innerHTML = `<span class="mr-2">${emoji}</span><span>${name}</span>`;

                // Update hierarchy display
                if (parentValue && parentText) {
                    const parentName = parentText.split(' (')[0];
                    previewHierarchy.textContent = `${parentName} > ${name}`;
                    previewColorDot.className = 'w-4 h-4 rounded-full bg-gradient-to-r from-blue-400 to-green-400';
                } else {
                    previewHierarchy.textContent = `Parent Category: ${name}`;
                    previewColorDot.className = 'w-4 h-4 rounded-full bg-gradient-to-r from-purple-400 to-pink-400';
                }
            }

            previewDescription.textContent = description || 'Category description will be displayed here...';
            updateUrlPreview();
            checkForChanges();
        }

        // Update URL preview
        function updateUrlPreview() {
            const slug = slugInput.value.trim();
            const parentValue = parentSelect.value;
            const parentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';
            const baseUrl = '<?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>';

            if (parentValue && parentText) {
                // Child category URL structure
                const parentName = parentText.split(' (')[0].toLowerCase().replace(/[^a-z0-9]+/g, '-');
                newUrl.textContent = `${baseUrl}/${parentName}/${slug || 'category-slug'}`;
            } else {
                // Parent category URL structure
                newUrl.textContent = `${baseUrl}/${slug || 'category-slug'}`;
            }
        }

        // Check for changes and show warnings
        function checkForChanges() {
            const currentParentId = parentSelect.value;
            const currentSlug = slugInput.value.trim();

            // Check if parent changed
            const parentChangeWarning = document.getElementById('parentChangeWarning');
            if (currentParentId !== originalValues.parent_id) {
                parentChangeWarning.classList.remove('hidden');
                parentChangeWarning.classList.add('warning-highlight');
            } else {
                parentChangeWarning.classList.add('hidden');
                parentChangeWarning.classList.remove('warning-highlight');
            }

            // Check if slug changed
            const slugChangeWarning = document.getElementById('slugChangeWarning');
            if (currentSlug !== originalValues.slug) {
                slugChangeWarning.classList.remove('hidden');
                slugChangeWarning.classList.add('warning-highlight');
            } else {
                slugChangeWarning.classList.add('hidden');
                slugChangeWarning.classList.remove('warning-highlight');
            }
        }

        // Event listeners
        nameInput.addEventListener('input', function() {
            updatePreview();

            // Auto-generate slug if it matches original or is empty
            if (slugInput.value === originalValues.slug || !slugInput.value.trim()) {
                const slug = createSlug(this.value);
                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
            }
        });

        slugInput.addEventListener('input', function() {
            slugInput.dataset.autoGenerated = 'false';
            updatePreview();
        });

        descriptionInput.addEventListener('input', updatePreview);
        parentSelect.addEventListener('change', updatePreview);

        // Form validation with impact warning
        const form = document.getElementById('categoryEditForm');
        form.addEventListener('submit', function(e) {
            const name = nameInput.value.trim();
            const categoryType = document.querySelector('input[name="category_type"]:checked').value;
            const parentId = parentSelect.value;

            if (!name) {
                e.preventDefault();
                nameInput.focus();
                showMessage('Category name is required! 🎨', 'error');
                return;
            }

            if (categoryType === 'child' && !parentId) {
                e.preventDefault();
                parentSelect.focus();
                showMessage('Please select a parent category for child categories! 📁', 'error');
                return;
            }

            // Check for major changes that might impact users
            const hasParentChange = parentSelect.value !== originalValues.parent_id;
            const hasSlugChange = slugInput.value.trim() !== originalValues.slug;

            if (hasParentChange || hasSlugChange) {
                e.preventDefault();
                showImpactModal(hasParentChange, hasSlugChange);
                return;
            }

            showMessage('Category is being updated... ✨', 'success');
        });

        // Show impact modal for major changes
        function showImpactModal(hasParentChange, hasSlugChange) {
            const modal = document.getElementById('impactModal');
            const modalContent = document.getElementById('modalContent');

            let content = '<div class="text-left space-y-2">';
            content += '<p class="font-semibold text-red-600">The following changes will impact your site:</p>';
            content += '<ul class="list-disc list-inside space-y-1 text-sm">';

            if (hasParentChange) {
                content += '<li>🔄 <strong>Parent category changed:</strong> URL structure will change</li>';
                content += '<li>📊 Existing bookmarks may break</li>';
            }

            if (hasSlugChange) {
                content += '<li>🔗 <strong>URL slug changed:</strong> Category URL will change</li>';
                content += '<li>🔍 SEO rankings may be affected</li>';
            }

            content += '<li>⚠️ Consider setting up redirects from old URLs</li>';
            content += '</ul>';
            content += '<p class="mt-3 text-sm text-gray-600">Are you sure you want to continue?</p>';
            content += '</div>';

            modalContent.innerHTML = content;
            modal.classList.remove('hidden');
        }

        // Initialize preview
        updatePreview();

        // Set initial emoji
        const currentName = nameInput.value.trim();
        if (currentName) {
            const emoji = getCategoryEmoji(currentName);
            previewName.innerHTML = `<span class="mr-2">${emoji}</span><span>${currentName}</span>`;
        }
    });

    // Toggle parent selection based on category type
    function toggleParentSelection() {
        const categoryType = document.querySelector('input[name="category_type"]:checked').value;
        const parentSelection = document.getElementById('parentSelection');
        const parentSelect = document.getElementById('parentSelect');

        if (categoryType === 'child') {
            parentSelection.classList.remove('hidden');
            parentSelection.classList.add('show');
            parentSelect.required = true;
        } else {
            parentSelection.classList.add('hidden');
            parentSelection.classList.remove('show');
            parentSelect.required = false;
            parentSelect.value = '';
        }

        // Trigger preview update
        document.dispatchEvent(new Event('input', {
            bubbles: true
        }));
    }

    // Reset form to original values
    function resetForm() {
        const confirmReset = confirm('Are you sure you want to reset all changes? 🔄\n\nThis will restore the original values.');
        if (confirmReset) {
            document.getElementById('categoryName').value = originalValues.name;
            document.getElementById('categorySlug').value = originalValues.slug;
            document.getElementById('categoryDescription').value = originalValues.description;
            document.getElementById('parentSelect').value = originalValues.parent_id;

            // Reset radio buttons
            if (originalValues.parent_id) {
                document.getElementById('type_child').checked = true;
                document.getElementById('parentSelection').classList.remove('hidden');
            } else {
                document.getElementById('type_parent').checked = true;
                document.getElementById('parentSelection').classList.add('hidden');
            }

            // Update previews
            const emoji = getCategoryEmoji(originalValues.name);
            document.getElementById('previewName').innerHTML = `<span class="mr-2">${emoji}</span><span>${originalValues.name}</span>`;

            if (originalValues.parent_id) {
                const parentText = document.getElementById('parentSelect').options[document.getElementById('parentSelect').selectedIndex]?.text || '';
                const parentName = parentText.split(' (')[0];
                document.getElementById('previewHierarchy').textContent = `${parentName} > ${originalValues.name}`;
                document.getElementById('previewColorDot').className = 'w-4 h-4 rounded-full bg-gradient-to-r from-blue-400 to-green-400';
            } else {
                document.getElementById('previewHierarchy').textContent = `Parent Category: ${originalValues.name}`;
                document.getElementById('previewColorDot').className = 'w-4 h-4 rounded-full bg-gradient-to-r from-purple-400 to-pink-400';
            }

            document.getElementById('previewDescription').textContent = originalValues.description || 'Category description will be displayed here...';

            // Hide warnings
            document.getElementById('parentChangeWarning').classList.add('hidden');
            document.getElementById('slugChangeWarning').classList.add('hidden');

            // Update URL preview
            const baseUrl = '<?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>';
            if (originalValues.parent_id) {
                // Get parent slug from original data
                const parentSlug = '<?= $category['parent_slug'] ?? '' ?>';
                document.getElementById('newUrl').textContent = `${baseUrl}/${parentSlug}/${originalValues.slug}`;
            } else {
                document.getElementById('newUrl').textContent = `${baseUrl}/${originalValues.slug}`;
            }

            showMessage('Form reset to original values! 🔄', 'success');
        }
    }

    // Modal functions
    function closeModal() {
        document.getElementById('impactModal').classList.add('hidden');
    }

    function confirmChanges() {
        closeModal();
        showMessage('Category is being updated... ✨', 'success');
        document.getElementById('categoryEditForm').submit();
    }

    // Show message function
    function showMessage(message, type) {
        const existingMessage = document.querySelector('.form-message');
        if (existingMessage) existingMessage.remove();

        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message fixed top-4 right-4 px-6 py-3 rounded-2xl text-white font-semibold kids-shadow z-50 ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}`;
        messageDiv.textContent = message;

        document.body.appendChild(messageDiv);
        setTimeout(() => messageDiv.remove(), 3000);
    }

    // Focus animations
    const inputs = document.querySelectorAll('input, textarea, select');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-105');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-105');
            this.classList.remove('border-red-400');
        });
    });
</script>