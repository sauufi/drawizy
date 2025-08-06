<div class="max-w-md mx-auto">
    <!-- Change Password Card -->
    <div class="bg-white kids-shadow rounded-2xl p-8 transform hover:scale-105 transition-all duration-300">
        <!-- Header with Icon -->
        <div class="text-center mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-full p-4 w-20 h-20 mx-auto mb-4 kids-shadow">
                <i class="fas fa-key text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Change Password</h1>
            <p class="text-gray-600">Keep your account secure! 🔐</p>
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

        <!-- Success Messages -->
        <?php if (isset($success)): ?>
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-400 mr-2"></i>
                    <p class="text-green-700"><?= $success ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Change Password Form -->
        <form method="post" action="/admin/change-password" class="space-y-6">
            <!-- Current Password Field -->
            <div class="form-field">
                <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-lock text-red-500"></i>
                    <span>Current Password</span>
                </label>
                <input type="password"
                    name="current_password"
                    placeholder="Enter your current password"
                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-red-400 focus:ring-2 focus:ring-red-100 transition-all duration-300 hover:border-red-300"
                    required>
            </div>

            <!-- New Password Field -->
            <div class="form-field">
                <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-key text-blue-500"></i>
                    <span>New Password</span>
                </label>
                <input type="password"
                    name="new_password"
                    placeholder="Enter your new password"
                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-300 hover:border-blue-300"
                    required>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-field">
                <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-2">
                    <i class="fas fa-shield-alt text-green-500"></i>
                    <span>Confirm New Password</span>
                </label>
                <input type="password"
                    name="confirm_password"
                    placeholder="Confirm your new password"
                    class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all duration-300 hover:border-green-300"
                    required>
            </div>

            <!-- Password Requirements -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-400 mr-2 mt-1"></i>
                    <div>
                        <p class="text-blue-700 font-semibold mb-2">Password Requirements:</p>
                        <ul class="text-blue-600 text-sm space-y-1">
                            <li>• At least 8 characters long</li>
                            <li>• Use a mix of letters and numbers</li>
                            <li>• Avoid using personal information</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 kids-shadow hover:shadow-lg flex items-center justify-center space-x-2">
                <i class="fas fa-save"></i>
                <span>Update Password</span>
                <span>🔒</span>
            </button>
        </form>

        <!-- Security Tips -->
        <div class="mt-6 p-4 bg-gray-50 rounded-xl">
            <div class="flex items-start space-x-2">
                <i class="fas fa-lightbulb text-yellow-500 mt-1"></i>
                <div>
                    <p class="text-gray-700 font-semibold mb-1">Security Tip:</p>
                    <p class="text-gray-600 text-sm">Change your password regularly and never share it with others!</p>
                </div>
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

    /* Password strength indicator animation */
    .password-field:focus-within {
        animation: pulse-glow 2s infinite;
    }

    @keyframes pulse-glow {

        0%,
        100% {
            box-shadow: 0 0 5px rgba(59, 130, 246, 0.3);
        }

        50% {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
    }
</style>