<!-- Hero Section -->
<div class="text-center mb-8 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-pink-100 via-purple-100 to-blue-100 rounded-3xl opacity-50"></div>
    <div class="relative z-10 py-8">
        <h1 class="text-4xl md:text-5xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 mb-4 bounce-soft">
            🌈 Free Coloring Pages for Creative Kids! 🎨
        </h1>
        <p class="text-xl text-gray-700 font-semibold mb-6">
            ✨ Thousands of fun coloring pages • PDF & Online • Perfect for Kids & Adults! ✨
        </p>
        <div class="flex justify-center space-x-4 text-3xl">
            <span class="animate-bounce">🖍️</span>
            <span class="animate-pulse">🎭</span>
            <span class="animate-bounce" style="animation-delay: 0.2s;">🦄</span>
            <span class="animate-pulse" style="animation-delay: 0.3s;">🌟</span>
            <span class="animate-bounce" style="animation-delay: 0.4s;">🎈</span>
        </div>
    </div>
</div>

<!-- Featured Categories Banner -->
<div class="bg-gradient-to-r from-yellow-200 via-pink-200 to-purple-200 rounded-2xl p-6 mb-8 shadow-lg border-4 border-white">
    <h2 class="text-2xl font-kids text-center text-purple-700 mb-4">🎯 Popular Categories</h2>
    <div class="flex flex-wrap justify-center gap-3">
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🦁 Animals</span>
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🏰 Disney</span>
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🎃 Holidays</span>
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🚗 Cartoons</span>
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🎬 Movies</span>
        <span class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer">🎮 Games</span>
    </div>
</div>

<!-- Coloring Pages Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <?php foreach ($images as $img): ?>
        <a href="/image/<?= $img['slug'] ?>" class="group bg-white shadow-lg rounded-2xl p-4 text-center hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-4 border-transparent hover:border-pink-200">
            <div class="relative overflow-hidden rounded-xl mb-3">
                <img src="/uploads/<?= $img['preview'] ?>" class="mx-auto transition-transform duration-300 group-hover:scale-110" alt="<?= htmlspecialchars($img['title']) ?>">
                <div class="absolute inset-0 bg-gradient-to-t from-purple-200/0 to-pink-200/0 group-hover:from-purple-200/20 group-hover:to-pink-200/20 transition-all duration-300"></div>
                <!-- Fun stickers on hover -->
                <div class="absolute top-2 right-2 text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 animate-bounce">⭐</div>
            </div>
            <p class="font-bold text-gray-700 group-hover:text-purple-600 transition-colors text-sm md:text-base">
                🎨 <?= htmlspecialchars($img['title']) ?>
            </p>
            <div class="mt-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <span class="inline-block bg-gradient-to-r from-pink-400 to-purple-400 text-white text-xs px-3 py-1 rounded-full font-semibold">
                    Color Me! ✨
                </span>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<!-- Fun Pagination -->
<?php if ($totalPages > 1): ?>
    <div class="flex justify-center mt-8 mb-8">
        <div class="bg-white rounded-full shadow-lg p-2 border-4 border-yellow-200">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>&q=<?= urlencode($search) ?>"
                    class="inline-block px-4 py-2 mx-1 rounded-full font-semibold transition-all duration-300 <?= $i == $currentPage ? 'bg-gradient-to-r from-pink-400 to-purple-500 text-white shadow-lg' : 'text-purple-600 hover:bg-purple-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>
        </div>
    </div>
<?php endif; ?>

<!-- About Section with Fun Design -->
<section class="mt-12 bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50 rounded-3xl p-8 shadow-xl border-4 border-white relative overflow-hidden">
    <!-- Decorative elements -->
    <div class="absolute top-4 left-4 text-4xl opacity-20">🎨</div>
    <div class="absolute top-8 right-8 text-3xl opacity-20">🌈</div>
    <div class="absolute bottom-4 left-8 text-2xl opacity-20">✨</div>
    <div class="absolute bottom-8 right-4 text-3xl opacity-20">🎭</div>

    <div class="relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-4">
                🌟 Welcome to Our Magical Coloring World! 🌟
            </h1>
            <div class="w-24 h-1 bg-gradient-to-r from-pink-400 to-purple-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 items-center mb-8">
            <div>
                <h2 class="text-2xl font-kids text-purple-700 mb-4">🎯 What Makes Us Special?</h2>
                <p class="text-gray-700 leading-relaxed font-semibold">
                    At <span class="text-purple-600 font-bold">Drawizy.com</span>, we create a magical world where creativity comes alive!
                    With thousands of free coloring pages featuring <span class="text-pink-600 font-bold">Animals 🦁, Disney Characters 🏰, Holidays 🎃, Cartoons 🚗, Movies 🎬, and Games 🎮</span>,
                    every child can find their perfect coloring adventure!
                </p>
            </div>
            <div class="text-center">
                <div class="bg-white rounded-2xl p-6 shadow-lg inline-block border-4 border-yellow-200">
                    <div class="text-6xl mb-2">🎨</div>
                    <p class="font-kids text-purple-600 text-xl">Thousands of Pages!</p>
                    <p class="text-gray-600 font-semibold">Updated Daily</p>
                </div>
            </div>
        </div>

        <!-- Benefits Grid -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-4 border-pink-200 hover:border-pink-400 transition-all">
                <div class="text-4xl mb-3">🧠</div>
                <h3 class="font-kids text-xl text-purple-700 mb-2">Smart Learning</h3>
                <p class="text-gray-600 font-semibold">Boost creativity, focus, and fine motor skills while having tons of fun!</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-4 border-blue-200 hover:border-blue-400 transition-all">
                <div class="text-4xl mb-3">👨‍👩‍👧‍👦</div>
                <h3 class="font-kids text-xl text-purple-700 mb-2">Family Fun</h3>
                <p class="text-gray-600 font-semibold">Perfect for family bonding time and classroom activities!</p>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-lg text-center border-4 border-green-200 hover:border-green-400 transition-all">
                <div class="text-4xl mb-3">🎯</div>
                <h3 class="font-kids text-xl text-purple-700 mb-2">All Ages</h3>
                <p class="text-gray-600 font-semibold">From toddlers to adults - everyone finds their perfect page!</p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-white rounded-2xl p-6 shadow-lg mb-8 border-4 border-yellow-200">
            <h3 class="text-2xl font-kids text-center text-purple-700 mb-6">🚀 Amazing Features Just for You!</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div class="flex items-center space-x-3 p-3 bg-pink-50 rounded-xl">
                    <span class="text-2xl">🔍</span>
                    <div>
                        <p class="font-bold text-purple-600">Quick Search</p>
                        <p class="text-sm text-gray-600">Find your favorite characters instantly!</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-xl">
                    <span class="text-2xl">📱</span>
                    <div>
                        <p class="font-bold text-purple-600">Online Coloring</p>
                        <p class="text-sm text-gray-600">Color directly on your device!</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl">
                    <span class="text-2xl">🖨️</span>
                    <div>
                        <p class="font-bold text-purple-600">Easy Printing</p>
                        <p class="text-sm text-gray-600">PDF, PNG & JPG formats available!</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 p-3 bg-purple-50 rounded-xl">
                    <span class="text-2xl">🎥</span>
                    <div>
                        <p class="font-bold text-purple-600">Drawing Tutorials</p>
                        <p class="text-sm text-gray-600">Learn to draw step-by-step!</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Community Section -->
        <div class="text-center bg-gradient-to-r from-pink-100 to-purple-100 rounded-2xl p-6 border-4 border-white">
            <h3 class="text-2xl font-kids text-purple-700 mb-4">🌟 Join Our Creative Family!</h3>
            <p class="text-gray-700 font-semibold mb-4">
                Share your colorful creations and connect with other creative kids and families around the world!
            </p>
            <div class="flex justify-center space-x-4 text-2xl">
                <span class="bounce-soft cursor-pointer">📘</span>
                <span class="bounce-soft cursor-pointer">📷</span>
                <span class="bounce-soft cursor-pointer">📌</span>
                <span class="bounce-soft cursor-pointer">🐦</span>
            </div>
        </div>

        <!-- Mission Statement -->
        <div class="mt-8 text-center">
            <div class="bg-gradient-to-r from-yellow-200 to-pink-200 rounded-2xl p-6 border-4 border-white">
                <h2 class="text-2xl font-kids text-purple-700 mb-4">💖 Our Promise to You</h2>
                <p class="text-gray-700 font-semibold text-lg leading-relaxed">
                    We believe every child is an artist! Our mission is to provide free, high-quality coloring pages that inspire creativity,
                    support learning, and bring families together through the joy of art. Let's color the world more beautiful, one page at a time! 🌈✨
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    .bounce-soft:hover {
        animation: bounce-soft 1s ease-in-out;
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
            transform: translateY(-8px);
        }

        60% {
            transform: translateY(-4px);
        }
    }
</style>