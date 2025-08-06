<?php
// At the top of your form.php file, add this PHP code to fetch categories
use App\Models\Category;

// Get parent categories from database
$parentCategories = Category::getParents();
?>

<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-upload text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Upload Coloring Pages</h1>
    <p class="text-gray-600">Add beautiful new coloring pages with manual tags and proper categorization! 🎨✨</p>
</div>

<!-- Upload Instructions -->
<div class="max-w-6xl mx-auto mb-8">
    <div class="bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 rounded-2xl p-6 border-4 border-white kids-shadow">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                <i class="fas fa-info-circle text-white"></i>
            </div>
            <h3 class="text-xl font-kids text-purple-700">📋 Upload Instructions</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">📁</div>
                <h4 class="font-semibold text-blue-600 mb-2">PDF Files</h4>
                <p class="text-gray-600">Upload PDF coloring pages that kids can print and color</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">🖼️</div>
                <h4 class="font-semibold text-green-600 mb-2">Thumbnails</h4>
                <p class="text-gray-600">Optional PNG/JPG preview images for each PDF</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">🏷️</div>
                <h4 class="font-semibold text-pink-600 mb-2">Manual Tags</h4>
                <p class="text-gray-600">Custom tags separated by commas for better organization</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">⚡</div>
                <h4 class="font-semibold text-orange-600 mb-2">Bulk Upload</h4>
                <p class="text-gray-600">Upload multiple files at once for efficiency</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Upload Form -->
<div class="max-w-6xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-blue-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white rounded-full p-2">
                        <i class="fas fa-cloud-upload-alt text-blue-500 text-lg"></i>
                    </div>
                    <div class="text-white">
                        <h2 class="text-xl font-bold">Simplified Upload Form</h2>
                        <p class="text-blue-100">Add new coloring pages with hierarchical categories and manual tags</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-2 text-white opacity-70">
                    <div class="text-2xl animate-bounce">🎨</div>
                    <div class="text-2xl animate-pulse">✨</div>
                    <div class="text-2xl animate-bounce" style="animation-delay: 0.5s;">🌟</div>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="post" action="/dashboard/images/multiple" enctype="multipart/form-data" id="uploadForm" class="space-y-8">

                <!-- Category Selection Section -->
                <div class="bg-gradient-to-br from-purple-50 to-blue-50 rounded-2xl p-6 border-2 border-dashed border-purple-200">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fas fa-sitemap text-purple-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🗂️ Category Selection</h3>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Parent Category -->
                        <div class="group">
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-folder text-purple-500"></i>
                                <span>Parent Category</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select id="parentCategorySelect"
                                    class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-lg appearance-none"
                                    required onchange="updateChildCategories()">
                                    <option value="">🎯 Choose a parent category...</option>
                                    <?php foreach ($parentCategories as $parent): ?>
                                        <option value="<?= $parent['id'] ?>" data-slug="<?= $parent['slug'] ?>">
                                            <?= getCategoryEmoji($parent['name']) ?> <?= htmlspecialchars($parent['name']) ?>
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
                        </div>

                        <!-- Child Category -->
                        <div class="group">
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-sitemap text-blue-500"></i>
                                <span>Specific Category</span>
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="category_id" id="childCategorySelect"
                                    class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 text-lg appearance-none"
                                    required disabled>
                                    <option value="">🎯 First select a parent category...</option>
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                                    <i class="fas fa-sitemap text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2 ml-2">
                                <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                                Choose the most specific category for better organization
                            </p>
                        </div>
                    </div>

                    <!-- Category Hierarchy Preview -->
                    <div id="categoryPreview" class="mt-4 hidden">
                        <div class="bg-white rounded-xl p-4 shadow-sm border border-purple-200">
                            <div class="text-sm text-gray-600 mb-2">Selected Category Path:</div>
                            <div class="flex items-center space-x-2 text-lg font-semibold" id="categoryPath">
                                <!-- Will be populated by JavaScript -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Interactive Tags Section -->
                <div class="bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl p-6 border-2 border-dashed border-pink-200">
                    <div class="flex items-center space-x-2 mb-6">
                        <i class="fas fa-tags text-pink-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🏷️ Interactive Tags (Optional)</h3>
                    </div>

                    <!-- Interactive Tags Input Container -->
                    <div class="mb-6">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                            <i class="fas fa-magic text-blue-500"></i>
                            <span>Add Tags</span>
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
                            <input type="hidden" name="manual_tags" id="hiddenTagsInput">

                            <!-- Tag counter -->
                            <div class="absolute -top-2 right-3 bg-blue-500 text-white text-xs px-2 py-1 rounded-full opacity-0 transition-opacity" id="tagCounter">
                                0 tags
                            </div>
                        </div>

                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="text-sm text-blue-700">
                                    <i class="fas fa-keyboard text-blue-500 mr-1"></i>
                                    <strong>Quick Add:</strong> Type and press Enter, comma, or space to add tags instantly!
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
                            Tag Examples
                        </h5>
                        <div class="text-sm text-gray-600 mb-3">Here are some tag ideas for different categories:</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3 text-sm">
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Style:</strong> cute, kawaii, detailed, simple, realistic, cartoon
                            </div>
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Difficulty:</strong> easy, beginner, intermediate, detailed, complex
                            </div>
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Age:</strong> toddler, preschool, kids, teens, adults
                            </div>
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Theme:</strong> baby, wild, domestic, magical, futuristic
                            </div>
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Colors:</strong> colorful, black-white, outline, pattern
                            </div>
                            <div class="p-2 bg-white rounded-lg">
                                <strong>Season:</strong> summer, winter, spring, fall, holiday
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SEO Fields -->
                <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl p-6 border-2 border-dashed border-green-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-search text-green-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🔍 SEO Optimization (Optional)</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-heading text-blue-500"></i>
                                <span>Meta Title Template</span>
                            </label>
                            <input type="text"
                                name="meta_title"
                                id="metaTitle"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                placeholder="e.g., Free {category} Coloring Pages for Kids">
                            <p class="text-xs text-gray-500 mt-1">Use {category} as placeholder for category name</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-align-left text-green-500"></i>
                                <span>Meta Description Template</span>
                            </label>
                            <textarea name="meta_description"
                                id="metaDescription"
                                rows="3"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all resize-none"
                                placeholder="Beautiful {category} coloring pages perfect for kids..."></textarea>
                            <p class="text-xs text-gray-500 mt-1">Brief description template for search engines</p>
                        </div>
                    </div>
                </div>

                <!-- PDF Files Upload -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                        <span class="text-lg">PDF Coloring Pages</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="border-3 border-dashed border-red-200 rounded-2xl p-8 text-center hover:border-red-400 transition-all bg-red-50 hover:bg-red-100" id="pdfDropZone">
                        <div class="mb-4">
                            <i class="fas fa-file-pdf text-red-400 text-6xl mb-4"></i>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Drop PDF files here or click to browse</div>
                            <div class="text-gray-500">Select multiple PDF files to upload at once</div>
                        </div>
                        <input type="file"
                            name="pdf_files[]"
                            id="pdfFiles"
                            multiple
                            accept="application/pdf"
                            class="hidden"
                            required>
                        <button type="button"
                            onclick="document.getElementById('pdfFiles').click()"
                            class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-all font-semibold">
                            <i class="fas fa-upload mr-2"></i>
                            Choose PDF Files
                        </button>
                    </div>
                    <div id="pdfFileList" class="mt-4 space-y-2 hidden">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-list mr-2 text-blue-500"></i>
                            Selected PDF Files:
                        </h4>
                        <div id="pdfFiles-list" class="space-y-2"></div>
                    </div>
                </div>

                <!-- Thumbnail Files Upload -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-image text-green-500 text-lg"></i>
                        <span class="text-lg">Thumbnail Images (Optional)</span>
                        <span class="text-gray-400 text-sm ml-2">- PNG or JPG</span>
                    </label>
                    <div class="border-3 border-dashed border-green-200 rounded-2xl p-8 text-center hover:border-green-400 transition-all bg-green-50 hover:bg-green-100" id="thumbDropZone">
                        <div class="mb-4">
                            <i class="fas fa-images text-green-400 text-6xl mb-4"></i>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Drop thumbnail images here or click to browse</div>
                            <div class="text-gray-500">Order should match your PDF files</div>
                        </div>
                        <input type="file"
                            name="thumb_files[]"
                            id="thumbFiles"
                            multiple
                            accept="image/png,image/jpeg,image/jpg"
                            class="hidden">
                        <button type="button"
                            onclick="document.getElementById('thumbFiles').click()"
                            class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition-all font-semibold">
                            <i class="fas fa-upload mr-2"></i>
                            Choose Thumbnail Images
                        </button>
                    </div>
                    <div id="thumbFileList" class="mt-4 space-y-2 hidden">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-list mr-2 text-green-500"></i>
                            Selected Thumbnail Files:
                        </h4>
                        <div id="thumbFiles-list" class="space-y-2"></div>
                    </div>
                </div>

                <!-- File Matching Preview -->
                <div id="fileMatching" class="hidden bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border-2 border-dashed border-purple-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-link text-purple-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">📝 File Matching Preview</h3>
                    </div>
                    <div id="matchingPreview" class="space-y-3"></div>
                </div>

                <!-- Progress Bar -->
                <div id="progressContainer" class="hidden">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border-2 border-blue-200">
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-cloud-upload-alt text-blue-500 text-lg"></i>
                            <h3 class="text-lg font-semibold text-gray-700">🚀 Upload Progress</h3>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div id="progressBar"
                                class="bg-gradient-to-r from-blue-500 to-purple-500 h-4 text-xs leading-none text-center text-white rounded-full transition-all duration-300 flex items-center justify-center font-bold"
                                style="width:0%">
                                0%
                            </div>
                        </div>
                        <div id="progressText" class="text-center text-gray-600 mt-2 font-semibold">
                            Preparing upload...
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/dashboard/images"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Images</span>
                    </a>

                    <div class="flex space-x-3">
                        <button type="button"
                            onclick="resetForm()"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset Form</span>
                        </button>

                        <button type="submit"
                            id="submitBtn"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-2xl hover:from-blue-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Upload Coloring Pages</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Tips -->
<div class="max-w-6xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">💡 Simplified Upload Tips & Best Practices</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                <div class="space-y-3">
                    <h4 class="font-semibold text-blue-600">📁 File Requirements:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">PDF files should be high quality (300 DPI recommended)</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Thumbnails should be PNG or JPG format</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Use clear, descriptive filenames</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Maximum file size: 10MB per file</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <h4 class="font-semibold text-purple-600">🏷️ Tagging Best Practices:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Enter 3-5 relevant tags separated by commas</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Mix style tags (cute, detailed) with content tags (animal, flower)</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Use difficulty tags (easy, detailed) to help parents choose</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Tags are automatically cleaned and formatted</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <h4 class="font-semibold text-green-600">🎯 Organization Tips:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Use specific child categories when available</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Group related images in same upload session</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Match thumbnail order with PDF order</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Add SEO info for better search visibility</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Helper function to get category emoji (add this to your functions or wherever appropriate)
function getCategoryEmoji($name)
{
    $lowerName = strtolower($name);
    if (strpos($lowerName, 'animal') !== false) return '🐾';
    if (strpos($lowerName, 'cartoon') !== false) return '🎭';
    if (strpos($lowerName, 'holiday') !== false) return '🎉';
    if (strpos($lowerName, 'learning') !== false) return '📚';
    if (strpos($lowerName, 'fantasy') !== false) return '🦄';
    if (strpos($lowerName, 'vehicle') !== false) return '🚗';
    if (strpos($lowerName, 'nature') !== false) return '🌿';
    if (strpos($lowerName, 'dinosaur') !== false) return '🦕';
    if (strpos($lowerName, 'mandala') !== false) return '🔮';
    if (strpos($lowerName, 'space') !== false) return '🚀';
    if (strpos($lowerName, 'cat') !== false) return '🐱';
    if (strpos($lowerName, 'dog') !== false) return '🐶';
    if (strpos($lowerName, 'wild') !== false) return '🦁';
    if (strpos($lowerName, 'disney') !== false) return '🏰';
    if (strpos($lowerName, 'anime') !== false) return '⚡';
    if (strpos($lowerName, 'christmas') !== false) return '🎄';
    if (strpos($lowerName, 'halloween') !== false) return '🎃';
    return '🎨';
}
?>

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

    .file-item {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #cbd5e0;
        border-radius: 0.75rem;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: between;
        transition: all 0.3s ease;
    }

    .file-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .drop-zone-active {
        border-color: #3b82f6 !important;
        background-color: #dbeafe !important;
        transform: scale(1.02);
    }

    @keyframes uploadPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .upload-active {
        animation: uploadPulse 2s infinite;
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
</style>

<script>
    // Real child categories data from database
    let childCategoriesData = [];

    const form = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const submitBtn = document.getElementById('submitBtn');
    const pdfFiles = document.getElementById('pdfFiles');
    const thumbFiles = document.getElementById('thumbFiles');

    // Function to fetch child categories from database
    async function fetchChildCategories(parentId) {
        try {
            const response = await fetch(`/dashboard/categories/children/${parentId}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            if (response.ok) {
                const data = await response.json();
                return data;
            } else {
                console.error('Failed to fetch child categories');
                return [];
            }
        } catch (error) {
            console.error('Error fetching child categories:', error);
            return [];
        }
    }

    // Update child categories when parent is selected
    async function updateChildCategories() {
        const parentSelect = document.getElementById('parentCategorySelect');
        const childSelect = document.getElementById('childCategorySelect');
        const categoryPreview = document.getElementById('categoryPreview');
        const categoryPath = document.getElementById('categoryPath');

        const selectedParentId = parentSelect.value;
        const selectedParentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';

        // Clear child categories
        childSelect.innerHTML = '<option value="">🎯 Choose specific category...</option>';

        if (selectedParentId) {
            // Enable child select
            childSelect.disabled = false;

            // Show loading state
            childSelect.innerHTML += '<option value="" disabled>⏳ Loading categories...</option>';

            try {
                // Fetch child categories from database
                const children = await fetchChildCategories(selectedParentId);

                // Clear loading state
                childSelect.innerHTML = '<option value="">🎯 Choose specific category...</option>';

                // Add parent category as an option
                childSelect.innerHTML += `<option value="${selectedParentId}">Use "${selectedParentText}" (Parent Category)</option>`;

                // Add child categories
                if (children && children.length > 0) {
                    children.forEach(child => {
                        const childEmoji = getCategoryEmoji(child.name);
                        childSelect.innerHTML += `<option value="${child.id}">${childEmoji} ${child.name}</option>`;
                    });
                }

                // Store data for later use
                childCategoriesData = children;

            } catch (error) {
                childSelect.innerHTML = '<option value="">❌ Error loading categories</option>';
                console.error('Error loading child categories:', error);
            }

            // Show category preview
            categoryPreview.classList.remove('hidden');
            categoryPath.innerHTML = `
                <span class="text-purple-600 font-bold">${selectedParentText.split(' ')[1] || selectedParentText}</span>
                <span class="text-gray-400">></span>
                <span class="text-gray-500">Select specific category...</span>
            `;
        } else {
            // Disable child select
            childSelect.disabled = true;
            categoryPreview.classList.add('hidden');
        }
    }

    // Update category path when child is selected
    document.getElementById('childCategorySelect').addEventListener('change', function() {
        const parentSelect = document.getElementById('parentCategorySelect');
        const categoryPath = document.getElementById('categoryPath');

        const selectedParentText = parentSelect.options[parentSelect.selectedIndex]?.text || '';
        const selectedChildText = this.options[this.selectedIndex]?.text || '';
        const selectedChildId = this.value;
        const selectedParentId = parentSelect.value;

        if (selectedChildId && selectedChildId !== selectedParentId) {
            // Child category selected
            categoryPath.innerHTML = `
                <span class="text-purple-600 font-bold">${selectedParentText.split(' ')[1] || selectedParentText}</span>
                <span class="text-gray-400">></span>
                <span class="text-blue-600 font-bold">${selectedChildText.substring(2) || selectedChildText}</span>
            `;
        } else if (selectedChildId === selectedParentId) {
            // Parent category selected
            categoryPath.innerHTML = `
                <span class="text-purple-600 font-bold">${selectedParentText.split(' ')[1] || selectedParentText}</span>
                <span class="text-sm text-gray-500 ml-2">(Parent Category)</span>
            `;
        }
    });

    // Get category emoji (JavaScript version)
    function getCategoryEmoji(name) {
        const lowerName = name.toLowerCase();
        if (lowerName.includes('cat')) return '🐱';
        if (lowerName.includes('dog')) return '🐶';
        if (lowerName.includes('wild')) return '🦁';
        if (lowerName.includes('disney')) return '🏰';
        if (lowerName.includes('anime')) return '⚡';
        if (lowerName.includes('christmas')) return '🎄';
        if (lowerName.includes('halloween')) return '🎃';
        if (lowerName.includes('animal')) return '🐾';
        if (lowerName.includes('cartoon')) return '🎭';
        if (lowerName.includes('holiday')) return '🎉';
        if (lowerName.includes('learning')) return '📚';
        if (lowerName.includes('fantasy')) return '🦄';
        if (lowerName.includes('vehicle')) return '🚗';
        if (lowerName.includes('nature')) return '🌿';
        if (lowerName.includes('dinosaur')) return '🦕';
        if (lowerName.includes('mandala')) return '🔮';
        if (lowerName.includes('space')) return '🚀';
        return '🎨';
    }

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

        // Auto-add tag if it contains comma or enters
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

    // Initialize tags from existing value (for form restoration)
    function initializeTags() {
        const hiddenInput = document.getElementById('hiddenTagsInput');
        if (hiddenInput.value) {
            const existingTags = hiddenInput.value.split(',').filter(tag => tag.trim());
            existingTags.forEach(tag => {
                currentTags.push(tag.trim());
            });
            renderTags();
            updateTagCounter();
        }
    }

    // File list management
    function updateFileList(input, listContainer, listElement) {
        const files = Array.from(input.files);
        const container = document.getElementById(listContainer);
        const list = document.getElementById(listElement);

        if (files.length > 0) {
            container.classList.remove('hidden');
            list.innerHTML = '';

            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';

                const fileIcon = input.accept.includes('pdf') ? 'fas fa-file-pdf text-red-500' : 'fas fa-image text-green-500';
                const fileSize = (file.size / 1024 / 1024).toFixed(2);

                fileItem.innerHTML = `
                    <div class="flex items-center space-x-3 flex-1">
                        <i class="${fileIcon} text-lg"></i>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">${file.name}</div>
                            <div class="text-sm text-gray-500">${fileSize} MB</div>
                        </div>
                        <div class="text-sm text-gray-400">#${index + 1}</div>
                    </div>
                    <button type="button" onclick="removeFile('${input.id}', ${index})" 
                            class="text-red-500 hover:text-red-700 p-1 rounded">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                list.appendChild(fileItem);
            });

            updateFileMatching();
        } else {
            container.classList.add('hidden');
        }
    }

    // Remove file from list
    function removeFile(inputId, index) {
        const input = document.getElementById(inputId);
        const dt = new DataTransfer();
        const files = Array.from(input.files);

        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });

        input.files = dt.files;

        if (inputId === 'pdfFiles') {
            updateFileList(input, 'pdfFileList', 'pdfFiles-list');
        } else {
            updateFileList(input, 'thumbFileList', 'thumbFiles-list');
        }
    }

    // Update file matching preview
    function updateFileMatching() {
        const pdfFilesList = Array.from(pdfFiles.files);
        const thumbFilesList = Array.from(thumbFiles.files);
        const matchingContainer = document.getElementById('fileMatching');
        const matchingPreview = document.getElementById('matchingPreview');

        if (pdfFilesList.length > 0) {
            matchingContainer.classList.remove('hidden');
            matchingPreview.innerHTML = '';

            pdfFilesList.forEach((pdfFile, index) => {
                const thumbFile = thumbFilesList[index];
                const matchItem = document.createElement('div');
                matchItem.className = 'bg-white rounded-xl p-4 shadow-md flex items-center justify-between';

                matchItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="text-2xl">${index + 1}</div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <span class="font-semibold text-gray-800">${pdfFile.name}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-arrow-right text-gray-400"></i>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-image ${thumbFile ? 'text-green-500' : 'text-gray-400'}"></i>
                            <span class="text-sm ${thumbFile ? 'text-gray-800' : 'text-gray-400'}">
                                ${thumbFile ? thumbFile.name : 'No thumbnail'}
                            </span>
                        </div>
                    </div>
                `;

                matchingPreview.appendChild(matchItem);
            });
        } else {
            matchingContainer.classList.add('hidden');
        }
    }

    // Drag and drop functionality
    function setupDragAndDrop(dropZone, fileInput) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('drop-zone-active'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('drop-zone-active'), false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;

            if (fileInput.id === 'pdfFiles') {
                updateFileList(fileInput, 'pdfFileList', 'pdfFiles-list');
            } else {
                updateFileList(fileInput, 'thumbFileList', 'thumbFiles-list');
            }
        }, false);
    }

    // Event listeners for file inputs
    pdfFiles.addEventListener('change', function() {
        updateFileList(this, 'pdfFileList', 'pdfFiles-list');
    });

    thumbFiles.addEventListener('change', function() {
        updateFileList(this, 'thumbFileList', 'thumbFiles-list');
    });

    // Setup drag and drop
    setupDragAndDrop(document.getElementById('pdfDropZone'), pdfFiles);
    setupDragAndDrop(document.getElementById('thumbDropZone'), thumbFiles);

    // Form submission with progress
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const categoryId = document.getElementById('childCategorySelect').value;
        const pdfFilesList = Array.from(pdfFiles.files);

        if (!categoryId) {
            showMessage('Please select a specific category! 📁', 'error');
            document.getElementById('childCategorySelect').focus();
            return;
        }

        if (pdfFilesList.length === 0) {
            showMessage('Please select at least one PDF file! 📄', 'error');
            document.getElementById('pdfFiles').focus();
            return;
        }

        // Show progress container
        progressContainer.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

        // Add upload animation to form
        form.classList.add('upload-active');

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        // Progress tracking
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.textContent = percent + '%';

                // Update progress text
                if (percent < 20) {
                    progressText.textContent = '📤 Uploading files...';
                } else if (percent < 40) {
                    progressText.textContent = '🎨 Processing coloring pages...';
                } else if (percent < 60) {
                    progressText.textContent = '🖼️ Creating thumbnails...';
                } else if (percent < 80) {
                    progressText.textContent = '🏷️ Applying tags...';
                } else if (percent < 100) {
                    progressText.textContent = '✨ Finalizing upload...';
                } else {
                    progressText.textContent = '🎉 Upload complete!';
                }
            }
        });

        // Handle completion
        xhr.addEventListener('load', function() {
            form.classList.remove('upload-active');

            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        const tagInfo = currentTags.length > 0 ? ` with ${currentTags.length} tags` : '';

                        progressText.textContent = `🎉 Successfully uploaded ${response.uploaded.length} coloring pages${tagInfo}!`;
                        showMessage(`🎉 Successfully uploaded ${response.uploaded.length} coloring pages with interactive tags!`, 'success');

                        setTimeout(() => {
                            window.location.href = '/dashboard/images';
                        }, 2000);
                    } else {
                        throw new Error(response.message || 'Upload failed');
                    }
                } catch (error) {
                    showMessage('❌ Upload failed: ' + error.message, 'error');
                    resetUploadState();
                }
            } else {
                showMessage('❌ Upload failed! Please try again.', 'error');
                resetUploadState();
            }
        });

        // Handle errors
        xhr.addEventListener('error', function() {
            showMessage('❌ Network error during upload!', 'error');
            resetUploadState();
        });

        // Send request
        xhr.open('POST', form.action, true);
        xhr.send(formData);
    });

    // Reset upload state
    function resetUploadState() {
        form.classList.remove('upload-active');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i><span>Upload Coloring Pages</span>';
        progressContainer.classList.add('hidden');
        progressBar.style.width = '0%';
        progressBar.textContent = '0%';
        progressText.textContent = 'Preparing upload...';
    }

    // Reset form function
    function resetForm() {
        const confirmReset = confirm('🔄 Are you sure you want to reset the form?\n\nThis will clear all selected files, tags, and form data.');
        if (confirmReset) {
            form.reset();
            document.getElementById('pdfFileList').classList.add('hidden');
            document.getElementById('thumbFileList').classList.add('hidden');
            document.getElementById('fileMatching').classList.add('hidden');
            document.getElementById('categoryPreview').classList.add('hidden');
            document.getElementById('childCategorySelect').disabled = true;

            // Reset interactive tags
            currentTags = [];
            renderTags();
            updateTagCounter();
            updateHiddenInput();

            progressContainer.classList.add('hidden');

            resetUploadState();
            showMessage('📝 Form has been reset!', 'success');
        }
    }

    // Show message function
    function showMessage(message, type) {
        const existingMessage = document.querySelector('.form-message');
        if (existingMessage) existingMessage.remove();

        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message fixed top-4 right-4 px-6 py-3 rounded-2xl text-white font-semibold kids-shadow z-50 ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}`;
        messageDiv.textContent = message;

        document.body.appendChild(messageDiv);
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 4000);
    }

    // Enhanced interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize interactive tags
        initializeTags();

        // Focus animations
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
                this.parentElement.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });

        // File validation
        pdfFiles.addEventListener('change', function() {
            const files = Array.from(this.files);
            let validFiles = 0;
            let totalSize = 0;

            files.forEach(file => {
                if (file.type === 'application/pdf') {
                    validFiles++;
                    totalSize += file.size;
                } else {
                    showMessage(`❌ ${file.name} is not a PDF file!`, 'error');
                }
            });

            if (totalSize > 100 * 1024 * 1024) { // 100MB limit
                showMessage('⚠️ Total file size too large! Please reduce file sizes.', 'error');
            } else if (validFiles > 0) {
                showMessage(`📄 ${validFiles} PDF file(s) selected!`, 'success');
            }
        });

        thumbFiles.addEventListener('change', function() {
            const files = Array.from(this.files);
            const pdfCount = pdfFiles.files.length;
            let validFiles = 0;

            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    validFiles++;
                } else {
                    showMessage(`❌ ${file.name} is not an image file!`, 'error');
                }
            });

            if (validFiles > 0) {
                if (validFiles === pdfCount) {
                    showMessage(`🖼️ Perfect! ${validFiles} thumbnails match ${pdfCount} PDFs!`, 'success');
                } else if (validFiles < pdfCount) {
                    showMessage(`🖼️ ${validFiles} thumbnails selected (${pdfCount - validFiles} PDFs will use auto-generated previews)`, 'success');
                } else {
                    showMessage(`⚠️ More thumbnails than PDFs! Extra thumbnails will be ignored.`, 'error');
                }
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+U or Cmd+U for upload
        if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
            e.preventDefault();
            if (!submitBtn.disabled) {
                form.dispatchEvent(new Event('submit'));
            }
        }

        // Ctrl+R or Cmd+R for reset (with custom confirm)
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            resetForm();
        }
    });
</script>