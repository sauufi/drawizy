<?php $pages = \App\Models\Page::all(); ?>
<?php $setting = \App\Models\Setting::get(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= $meta_title ?? $setting['site_title'] ?></title>
    <meta name="description" content="<?= $meta_description ?? $setting['site_description'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/images/drawizy.png">

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Tailwind CSS -->
    <!-- <link href="/dist/output.min.css?v=2221212" rel="stylesheet"> -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Fredoka+One:wght@400&family=Nunito:wght@400;600;700&display=swap');

        .font-kids {
            font-family: 'Fredoka One', cursive;
        }

        .font-body {
            font-family: 'Nunito', sans-serif;
        }

        /* Fun animations */
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
                transform: translateY(-3px);
            }
        }

        .bounce-soft:hover {
            animation: bounce-soft 1s ease-in-out;
        }

        /* Gradient backgrounds */
        .gradient-rainbow {
            background: linear-gradient(135deg, #ff6b6b, #ffd93d, #6bcf7f, #4d96ff, #9c88ff, #ff8cc8);
            background-size: 300% 300%;
            animation: gradient-shift 6s ease infinite;
        }

        @keyframes gradient-shift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Custom shadows */
        .shadow-colorful {
            box-shadow: 0 10px 25px -5px rgba(255, 107, 107, 0.3), 0 4px 6px -2px rgba(255, 140, 204, 0.2);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 flex flex-col min-h-screen font-body">
    <!-- Header -->
    <nav class="bg-white shadow-lg border-b-4 border-yellow-300">
        <!-- Top bar: Logo & Search -->
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center p-4 space-y-4 md:space-y-0">
            <a href="/" class="flex items-center space-x-3 bounce-soft">
                <?php if ($setting['site_logo']): ?>
                    <img src="/uploads/<?= $setting['site_logo'] ?>" alt="Logo" class="h-12 w-12 rounded-full shadow-colorful">
                <?php endif; ?>
                <span class="text-2xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500">
                    <?= htmlspecialchars($setting['site_title']) ?>
                </span>
            </a>

            <!-- Search Form -->
            <form method="get" action="/" class="w-full md:w-1/2 flex relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" value="<?= htmlspecialchars($search ?? '') ?>"
                    placeholder="🎨 Search for fun coloring pages..."
                    class="border-2 border-pink-200 p-3 pl-10 flex-1 rounded-l-full focus:outline-none focus:ring-2 focus:ring-purple-400 focus:border-purple-400 text-gray-700 shadow-md">
                <button type="submit" class="bg-gradient-to-r from-pink-400 to-purple-500 text-white px-6 rounded-r-full hover:from-pink-500 hover:to-purple-600 transition-all duration-300 shadow-colorful font-semibold">
                    Search ✨
                </button>
            </form>

            <!-- Mobile Hamburger -->
            <button id="menu-btn" class="md:hidden bg-gradient-to-r from-yellow-400 to-orange-400 text-white px-4 py-2 rounded-full shadow-lg hover:from-yellow-500 hover:to-orange-500 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Bottom bar: Categories -->
        <div class="border-t-2 border-yellow-200 bg-gradient-to-r from-yellow-100 to-pink-100">
            <!-- Desktop Categories -->
            <div class="container mx-auto hidden md:flex space-x-2 p-3 overflow-x-auto">
                <a href="/" class="px-4 py-2 bg-white rounded-full text-purple-600 hover:bg-purple-100 font-semibold transition-all duration-300 shadow-md hover:shadow-lg bounce-soft whitespace-nowrap">
                    🏠 Home
                </a>
                <?php foreach (\App\Models\Category::findByLimit() as $c): ?>
                    <a href="/category/<?= $c['slug'] ?>" class="px-4 py-2 bg-white rounded-full text-purple-600 hover:bg-purple-100 font-semibold transition-all duration-300 shadow-md hover:shadow-lg bounce-soft whitespace-nowrap">
                        🎨 <?= $c['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden flex-col space-y-2 p-4 md:hidden bg-white mx-4 rounded-lg shadow-lg mb-4">
                <a href="/" class="block px-4 py-3 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors font-semibold">
                    🏠 Home
                </a>
                <?php foreach (\App\Models\Category::findByLimit() as $c): ?>
                    <a href="/category/<?= $c['slug'] ?>" class="block px-4 py-3 text-purple-600 hover:bg-purple-50 rounded-lg transition-colors font-semibold">
                        🎨 <?= $c['name'] ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </nav>

    <!-- Fun Decorative Elements -->
    <div class="absolute top-20 left-10 text-4xl animate-pulse hidden lg:block">🌟</div>
    <div class="absolute top-32 right-16 text-3xl animate-bounce hidden lg:block">🎈</div>
    <div class="absolute top-48 left-20 text-2xl animate-spin hidden lg:block">🌈</div>

    <!-- Content -->
    <main class="container max-w-screen-xl mx-auto p-4 flex-grow relative z-10">
        <div class="bg-white rounded-3xl shadow-2xl p-6 border-4 border-gradient-to-r from-pink-200 to-purple-200 min-h-96">
            <?= $content ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="gradient-rainbow text-white mt-12 relative overflow-hidden">
        <!-- Decorative shapes -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-4 left-10 w-16 h-16 bg-white rounded-full"></div>
            <div class="absolute top-8 right-20 w-12 h-12 bg-yellow-300 rounded-full"></div>
            <div class="absolute bottom-6 left-1/4 w-20 h-20 bg-pink-300 rounded-full"></div>
            <div class="absolute bottom-10 right-1/3 w-14 h-14 bg-blue-300 rounded-full"></div>
        </div>

        <div class="container mx-auto px-6 py-12 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
            <div class="text-center md:text-left">
                <h3 class="text-2xl font-kids mb-4 text-yellow-100">
                    🌟 <?= htmlspecialchars($setting['site_title']) ?>
                </h3>
                <p class="text-white/90 text-lg leading-relaxed font-semibold">
                    <?= htmlspecialchars($setting['site_description']) ?>
                </p>
                <div class="flex justify-center md:justify-start space-x-2 mt-4">
                    <span class="text-2xl">🎨</span>
                    <span class="text-2xl">✏️</span>
                    <span class="text-2xl">🖍️</span>
                    <span class="text-2xl">🎭</span>
                </div>
            </div>

            <div class="text-center">
                <h4 class="text-xl font-kids mb-4 text-yellow-100">📚 Fun Pages</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="/about-us" class="text-white/90 hover:text-yellow-200 transition-colors text-lg font-semibold hover:underline decoration-wavy">
                            ✨ About Us
                        </a>
                    </li>
                    <li>
                        <a href="/contact" class="text-white/90 hover:text-yellow-200 transition-colors text-lg font-semibold hover:underline decoration-wavy">
                            ✨ Contact
                        </a>
                    </li>
                    <li>
                        <a href="/copyrights" class="text-white/90 hover:text-yellow-200 transition-colors text-lg font-semibold hover:underline decoration-wavy">
                            ✨ Copyrights
                        </a>
                    </li>
                </ul>
            </div>

            <div class="text-center md:text-right">
                <h4 class="text-xl font-kids mb-4 text-yellow-100">💌 Contact Us</h4>
                <div class="space-y-2">
                    <p class="text-white/90 text-lg font-semibold">📧 info@drawizy.com</p>
                    <p class="text-white/90 text-lg font-semibold">
                        © <?= date('Y') ?> <?= htmlspecialchars($setting['site_title']) ?>
                    </p>
                    <p class="text-yellow-200 text-sm mt-4 font-semibold">
                        Made with 💖 for Creative Kids!
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menu-btn').addEventListener('click', () => {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');

            // Add slide animation
            if (!mobileMenu.classList.contains('hidden')) {
                mobileMenu.style.transform = 'translateY(-10px)';
                mobileMenu.style.opacity = '0';
                setTimeout(() => {
                    mobileMenu.style.transform = 'translateY(0)';
                    mobileMenu.style.opacity = '1';
                    mobileMenu.style.transition = 'all 0.3s ease';
                }, 10);
            }
        });

        // Add some interactive fun elements
        document.addEventListener('DOMContentLoaded', function() {
            // Randomly animate decorative elements
            const decorativeElements = document.querySelectorAll('.animate-pulse, .animate-bounce, .animate-spin');
            decorativeElements.forEach(el => {
                setInterval(() => {
                    el.style.transform = `scale(${0.8 + Math.random() * 0.4})`;
                }, 2000 + Math.random() * 3000);
            });
        });
    </script>
</body>

</html>