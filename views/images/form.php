<!-- Header Section -->
<div class="mb-8 text-center">
    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full mb-4 kids-shadow">
        <i class="fas fa-upload text-white text-2xl"></i>
    </div>
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Upload Coloring Pages</h1>
    <p class="text-gray-600">Add beautiful new coloring pages to your collection! 🎨✨</p>
</div>

<!-- Upload Instructions -->
<div class="max-w-6xl mx-auto mb-8">
    <div class="bg-gradient-to-r from-yellow-100 via-pink-100 to-purple-100 rounded-2xl p-6 border-4 border-white kids-shadow">
        <div class="flex items-center space-x-3 mb-4">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                <i class="fas fa-info-circle text-white"></i>
            </div>
            <h3 class="text-xl font-kids text-purple-700">📋 Upload Instructions</h3>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-sm">
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">📁</div>
                <h4 class="font-semibold text-blue-600 mb-2">PDF Files</h4>
                <p class="text-gray-600">Upload PDF coloring pages that kids can print and color</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">🖼️</div>
                <h4 class="font-semibold text-green-600 mb-2">Thumbnails</h4>
                <p class="text-gray-600">Optional PNG/JPG preview images for each PDF</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">📝</div>
                <h4 class="font-semibold text-purple-600 mb-2">Auto Naming</h4>
                <p class="text-gray-600">Titles are generated from PDF filenames automatically</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-md text-center">
                <div class="text-3xl mb-2">⚡</div>
                <h4 class="font-semibold text-pink-600 mb-2">Bulk Upload</h4>
                <p class="text-gray-600">Upload multiple files at once for efficiency</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Upload Form -->
<div class="max-w-4xl mx-auto">
    <div class="bg-white kids-shadow rounded-3xl overflow-hidden border-t-4 border-blue-400">
        <!-- Form Header -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-500 p-6">
            <div class="flex items-center space-x-3">
                <div class="bg-white rounded-full p-2">
                    <i class="fas fa-cloud-upload-alt text-blue-500 text-lg"></i>
                </div>
                <div class="text-white">
                    <h2 class="text-xl font-bold">Upload Form</h2>
                    <p class="text-blue-100">Add new coloring pages with PDF and thumbnail files</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="p-8">
            <form method="post" action="/admin/images/multiple" enctype="multipart/form-data" id="uploadForm" class="space-y-8">

                <!-- Category Selection -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-folder text-purple-500 text-lg"></i>
                        <span class="text-lg">Select Category</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="category_id" id="categorySelect"
                            class="w-full border-2 border-gray-200 rounded-2xl p-4 pl-12 focus:border-purple-400 focus:ring-4 focus:ring-purple-100 transition-all duration-300 text-lg appearance-none"
                            required>
                            <option value="">🎯 Choose a category for your coloring pages...</option>
                            <?php foreach ($categories as $c): ?>
                                <option value="<?= $c['id'] ?>">
                                    <?php
                                    // Add emoji based on category name
                                    $name = strtolower($c['name']);
                                    $emoji = '';
                                    if (stripos($name, 'animal') !== false) $emoji = '🐾';
                                    elseif (stripos($name, 'cartoon') !== false) $emoji = '🎭';
                                    elseif (stripos($name, 'nature') !== false) $emoji = '🌿';
                                    elseif (stripos($name, 'holiday') !== false) $emoji = '🎉';
                                    elseif (stripos($name, 'fantasy') !== false) $emoji = '🦄';
                                    elseif (stripos($name, 'vehicle') !== false) $emoji = '🚗';
                                    elseif (stripos($name, 'space') !== false) $emoji = '🚀';
                                    elseif (stripos($name, 'dinosaur') !== false) $emoji = '🦕';
                                    elseif (stripos($name, 'food') !== false) $emoji = '🍎';
                                    elseif (stripos($name, 'music') !== false) $emoji = '🎵';
                                    elseif (stripos($name, 'sport') !== false) $emoji = '⚽';
                                    elseif (stripos($name, 'people') !== false) $emoji = '👥';
                                    elseif (stripos($name, 'sea') !== false) $emoji = '🌊';
                                    elseif (stripos($name, 'insect') !== false) $emoji = '🦋';
                                    elseif (stripos($name, 'robot') !== false) $emoji = '🤖';
                                    elseif (stripos($name, 'myth') !== false) $emoji = '⚡';
                                    elseif (stripos($name, 'farm') !== false) $emoji = '🚜';
                                    elseif (stripos($name, 'weather') !== false) $emoji = '🌤️';
                                    elseif (stripos($name, 'mandala') !== false) $emoji = '🔮';
                                    elseif (stripos($name, 'learning') !== false) $emoji = '📚';
                                    else $emoji = '🎨';
                                    ?>
                                    <?= $emoji ?> <?= htmlspecialchars($c['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-folder text-gray-400 group-focus-within:text-purple-500 transition-colors"></i>
                        </div>
                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2 ml-2">
                        <i class="fas fa-lightbulb text-yellow-400 mr-1"></i>
                        Choose the category that best fits your coloring pages
                    </p>
                </div>

                <!-- SEO Fields -->
                <div class="bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl p-6 border-2 border-dashed border-green-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-search text-green-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">🔍 SEO Optimization (Optional)</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Meta Title -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-heading text-blue-500"></i>
                                <span>Meta Title</span>
                            </label>
                            <input type="text"
                                name="meta_title"
                                id="metaTitle"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all"
                                placeholder="e.g., Free Animal Coloring Pages for Kids">
                            <p class="text-xs text-gray-500 mt-1">Will be used for all uploaded images</p>
                        </div>

                        <!-- Meta Description -->
                        <div>
                            <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                                <i class="fas fa-align-left text-green-500"></i>
                                <span>Meta Description</span>
                            </label>
                            <textarea name="meta_description"
                                id="metaDescription"
                                rows="3"
                                class="w-full border-2 border-gray-200 rounded-xl p-3 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all resize-none"
                                placeholder="Beautiful coloring pages perfect for kids..."></textarea>
                            <p class="text-xs text-gray-500 mt-1">Brief description for search engines</p>
                        </div>
                    </div>
                </div>

                <!-- PDF Files Upload -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-file-pdf text-red-500 text-lg"></i>
                        <span class="text-lg">PDF Coloring Pages</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="border-3 border-dashed border-red-200 rounded-2xl p-8 text-center hover:border-red-400 transition-all bg-red-50 hover:bg-red-100" id="pdfDropZone">
                        <div class="mb-4">
                            <i class="fas fa-file-pdf text-red-400 text-6xl mb-4"></i>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Drop PDF files here or click to browse</div>
                            <div class="text-gray-500">Select multiple PDF files to upload at once</div>
                        </div>
                        <input type="file"
                            name="pdf_files[]"
                            id="pdfFiles"
                            multiple
                            accept="application/pdf"
                            class="hidden"
                            required>
                        <button type="button"
                            onclick="document.getElementById('pdfFiles').click()"
                            class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition-all font-semibold">
                            <i class="fas fa-upload mr-2"></i>
                            Choose PDF Files
                        </button>
                    </div>
                    <div id="pdfFileList" class="mt-4 space-y-2 hidden">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-list mr-2 text-blue-500"></i>
                            Selected PDF Files:
                        </h4>
                        <div id="pdfFiles-list" class="space-y-2"></div>
                    </div>
                </div>

                <!-- Thumbnail Files Upload -->
                <div class="group">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-4">
                        <i class="fas fa-image text-green-500 text-lg"></i>
                        <span class="text-lg">Thumbnail Images (Optional)</span>
                        <span class="text-gray-400 text-sm ml-2">- PNG or JPG</span>
                    </label>
                    <div class="border-3 border-dashed border-green-200 rounded-2xl p-8 text-center hover:border-green-400 transition-all bg-green-50 hover:bg-green-100" id="thumbDropZone">
                        <div class="mb-4">
                            <i class="fas fa-images text-green-400 text-6xl mb-4"></i>
                            <div class="text-xl font-semibold text-gray-700 mb-2">Drop thumbnail images here or click to browse</div>
                            <div class="text-gray-500">Order should match your PDF files</div>
                        </div>
                        <input type="file"
                            name="thumb_files[]"
                            id="thumbFiles"
                            multiple
                            accept="image/png,image/jpeg,image/jpg"
                            class="hidden">
                        <button type="button"
                            onclick="document.getElementById('thumbFiles').click()"
                            class="bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition-all font-semibold">
                            <i class="fas fa-upload mr-2"></i>
                            Choose Thumbnail Images
                        </button>
                    </div>
                    <div id="thumbFileList" class="mt-4 space-y-2 hidden">
                        <h4 class="font-semibold text-gray-700 flex items-center">
                            <i class="fas fa-list mr-2 text-green-500"></i>
                            Selected Thumbnail Files:
                        </h4>
                        <div id="thumbFiles-list" class="space-y-2"></div>
                    </div>
                </div>

                <!-- File Matching Preview -->
                <div id="fileMatching" class="hidden bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6 border-2 border-dashed border-purple-200">
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-link text-purple-500 text-lg"></i>
                        <h3 class="text-lg font-semibold text-gray-700">📝 File Matching Preview</h3>
                    </div>
                    <div id="matchingPreview" class="space-y-3"></div>
                </div>

                <!-- Progress Bar -->
                <div id="progressContainer" class="hidden">
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border-2 border-blue-200">
                        <div class="flex items-center space-x-2 mb-4">
                            <i class="fas fa-cloud-upload-alt text-blue-500 text-lg"></i>
                            <h3 class="text-lg font-semibold text-gray-700">🚀 Upload Progress</h3>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                            <div id="progressBar"
                                class="bg-gradient-to-r from-blue-500 to-purple-500 h-4 text-xs leading-none text-center text-white rounded-full transition-all duration-300 flex items-center justify-center font-bold"
                                style="width:0%">
                                0%
                            </div>
                        </div>
                        <div id="progressText" class="text-center text-gray-600 mt-2 font-semibold">
                            Preparing upload...
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="/admin/images"
                        class="inline-flex items-center space-x-2 px-6 py-3 bg-gray-500 text-white rounded-2xl hover:bg-gray-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Images</span>
                    </a>

                    <div class="flex space-x-3">
                        <button type="button"
                            onclick="resetForm()"
                            class="inline-flex items-center space-x-2 px-6 py-3 bg-orange-500 text-white rounded-2xl hover:bg-orange-600 transition-all duration-300 transform hover:scale-105 kids-shadow">
                            <i class="fas fa-undo"></i>
                            <span>Reset Form</span>
                        </button>

                        <button type="submit"
                            id="submitBtn"
                            class="inline-flex items-center space-x-2 px-8 py-3 bg-gradient-to-r from-blue-500 to-purple-500 text-white rounded-2xl hover:from-blue-600 hover:to-purple-600 transition-all duration-300 transform hover:scale-105 kids-shadow font-semibold">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>Upload Coloring Pages</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Tips -->
<div class="max-w-4xl mx-auto mt-8">
    <div class="bg-gradient-to-r from-yellow-400 via-pink-500 to-purple-600 rounded-2xl p-1">
        <div class="bg-white rounded-xl p-6">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full p-2">
                    <i class="fas fa-lightbulb text-white"></i>
                </div>
                <h3 class="font-bold text-gray-800">💡 Upload Tips & Best Practices</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <div class="space-y-3">
                    <h4 class="font-semibold text-blue-600">📁 File Requirements:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">PDF files should be high quality (300 DPI recommended)</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Thumbnails should be PNG or JPG format</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Use clear, descriptive filenames</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-check-circle text-green-500 mt-1"></i>
                            <span class="text-gray-600">Maximum file size: 10MB per file</span>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <h4 class="font-semibold text-purple-600">🎯 Best Practices:</h4>
                    <div class="space-y-2">
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Group related images in same upload session</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Match thumbnail order with PDF order</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Choose appropriate category before uploading</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <i class="fas fa-star text-yellow-500 mt-1"></i>
                            <span class="text-gray-600">Add SEO info for better search visibility</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .border-3 {
        border-width: 3px;
    }

    .group:focus-within {
        transform: scale(1.01);
        transition: transform 0.2s ease-in-out;
    }

    .file-item {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border: 1px solid #cbd5e0;
        border-radius: 0.75rem;
        padding: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: between;
        transition: all 0.3s ease;
    }

    .file-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .drop-zone-active {
        border-color: #3b82f6 !important;
        background-color: #dbeafe !important;
        transform: scale(1.02);
    }

    @keyframes uploadPulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }
    }

    .upload-active {
        animation: uploadPulse 2s infinite;
    }

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

    .group:nth-child(5) {
        animation-delay: 0.5s;
    }
</style>

<script>
    const form = document.getElementById('uploadForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');
    const progressText = document.getElementById('progressText');
    const submitBtn = document.getElementById('submitBtn');
    const pdfFiles = document.getElementById('pdfFiles');
    const thumbFiles = document.getElementById('thumbFiles');

    // File list management
    function updateFileList(input, listContainer, listElement) {
        const files = Array.from(input.files);
        const container = document.getElementById(listContainer);
        const list = document.getElementById(listElement);

        if (files.length > 0) {
            container.classList.remove('hidden');
            list.innerHTML = '';

            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';

                const fileIcon = input.accept.includes('pdf') ? 'fas fa-file-pdf text-red-500' : 'fas fa-image text-green-500';
                const fileSize = (file.size / 1024 / 1024).toFixed(2);

                fileItem.innerHTML = `
                    <div class="flex items-center space-x-3 flex-1">
                        <i class="${fileIcon} text-lg"></i>
                        <div class="flex-1">
                            <div class="font-semibold text-gray-800">${file.name}</div>
                            <div class="text-sm text-gray-500">${fileSize} MB</div>
                        </div>
                        <div class="text-sm text-gray-400">#${index + 1}</div>
                    </div>
                    <button type="button" onclick="removeFile('${input.id}', ${index})" 
                            class="text-red-500 hover:text-red-700 p-1 rounded">
                        <i class="fas fa-times"></i>
                    </button>
                `;

                list.appendChild(fileItem);
            });

            updateFileMatching();
        } else {
            container.classList.add('hidden');
        }
    }

    // Remove file from list
    function removeFile(inputId, index) {
        const input = document.getElementById(inputId);
        const dt = new DataTransfer();
        const files = Array.from(input.files);

        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });

        input.files = dt.files;

        if (inputId === 'pdfFiles') {
            updateFileList(input, 'pdfFileList', 'pdfFiles-list');
        } else {
            updateFileList(input, 'thumbFileList', 'thumbFiles-list');
        }
    }

    // Update file matching preview
    function updateFileMatching() {
        const pdfFilesList = Array.from(pdfFiles.files);
        const thumbFilesList = Array.from(thumbFiles.files);
        const matchingContainer = document.getElementById('fileMatching');
        const matchingPreview = document.getElementById('matchingPreview');

        if (pdfFilesList.length > 0) {
            matchingContainer.classList.remove('hidden');
            matchingPreview.innerHTML = '';

            pdfFilesList.forEach((pdfFile, index) => {
                const thumbFile = thumbFilesList[index];
                const matchItem = document.createElement('div');
                matchItem.className = 'bg-white rounded-xl p-4 shadow-md flex items-center justify-between';

                matchItem.innerHTML = `
                    <div class="flex items-center space-x-4">
                        <div class="text-2xl">${index + 1}</div>
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-file-pdf text-red-500"></i>
                            <span class="font-semibold text-gray-800">${pdfFile.name}</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-arrow-right text-gray-400"></i>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-image ${thumbFile ? 'text-green-500' : 'text-gray-400'}"></i>
                            <span class="text-sm ${thumbFile ? 'text-gray-800' : 'text-gray-400'}">
                                ${thumbFile ? thumbFile.name : 'No thumbnail'}
                            </span>
                        </div>
                    </div>
                `;

                matchingPreview.appendChild(matchItem);
            });
        } else {
            matchingContainer.classList.add('hidden');
        }
    }

    // Drag and drop functionality
    function setupDragAndDrop(dropZone, fileInput) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('drop-zone-active'), false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('drop-zone-active'), false);
        });

        dropZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;

            if (fileInput.id === 'pdfFiles') {
                updateFileList(fileInput, 'pdfFileList', 'pdfFiles-list');
            } else {
                updateFileList(fileInput, 'thumbFileList', 'thumbFiles-list');
            }
        }, false);
    }

    // Event listeners for file inputs
    pdfFiles.addEventListener('change', function() {
        updateFileList(this, 'pdfFileList', 'pdfFiles-list');
    });

    thumbFiles.addEventListener('change', function() {
        updateFileList(this, 'thumbFileList', 'thumbFiles-list');
    });

    // Setup drag and drop
    setupDragAndDrop(document.getElementById('pdfDropZone'), pdfFiles);
    setupDragAndDrop(document.getElementById('thumbDropZone'), thumbFiles);

    // Form submission with progress
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const categoryId = document.getElementById('categorySelect').value;
        const pdfFilesList = Array.from(pdfFiles.files);

        if (!categoryId) {
            showMessage('Please select a category! 📁', 'error');
            document.getElementById('categorySelect').focus();
            return;
        }

        if (pdfFilesList.length === 0) {
            showMessage('Please select at least one PDF file! 📄', 'error');
            document.getElementById('pdfFiles').focus();
            return;
        }

        // Show progress container
        progressContainer.classList.remove('hidden');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';

        // Add upload animation to form
        form.classList.add('upload-active');

        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        // Progress tracking
        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percent = Math.round((e.loaded / e.total) * 100);
                progressBar.style.width = percent + '%';
                progressBar.textContent = percent + '%';

                // Update progress text
                if (percent < 25) {
                    progressText.textContent = '📤 Uploading files...';
                } else if (percent < 50) {
                    progressText.textContent = '🎨 Processing coloring pages...';
                } else if (percent < 75) {
                    progressText.textContent = '🖼️ Creating thumbnails...';
                } else if (percent < 100) {
                    progressText.textContent = '✨ Finalizing upload...';
                } else {
                    progressText.textContent = '🎉 Upload complete!';
                }
            }
        });

        // Handle completion
        xhr.addEventListener('load', function() {
            form.classList.remove('upload-active');

            if (xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        progressText.textContent = `🎉 Successfully uploaded ${response.uploaded.length} coloring pages!`;
                        showMessage(`🎉 Successfully uploaded ${response.uploaded.length} coloring pages!`, 'success');

                        setTimeout(() => {
                            window.location.href = '/admin/images';
                        }, 2000);
                    } else {
                        throw new Error(response.message || 'Upload failed');
                    }
                } catch (error) {
                    showMessage('❌ Upload failed: ' + error.message, 'error');
                    resetUploadState();
                }
            } else {
                showMessage('❌ Upload failed! Please try again.', 'error');
                resetUploadState();
            }
        });

        // Handle errors
        xhr.addEventListener('error', function() {
            showMessage('❌ Network error during upload!', 'error');
            resetUploadState();
        });

        // Send request
        xhr.open('POST', form.action, true);
        xhr.send(formData);
    });

    // Reset upload state
    function resetUploadState() {
        form.classList.remove('upload-active');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-cloud-upload-alt"></i><span>Upload Coloring Pages</span>';
        progressContainer.classList.add('hidden');
        progressBar.style.width = '0%';
        progressBar.textContent = '0%';
        progressText.textContent = 'Preparing upload...';
    }

    // Reset form function
    function resetForm() {
        const confirmReset = confirm('🔄 Are you sure you want to reset the form?\n\nThis will clear all selected files and form data.');
        if (confirmReset) {
            form.reset();
            document.getElementById('pdfFileList').classList.add('hidden');
            document.getElementById('thumbFileList').classList.add('hidden');
            document.getElementById('fileMatching').classList.add('hidden');
            progressContainer.classList.add('hidden');
            resetUploadState();
            showMessage('📝 Form has been reset!', 'success');
        }
    }

    // Show message function
    function showMessage(message, type) {
        const existingMessage = document.querySelector('.form-message');
        if (existingMessage) existingMessage.remove();

        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message fixed top-4 right-4 px-6 py-3 rounded-2xl text-white font-semibold kids-shadow z-50 ${type === 'error' ? 'bg-red-500' : 'bg-green-500'}`;
        messageDiv.textContent = message;

        document.body.appendChild(messageDiv);
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.remove();
            }
        }, 4000);
    }

    // Enhanced interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Focus animations
        const inputs = document.querySelectorAll('input, textarea, select');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('scale-105');
                this.parentElement.style.transition = 'transform 0.2s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('scale-105');
            });
        });

        // Category selection enhancement
        const categorySelect = document.getElementById('categorySelect');
        categorySelect.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('border-green-400');
                this.classList.remove('border-gray-200');
                showMessage('📁 Category selected: ' + this.options[this.selectedIndex].text, 'success');
            } else {
                this.classList.remove('border-green-400');
                this.classList.add('border-gray-200');
            }
        });

        // File validation
        pdfFiles.addEventListener('change', function() {
            const files = Array.from(this.files);
            let validFiles = 0;
            let totalSize = 0;

            files.forEach(file => {
                if (file.type === 'application/pdf') {
                    validFiles++;
                    totalSize += file.size;
                } else {
                    showMessage(`❌ ${file.name} is not a PDF file!`, 'error');
                }
            });

            if (totalSize > 100 * 1024 * 1024) { // 100MB limit
                showMessage('⚠️ Total file size too large! Please reduce file sizes.', 'error');
            } else if (validFiles > 0) {
                showMessage(`📄 ${validFiles} PDF file(s) selected!`, 'success');
            }
        });

        thumbFiles.addEventListener('change', function() {
            const files = Array.from(this.files);
            const pdfCount = pdfFiles.files.length;
            let validFiles = 0;

            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    validFiles++;
                } else {
                    showMessage(`❌ ${file.name} is not an image file!`, 'error');
                }
            });

            if (validFiles > 0) {
                if (validFiles === pdfCount) {
                    showMessage(`🖼️ Perfect! ${validFiles} thumbnails match ${pdfCount} PDFs!`, 'success');
                } else if (validFiles < pdfCount) {
                    showMessage(`🖼️ ${validFiles} thumbnails selected (${pdfCount - validFiles} PDFs will use auto-generated previews)`, 'success');
                } else {
                    showMessage(`⚠️ More thumbnails than PDFs! Extra thumbnails will be ignored.`, 'error');
                }
            }
        });

        // Add loading animations on page load
        const animatedElements = document.querySelectorAll('.group, .bg-gradient-to-r');
        animatedElements.forEach((element, index) => {
            setTimeout(() => {
                element.style.transform = 'translateY(-2px)';
                element.style.transition = 'transform 0.3s ease';
                setTimeout(() => {
                    element.style.transform = 'translateY(0)';
                }, 300);
            }, index * 100);
        });

        // Interactive hover effects for tips
        const tipElements = document.querySelectorAll('.fas.fa-check-circle, .fas.fa-star');
        tipElements.forEach(element => {
            element.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2) rotate(360deg)';
                this.style.transition = 'transform 0.5s ease';
            });

            element.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+U or Cmd+U for upload
        if ((e.ctrlKey || e.metaKey) && e.key === 'u') {
            e.preventDefault();
            if (!submitBtn.disabled) {
                form.dispatchEvent(new Event('submit'));
            }
        }

        // Ctrl+R or Cmd+R for reset (with custom confirm)
        if ((e.ctrlKey || e.metaKey) && e.key === 'r') {
            e.preventDefault();
            resetForm();
        }
    });

    // Auto-save form data to prevent loss
    let autoSaveTimer;

    function autoSaveFormData() {
        const formData = {
            category_id: document.getElementById('categorySelect').value,
            meta_title: document.getElementById('metaTitle').value,
            meta_description: document.getElementById('metaDescription').value
        };
        localStorage.setItem('uploadFormData', JSON.stringify(formData));
    }

    // Restore form data on page load
    function restoreFormData() {
        const savedData = localStorage.getItem('uploadFormData');
        if (savedData) {
            try {
                const formData = JSON.parse(savedData);
                document.getElementById('categorySelect').value = formData.category_id || '';
                document.getElementById('metaTitle').value = formData.meta_title || '';
                document.getElementById('metaDescription').value = formData.meta_description || '';
            } catch (e) {
                console.log('Could not restore form data');
            }
        }
    }

    // Auto-save on form changes
    ['change', 'input'].forEach(eventType => {
        form.addEventListener(eventType, function(e) {
            if (['SELECT', 'INPUT', 'TEXTAREA'].includes(e.target.tagName)) {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(autoSaveFormData, 1000);
            }
        });
    });

    // Clear saved data on successful upload
    form.addEventListener('submit', function() {
        localStorage.removeItem('uploadFormData');
    });

    // Restore data on page load
    window.addEventListener('load', restoreFormData);
</script>