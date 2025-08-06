<!-- Fun Breadcrumb -->
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
            <?php if (!empty($image['parent_category_name']) && !empty($image['parent_category_slug'])): ?>
                <li>
                    <a href="/category/<?= $image['parent_category_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors flex items-center space-x-1 bounce-soft">
                        <span>📁</span>
                        <span><?= htmlspecialchars($image['parent_category_name']) ?></span>
                    </a>
                </li>
                <li class="text-gray-400 text-lg">→</li>
            <?php endif; ?>

            <!-- Current Category -->
            <li>
                <a href="/category/<?= $image['category_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors flex items-center space-x-1 bounce-soft">
                    <span>🎨</span>
                    <span><?= htmlspecialchars($image['category_name']) ?></span>
                </a>
            </li>
            <li class="text-gray-400 text-lg">→</li>

            <!-- Current Image -->
            <li class="text-gray-600 flex items-center space-x-1">
                <span>✨</span>
                <span><?= htmlspecialchars($image['title']) ?></span>
            </li>
        </ol>
    </div>
</nav>

<!-- Main Content -->
<div class="max-w-6xl mx-auto">
    <div class="grid lg:grid-cols-2 gap-8 items-start">

        <!-- Image Section -->
        <div class="relative">
            <div class="bg-white p-8 rounded-3xl shadow-2xl border-4 border-gradient-to-r from-pink-200 to-purple-200 relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute top-4 left-4 text-3xl opacity-10 animate-pulse">🎨</div>
                <div class="absolute top-4 right-4 text-2xl opacity-10 animate-bounce">⭐</div>
                <div class="absolute bottom-4 left-4 text-2xl opacity-10 animate-pulse">🌈</div>
                <div class="absolute bottom-4 right-4 text-3xl opacity-10 animate-bounce" style="animation-delay: 0.5s;">✨</div>

                <div class="relative z-10 text-center">
                    <!-- Image with fancy frame -->
                    <div class="relative inline-block mb-6">
                        <div class="absolute inset-0 bg-gradient-to-r from-pink-300 to-purple-300 rounded-2xl transform rotate-1"></div>
                        <div class="relative bg-white p-4 rounded-2xl shadow-lg">
                            <img src="/uploads/<?= $image['preview'] ?>"
                                class="mx-auto max-w-full h-auto rounded-xl"
                                alt="<?= htmlspecialchars($image['title']) ?>">
                        </div>
                        <!-- Corner decorations -->
                        <div class="absolute -top-2 -left-2 text-2xl animate-bounce">🌟</div>
                        <div class="absolute -top-2 -right-2 text-2xl animate-pulse">🎈</div>
                        <div class="absolute -bottom-2 -left-2 text-2xl animate-pulse">🎭</div>
                        <div class="absolute -bottom-2 -right-2 text-2xl animate-bounce">🦄</div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/download/<?= $image['id'] ?>"
                                target="_blank"
                                class="group bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span>📄 Download PDF</span>
                            </a>

                            <a href="/coloring/coloring.html?image=/uploads/<?= urlencode($image['preview']) ?>"
                                target="_blank"
                                class="group bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-bold py-4 px-8 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
                                </svg>
                                <span>🎨 Color Online</span>
                            </a>
                        </div>

                        <!-- Additional fun buttons -->
                        <div class="flex flex-wrap gap-2 justify-center">
                            <button class="bg-gradient-to-r from-pink-300 to-pink-400 hover:from-pink-400 hover:to-pink-500 text-white font-semibold py-2 px-4 rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 text-sm">
                                💖 Add to Favorites
                            </button>
                            <button class="bg-gradient-to-r from-purple-300 to-purple-400 hover:from-purple-400 hover:to-purple-500 text-white font-semibold py-2 px-4 rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 text-sm">
                                📤 Share with Friends
                            </button>
                            <button class="bg-gradient-to-r from-yellow-300 to-yellow-400 hover:from-yellow-400 hover:to-yellow-500 text-white font-semibold py-2 px-4 rounded-full transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105 text-sm">
                                🖨️ Print Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Section -->
        <div class="space-y-6">
            <!-- Title Card -->
            <div class="bg-gradient-to-br from-yellow-50 to-pink-50 rounded-2xl p-6 shadow-lg border-4 border-white">
                <h1 class="text-3xl md:text-4xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-4 text-center">
                    ✨ <?= htmlspecialchars($image['title']) ?> ✨
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-pink-400 to-purple-500 mx-auto rounded-full mb-4"></div>

                <!-- Category Path -->
                <div class="text-center text-gray-700 font-semibold text-lg">
                    <?php if (!empty($image['parent_category_name'])): ?>
                        <!-- Parent > Child structure -->
                        <div class="flex items-center justify-center space-x-2 mb-2">
                            <span>📂 Category Path:</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2 text-base">
                            <a href="/category/<?= $image['parent_category_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors font-bold hover:underline decoration-wavy">
                                📁 <?= htmlspecialchars($image['parent_category_name']) ?>
                            </a>
                            <span class="text-gray-400">→</span>
                            <a href="/category/<?= $image['category_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors font-bold hover:underline decoration-wavy">
                                🎨 <?= htmlspecialchars($image['category_name']) ?>
                            </a>
                        </div>
                    <?php else: ?>
                        <!-- Single category -->
                        <div>
                            Category:
                            <a href="/category/<?= $image['category_slug'] ?>" class="text-purple-600 hover:text-pink-500 transition-colors font-bold hover:underline decoration-wavy">
                                🎨 <?= htmlspecialchars($image['category_name']) ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Fun Facts Card -->
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 shadow-lg border-4 border-white">
                <h3 class="text-2xl font-kids text-purple-700 mb-4 text-center">🎯 Fun Facts!</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white rounded-xl p-4 text-center shadow-md">
                        <div class="text-3xl mb-2">🎨</div>
                        <p class="font-bold text-purple-600">Perfect For</p>
                        <p class="text-sm text-gray-600">Ages 3-99!</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow-md">
                        <div class="text-3xl mb-2">⏱️</div>
                        <p class="font-bold text-pink-600">Time Needed</p>
                        <p class="text-sm text-gray-600">15-30 min</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow-md">
                        <div class="text-3xl mb-2">📏</div>
                        <p class="font-bold text-blue-600">Size</p>
                        <p class="text-sm text-gray-600">A4 Ready</p>
                    </div>
                    <div class="bg-white rounded-xl p-4 text-center shadow-md">
                        <div class="text-3xl mb-2">⭐</div>
                        <p class="font-bold text-green-600">Quality</p>
                        <p class="text-sm text-gray-600">HD Print</p>
                    </div>
                </div>
            </div>

            <!-- Coloring Tips Card -->
            <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl p-6 shadow-lg border-4 border-white">
                <h3 class="text-2xl font-kids text-purple-700 mb-4 text-center">💡 Coloring Tips!</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3 bg-white rounded-xl p-3 shadow-sm">
                        <span class="text-2xl">🖍️</span>
                        <p class="text-gray-700 font-semibold">Use different colors to make it unique!</p>
                    </div>
                    <div class="flex items-center space-x-3 bg-white rounded-xl p-3 shadow-sm">
                        <span class="text-2xl">✨</span>
                        <p class="text-gray-700 font-semibold">Add glitter or stickers for extra fun!</p>
                    </div>
                    <div class="flex items-center space-x-3 bg-white rounded-xl p-3 shadow-sm">
                        <span class="text-2xl">🎨</span>
                        <p class="text-gray-700 font-semibold">Try mixing colors for new shades!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Related Images Section -->
<?php if (!empty($relatedImages)): ?>
    <div class="max-w-6xl mx-auto mt-16">
        <div class="text-center mb-8">
            <h2 class="text-3xl md:text-4xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-4">
                🌟 More Amazing Pages to Color! 🌟
            </h2>
            <div class="w-32 h-2 bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <?php foreach ($relatedImages as $rel): ?>
                <a href="/image/<?= $rel['slug'] ?>" class="group bg-white shadow-lg rounded-2xl p-4 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 border-4 border-transparent hover:border-pink-200">
                    <div class="relative overflow-hidden rounded-xl mb-3">
                        <img src="/uploads/<?= $rel['preview'] ?>"
                            class="mx-auto transition-transform duration-300 group-hover:scale-110 w-full h-auto"
                            alt="<?= htmlspecialchars($rel['title']) ?>">

                        <!-- Overlay and decorations -->
                        <div class="absolute inset-0 bg-gradient-to-t from-purple-200/0 to-pink-200/0 group-hover:from-purple-200/20 group-hover:to-pink-200/20 transition-all duration-300 rounded-xl"></div>
                        <div class="absolute top-2 right-2 text-xl opacity-0 group-hover:opacity-100 transition-all duration-300 animate-bounce">⭐</div>
                        <div class="absolute bottom-2 left-2 text-lg opacity-0 group-hover:opacity-100 transition-all duration-300 animate-pulse">✨</div>
                    </div>

                    <p class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors text-sm md:text-base mb-2">
                        🎨 <?= htmlspecialchars($rel['title']) ?>
                    </p>

                    <!-- Quick action button -->
                    <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <span class="inline-block bg-gradient-to-r from-pink-400 to-purple-400 text-white text-xs px-3 py-1 rounded-full font-bold shadow-lg">
                            Color This Too! 🚀
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- View More Button with dynamic text based on category hierarchy -->
        <div class="text-center mt-8">
            <?php if (!empty($image['parent_category_name'])): ?>
                <!-- Show parent category link when in child category -->
                <a href="/category/<?= $image['category_slug'] ?>" class="inline-block bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-pink-500 hover:via-purple-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 mr-4">
                    🎨 See All <?= htmlspecialchars($image['category_name']) ?> Pages! ✨
                </a>
                <a href="/category/<?= $image['parent_category_slug'] ?>" class="inline-block bg-gradient-to-r from-green-400 via-teal-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-green-500 hover:via-teal-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    📁 Browse All <?= htmlspecialchars($image['parent_category_name']) ?> Categories! 🌟
                </a>
            <?php else: ?>
                <!-- Show single category link -->
                <a href="/category/<?= $image['category_slug'] ?>" class="inline-block bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-pink-500 hover:via-purple-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    🎨 See All <?= htmlspecialchars($image['category_name']) ?> Pages! ✨
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<!-- Floating Action Buttons (Mobile) -->
<div class="fixed bottom-6 right-6 flex flex-col space-y-3 md:hidden z-50">
    <a href="/download/<?= $image['id'] ?>" target="_blank"
        class="bg-blue-500 hover:bg-blue-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
    </a>
    <a href="/coloring/coloring.html?image=/uploads/<?= urlencode($image['preview']) ?>" target="_blank"
        class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:scale-110">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z" />
        </svg>
    </a>
</div>

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
            transform: translateY(-3px);
        }

        60% {
            transform: translateY(-1px);
        }
    }

    /* Fun pulse animation for decorative elements */
    @keyframes fun-pulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.7;
        }

        50% {
            transform: scale(1.1);
            opacity: 1;
        }
    }

    .fun-pulse {
        animation: fun-pulse 2s ease-in-out infinite;
    }
</style>