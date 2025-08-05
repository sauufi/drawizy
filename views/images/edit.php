<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-400 to-blue-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-edit text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Coloring Page</h1>
    <p class="text-gray-600">Update your coloring page information and files! 🎨✨</p>
</div>

<!-- Current Image Info -->
<div class="max-w-6xl mx-auto mb-8">
    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border-4 border-amber-200 kids-shadow">
        <div class="flex items-center space-x-2 mb-4">
            <i class="fas fa-info-circle text-amber-500 text-lg"></i>
            <h3 class="text-xl font-kids text-amber-700">📋 Current Image Information</h3>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Image Preview -->
            <div class="text-center">
                <div class="relative inline-block">
                    <div class="w-32 h-32 rounded-2xl overflow-hidden shadow-lg border-4 border-white mx-auto mb-3">
                        <img src="/uploads/<?= $image['preview'] ?>"
                            alt="<?= htmlspecialchars($image['title']) ?>"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -top-2 -right-2 bg-blue-500 text-white rounded-full p-2">
                        <i class="fas fa-image text-sm"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-semibold">Current Preview</p>
            </div>

            <!-- Basic Info -->
            <div class="space-y-3">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-hashtag text-blue-500"></i>
                    <span class="text-gray-600">ID: <strong>#<?= $image['id'] ?></strong></span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar text-green-500"></i>
                    <span class="text-gray-600">Created: <strong><?= date('M j, Y', strtotime($image['created_at'])) ?></strong></span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-download text-purple-500"></i>
                    <span class="text-gray-600">Downloads: <strong><?= number_format($image['downloads']) ?></strong></span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-link text-pink-500"></i>
                    <span class="text-gray-600">Slug: <strong><?= htmlspecialchars($image['slug']) ?></strong></span>
                </div>
            </div>

            <!-- Files Info -->
            <div class="space-y-3">
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-700">PDF File:</span>
                        <i class="fas fa-file-pdf text-red-500"></i>
                    </div>
                    <?php if ($image['filename']): ?>
                        <a href="/uploads/<?= $image['filename'] ?>" target="_blank"
                            class="text-blue-500 hover:text-blue-700 underline text-sm break-all">
                            <?= $image['filename'] ?>
                        </a>
                    <?php else: ?>
                        <span class="text-gray-400 text-sm">No PDF file</span>
                    <?php endif; ?>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-700">Preview:</span>
                        <i class="fas fa-image text-green-500"></i>
                    </div>
                    <?php if ($image['preview']): ?>
                        <span class="text-gray-600 text-sm break-all"><?= $image['preview'] ?></span>
                    <?php else: ?>
                        <span class="text-gray-400 text-sm">No preview image</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Edit Form -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-green-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-green-500 to-blue-500 p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-edit text-green-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Edit Form</h2>
                    <p class="text-green-100">Update coloring page information and files</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form action="/admin/images/update/<?= $image['id'] ?>" method="post" enctype="multipart/form-data" id="editForm" class="space-y-8">

                <!-- Title Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-tag text-blue-500 text-lg"></i>
                        <span class="text-lg">Image Title</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="title"
                            name="title"
                            value="<?= htmlspecialchars($image['title']) ?>"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-lg"
                            placeholder="Enter a fun and descriptive title..."
                            required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-edit text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-lightbulb text-yellow-400 mr-1"></i>
                        Use a clear, kid-friendly title that describes the coloring page
                    </p>
                </div>

                <!-- Slug Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-link text-green-500 text-lg"></i>
                        <span class="text-lg">URL Slug</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            id="slug"
                            name="slug"
                            value="<?= htmlspecialchars($image['slug']) ?>"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 font-mono text-gray-600"
                            placeholder="url-friendly-slug"
                            required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-hashtag text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                        </div>
                    </div>
                    <div id="slugWarning" class="hidden mt-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-exclamation-triangle text-red-500 mt-1"></i>
                            <div class="text-sm text-red-700">
                                <strong>Warning:</strong> This slug already exists! Please choose a different one.
                            </div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-green-400 mr-1"></i>
                        URL-friendly version of the title (auto-generated from title)
                    </p>
                </div>

                <!-- Category Selection -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-folder text-purple-500 text-lg"></i>
                        <span class="text-lg">Category</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="category_id"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-lg appearance-none"
                            required>
                            <option value="">🎯 Choose a category...</option>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= $c['id'] == $image['category_id'] ? 'selected' : '' ?>>
                                    <?php
                                    // Add emoji based on category name
                                    $name = strtolower($c['name']);
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
                                    <?= $emoji ?> <?= htmlspecialchars($c['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-folder text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-star text-purple-400 mr-1"></i>
                        Choose the most appropriate category for this coloring page
                    </p>
                </div>

                <!-- SEO Fields -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border-2 border-dashed border-indigo-200">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fas fa-search text-indigo-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🔍 SEO Settings</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-heading text-blue-500"></i>
                                <span>Meta Title</span>
                            </label>
                            <input type="text"
                                name="meta_title"
                                value="<?= htmlspecialchars($image['meta_title'] ?? '') ?>"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                placeholder="SEO-optimized title for search engines">
                            <p class="text-xs text-gray-500 mt-1">Leave empty to use default title</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-align-left text-green-500"></i>
                                <span>Meta Description</span>
                            </label>
                            <textarea name="meta_description"
                                rows="3"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all resize-none"
                                placeholder="Brief description for search engines..."><?= htmlspecialchars($image['meta_description'] ?? '') ?></textarea>
                            <p class="text-xs text-gray-500 mt-1">Optimal length: 120-160 characters</p>
                        </div>
                    </div>
                </div>

                <!-- File Updates -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- PDF File Update -->
                    <div class="group">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                            <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                            <span class="text-lg">Update PDF File</span>
                            <span class="text-gray-400 text-sm">- Optional</span>
                        </label>
                        <div class="border-3 border-dashed border-red-200 rounded-2xl p-6 text-center hover:border-red-400 transition-all bg-red-50">
                            <div class="mb-4">
                                <i class="fas fa-file-pdf text-red-400 text-4xl mb-3"></i>
                                <div class="text-lg font-semibold text-gray-700 mb-2">Replace PDF File</div>
                                <div class="text-gray-500 text-sm">Choose a new PDF to replace the current one</div>
                            </div>
                            <input type="file"
                                name="pdf_file"
                                accept="application/pdf"
                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                        </div>
                        <input type="hidden" name="existing_filename" value="<?= htmlspecialchars($image['filename']) ?>">
                        <p class="text-sm text-gray-500 mt-2 ml-2">
                            <i class="fas fa-info-circle text-red-400 mr-1"></i>
                            Leave empty to keep current PDF file
                        </p>
                    </div>

                    <!-- Thumbnail Update -->
                    <div class="group">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                            <i class="fas fa-image text-green-500 text-lg"></i>
                            <span class="text-lg">Update Thumbnail</span>
                            <span class="text-gray-400 text-sm">- Optional</span>
                        </label>
                        <div class="border-3 border-dashed border-green-200 rounded-2xl p-6 text-center hover:border-green-400 transition-all bg-green-50">
                            <div class="mb-4">
                                <i class="fas fa-image text-green-400 text-4xl mb-3"></i>
                                <div class="text-lg font-semibold text-gray-700 mb-2">Replace Thumbnail</div>
                                <div class="text-gray-500 text-sm">Choose a new preview image</div>
                            </div>
                            <input type="file"
                                name="thumb_file"
                                accept="image/png,image/jpeg,image/jpg"
                                class="w-full border border-gray-300 rounded-lg p-2 text-sm">
                        </div>
                        <input type="hidden" name="existing_preview" value="<?= htmlspecialchars($image['preview']) ?>">
                        <p class="text-sm text-gray-500 mt-2 ml-2">
                            <i class="fas fa-info-circle text-green-400 mr-1"></i>
                            Leave empty to keep current thumbnail
                        </p>
                    </div>
                </div>

                <!-- URL Preview -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-dashed border-blue-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-globe text-blue-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🌐 URL Preview</h3>
                    </div>
                    <div class="space-y-3">
                        <div class="bg-white rounded-xl p-4 kids-shadow">
                            <div class="text-sm text-gray-600 mb-2">Current URL:</div>
                            <div class="font-mono text-gray-500 text-lg" id="currentUrl">
                                <?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>/image/<?= $image['slug'] ?>
                            </div>
                        </div>
                        <div class="bg-white rounded-xl p-4 kids-shadow">
                            <div class="text-sm text-gray-600 mb-2">New URL will be:</div>
                            <div class="font-mono text-blue-600 text-lg" id="newUrl">
                                <?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>/image/<?= $image['slug'] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/admin/images"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Images</span>
                    </a>

                    <div class="flex space-x-3">
                        <!-- Preview Button -->
                        <a href="/image/<?= $image['slug'] ?>" target="_blank"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-blue-500 text-white rounded-2xl hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-external-link-alt"></i>
                            <span>Preview</span>
                        </a>

                        <!-- Reset Button -->
                        <button type="button"
                            onclick="resetForm()"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset</span>
                        </button>

                        <!-- Save Button -->
                        <button type="submit"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-green-500 to-blue-500 text-white rounded-2xl hover:from-green-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Save Changes</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tips -->
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-green-400 to-blue-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">💡 Editing Tips & Best Practices</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div class="space-y-3">
                    <h4 class="font-semibold text-green-600">✏️ Content Updates:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Keep titles descriptive and kid-friendly</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Update category if content theme changes</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Use SEO fields for better search visibility</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <h4 class="font-semibold text-blue-600">🔧 Technical Notes:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                            <span class="text-gray-600">Changing slug affects URL and bookmarks</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                            <span class="text-gray-600">New files replace old ones permanently</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                            <span class="text-gray-600">Preview changes before saving</span>
                        </div>
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

    .border-3 {
        border-width: 3px;
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
        title: '<?= htmlspecialchars($image['title']) ?>',
        slug: '<?= htmlspecialchars($image['slug']) ?>',
        category_id: '<?= $image['category_id'] ?>'
    };

    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const newUrl = document.getElementById('newUrl');

        // Auto-generate slug from title
        titleInput.addEventListener('input', function() {
            // Only auto-generate if slug hasn't been manually modified
            if (slugInput.dataset.manuallyEdited !== 'true') {
                const slug = createSlug(this.value);
                slugInput.value = slug;
                updateUrlPreview();
            }
        });

        // Mark slug as manually edited when user types in it
        slugInput.addEventListener('input', function() {
            slugInput.dataset.manuallyEdited = 'true';
            updateUrlPreview();
            checkSlugUniqueness();
        });

        // Function to create slug
        function createSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }

        // Update URL preview
        function updateUrlPreview() {
            const slug = slugInput.value.trim();
            const baseUrl = '<?= $_SERVER['HTTP_HOST'] ?? 'yoursite.com' ?>';
            newUrl.textContent = `${baseUrl}/image/${slug || 'your-slug'}`;
        }

        // Check slug uniqueness
        function checkSlugUniqueness() {
            const slug = slugInput.value.trim();
            const imageId = <?= $image['id'] ?>;

            if (slug && slug !== originalValues.slug) {
                fetch(`/admin/images/check-slug?slug=${encodeURIComponent(slug)}&id=${imageId}`)
                    .then(response => response.json())
                    .then(data => {
                        const warning = document.getElementById('slugWarning');
                        if (data.unique) {
                            warning.classList.add('hidden');
                            slugInput.classList.remove('border-red-400');
                            slugInput.classList.add('border-green-400');
                        } else {
                            warning.classList.remove('hidden');
                            warning.classList.add('warning-highlight');
                            slugInput.classList.add('border-red-400');
                            slugInput.classList.remove('border-green-400');
                        }
                    })
                    .catch(error => {
                        console.error('Error checking slug:', error);
                    });
            } else {
                document.getElementById('slugWarning').classList.add('hidden');
                slugInput.classList.remove('border-red-400', 'border-green-400');
            }
        }

        // Form validation
        const form = document.getElementById('editForm');
        form.addEventListener('submit', function(e) {
            const title = titleInput.value.trim();
            const slug = slugInput.value.trim();

            if (!title) {
                e.preventDefault();
                titleInput.focus();
                showMessage('Title is required! 🎨', 'error');
                return;
            }

            if (!slug) {
                e.preventDefault();
                slugInput.focus();
                showMessage('Slug is required! 🔗', 'error');
                return;
            }

            // Check if slug warning is visible
            if (!document.getElementById('slugWarning').classList.contains('hidden')) {
                e.preventDefault();
                slugInput.focus();
                showMessage('Please fix the slug issue before saving! ⚠️', 'error');
                return;
            }

            showMessage('Saving changes... ✨', 'success');
        });

        // Reset form function
        window.resetForm = function() {
            const confirmReset = confirm('🔄 Are you sure you want to reset all changes?\n\nThis will restore the original values.');
            if (confirmReset) {
                titleInput.value = originalValues.title;
                slugInput.value = originalValues.slug;
                slugInput.dataset.manuallyEdited = 'false';

                // Reset category
                document.querySelector('select[name="category_id"]').value = originalValues.category_id;

                // Reset file inputs
                document.querySelector('input[name="pdf_file"]').value = '';
                document.querySelector('input[name="thumb_file"]').value = '';

                // Reset SEO fields
                document.querySelector('input[name="meta_title"]').value = '<?= htmlspecialchars($image['meta_title'] ?? '') ?>';
                document.querySelector('textarea[name="meta_description"]').value = '<?= htmlspecialchars($image['meta_description'] ?? '') ?>';

                // Hide warnings
                document.getElementById('slugWarning').classList.add('hidden');
                slugInput.classList.remove('border-red-400', 'border-green-400');

                updateUrlPreview();
                showMessage('Form has been reset! 🔄', 'success');
            }
        };

        // Focus animations
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });

        // Initial URL preview
        updateUrlPreview();

        // Add interactive animations on page load
        const animatedElements = document.querySelectorAll('.group, .bg-gradient-to-br');
        animatedElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.transform = 'translateY(-2px)';
                setTimeout(() => {
                    element.style.transform = 'translateY(0)';
                }, 200);
            }, index * 100);
        });
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
</script>