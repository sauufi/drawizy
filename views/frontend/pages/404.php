<!-- 404 Page Container -->
<div class="min-h-screen flex items-center justify-center px-4 py-8">
    <div class="max-w-4xl mx-auto text-center relative">

        <!-- Floating Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-10 left-10 text-6xl opacity-20 animate-bounce" style="animation-delay: 0s;">🎨</div>
            <div class="absolute top-20 right-16 text-4xl opacity-30 animate-pulse" style="animation-delay: 0.5s;">⭐</div>
            <div class="absolute top-32 left-32 text-3xl opacity-25 animate-bounce" style="animation-delay: 1s;">🌈</div>
            <div class="absolute top-40 right-8 text-5xl opacity-20 animate-pulse" style="animation-delay: 1.5s;">🎈</div>
            <div class="absolute bottom-32 left-8 text-4xl opacity-30 animate-bounce" style="animation-delay: 2s;">✨</div>
            <div class="absolute bottom-20 right-32 text-3xl opacity-25 animate-pulse" style="animation-delay: 2.5s;">🦄</div>
            <div class="absolute bottom-40 left-24 text-5xl opacity-20 animate-bounce" style="animation-delay: 3s;">🌟</div>
        </div>

        <!-- Main 404 Content -->
        <div class="relative z-10">

            <!-- 404 Number Display -->
            <div class="mb-8">
                <div class="flex justify-center items-center space-x-4 mb-4">
                    <div class="relative">
                        <div class="text-9xl md:text-[12rem] font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-400 via-purple-500 to-blue-500 leading-none">
                            4
                        </div>
                        <div class="absolute top-2 right-2 text-4xl animate-spin" style="animation-duration: 3s;">🎨</div>
                    </div>
                    <div class="relative">
                        <div class="text-9xl md:text-[12rem] font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-400 to-blue-600 leading-none">
                            0
                        </div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-4xl animate-bounce">😢</div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="text-9xl md:text-[12rem] font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-600 via-purple-500 to-blue-400 leading-none">
                            4
                        </div>
                        <div class="absolute top-2 left-2 text-4xl animate-pulse">💔</div>
                    </div>
                </div>
            </div>

            <!-- Error Message -->
            <div class="bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 rounded-3xl p-8 shadow-2xl border-4 border-white mb-8 relative overflow-hidden">
                <!-- Background pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-4 left-4 text-6xl">🎭</div>
                    <div class="absolute top-4 right-4 text-5xl">🖍️</div>
                    <div class="absolute bottom-4 left-4 text-4xl">📝</div>
                    <div class="absolute bottom-4 right-4 text-6xl">🎪</div>
                </div>

                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 to-purple-600 mb-6">
                        🎨 Oops! This Page Got Lost in Our Art Box! 🎨
                    </h1>
                    <div class="w-32 h-2 bg-gradient-to-r from-pink-400 to-purple-500 mx-auto rounded-full mb-6"></div>
                    <p class="text-xl md:text-2xl text-gray-700 font-semibold leading-relaxed mb-6">
                        Don't worry, little artist! Sometimes pages go on adventures just like crayons that roll under the couch! 🖍️
                    </p>
                    <p class="text-lg text-gray-600 font-semibold max-w-2xl mx-auto">
                        Let's find you something even more amazing to color! Our magical art world is full of surprises! ✨
                    </p>
                </div>
            </div>

            <!-- Fun Suggestions -->
            <div class="grid md:grid-cols-3 gap-6 mb-8">
                <!-- Suggestion 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-pink-200 hover:border-pink-400 transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-5xl mb-4 animate-bounce">🏠</div>
                    <h3 class="text-xl font-kids text-purple-700 mb-3">Go Back Home</h3>
                    <p class="text-gray-600 font-semibold mb-4 text-sm">
                        Return to our colorful homepage where thousands of amazing pages are waiting for you!
                    </p>
                    <a href="/" class="inline-block bg-gradient-to-r from-pink-400 to-pink-600 text-white font-bold py-2 px-4 rounded-full hover:from-pink-500 hover:to-pink-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                        Take Me Home! 🌈
                    </a>
                </div>

                <!-- Suggestion 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-blue-200 hover:border-blue-400 transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-5xl mb-4 animate-pulse">🔍</div>
                    <h3 class="text-xl font-kids text-purple-700 mb-3">Search for Fun</h3>
                    <p class="text-gray-600 font-semibold mb-4 text-sm">
                        Use our super-powered search to find your favorite characters and themes!
                    </p>
                    <div class="relative">
                        <input type="text" placeholder="🎨 Search coloring pages..."
                            class="w-full border-2 border-blue-200 rounded-full py-2 px-4 text-sm focus:outline-none focus:border-blue-400"
                            onkeypress="if(event.key==='Enter') window.location.href='/?q='+this.value">
                        <button onclick="window.location.href='/?q='+this.previousElementSibling.value"
                            class="absolute right-1 top-1 bg-blue-500 text-white rounded-full px-3 py-1 text-xs hover:bg-blue-600 transition-colors">
                            Go! 🚀
                        </button>
                    </div>
                </div>

                <!-- Suggestion 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-4 border-green-200 hover:border-green-400 transition-all transform hover:-translate-y-2 hover:shadow-xl">
                    <div class="text-5xl mb-4 animate-spin" style="animation-duration: 3s;">🎲</div>
                    <h3 class="text-xl font-kids text-purple-700 mb-3">Random Adventure</h3>
                    <p class="text-gray-600 font-semibold mb-4 text-sm">
                        Feeling adventurous? Let us surprise you with a random coloring page!
                    </p>
                    <button onclick="goToRandomPage()" class="inline-block bg-gradient-to-r from-green-400 to-green-600 text-white font-bold py-2 px-4 rounded-full hover:from-green-500 hover:to-green-700 transition-all shadow-md hover:shadow-lg transform hover:scale-105">
                        Surprise Me! ✨
                    </button>
                </div>
            </div>

            <!-- Popular Categories -->
            <div class="bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 rounded-2xl p-8 shadow-lg border-4 border-white mb-8">
                <h2 class="text-3xl font-kids text-purple-700 mb-6 text-center">
                    🌟 Popular Adventures Await! 🌟
                </h2>
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="/category/animals" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🦁 Animals
                    </a>
                    <a href="/category/disney" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🏰 Disney
                    </a>
                    <a href="/category/cartoons" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🚗 Cartoons
                    </a>
                    <a href="/category/nature" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🌳 Nature
                    </a>
                    <a href="/category/holidays" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🎃 Holidays
                    </a>
                    <a href="/category/fantasy" class="bg-white px-4 py-2 rounded-full shadow-md text-purple-600 font-semibold hover:shadow-lg transition-all bounce-soft cursor-pointer border-2 border-transparent hover:border-pink-300">
                        🦄 Fantasy
                    </a>
                </div>
            </div>

            <!-- Encouraging Message -->
            <div class="bg-white rounded-2xl p-8 shadow-lg border-4 border-gradient-to-r from-pink-200 to-purple-200 text-center">
                <div class="text-6xl mb-4">🤗</div>
                <h3 class="text-2xl font-kids text-purple-700 mb-4">
                    Remember, Every Great Artist Makes Happy Mistakes!
                </h3>
                <p class="text-lg text-gray-600 font-semibold max-w-2xl mx-auto leading-relaxed">
                    Just like when we color outside the lines, sometimes we click outside the pages!
                    That's okay - it's all part of the creative adventure! 🎨
                </p>
                <div class="flex justify-center space-x-2 mt-6 text-3xl">
                    <span class="animate-bounce">💖</span>
                    <span class="animate-pulse">🌈</span>
                    <span class="animate-bounce" style="animation-delay: 0.2s;">✨</span>
                    <span class="animate-pulse" style="animation-delay: 0.3s;">🎨</span>
                    <span class="animate-bounce" style="animation-delay: 0.4s;">🦄</span>
                </div>
            </div>

            <!-- Back Button -->
            <div class="mt-8">
                <button onclick="history.back()" class="bg-gradient-to-r from-purple-400 via-pink-500 to-blue-500 text-white font-bold py-4 px-8 rounded-full hover:from-purple-500 hover:via-pink-600 hover:to-blue-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 text-lg">
                    ← Go Back to Previous Page 🔙
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Fun floating elements -->
<div class="fixed bottom-6 right-6 pointer-events-none z-50">
    <div class="text-4xl animate-bounce opacity-70" style="animation-delay: 0s;">🎈</div>
</div>
<div class="fixed bottom-16 right-16 pointer-events-none z-50">
    <div class="text-3xl animate-pulse opacity-60" style="animation-delay: 1s;">⭐</div>
</div>
<div class="fixed bottom-32 right-8 pointer-events-none z-50">
    <div class="text-2xl animate-bounce opacity-50" style="animation-delay: 2s;">✨</div>
</div>

<script>
    function goToRandomPage() {
        // Simulate random page redirect
        const categories = ['animals', 'disney', 'cartoons', 'nature', 'holidays', 'fantasy'];
        const randomCategory = categories[Math.floor(Math.random() * categories.length)];

        // Add fun loading effect
        const button = event.target;
        const originalText = button.innerHTML;
        button.innerHTML = '🎲 Loading Magic...';
        button.disabled = true;

        setTimeout(() => {
            window.location.href = '/category/' + randomCategory;
        }, 1500);
    }

    // Add some interactive fun
    document.addEventListener('DOMContentLoaded', function() {
        // Make floating elements interactive
        const floatingElements = document.querySelectorAll('.animate-bounce, .animate-pulse');

        floatingElements.forEach(element => {
            element.addEventListener('click', function() {
                this.style.transform = 'scale(1.5) rotate(360deg)';
                this.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    this.style.transform = '';
                }, 500);
            });
        });

        // Add sparkle effect on hover for main elements
        const cards = document.querySelectorAll('.hover\\:-translate-y-2');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                // Create sparkle effect
                for (let i = 0; i < 5; i++) {
                    setTimeout(() => {
                        const sparkle = document.createElement('div');
                        sparkle.innerHTML = '✨';
                        sparkle.className = 'absolute text-xl pointer-events-none animate-ping';
                        sparkle.style.left = Math.random() * 100 + '%';
                        sparkle.style.top = Math.random() * 100 + '%';

                        this.appendChild(sparkle);

                        setTimeout(() => {
                            sparkle.remove();
                        }, 1000);
                    }, i * 100);
                }
            });
        });
    });
</script>

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

    /* Gradient animation for the 404 numbers */
    @keyframes gradient-shift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    .gradient-text-animated {
        background-size: 200% 200%;
        animation: gradient-shift 3s ease infinite;
    }

    /* Floating animation for background elements */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px) rotate(0deg);
        }

        33% {
            transform: translateY(-10px) rotate(2deg);
        }

        66% {
            transform: translateY(5px) rotate(-1deg);
        }
    }

    .float-animation {
        animation: float 4s ease-in-out infinite;
    }

    /* Interactive sparkle effect */
    @keyframes sparkle {
        0% {
            transform: scale(0) rotate(0deg);
            opacity: 1;
        }

        50% {
            transform: scale(1) rotate(180deg);
            opacity: 0.8;
        }

        100% {
            transform: scale(0) rotate(360deg);
            opacity: 0;
        }
    }

    .sparkle-effect {
        animation: sparkle 1s ease-out forwards;
    }
</style>