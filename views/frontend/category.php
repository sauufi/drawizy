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
            <li class="text-gray-600 flex items-center space-x-1">
                <span>🎨</span>
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
            🎨 <?= htmlspecialchars($category['name']) ?> Coloring Pages! 🖍️
        </h1>
        <div class="w-32 h-2 bg-gradient-to-r from-pink-400 via-purple-400 to-blue-400 mx-auto rounded-full mb-4"></div>
        <p class="text-xl text-gray-700 font-semibold">
            ✨ Discover amazing coloring adventures in this category! ✨
        </p>
    </div>
</div>

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

                <!-- Color palette indicator -->
                <div class="absolute bottom-2 left-2 opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <div class="flex space-x-1">
                        <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="space-y-2">
                <p class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors text-sm md:text-base">
                    🎨 <?= htmlspecialchars($img['title']) ?>
                </p>

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
                <p class="text-sm text-gray-600 font-semibold">Pages Available</p>
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

    /* Custom gradient border animation */
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
</style>