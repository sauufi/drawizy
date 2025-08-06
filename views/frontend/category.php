<!-- Fun Breadcrumb with Parent-Child Support -->
<nav class="mb-6" aria-label="Breadcrumb">
    <div class="bg-gradient-to-r from-pink-100 to-purple-100 rounded-full p-3 border-4 border-white shadow-lg inline-flex">
        <ol class="flex items-center space-x-2 text-sm font-semibold">
            <li>
                <a href="/" class="text-purple-600 hover:text-pink-500 transition-colors flex items-center space-x-1 bounce-soft">
                    <span>🏠</span>
                    <span>Home</span>
                </a>
            </li>
            <li class="text-gray-400 text-lg">→</li>

            <!-- Parent Category (if exists) -->
            <?php if (!empty($category['parent_name']) && !empty($category['parent_slug'])): ?>
                <li>
                    <a href="/category/<?= $category['parent_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors flex items-center space-x-1 bounce-soft">
                        <span>📁</span>
                        <span><?= htmlspecialchars($category['parent_name']) ?></span>
                    </a>
                </li>
                <li class="text-gray-400 text-lg">→</li>
            <?php endif; ?>

            <!-- Current Category -->
            <li class="text-gray-600 flex items-center space-x-1">
                <span><?= $category['level'] == 0 ? '📁' : '🎨' ?></span>
                <span><?= htmlspecialchars($category['name']) ?></span>
            </li>
        </ol>
    </div>
</nav>

<!-- Category Header -->
<div class="text-center mb-8 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 rounded-3xl opacity-60"></div>
    <div class="relative z-10 py-8">
        <!-- Decorative elements -->
        <div class="absolute top-2 left-4 text-3xl animate-pulse opacity-50">⭐</div>
        <div class="absolute top-4 right-6 text-2xl animate-bounce opacity-50">🌈</div>
        <div class="absolute bottom-2 left-8 text-2xl animate-pulse opacity-50">✨</div>
        <div class="absolute bottom-4 right-4 text-3xl animate-bounce opacity-50" style="animation-delay: 0.5s;">🎈</div>

        <h1 class="text-4xl md:text-5xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 mb-4">
            <?= $category['level'] == 0 ? '📁' : '🎨' ?> <?= htmlspecialchars($category['name']) ?> Coloring Pages! 🖍️
        </h1>
        <div class="w-32 h-2 bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mx-auto rounded-full mb-4"></div>

        <!-- Category Type Indicator -->
        <?php if ($category['level'] == 0): ?>
            <p class="text-xl text-gray-700 font-semibold mb-2">
                ✨ Discover amazing coloring adventures in this main category! ✨
            </p>
            <p class="text-lg text-purple-600 font-bold">
                📋 Showing images from all subcategories below! 📋
            </p>
        <?php else: ?>
            <p class="text-xl text-gray-700 font-semibold">
                ✨ Discover amazing coloring adventures in this category! ✨
            </p>
        <?php endif; ?>
    </div>
</div>

<!-- Child Categories Section (only for parent categories) -->
<?php if ($category['level'] == 0 && !empty($relatedCategories)): ?>
    <div class="mb-12">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-2">
                🗂️ Browse by Subcategory 🗂️
            </h2>
            <p class="text-gray-600 font-semibold">Choose a specific subcategory or scroll down to see all images!</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
            <?php foreach ($relatedCategories as $child): ?>
                <a href="/category/<?= $child['slug'] ?>" class="group bg-white shadow-lg rounded-2xl p-4 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-4 border-transparent hover:border-pink-200 subcategory-card">

                    <!-- Image Preview Section -->
                    <div class="relative w-full h-32 md:h-40 mb-3 rounded-xl overflow-hidden bg-gradient-to-br from-pink-50 to-purple-50">
                        <?php if (!empty($child['first_image_preview'])): ?>
                            <!-- Actual first image from category -->
                            <img src="/uploads/<?= $child['first_image_preview'] ?>"
                                alt="<?= htmlspecialchars($child['name']) ?> preview"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110 category-preview-img">

                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-purple-500/20 to-pink-500/20 opacity-0 group-hover:opacity-100 transition-all duration-300"></div>

                            <!-- Preview badge -->
                            <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm rounded-full px-2 py-1 text-xs font-bold text-purple-600 opacity-0 group-hover:opacity-100 transition-all duration-300">
                                Preview
                            </div>
                        <?php else: ?>
                            <!-- Fallback when no images available -->
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                <div class="text-center">
                                    <div class="text-4xl mb-2 group-hover:animate-bounce"><?= getChildCategoryEmoji($child['name']) ?></div>
                                    <div class="text-xs text-gray-500 font-semibold">Coming Soon!</div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Decorative elements that appear on hover -->
                        <div class="absolute top-2 left-2 text-xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">✨</div>
                        <div class="absolute bottom-2 right-2 text-lg opacity-0 group-hover:opacity-100 transition-all duration-500 animate-bounce" style="animation-delay: 0.2s;">🎨</div>
                    </div>

                    <!-- Category Info -->
                    <div class="space-y-2">
                        <h3 class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors text-sm md:text-base">
                            <?= htmlspecialchars($child['name']) ?>
                        </h3>

                        <p class="text-xs text-gray-500">
                            <?= $child['image_count'] ?>
                            <?= $child['image_count'] == 1 ? 'image' : 'images' ?>
                        </p>

                        <!-- Action button that appears on hover -->
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                            <span class="inline-block bg-gradient-to-r from-pink-400 to-purple-400 text-white text-xs px-3 py-1 rounded-full font-bold">
                                Explore! 🚀
                            </span>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Divider -->
        <div class="flex items-center justify-center mb-8">
            <div class="flex-1 h-1 bg-gradient-to-r from-pink-300 to-purple-300 rounded"></div>
            <div class="px-4 text-2xl">🎨</div>
            <div class="flex-1 h-1 bg-gradient-to-l from-pink-300 to-purple-300 rounded"></div>
        </div>
    </div>
<?php endif; ?>

<!-- Fun Search Bar -->
<div class="max-w-2xl mx-auto mb-8">
    <form method="get" class="relative">
        <div class="bg-white rounded-2xl shadow-lg border-4 border-yellow-200 p-2 hover:border-yellow-300 transition-all">
            <div class="flex items-center">
                <div class="absolute left-6 text-purple-500">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>"
                    placeholder="🔍 Search for more fun coloring pages..."
                    class="border-0 p-4 pl-14 flex-1 rounded-l-2xl focus:outline-none focus:ring-2 focus:ring-purple-400 text-gray-700 font-semibold">
                <input type="hidden" name="slug" value="<?= $category['slug'] ?>">
                <button type="submit" class="bg-gradient-to-r from-pink-400 to-purple-500 text-white px-8 py-4 rounded-r-2xl hover:from-pink-500 hover:to-purple-600 transition-all duration-300 shadow-lg font-bold text-lg">
                    Search! 🚀
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Category Description -->
<?php if (!empty($category['description'])): ?>
    <div class="max-w-4xl mx-auto mb-8">
        <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 shadow-lg border-4 border-white relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-2 right-2 text-4xl opacity-10">🎨</div>
            <div class="absolute bottom-2 left-2 text-3xl opacity-10">🌟</div>

            <div class="relative z-10">
                <div class="flex items-center justify-center mb-4">
                    <span class="text-3xl mr-2">📖</span>
                    <h2 class="text-2xl font-kids text-purple-700">About This Category</h2>
                    <span class="text-3xl ml-2">📖</span>
                </div>
                <div class="text-center">
                    <p class="text-gray-700 text-lg leading-relaxed font-semibold">
                        <?= nl2br(htmlspecialchars($category['description'])) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Images Grid Title -->
<div class="text-center mb-6">
    <?php if ($category['level'] == 0): ?>
        <h2 class="text-2xl md:text-3xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-2">
            🎨 All <?= htmlspecialchars($category['name']) ?> Coloring Pages 🎨
        </h2>
        <p class="text-gray-600 font-semibold">Images from all subcategories combined!</p>
    <?php else: ?>
        <h2 class="text-2xl md:text-3xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600">
            🎨 <?= htmlspecialchars($category['name']) ?> Coloring Pages 🎨
        </h2>
    <?php endif; ?>
</div>

<!-- Coloring Pages Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <?php foreach ($images as $img): ?>
        <a href="/image/<?= $img['slug'] ?>" class="group bg-white shadow-lg rounded-2xl p-4 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 border-4 border-transparent hover:border-gradient-to-r hover:from-pink-200 hover:to-purple-200">
            <div class="relative overflow-hidden rounded-xl mb-3">
                <img src="/uploads/<?= $img['preview'] ?>" class="mx-auto transition-transform duration-300 group-hover:scale-110 w-full h-auto" alt="<?= htmlspecialchars($img['title']) ?>">

                <!-- Overlay gradient on hover -->
                <div class="absolute inset-0 bg-gradient-to-t from-purple-200/0 to-pink-200/0 group-hover:from-purple-200/20 group-hover:to-pink-200/20 transition-all duration-300 rounded-xl"></div>

                <!-- Fun floating elements -->
                <div class="absolute top-2 right-2 text-2xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">⭐</div>
                <div class="absolute top-2 left-2 text-xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse" style="animation-delay: 0.2s;">✨</div>
                <div class="absolute bottom-2 right-2 text-xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce" style="animation-delay: 0.4s;">🌈</div>

                <!-- Category indicator for parent categories showing mixed content -->
                <?php if ($category['level'] == 0 && !empty($img['parent_category_name'])): ?>
                    <div class="absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <span class="bg-purple-500 text-white text-xs px-2 py-1 rounded-full font-bold">
                            <?= htmlspecialchars($img['category_name']) ?>
                        </span>
                    </div>
                <?php else: ?>
                    <!-- Color palette indicator -->
                    <div class="absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <div class="flex space-x-1">
                            <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                            <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="space-y-2">
                <p class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors text-sm md:text-base">
                    🎨 <?= htmlspecialchars($img['title']) ?>
                </p>

                <!-- Show subcategory name for parent category views -->
                <?php if ($category['level'] == 0 && !empty($img['category_name']) && $img['category_name'] !== $category['name']): ?>
                    <p class="text-xs text-purple-600 font-semibold opacity-75">
                        from <?= htmlspecialchars($img['category_name']) ?>
                    </p>
                <?php endif; ?>

                <!-- Action button that appears on hover -->
                <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                    <span class="inline-block bg-gradient-to-r from-pink-400 to-purple-400 text-white text-xs px-4 py-2 rounded-full font-bold shadow-lg">
                        Start Coloring! ✨
                    </span>
                </div>

                <!-- Difficulty indicator -->
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <div class="flex justify-center space-x-1 mt-2">
                        <span class="text-xs text-gray-500">Level:</span>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<!-- No Images Message -->
<?php if (empty($images)): ?>
    <div class="text-center py-12">
        <div class="text-8xl mb-4">😢</div>
        <h3 class="text-2xl font-kids text-purple-600 mb-2">Oops! No coloring pages found!</h3>
        <p class="text-gray-600 font-semibold mb-4">
            <?php if ($search): ?>
                Try a different search term or browse all pages below.
            <?php else: ?>
                This category doesn't have any coloring pages yet, but check back soon!
            <?php endif; ?>
        </p>
        <?php if ($search): ?>
            <a href="/category/<?= $category['slug'] ?>" class="inline-block bg-gradient-to-r from-pink-400 to-purple-500 text-white font-bold py-3 px-6 rounded-full hover:from-pink-500 hover:to-purple-600 transition-all shadow-lg">
                See All Pages
            </a>
        <?php endif; ?>
    </div>
<?php endif; ?>

<!-- Fun Pagination -->
<?php if ($totalPages > 1): ?>
    <div class="flex justify-center mt-12 mb-8">
        <div class="bg-white rounded-full shadow-xl p-3 border-4 border-gradient-to-r from-pink-200 to-purple-200">
            <div class="flex items-center space-x-2">
                <!-- Previous button -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?= $currentPage - 1 ?>&q=<?= urlencode($search) ?>"
                        class="bg-gradient-to-r from-pink-400 to-purple-400 text-white px-4 py-2 rounded-full hover:from-pink-500 hover:to-purple-500 transition-all shadow-lg font-bold">
                        ← Prev
                    </a>
                <?php endif; ?>

                <!-- Page numbers -->
                <?php
                $startPage = max(1, $currentPage - 2);
                $endPage = min($totalPages, $currentPage + 2);
                for ($i = $startPage; $i <= $endPage; $i++):
                ?>
                    <a href="?page=<?= $i ?>&q=<?= urlencode($search) ?>"
                        class="inline-block px-4 py-2 mx-1 rounded-full font-bold transition-all duration-300 <?= $i == $currentPage ? 'bg-gradient-to-r from-pink-400 to-purple-500 text-white shadow-lg transform scale-110' : 'text-purple-600 hover:bg-purple-100 hover:scale-105' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <!-- Next button -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=<?= $currentPage + 1 ?>&q=<?= urlencode($search) ?>"
                        class="bg-gradient-to-r from-pink-400 to-purple-400 text-white px-4 py-2 rounded-full hover:from-pink-500 hover:to-purple-500 transition-all shadow-lg font-bold">
                        Next →
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Category Stats (Fun addition) -->
<div class="max-w-4xl mx-auto mt-12">
    <div class="bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 rounded-2xl p-6 shadow-lg border-4 border-white text-center">
        <h3 class="text-2xl font-kids text-purple-700 mb-4">🎯 Category Fun Facts!</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="text-3xl mb-2">📄</div>
                <p class="text-2xl font-bold text-purple-600"><?= count($images) ?></p>
                <p class="text-sm text-gray-600 font-semibold">
                    <?php if ($currentPage > 1): ?>
                        On This Page
                    <?php else: ?>
                        Pages Available
                    <?php endif; ?>
                </p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="text-3xl mb-2">🎨</div>
                <p class="text-2xl font-bold text-pink-600">∞</p>
                <p class="text-sm text-gray-600 font-semibold">Color Possibilities</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="text-3xl mb-2">⭐</div>
                <p class="text-2xl font-bold text-blue-600">100%</p>
                <p class="text-sm text-gray-600 font-semibold">Fun Guaranteed</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md">
                <div class="text-3xl mb-2">💖</div>
                <p class="text-2xl font-bold text-green-600">FREE</p>
                <p class="text-sm text-gray-600 font-semibold">Always & Forever</p>
            </div>
        </div>
    </div>
</div>

<!-- Back to Parent Category (for child categories) -->
<?php if ($category['level'] == 1 && !empty($category['parent_name'])): ?>
    <div class="text-center mt-8">
        <a href="/category/<?= $category['parent_slug'] ?>" class="inline-block bg-gradient-to-r from-green-400 via-teal-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-green-500 hover:via-teal-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
            📁 Browse All <?= htmlspecialchars($category['parent_name']) ?> Categories! 🌟
        </a>
    </div>
<?php endif; ?>

<style>
    .bounce-soft:hover {
        animation: bounce-soft 0.6s ease-in-out;
    }

    @keyframes bounce-soft {

        0%,
        20%,
        50%,
        80%,
        100% {
            transform: translateY(0);
        }

        40% {
            transform: translateY(-5px);
        }

        60% {
            transform: translateY(-2px);
        }
    }

    /* Enhanced hover effects for subcategory cards */
    .group:hover .category-preview-img {
        transform: scale(1.1);
        filter: brightness(1.1) saturate(1.2);
    }

    /* Smooth loading effect for images */
    .category-preview-img {
        transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        background-color: #f3f4f6;
    }

    /* Loading placeholder animation */
    @keyframes shimmer {
        0% {
            background-position: -200px 0;
        }

        100% {
            background-position: calc(200px + 100%) 0;
        }
    }

    .loading-shimmer {
        background: linear-gradient(90deg, #f0f0f0 0px, #e0e0e0 40px, #f0f0f0 80px);
        background-size: 200px;
        animation: shimmer 1.5s infinite;
    }

    /* Gradient border animation for hover state */
    @keyframes gradient-border {
        0% {
            border-image-source: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #dda0dd);
        }

        25% {
            border-image-source: linear-gradient(45deg, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #dda0dd, #ff6b6b);
        }

        50% {
            border-image-source: linear-gradient(45deg, #45b7d1, #96ceb4, #ffeaa7, #dda0dd, #ff6b6b, #4ecdc4);
        }

        75% {
            border-image-source: linear-gradient(45deg, #96ceb4, #ffeaa7, #dda0dd, #ff6b6b, #4ecdc4, #45b7d1);
        }

        100% {
            border-image-source: linear-gradient(45deg, #ff6b6b, #4ecdc4, #45b7d1, #96ceb4, #ffeaa7, #dda0dd);
        }
    }

    /* Enhanced subcategory card hover effects */
    .subcategory-card {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .subcategory-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Image aspect ratio container */
    .aspect-ratio-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 75%;
        /* 4:3 aspect ratio */
        overflow: hidden;
        border-radius: 0.75rem;
    }

    .aspect-ratio-container img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Enhanced subcategory card hover effects */
    .subcategory-card {
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .subcategory-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Enhanced hover effects for subcategory cards */
    .group:hover .category-preview-img {
        transform: scale(1.1);
        filter: brightness(1.1) saturate(1.2);
    }

    /* Smooth loading effect for images */
    .category-preview-img {
        transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
        background-color: #f3f4f6;
    }
</style>

<?php
// Helper function for child category emojis
function getChildCategoryEmoji($categoryName)
{
    $name = strtolower($categoryName);
    if (strpos($name, 'animal') !== false) return '🐾';
    if (strpos($name, 'car') !== false || strpos($name, 'vehicle') !== false) return '🚗';
    if (strpos($name, 'flower') !== false || strpos($name, 'plant') !== false) return '🌸';
    if (strpos($name, 'princess') !== false) return '👸';
    if (strpos($name, 'superhero') !== false) return '🦸';
    if (strpos($name, 'food') !== false) return '🍎';
    if (strpos($name, 'space') !== false) return '🚀';
    if (strpos($name, 'ocean') !== false || strpos($name, 'sea') !== false) return '🌊';
    if (strpos($name, 'farm') !== false) return '🚜';
    if (strpos($name, 'wild') !== false) return '🦁';
    if (strpos($name, 'pet') !== false) return '🐕';
    if (strpos($name, 'birthday') !== false) return '🎂';
    if (strpos($name, 'christmas') !== false) return '🎄';
    if (strpos($name, 'halloween') !== false) return '🎃';
    if (strpos($name, 'easter') !== false) return '🐰';
    return '🎨'; // default emoji
}
?>