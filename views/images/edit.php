<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-green-400 to-blue-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-edit text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Edit Coloring Page</h1>
    <p class="text-gray-600">Update your coloring page information, tags, and files! 🎨✨</p>
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

                <!-- Current Tags Display -->
                <div class="bg-white rounded-xl p-4 shadow-md">
                    <div class="flex items-center justify-between mb-2">
                        <span class="font-semibold text-gray-700">Current Tags:</span>
                        <i class="fas fa-tags text-purple-500"></i>
                    </div>
                    <div id="currentTagsDisplay" class="flex flex-wrap gap-1">
                        <!-- Current tags will be loaded here -->
                        <span class="text-gray-400 text-sm">Loading tags...</span>
                    </div>
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
                    <h2 class="text-xl font-bold">Enhanced Edit Form</h2>
                    <p class="text-green-100">Update coloring page information, tags, and files</p>
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

                <!-- Interactive Tags Section -->
                <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-6 border-2 border-dashed border-pink-200">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fas fa-tags text-pink-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🏷️ Update Tags</h3>
                    </div>

                    <!-- Interactive Tags Input Container -->
                    <div class="mb-6">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                            <i class="fas fa-magic text-blue-500"></i>
                            <span>Edit Tags</span>
                            <span class="text-sm text-gray-500 ml-2">(Press Enter or comma to add)</span>
                        </label>

                        <!-- Tags Container with Input -->
                        <div class="relative">
                            <div id="tagsContainer"
                                class="min-h-14 w-full border-2 border-gray-200 rounded-2xl p-3 focus-within:border-blue-400 focus-within:ring-4 focus-within:ring-blue-100 transition-all duration-300 bg-white cursor-text flex flex-wrap items-center gap-2"
                                onclick="focusTagInput()">

                                <!-- Tags will be inserted here dynamically -->

                                <!-- Input field inside the container -->
                                <input type="text"
                                    id="tagInput"
                                    class="flex-1 min-w-32 border-0 outline-none bg-transparent text-gray-700 placeholder-gray-400"
                                    placeholder="Type tags and press Enter or comma..."
                                    onkeydown="handleTagInput(event)"
                                    onkeyup="handleTagTyping(event)"
                                    onpaste="handleTagPaste(event)">
                            </div>

                            <!-- Hidden input for form submission -->
                            <input type="hidden" name="tags" id="hiddenTagsInput">

                            <!-- Tag counter -->
                            <div class="absolute -top-2 right-3 bg-blue-500 text-white text-xs px-2 py-1 rounded-full opacity-0 transition-opacity" id="tagCounter">
                                0 tags
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="text-sm text-blue-700">
                                    <i class="fas fa-keyboard text-blue-500 mr-1"></i>
                                    <strong>Quick Edit:</strong> Type and press Enter, comma, or space to add/edit tags instantly!
                                </div>
                            </div>
                            <div class="p-3 bg-green-50 rounded-lg border border-green-200">
                                <div class="text-sm text-green-700">
                                    <i class="fas fa-mouse-pointer text-green-500 mr-1"></i>
                                    <strong>Easy Remove:</strong> Click the × on any tag to remove it quickly!
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tag Examples -->
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200">
                        <h5 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-lightbulb text-purple-500 mr-2"></i>
                            Popular Tag Ideas
                        </h5>
                        <div class="text-sm text-gray-600 mb-3">Click any example to add it to your tags:</div>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 text-sm">
                            <button type="button" onclick="addQuickTag('cute')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>cute</strong> - adorable designs
                            </button>
                            <button type="button" onclick="addQuickTag('easy')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>easy</strong> - simple for beginners
                            </button>
                            <button type="button" onclick="addQuickTag('detailed')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>detailed</strong> - complex designs
                            </button>
                            <button type="button" onclick="addQuickTag('kawaii')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>kawaii</strong> - Japanese cute style
                            </button>
                            <button type="button" onclick="addQuickTag('realistic')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>realistic</strong> - lifelike designs
                            </button>
                            <button type="button" onclick="addQuickTag('cartoon')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>cartoon</strong> - animated style
                            </button>
                            <button type="button" onclick="addQuickTag('baby')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>baby</strong> - young characters
                            </button>
                            <button type="button" onclick="addQuickTag('colorful')" class="tag-suggestion p-2 bg-white rounded-lg text-left hover:bg-purple-100 transition-colors border border-purple-200">
                                <strong>colorful</strong> - vibrant designs
                            </button>
                        </div>
                    </div>
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
                <h3 class="font-bold text-gray-800">💡 Enhanced Editing Tips & Best Practices</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
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
                    <h4 class="font-semibold text-purple-600">🏷️ Tags Management:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-purple-500 mt-1"></i>
                            <span class="text-gray-600">Use 3-5 relevant tags for better discovery</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-purple-500 mt-1"></i>
                            <span class="text-gray-600">Mix style and content tags effectively</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-purple-500 mt-1"></i>
                            <span class="text-gray-600">Click examples to quickly add popular tags</span>
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

    .tag-suggestion:hover {
        transform: scale(1.02);
        transition: transform 0.2s ease;
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

    // Interactive Tags System
    let currentTags = [];
    const tagColors = ['#EC4899', '#F97316', '#8B5CF6', '#06B6D4', '#10B981', '#F59E0B', '#84CC16', '#EF4444', '#0EA5E9', '#F472B6'];

    // Focus the tag input when container is clicked
    function focusTagInput() {
        document.getElementById('tagInput').focus();
    }

    // Handle tag input (Enter, comma, space)
    function handleTagInput(event) {
        const input = event.target;
        const value = input.value.trim();

        // Handle Enter, comma, or space
        if (event.key === 'Enter' || event.key === ',' || event.key === ' ') {
            event.preventDefault();

            if (value) {
                addTag(value);
                input.value = '';
                updateTagCounter();
            }
        }

        // Handle Backspace when input is empty (remove last tag)
        else if (event.key === 'Backspace' && input.value === '' && currentTags.length > 0) {
            removeTag(currentTags.length - 1);
            updateTagCounter();
        }
    }

    // Handle typing for real-time feedback
    function handleTagTyping(event) {
        const input = event.target;
        const value = input.value;

        // Auto-add tag if it contains comma
        if (value.includes(',')) {
            const parts = value.split(',');
            const newTag = parts[0].trim();

            if (newTag) {
                addTag(newTag);
                input.value = parts.slice(1).join(',').trim();
                updateTagCounter();
            }
        }
    }

    // Handle paste event
    function handleTagPaste(event) {
        setTimeout(() => {
            const input = event.target;
            const value = input.value;

            if (value.includes(',')) {
                const tags = value.split(',').map(tag => tag.trim()).filter(tag => tag);

                tags.forEach(tag => {
                    if (tag) addTag(tag);
                });

                input.value = '';
                updateTagCounter();
            }
        }, 10);
    }

    // Add a new tag
    function addTag(tagText) {
        // Clean the tag
        const cleanTag = cleanTagText(tagText);

        if (!cleanTag || cleanTag.length < 2) {
            showMessage('Tag must be at least 2 characters long!', 'error');
            return;
        }

        if (cleanTag.length > 20) {
            showMessage('Tag cannot be longer than 20 characters!', 'error');
            return;
        }

        // Check for duplicates
        if (currentTags.some(tag => tag.toLowerCase() === cleanTag.toLowerCase())) {
            showMessage(`Tag "${cleanTag}" already exists!`, 'error');
            return;
        }

        // Check max tags limit
        if (currentTags.length >= 10) {
            showMessage('Maximum 10 tags allowed!', 'error');
            return;
        }

        // Add to array
        currentTags.push(cleanTag);

        // Update UI
        renderTags();
        updateHiddenInput();
        updateTagCounter();

        // Show success message
        showMessage(`✨ Tag "${cleanTag}" added!`, 'success');
    }

    // Add quick tag from suggestions
    function addQuickTag(tagName) {
        addTag(tagName);
    }

    // Remove a tag by index
    function removeTag(index) {
        if (index >= 0 && index < currentTags.length) {
            const removedTag = currentTags[index];
            currentTags.splice(index, 1);

            renderTags();
            updateHiddenInput();
            updateTagCounter();

            showMessage(`🗑️ Tag "${removedTag}" removed!`, 'success');
        }
    }

    // Clean tag text
    function cleanTagText(text) {
        return text
            .trim()
            .toLowerCase()
            .replace(/[^a-zA-Z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, ' ') // Replace multiple spaces with single space
            .trim();
    }

    // Capitalize tag for display
    function capitalizeTag(tag) {
        return tag.split(' ').map(word =>
            word.charAt(0).toUpperCase() + word.slice(1)
        ).join(' ');
    }

    // Render all tags in the container
    function renderTags() {
        const container = document.getElementById('tagsContainer');
        const input = document.getElementById('tagInput');

        // Clear existing tags (keep input)
        const existingTags = container.querySelectorAll('.tag-item');
        existingTags.forEach(tag => tag.remove());

        // Add new tags
        currentTags.forEach((tag, index) => {
            const tagElement = createTagElement(tag, index);
            container.insertBefore(tagElement, input);
        });

        // Update placeholder
        if (currentTags.length > 0) {
            input.placeholder = 'Add more tags...';
        } else {
            input.placeholder = 'Type tags and press Enter or comma...';
        }
    }

    // Create a tag element
    function createTagElement(tagText, index) {
        const tagDiv = document.createElement('div');
        tagDiv.className = 'tag-item inline-flex items-center px-3 py-1 rounded-full text-sm font-medium text-white transition-all hover:scale-105 cursor-default';
        tagDiv.style.backgroundColor = tagColors[index % tagColors.length];

        tagDiv.innerHTML = `
            <span class="mr-2">${capitalizeTag(tagText)}</span>
            <button type="button" 
                    onclick="removeTag(${index})" 
                    class="text-white hover:text-gray-200 hover:bg-black hover:bg-opacity-20 rounded-full w-4 h-4 flex items-center justify-center text-xs transition-all"
                    title="Remove tag">
                <i class="fas fa-times"></i>
            </button>
        `;

        // Add click animation
        tagDiv.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
        });

        tagDiv.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });

        return tagDiv;
    }

    // Update hidden input for form submission
    function updateHiddenInput() {
        const hiddenInput = document.getElementById('hiddenTagsInput');
        hiddenInput.value = currentTags.join(',');
    }

    // Update tag counter
    function updateTagCounter() {
        const counter = document.getElementById('tagCounter');
        const count = currentTags.length;

        if (count > 0) {
            counter.textContent = `${count} tag${count > 1 ? 's' : ''}`;
            counter.classList.remove('opacity-0');
            counter.classList.add('opacity-100');

            // Change color based on count
            if (count >= 8) {
                counter.className = counter.className.replace('bg-blue-500', 'bg-red-500');
            } else if (count >= 5) {
                counter.className = counter.className.replace('bg-blue-500', 'bg-yellow-500');
                counter.className = counter.className.replace('bg-red-500', 'bg-yellow-500');
            } else {
                counter.className = counter.className.replace('bg-yellow-500', 'bg-blue-500');
                counter.className = counter.className.replace('bg-red-500', 'bg-blue-500');
            }
        } else {
            counter.classList.remove('opacity-100');
            counter.classList.add('opacity-0');
        }
    }

    // Load existing tags for this image
    function loadExistingTags() {
        // This would typically fetch from the server - for now we'll simulate
        const existingTagsFromServer = []; // Replace with actual data from PHP

        existingTagsFromServer.forEach(tag => {
            currentTags.push(tag);
        });

        renderTags();
        updateTagCounter();
        updateHiddenInput();
    }

    // Display current tags in info section
    function displayCurrentTags(tags) {
        const currentTagsDisplay = document.getElementById('currentTagsDisplay');

        if (tags && tags.length > 0) {
            currentTagsDisplay.innerHTML = tags.map((tag, index) => {
                const color = tagColors[index % tagColors.length];
                return `
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium text-white"
                          style="background-color: ${color}">
                        ${capitalizeTag(tag)}
                    </span>
                `;
            }).join('');
        } else {
            currentTagsDisplay.innerHTML = '<span class="text-gray-400 text-sm">No tags assigned</span>';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        const newUrl = document.getElementById('newUrl');

        // Initialize tags system
        loadExistingTags();

        // Load and display current tags (this would come from server)
        const currentImageTags = []; // Replace with actual tags from PHP
        displayCurrentTags(currentImageTags);

        // Copy current tags to editable tags
        currentImageTags.forEach(tag => {
            currentTags.push(tag);
        });
        renderTags();
        updateTagCounter();
        updateHiddenInput();

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

            const tagInfo = currentTags.length > 0 ? ` with ${currentTags.length} tags` : '';
            showMessage(`Saving changes${tagInfo}... ✨`, 'success');
        });

        // Reset form function
        window.resetForm = function() {
            const confirmReset = confirm('🔄 Are you sure you want to reset all changes?\n\nThis will restore the original values including tags.');
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

                // Reset tags
                currentTags = [];
                const currentImageTags = []; // Replace with actual original tags
                currentImageTags.forEach(tag => {
                    currentTags.push(tag);
                });
                renderTags();
                updateTagCounter();
                updateHiddenInput();

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