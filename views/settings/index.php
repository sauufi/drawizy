<div class="max-w-4xl mx-auto">
    <!-- Site Settings Card -->
    <div class="bg-white kids-shadow rounded-2xl p-8 transform hover:scale-[1.02] transition-all duration-300">
        <!-- Header with Icon -->
        <div class="text-center mb-8">
            <div class="bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full p-4 w-20 h-20 mx-auto mb-4 kids-shadow">
                <i class="fas fa-cog text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Site Settings</h1>
            <p class="text-gray-600">Configure your website's appearance and content 🎨</p>
        </div>

        <!-- Settings Form -->
        <form action="/dashboard/settings" method="post" enctype="multipart/form-data" class="space-y-8">

            <!-- Basic Information Section -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border-l-4 border-blue-400">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                    Basic Information
                </h2>

                <div class="grid md:grid-cols-1 gap-6">
                    <!-- Site Title -->
                    <div class="form-field">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                            <i class="fas fa-heading text-blue-500"></i>
                            <span>Website Title</span>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="site_title"
                            value="<?= htmlspecialchars($setting['site_title']) ?>"
                            placeholder="Enter your website title"
                            class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-300 hover:border-blue-300"
                            required>
                        <p class="text-xs text-gray-500 mt-2">This will appear in the browser tab and as your site's main title</p>
                    </div>

                    <!-- Site Description -->
                    <div class="form-field">
                        <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                            <i class="fas fa-align-left text-green-500"></i>
                            <span>Website Description</span>
                        </label>
                        <textarea name="site_description"
                            rows="4"
                            placeholder="Describe your website (for SEO and meta descriptions)"
                            class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all duration-300 hover:border-green-300 resize-none"><?= htmlspecialchars($setting['site_description']) ?></textarea>
                        <p class="text-xs text-gray-500 mt-2">This description helps search engines understand your site</p>
                    </div>
                </div>
            </div>

            <!-- Branding Section -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-2xl p-6 border-l-4 border-purple-400">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-palette text-purple-500 mr-3"></i>
                    Branding & Logo
                </h2>

                <!-- Current Logo Display -->
                <?php if ($setting['site_logo']): ?>
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-3">Current Logo:</label>
                        <div class="bg-white rounded-xl p-4 inline-block kids-shadow">
                            <img src="/uploads/<?= $setting['site_logo'] ?>"
                                alt="Current Logo"
                                class="h-20 w-auto object-contain">
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Logo Upload -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-image text-pink-500"></i>
                        <span><?= $setting['site_logo'] ? 'Update Logo' : 'Upload Logo' ?></span>
                    </label>

                    <div class="border-3 border-dashed border-pink-200 rounded-2xl p-8 text-center hover:border-pink-400 transition-all bg-pink-50 hover:bg-pink-100" id="logoDropZone">
                        <div class="mb-4">
                            <i class="fas fa-cloud-upload-alt text-pink-400 text-4xl mb-4"></i>
                            <div class="text-lg font-semibold text-gray-700 mb-2">
                                Drop your logo here or click to browse
                            </div>
                            <p class="text-gray-500 text-sm mb-4">Supports: JPG, PNG, GIF (Max: 2MB)</p>
                        </div>

                        <input type="file"
                            name="site_logo"
                            id="logoInput"
                            class="hidden"
                            accept="image/*">

                        <button type="button"
                            onclick="document.getElementById('logoInput').click()"
                            class="bg-gradient-to-r from-pink-400 to-purple-500 hover:from-pink-500 hover:to-purple-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-folder-open mr-2"></i>
                            Choose File
                        </button>
                    </div>

                    <p class="text-xs text-gray-500 mt-2">
                        Recommended size: 200x200 pixels. The logo will be automatically resized to fit.
                    </p>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex justify-center pt-6">
                <button type="submit"
                    class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 kids-shadow hover:shadow-lg flex items-center space-x-3">
                    <i class="fas fa-save text-xl"></i>
                    <span class="text-lg">Save Changes</span>
                    <span>✨</span>
                </button>
            </div>

            <!-- Help Section -->
            <div class="mt-8 p-6 bg-yellow-50 rounded-xl border-l-4 border-yellow-400">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-yellow-500 text-xl mt-1"></i>
                    <div>
                        <p class="text-yellow-800 font-semibold mb-2">💡 Pro Tips:</p>
                        <ul class="text-yellow-700 text-sm space-y-1">
                            <li>• Choose a descriptive title that reflects your site's purpose</li>
                            <li>• Write a clear description for better search engine visibility</li>
                            <li>• Use a high-quality logo that represents your brand</li>
                            <li>• Test your changes on different devices after saving</li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
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
    .form-field input:focus,
    .form-field textarea:focus {
        transform: scale(1.01);
    }

    /* Drag and drop styling */
    #logoDropZone.dragover {
        border-color: #ec4899;
        background-color: #fdf2f8;
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

    /* File input enhancement */
    .file-preview {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    // Drag and drop functionality
    const dropZone = document.getElementById('logoDropZone');
    const fileInput = document.getElementById('logoInput');

    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });

    // Highlight drop zone when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    // Handle dropped files
    dropZone.addEventListener('drop', handleDrop, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight(e) {
        dropZone.classList.add('dragover');
    }

    function unhighlight(e) {
        dropZone.classList.remove('dragover');
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;

        if (files.length > 0) {
            fileInput.files = files;
            handleFileSelect(files[0]);
        }
    }

    // Handle file selection
    fileInput.addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            handleFileSelect(e.target.files[0]);
        }
    });

    function handleFileSelect(file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file!');
            return;
        }

        // Validate file size (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('File size must be less than 2MB!');
            return;
        }

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.createElement('div');
            preview.className = 'file-preview mt-4 p-4 bg-white rounded-xl kids-shadow';
            preview.innerHTML = `
                <div class="flex items-center space-x-3">
                    <img src="${e.target.result}" alt="Preview" class="h-16 w-16 object-cover rounded-lg">
                    <div>
                        <p class="font-semibold text-gray-700">${file.name}</p>
                        <p class="text-sm text-gray-500">${(file.size / 1024).toFixed(1)} KB</p>
                    </div>
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            `;

            // Remove existing preview
            const existingPreview = dropZone.querySelector('.file-preview');
            if (existingPreview) {
                existingPreview.remove();
            }

            dropZone.appendChild(preview);
        };
        reader.readAsDataURL(file);
    }

    // Form validation and submission enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;

        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving Changes...';
        submitBtn.disabled = true;

        // Reset after form submission (adjust timing as needed)
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });
</script>