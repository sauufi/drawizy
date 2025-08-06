<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-50 via-pink-50 to-blue-50 relative overflow-hidden">
    <!-- Floating decorative elements -->
    <div class="absolute top-20 right-10 animate-bounce opacity-20 pointer-events-none">
        <i class="fas fa-star text-yellow-400 text-3xl"></i>
    </div>
    <div class="absolute bottom-20 left-10 animate-pulse opacity-20 pointer-events-none">
        <i class="fas fa-heart text-pink-400 text-2xl"></i>
    </div>
    <div class="absolute top-1/2 right-20 animate-bounce opacity-20 pointer-events-none" style="animation-delay: 1s;">
        <i class="fas fa-rainbow text-purple-400 text-2xl"></i>
    </div>

    <div class="max-w-md w-full mx-auto px-4">
        <!-- Login Card -->
        <div class="bg-white kids-shadow rounded-2xl p-8 transform hover:scale-105 transition-all duration-300">
            <!-- Header with Logo/Icon -->
            <div class="text-center mb-6">
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-full p-4 w-20 h-20 mx-auto mb-4 kids-shadow">
                    <i class="fas fa-palette text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Admin Login</h1>
                <p class="text-gray-600">Welcome back! Let's create something colorful! 🎨</p>
            </div>

            <!-- Error Messages -->
            <?php if (isset($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded-r-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-triangle text-red-400 mr-2"></i>
                        <p class="text-red-700"><?= $error ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form method="post" action="/login" class="space-y-6">
                <!-- Username Field -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user text-purple-500"></i>
                        <span>Username</span>
                    </label>
                    <input type="text"
                        name="username"
                        placeholder="Enter your username"
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all duration-300 hover:border-purple-300"
                        required>
                </div>

                <!-- Password Field -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                        <i class="fas fa-lock text-pink-500"></i>
                        <span>Password</span>
                    </label>
                    <input type="password"
                        name="password"
                        placeholder="Enter your password"
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-pink-400 focus:ring-2 focus:ring-pink-100 transition-all duration-300 hover:border-pink-300"
                        required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 kids-shadow hover:shadow-lg flex items-center justify-center space-x-2">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login to Dashboard</span>
                    <span>✨</span>
                </button>
            </form>

            <!-- Footer -->
            <div class="text-center mt-6 text-gray-500 text-sm">
                <p>Kids Coloring CMS Admin Panel</p>
            </div>
        </div>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .form-field:focus-within {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    /* Hover animations for input fields */
    .form-field input:focus {
        transform: scale(1.02);
    }

    /* Button ripple effect */
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    button:active::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: white;
        transform: scale(0);
        animation: ripple 0.6s linear;
        left: 50%;
        top: 50%;
    }
</style>