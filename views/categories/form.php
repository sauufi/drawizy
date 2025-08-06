<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-plus text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Create New Category</h1>
    <p class="text-gray-600">Add a parent category or subcategory for better organization! 🎨</p>
</div>

<!-- Main Form Container -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-purple-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-sitemap text-purple-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Category Form</h2>
                    <p class="text-purple-100">Create a parent category or subcategory</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form action="/dashboard/categories/store" method="post" class="space-y-6" id="categoryForm">

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
                            <input type="radio" id="type_parent" name="category_type" value="parent" class="sr-only" checked onchange="toggleParentSelection()">
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
                            <input type="radio" id="type_child" name="category_type" value="child" class="sr-only" onchange="toggleParentSelection()">
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

                <!-- Parent Category Selection (Hidden by default) -->
                <div class="group hidden" id="parentSelection">
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
                                    <option value="<?= $parent['id'] ?>">
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
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                        This category will appear under the selected parent category
                    </p>
                </div>

                <!-- Category Name Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-tag text-purple-500"></i>
                        <span>Category Name</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            name="name"
                            id="categoryName"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-lg"
                            placeholder="Example: Cute Animals, Beautiful Flowers, Cool Cars..."
                            required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-edit text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
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
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 font-mono text-gray-600"
                            placeholder="will-be-created-automatically">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-hashtag text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-green-400 mr-1"></i>
                        Will be generated automatically from category name (can be edited manually)
                    </p>
                </div>

                <!-- Description Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-align-left text-orange-500"></i>
                        <span>Description</span>
                    </label>
                    <div class="relative">
                        <textarea name="description"
                            id="categoryDescription"
                            rows="4"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-orange-400 focus:ring-4 focus:ring-orange-100 transition-all duration-300 resize-none"
                            placeholder="Tell us about this category... For example: 'A collection of cute animal pictures that kids love to color'"></textarea>
                        <div class="absolute left-4 top-4">
                            <i class="fas fa-comment-dots text-gray-400 group-focus-within:text-orange-500 transition-colors"></i>
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
                    <div class="bg-white rounded-xl p-4 kids-shadow">
                        <div class="text-sm text-gray-600 mb-2">Your category will be accessible at:</div>
                        <div class="font-mono text-indigo-600 text-lg" id="urlPreview">
                            <?= $_SERVER['HTTP_HOST'] ?? 'drawizy.com' ?>/category-slug
                        </div>
                        <div class="text-xs text-gray-500 mt-2" id="urlStructure">
                            Structure: Parent Category (if selected) > Category Name
                        </div>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border-2 border-dashed border-purple-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-eye text-purple-500"></i>
                        <h3 class="font-semibold text-gray-700">Category Preview</h3>
                    </div>
                    <div class="bg-white rounded-xl p-4 kids-shadow">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 bg-purple-400 rounded-full" id="previewColorDot"></div>
                            <div>
                                <div class="font-medium text-gray-800" id="previewName">
                                    <span class="mr-2">🎨</span>
                                    <span>Category name will appear here</span>
                                </div>
                                <div class="text-sm text-gray-500" id="previewHierarchy">Category hierarchy will be shown here</div>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600" id="previewDescription">
                            Category description will be displayed here...
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/dashboard/categories"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Categories</span>
                    </a>

                    <div class="flex space-x-3">
                        <button type="reset"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Create Category</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tips Section -->
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Tips for Creating Categories</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="space-y-2">
                    <h4 class="font-semibold text-purple-600">Parent Categories:</h4>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Use broad themes (Animals, Cartoons, Nature)</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Keep names simple and recognizable</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Think about what kids would look for</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <h4 class="font-semibold text-blue-600">Child Categories:</h4>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Be specific (Cats, Dogs under Animals)</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Choose the right parent category</span>
                    </div>
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-check-circle text-green-500 mt-1"></i>
                        <span class="text-gray-600">Organize related content together</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Examples Section -->
<div class="max-w-4xl mx-auto mt-6">
    <div class="bg-gradient-to-r from-blue-100 to-green-100 rounded-2xl p-6">
        <div class="text-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">📋 Category Structure Examples</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl p-4 shadow-md">
                <h4 class="font-semibold text-purple-600 mb-2">🐾 Animals</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>→ Cats</li>
                    <li>→ Dogs</li>
                    <li>→ Wild Animals</li>
                    <li>→ Farm Animals</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <h4 class="font-semibold text-blue-600 mb-2">🎭 Cartoons</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>→ Disney Characters</li>
                    <li>→ Anime Characters</li>
                    <li>→ Superheroes</li>
                    <li>→ Classic Cartoons</li>
                </ul>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <h4 class="font-semibold text-green-600 mb-2">🌿 Nature</h4>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>→ Flowers</li>
                    <li>→ Trees</li>
                    <li>→ Landscapes</li>
                    <li>→ Seasons</li>
                </ul>
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
        border-color: #8B5CF6;
        background: linear-gradient(135deg, #f3e8ff 0%, #e0e7ff 100%);
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
            max-height: 200px;
            transform: translateY(0);
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('categoryName');
        const slugInput = document.getElementById('categorySlug');
        const descriptionInput = document.getElementById('categoryDescription');
        const parentSelect = document.getElementById('parentSelect');
        const previewName = document.getElementById('previewName');
        const previewHierarchy = document.getElementById('previewHierarchy');
        const previewDescription = document.getElementById('previewDescription');
        const urlPreview = document.getElementById('urlPreview');
        const urlStructure = document.getElementById('urlStructure');
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

        // Update preview when name changes
        nameInput.addEventListener('input', function() {
            const name = this.value.trim();
            updatePreview();

            // Auto-generate slug if slug field is empty or was auto-generated
            if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                const slug = createSlug(name);
                slugInput.value = slug;
                slugInput.dataset.autoGenerated = 'true';
                updateUrlPreview();
            }
        });

        // Update preview when slug changes
        slugInput.addEventListener('input', function() {
            slugInput.dataset.autoGenerated = 'false';
            updateUrlPreview();
        });

        // Update preview when description changes
        descriptionInput.addEventListener('input', function() {
            updatePreview();
        });

        // Update preview when parent selection changes
        parentSelect.addEventListener('change', function() {
            updatePreview();
            updateUrlPreview();
        });

        function updatePreview() {
            const name = nameInput.value.trim();
            const parentValue = parentSelect.value;
            const parentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';
            const description = descriptionInput.value.trim();

            if (name) {
                const emoji = getCategoryEmoji(name);
                previewName.innerHTML = `<span class="mr-2">${emoji}</span><span>${name}</span>`;

                // Update hierarchy display
                if (parentValue && parentText) {
                    const parentName = parentText.split(' (')[0]; // Remove image count
                    previewHierarchy.textContent = `${parentName} > ${name}`;
                    previewColorDot.className = 'w-4 h-4 rounded-full bg-gradient-to-r from-blue-400 to-green-400';
                } else {
                    previewHierarchy.textContent = `Parent Category: ${name}`;
                    previewColorDot.className = 'w-4 h-4 rounded-full bg-gradient-to-r from-purple-400 to-pink-400';
                }
            } else {
                previewName.innerHTML = '<span class="mr-2">🎨</span><span>Category name will appear here</span>';
                previewHierarchy.textContent = 'Category hierarchy will be shown here';
            }

            previewDescription.textContent = description || 'Category description will be displayed here...';
        }

        function updateUrlPreview() {
            const slug = slugInput.value.trim();
            const parentValue = parentSelect.value;
            const parentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';
            const baseUrl = '<?= $_SERVER['HTTP_HOST'] ?? 'drawizy.com' ?>';

            if (parentValue && parentText) {
                // Child category URL structure
                const parentName = parentText.split(' (')[0].toLowerCase().replace(/[^a-z0-9]+/g, '-');
                urlPreview.textContent = `${baseUrl}/${parentName}/${slug || 'category-slug'}`;
                urlStructure.textContent = 'Structure: Parent Category > Child Category';
            } else {
                // Parent category URL structure
                urlPreview.textContent = `${baseUrl}/${slug || 'category-slug'}`;
                urlStructure.textContent = 'Structure: Parent Category';
            }
        }

        // Form validation
        const form = document.getElementById('categoryForm');
        form.addEventListener('submit', function(e) {
            const name = nameInput.value.trim();
            const categoryType = document.querySelector('input[name="category_type"]:checked').value;
            const parentId = parentSelect.value;

            if (!name) {
                e.preventDefault();
                nameInput.focus();
                nameInput.classList.add('border-red-400');
                showMessage('Category name is required! 🎨', 'error');
                return;
            }

            if (categoryType === 'child' && !parentId) {
                e.preventDefault();
                parentSelect.focus();
                parentSelect.classList.add('border-red-400');
                showMessage('Please select a parent category for child categories! 📁', 'error');
                return;
            }

            showMessage('Category is being created... ✨', 'success');
        });

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

        // Initialize preview
        updatePreview();
        updateUrlPreview();
    });

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

        // Update preview and URL
        const nameInput = document.getElementById('categoryName');
        if (nameInput.value) {
            document.dispatchEvent(new Event('input', {
                bubbles: true
            }));
        }
    }
</script>