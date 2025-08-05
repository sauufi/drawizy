<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-plus text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Create New Category</h1>
    <p class="text-gray-600">Add a fun coloring category for kids! 🎨</p>
</div>

<!-- Main Form Container -->
<div class="max-w-3xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-purple-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-palette text-purple-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Category Form</h2>
                    <p class="text-purple-100">Complete the category information below</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form action="/admin/categories/store" method="post" class="space-y-6" id="categoryForm">

                <!-- Category Name Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-tag text-purple-500"></i>
                        <span>Category Name</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            name="name"
                            id="categoryName"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-lg"
                            placeholder="Example: Cute Animals, Beautiful Flowers, Cool Cars..."
                            required>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-edit text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-lightbulb text-yellow-400 mr-1"></i>
                        Use a fun and easy-to-understand name for kids
                    </p>
                </div>

                <!-- Slug Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-link text-blue-500"></i>
                        <span>URL Slug</span>
                    </label>
                    <div class="relative">
                        <input type="text"
                            name="slug"
                            id="categorySlug"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-blue-400 focus:ring-4 focus:ring-blue-100 transition-all duration-300 font-mono text-gray-600"
                            placeholder="will-be-created-automatically">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-hashtag text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-info-circle text-blue-400 mr-1"></i>
                        Will be generated automatically from category name (can be edited manually)
                    </p>
                </div>

                <!-- Description Field -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-align-left text-green-500"></i>
                        <span>Description</span>
                    </label>
                    <div class="relative">
                        <textarea name="description"
                            id="categoryDescription"
                            rows="4"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-green-400 focus:ring-4 focus:ring-green-100 transition-all duration-300 resize-none"
                            placeholder="Tell us about this category... For example: 'A collection of cute animal pictures that kids love to color'"></textarea>
                        <div class="absolute left-4 top-4">
                            <i class="fas fa-comment-dots text-gray-400 group-focus-within:text-green-500 transition-colors"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-heart text-pink-400 mr-1"></i>
                        An attractive description will help parents choose a category for their child.
                    </p>
                </div>

                <!-- Preview Section -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border-2 border-dashed border-purple-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-eye text-purple-500"></i>
                        <h3 class="font-semibold text-gray-700">Category Preview</h3>
                    </div>
                    <div class="bg-white rounded-xl p-4 kids-shadow">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 bg-purple-400 rounded-full"></div>
                            <div>
                                <div class="font-medium text-gray-800" id="previewName">
                                    <span class="mr-2">🎨</span>
                                    <span>Category name will appear here</span>
                                </div>
                                <div class="text-sm text-gray-500" id="previewSlug">slug-will-appear-here</div>
                            </div>
                        </div>
                        <div class="mt-3 text-sm text-gray-600" id="previewDescription">
                            Category description will be displayed here...
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/admin/categories"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back</span>
                    </a>

                    <div class="flex space-x-3">
                        <button type="reset"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-2xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-save"></i>
                            <span>Save Category</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tips Section -->
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">Tips for Creating an Interesting Category</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-start space-x-2">
                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    <span class="text-gray-600">Use a name easily understood by kids</span>
                </div>
                <div class="flex items-start space-x-2">
                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    <span class="text-gray-600">Add an appealing description</span>
                </div>
                <div class="flex items-start space-x-2">
                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    <span class="text-gray-600">Choose themes popular among kids</span>
                </div>
                <div class="flex items-start space-x-2">
                    <i class="fas fa-check-circle text-green-500 mt-1"></i>
                    <span class="text-gray-600">Avoid overly long names</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Interactivity -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('categoryName');
        const slugInput = document.getElementById('categorySlug');
        const descriptionInput = document.getElementById('categoryDescription');
        const previewName = document.getElementById('previewName');
        const previewSlug = document.getElementById('previewSlug');
        const previewDescription = document.getElementById('previewDescription');

        // Function to create slug from name
        function createSlug(text) {
            return text
                .toLowerCase()
                .replace(/[^a-z0-9 -]/g, '') // Remove special characters
                .replace(/\s+/g, '-') // Replace spaces with -
                .replace(/-+/g, '-') // Replace multiple - with single -
                .trim();
        }

        // Function to get emoji based on category name
        function getCategoryEmoji(name) {
            const lowerName = name.toLowerCase();
            if (lowerName.includes('animal') || lowerName.includes('hewan')) return '🐾';
            if (lowerName.includes('flower') || lowerName.includes('bunga')) return '🌸';
            if (lowerName.includes('car') || lowerName.includes('mobil')) return '🚗';
            if (lowerName.includes('princess') || lowerName.includes('putri')) return '👸';
            if (lowerName.includes('nature') || lowerName.includes('alam')) return '🌿';
            if (lowerName.includes('food') || lowerName.includes('makanan')) return '🍎';
            if (lowerName.includes('space') || lowerName.includes('luar angkasa')) return '🚀';
            if (lowerName.includes('sea') || lowerName.includes('laut')) return '🌊';
            return '🎨';
        }

        // Update preview when name changes
        nameInput.addEventListener('input', function() {
            const name = this.value.trim();
            if (name) {
                const emoji = getCategoryEmoji(name);
                previewName.innerHTML = `<span class="mr-2">${emoji}</span><span>${name}</span>`;

                // Auto-generate slug if slug field is empty or was auto-generated
                if (!slugInput.value || slugInput.dataset.autoGenerated === 'true') {
                    const slug = createSlug(name);
                    slugInput.value = slug;
                    slugInput.dataset.autoGenerated = 'true';
                    previewSlug.textContent = slug || 'slug-will-appear-here';
                }
            } else {
                previewName.innerHTML = '<span class="mr-2">🎨</span><span>Category name will appear here</span>';
            }
        });

        // Update preview when slug changes
        slugInput.addEventListener('input', function() {
            const slug = this.value.trim();
            previewSlug.textContent = slug || 'slug-will-appear-here';

            // Mark as manually edited if user types
            if (slug) {
                slugInput.dataset.autoGenerated = 'false';
            }
        });

        // Update preview when description changes
        descriptionInput.addEventListener('input', function() {
            const description = this.value.trim();
            previewDescription.textContent = description || 'Description kategori akan ditampilkan di sini...';
        });

        // Form validation and enhancement
        const form = document.getElementById('categoryForm');
        form.addEventListener('submit', function(e) {
            const name = nameInput.value.trim();
            if (!name) {
                e.preventDefault();
                nameInput.focus();
                nameInput.classList.add('border-red-400');

                // Show error message
                showMessage('Category name is required! 🎨', 'error');
                return;
            }

            // Show success message
            showMessage('Category is being saved... ✨', 'success');
        });

        // Function to show messages
        function showMessage(message, type) {
            // Remove existing messages
            const existingMessage = document.querySelector('.form-message');
            if (existingMessage) {
                existingMessage.remove();
            }

            const messageDiv = document.createElement('div');
            messageDiv.className = `form-message fixed top-4 right-4 px-6 py-3 rounded-2xl text-white font-semibold kids-shadow z-50 ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}`;
            messageDiv.textContent = message;

            document.body.appendChild(messageDiv);

            // Auto remove after 3 seconds
            setTimeout(() => {
                messageDiv.remove();
            }, 3000);
        }

        // Add focus animations
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
                this.classList.remove('border-red-400');
            });
        });
    });
</script>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    /* Enhanced focus effects */
    .group:focus-within {
        transform: scale(1.01);
        transition: transform 0.2s ease-in-out;
    }

    /* Form animations */
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

    /* Button hover effects */
    button:hover,
    a:hover {
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15), 0 6px 10px rgba(0, 0, 0, 0.1);
    }
</style>