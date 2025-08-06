<div class="max-w-5xl mx-auto">
    <!-- Edit Page Header -->
    <div class="bg-white kids-shadow rounded-2xl p-8 mb-8 transform hover:scale-[1.02] transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-4 mb-4">
                    <a href="/admin/pages"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-3 rounded-xl transition-all duration-300 transform hover:scale-105"
                        title="Back to Pages">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full p-4 w-16 h-16 kids-shadow">
                        <i class="fas fa-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Edit Page</h1>
                        <p class="text-gray-600">Modify your existing page content ✏️</p>
                    </div>
                </div>
            </div>
            <div class="hidden md:flex flex-col items-end space-y-2">
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-save text-green-500"></i>
                    <span>Auto-save enabled</span>
                </div>
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <i class="fas fa-clock text-blue-500"></i>
                    <span>Page ID: #<?= $page['id'] ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Page Form -->
    <form action="/admin/pages/update/<?= $page['id'] ?>" method="post" id="pageForm" class="space-y-8">
        <!-- Basic Information Section -->
        <div class="bg-white kids-shadow rounded-2xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center mb-2">
                    <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                    Basic Information
                </h2>
                <p class="text-gray-600">Update the fundamental details of your page</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Page Title -->
                <div class="md:col-span-2 form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-heading text-blue-500"></i>
                        <span>Page Title</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="title"
                        id="pageTitle"
                        value="<?= htmlspecialchars($page['title']) ?>"
                        placeholder="Enter your page title"
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-300 hover:border-blue-300"
                        required>
                    <p class="text-xs text-gray-500 mt-2">This will be displayed as the main heading and page title</p>
                </div>

                <!-- Page Slug -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-link text-green-500"></i>
                        <span>Page URL (Slug)</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-500 text-sm">yoursite.com/page/</span>
                        <input type="text"
                            name="slug"
                            id="pageSlug"
                            value="<?= htmlspecialchars($page['slug']) ?>"
                            placeholder="page-url-slug"
                            class="flex-1 border-2 border-gray-200 rounded-xl p-4 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all duration-300 hover:border-green-300 font-mono text-sm"
                            required>
                        <button type="button"
                            onclick="generateSlugFromTitle()"
                            class="bg-green-100 hover:bg-green-200 text-green-700 p-3 rounded-xl transition-all duration-300"
                            title="Generate from title">
                            <i class="fas fa-magic"></i>
                        </button>
                    </div>
                    <div id="slugWarningPage" class="text-red-500 text-sm mt-2 hidden flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        <span>This slug already exists! Please choose a different one.</span>
                    </div>
                    <div id="slugValidPage" class="text-green-500 text-sm mt-2 hidden flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>This slug is available!</span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">The URL where this page will be accessible</p>
                </div>

                <!-- Page Status -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-eye text-purple-500"></i>
                        <span>Page Status</span>
                    </label>
                    <select name="status"
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all duration-300 hover:border-purple-300">
                        <option value="published" <?= ($page['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>📢 Published (Visible to everyone)</option>
                        <option value="draft" <?= ($page['status'] ?? 'published') === 'draft' ? 'selected' : '' ?>>📝 Draft (Only visible to admins)</option>
                        <option value="private" <?= ($page['status'] ?? 'published') === 'private' ? 'selected' : '' ?>>🔒 Private (Restricted access)</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Control who can see this page on your website</p>
                </div>
            </div>
        </div>

        <!-- SEO Settings Section -->
        <div class="bg-white kids-shadow rounded-2xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center mb-2">
                    <i class="fas fa-search text-indigo-500 mr-3"></i>
                    SEO Settings
                </h2>
                <p class="text-gray-600">Optimize your page for search engines</p>
            </div>

            <div class="grid md:grid-cols-1 gap-6">
                <!-- Meta Description -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-align-left text-indigo-500"></i>
                        <span>Meta Description</span>
                    </label>
                    <textarea name="meta_description"
                        id="metaDescription"
                        rows="3"
                        placeholder="Write a brief description of this page for search engines (150-160 characters recommended)"
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all duration-300 hover:border-indigo-300 resize-none"><?= htmlspecialchars($page['meta_description'] ?? '') ?></textarea>
                    <div class="flex justify-between items-center mt-2">
                        <p class="text-xs text-gray-500">This appears in search engine results</p>
                        <span id="metaCounter" class="text-xs text-gray-400">0/160 characters</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="bg-white kids-shadow rounded-2xl p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 flex items-center mb-2">
                    <i class="fas fa-edit text-orange-500 mr-3"></i>
                    Page Content
                </h2>
                <p class="text-gray-600">Edit your page content using the rich text editor</p>
            </div>

            <!-- Content Editor -->
            <div class="form-field">
                <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                    <i class="fas fa-file-alt text-orange-500"></i>
                    <span>Content</span>
                    <span class="text-red-500">*</span>
                </label>
                <div class="border-2 border-gray-200 rounded-xl overflow-hidden focus-within:border-orange-400 focus-within:ring-2 focus-within:ring-orange-100 transition-all duration-300">
                    <textarea id="contentEditor"
                        name="content"
                        class="w-full h-96 border-0 p-4 focus:outline-none resize-none"
                        required><?= htmlspecialchars($page['content']) ?></textarea>
                </div>
                <p class="text-xs text-gray-500 mt-2">Use the toolbar above to format your content with headings, links, images, and more</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white kids-shadow rounded-2xl p-8">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                <!-- Preview & Help -->
                <div class="flex flex-col md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4">
                    <button type="button"
                        onclick="previewPage()"
                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <i class="fas fa-eye"></i>
                        <span>Preview Changes</span>
                    </button>
                    <a href="/page/<?= htmlspecialchars($page['slug']) ?>"
                        target="_blank"
                        class="bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Live</span>
                    </a>
                    <div class="text-sm text-gray-500 flex items-center space-x-2">
                        <i class="fas fa-lightbulb text-yellow-500"></i>
                        <span>Tip: Use Ctrl+S to save quickly</span>
                    </div>
                </div>

                <!-- Save Actions -->
                <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-3">
                    <button type="button"
                        onclick="saveDraft()"
                        class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
                        <i class="fas fa-save"></i>
                        <span>Save as Draft</span>
                    </button>
                    <button type="submit"
                        class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-bold py-3 px-8 rounded-xl transition-all duration-300 transform hover:scale-105 kids-shadow hover:shadow-lg flex items-center space-x-2">
                        <i class="fas fa-save"></i>
                        <span>Save Changes</span>
                        <span>✨</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Revision History -->
        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 rounded-2xl p-6 border-l-4 border-purple-400">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <i class="fas fa-history text-purple-500 mr-3"></i>
                    Page Information
                </h3>
            </div>
            <div class="grid md:grid-cols-3 gap-4 text-sm">
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center space-x-2 text-gray-600 mb-1">
                        <i class="fas fa-calendar-plus text-green-500"></i>
                        <span>Created</span>
                    </div>
                    <p class="font-semibold text-gray-800"><?= date('M j, Y', strtotime($page['created_at'] ?? 'now')) ?></p>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center space-x-2 text-gray-600 mb-1">
                        <i class="fas fa-edit text-blue-500"></i>
                        <span>Last Modified</span>
                    </div>
                    <p class="font-semibold text-gray-800"><?= date('M j, Y g:i A', strtotime($page['updated_at'] ?? 'now')) ?></p>
                </div>
                <div class="bg-white rounded-lg p-4">
                    <div class="flex items-center space-x-2 text-gray-600 mb-1">
                        <i class="fas fa-eye text-purple-500"></i>
                        <span>Current Status</span>
                    </div>
                    <p class="font-semibold text-gray-800 capitalize"><?= htmlspecialchars($page['status'] ?? 'Published') ?></p>
                </div>
            </div>
        </div>

        <!-- Help Section -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border-l-4 border-blue-400">
            <div class="flex items-start space-x-3">
                <i class="fas fa-info-circle text-blue-500 text-xl mt-1"></i>
                <div>
                    <p class="text-blue-800 font-semibold mb-2">💡 Page Editing Tips:</p>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li>• Changes are automatically saved as you type (draft mode)</li>
                        <li>• Use the preview function to see how your changes will look</li>
                        <li>• Changing the slug will update the page URL - use carefully</li>
                        <li>• Meta descriptions help your page rank better in search results</li>
                        <li>• Save as draft to hide changes until you're ready to publish</li>
                    </ul>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .form-field:focus-within {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .form-field input:focus,
    .form-field textarea:focus,
    .form-field select:focus {
        transform: scale(1.01);
    }

    /* Custom editor styling */
    .tox-tinymce {
        border-radius: 0.75rem !important;
        border: none !important;
    }

    .tox .tox-toolbar {
        border-bottom: 1px solid #e5e7eb !important;
        border-radius: 0.75rem 0.75rem 0 0 !important;
    }

    /* Slug validation styling */
    .slug-checking {
        border-color: #fbbf24 !important;
    }

    .slug-valid {
        border-color: #10b981 !important;
    }

    .slug-invalid {
        border-color: #ef4444 !important;
    }

    /* Auto-save indicator */
    .auto-save-indicator {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .auto-save-indicator.show {
        opacity: 1;
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

    /* Loading animation */
    .loading-spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }
</style>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/7zr8q2qslb6wuby2zyescyf4eex8o1meaf5ysod973ubos3z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    // Initialize TinyMCE with enhanced configuration
    tinymce.init({
        selector: '#contentEditor',
        height: 400,
        menubar: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic underline strikethrough | fontfamily fontsize | ' +
            'alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | ' +
            'forecolor backcolor removeformat | pagebreak | charmap emoticons | ' +
            'fullscreen preview save print | insertfile image media template link anchor codesample | ltr rtl',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; line-height: 1.6; }',
        skin: 'oxide',
        content_css: 'default',
        branding: false,
        promotion: false,
        setup: function(editor) {
            editor.on('change', function() {
                autoSave();
            });
        }
    });

    // Auto-generate slug from title
    function generateSlugFromTitle() {
        const title = document.getElementById('pageTitle').value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .replace(/\s+/g, '-') // Replace spaces with hyphens
            .replace(/-+/g, '-') // Replace multiple hyphens with single
            .trim('-'); // Remove leading/trailing hyphens

        document.getElementById('pageSlug').value = slug;
        checkSlugUniqueness();
    }

    // Slug uniqueness checker
    let slugCheckTimeout;

    function checkSlugUniqueness() {
        const slugInput = document.getElementById('pageSlug');
        const warningDiv = document.getElementById('slugWarningPage');
        const validDiv = document.getElementById('slugValidPage');
        const slug = slugInput.value.trim();

        if (!slug) {
            warningDiv.classList.add('hidden');
            validDiv.classList.add('hidden');
            slugInput.classList.remove('slug-valid', 'slug-invalid');
            return;
        }

        // Add checking state
        slugInput.classList.add('slug-checking');
        slugInput.classList.remove('slug-valid', 'slug-invalid');
        warningDiv.classList.add('hidden');
        validDiv.classList.add('hidden');

        clearTimeout(slugCheckTimeout);
        slugCheckTimeout = setTimeout(() => {
            fetch('/admin/pages/check-slug?slug=' + encodeURIComponent(slug) + '&id=<?= $page['id'] ?>')
                .then(response => response.json())
                .then(data => {
                    slugInput.classList.remove('slug-checking');

                    if (data.unique) {
                        slugInput.classList.add('slug-valid');
                        slugInput.classList.remove('slug-invalid');
                        warningDiv.classList.add('hidden');
                        validDiv.classList.remove('hidden');
                    } else {
                        slugInput.classList.add('slug-invalid');
                        slugInput.classList.remove('slug-valid');
                        warningDiv.classList.remove('hidden');
                        validDiv.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error checking slug:', error);
                    slugInput.classList.remove('slug-checking');
                });
        }, 500);
    }

    // Meta description character counter
    function updateMetaCounter() {
        const metaField = document.getElementById('metaDescription');
        const counter = document.getElementById('metaCounter');
        const length = metaField.value.length;

        counter.textContent = `${length}/160 characters`;

        // Change color based on length
        if (length > 160) {
            counter.className = 'text-xs text-red-500';
        } else if (length > 140) {
            counter.className = 'text-xs text-yellow-500';
        } else {
            counter.className = 'text-xs text-green-500';
        }
    }

    // Auto-save functionality
    let autoSaveTimeout;

    function autoSave() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(() => {
            // Show auto-save indicator
            showAutoSaveIndicator();

            // Here you would implement actual auto-save logic
            console.log('Auto-saving changes...');

            // Simulate save completion
            setTimeout(() => {
                hideAutoSaveIndicator();
            }, 1000);
        }, 2000); // Auto-save after 2 seconds of inactivity
    }

    function showAutoSaveIndicator() {
        console.log('Saving draft...');
    }

    function hideAutoSaveIndicator() {
        console.log('Changes saved!');
    }

    // Preview functionality
    function previewPage() {
        const title = document.getElementById('pageTitle').value;
        const content = tinymce.get('contentEditor').getContent();

        if (!title || !content) {
            alert('⚠️ Please add a title and content before previewing!');
            return;
        }

        // Open preview in new window
        const previewWindow = window.open('', '_blank');
        previewWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <title>${title}</title>
                <style>
                    body { font-family: -apple-system, BlinkMacSystemFont, sans-serif; line-height: 1.6; max-width: 800px; margin: 0 auto; padding: 20px; }
                    h1 { color: #333; border-bottom: 2px solid #eee; padding-bottom: 10px; }
                </style>
            </head>
            <body>
                <h1>${title}</h1>
                ${content}
                <hr style="margin-top: 40px;">
                <p style="color: #666; font-size: 14px;"><em>This is a preview of your changes - not yet saved</em></p>
            </body>
            </html>
        `);
    }

    // Save as draft
    function saveDraft() {
        const form = document.getElementById('pageForm');
        const statusField = form.querySelector('select[name="status"]');
        statusField.value = 'draft';

        // Show loading state
        const draftBtn = event.target;
        const originalContent = draftBtn.innerHTML;
        draftBtn.innerHTML = '<i class="fas fa-spinner loading-spinner mr-2"></i>Saving Draft...';
        draftBtn.disabled = true;

        // Submit form
        form.submit();
    }

    // Form submission enhancement
    document.getElementById('pageForm').addEventListener('submit', function(e) {
        const title = document.getElementById('pageTitle').value.trim();
        const slug = document.getElementById('pageSlug').value.trim();
        const content = tinymce.get('contentEditor').getContent().trim();

        // Validation
        if (!title) {
            alert('⚠️ Please enter a page title!');
            e.preventDefault();
            return;
        }

        if (!slug) {
            alert('⚠️ Please enter a page slug!');
            e.preventDefault();
            return;
        }

        if (!content || content === '<p></p>' || content === '') {
            alert('⚠️ Please add some content to your page!');
            e.preventDefault();
            return;
        }

        // Check if slug is invalid
        const slugInput = document.getElementById('pageSlug');
        if (slugInput.classList.contains('slug-invalid')) {
            alert('⚠️ Please choose a different slug - this one already exists!');
            e.preventDefault();
            return;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner loading-spinner mr-2"></i>Saving Changes...';
        submitBtn.disabled = true;

        // If validation passes, form will submit naturally
    });

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Set up event listeners
        document.getElementById('pageSlug').addEventListener('input', checkSlugUniqueness);
        document.getElementById('metaDescription').addEventListener('input', updateMetaCounter);

        // Initialize meta counter
        updateMetaCounter();

        // Add form change tracking
        let formChanged = false;
        const form = document.getElementById('pageForm');

        form.addEventListener('input', function() {
            formChanged = true;
        });

        // Warn before leaving if unsaved changes
        window.addEventListener('beforeunload', function(e) {
            if (formChanged) {
                e.preventDefault();
                e.returnValue = '';
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl+S or Cmd+S to save
            if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                e.preventDefault();
                document.getElementById('pageForm').submit();
            }

            // Ctrl+P or Cmd+P to preview
            if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
                e.preventDefault();
                previewPage();
            }
        });
    });
</script>