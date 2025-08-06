<div class="max-w-6xl mx-auto">
    <!-- Pages Management Header -->
    <div class="bg-white kids-shadow rounded-2xl p-8 mb-8 transform hover:scale-[1.02] transition-all duration-300">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="text-center md:text-left mb-6 md:mb-0">
                <div class="bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full p-4 w-20 h-20 mx-auto md:mx-0 mb-4 kids-shadow">
                    <i class="fas fa-file-alt text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Static Pages</h1>
                <p class="text-gray-600">Manage your website's static content pages 📄</p>
            </div>

            <div class="flex flex-col items-center space-y-3">
                <div class="text-sm text-gray-500">
                    Total Pages: <span class="font-semibold text-gray-700"><?= count($pages) ?></span>
                </div>
                <a href="/admin/pages/create"
                    class="bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 kids-shadow hover:shadow-lg flex items-center space-x-2">
                    <i class="fas fa-plus"></i>
                    <span>Add New Page</span>
                    <span>✨</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Search and Filter Section -->
    <div class="bg-white kids-shadow rounded-2xl p-6 mb-8">
        <div class="flex flex-col md:flex-row gap-4 items-center">
            <div class="flex-1">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text"
                        id="searchPages"
                        placeholder="Search pages by title or slug..."
                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-300">
                </div>
            </div>
            <div class="flex space-x-3">
                <select id="sortBy" class="border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all">
                    <option value="title">Sort by Title</option>
                    <option value="slug">Sort by Slug</option>
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
                <button onclick="toggleView()"
                    id="viewToggle"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-3 rounded-xl transition-all duration-300 flex items-center space-x-2">
                    <i class="fas fa-th" id="viewIcon"></i>
                    <span id="viewText">Grid View</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Pages Content -->
    <div class="bg-white kids-shadow rounded-2xl p-8">
        <!-- Table View (Default) -->
        <div id="tableView">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                            <th class="text-left p-4 font-bold text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-heading text-blue-500"></i>
                                    <span>Title</span>
                                </div>
                            </th>
                            <th class="text-left p-4 font-bold text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-link text-green-500"></i>
                                    <span>Slug</span>
                                </div>
                            </th>
                            <th class="text-left p-4 font-bold text-gray-700">
                                <div class="flex items-center space-x-2">
                                    <i class="fas fa-eye text-purple-500"></i>
                                    <span>Status</span>
                                </div>
                            </th>
                            <th class="text-center p-4 font-bold text-gray-700">
                                <div class="flex items-center justify-center space-x-2">
                                    <i class="fas fa-cogs text-orange-500"></i>
                                    <span>Actions</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="pagesTableBody">
                        <?php foreach ($pages as $index => $p): ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-200 page-row"
                                data-title="<?= strtolower($p['title']) ?>"
                                data-slug="<?= strtolower($p['slug']) ?>">
                                <td class="p-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-gradient-to-r from-blue-400 to-indigo-500 rounded-lg p-2 text-white">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-800"><?= htmlspecialchars($p['title']) ?></div>
                                            <div class="text-sm text-gray-500">Page ID: #<?= $p['id'] ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center space-x-2">
                                        <code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono"><?= htmlspecialchars($p['slug']) ?></code>
                                        <button onclick="copyToClipboard('<?= htmlspecialchars($p['slug']) ?>')"
                                            class="text-gray-400 hover:text-blue-500 transition-colors"
                                            title="Copy slug">
                                            <i class="fas fa-copy text-xs"></i>
                                        </button>
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        <a href="/page/<?= htmlspecialchars($p['slug']) ?>"
                                            target="_blank"
                                            class="text-blue-500 hover:underline flex items-center space-x-1">
                                            <i class="fas fa-external-link-alt"></i>
                                            <span>View Live</span>
                                        </a>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Published
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="/admin/pages/edit/<?= $p['id'] ?>"
                                            class="bg-blue-100 hover:bg-blue-200 text-blue-700 hover:text-blue-800 font-semibold py-2 px-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-1"
                                            title="Edit page">
                                            <i class="fas fa-edit"></i>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        <button onclick="deletePage(<?= $p['id'] ?>, '<?= htmlspecialchars($p['title']) ?>')"
                                            class="bg-red-100 hover:bg-red-200 text-red-700 hover:text-red-800 font-semibold py-2 px-3 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-1"
                                            title="Delete page">
                                            <i class="fas fa-trash-alt"></i>
                                            <span class="hidden sm:inline">Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Grid View -->
        <div id="gridView" class="hidden">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" id="pagesGridContainer">
                <?php foreach ($pages as $p): ?>
                    <div class="page-card bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 border-2 border-gray-100 hover:border-blue-200 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1"
                        data-title="<?= strtolower($p['title']) ?>"
                        data-slug="<?= strtolower($p['slug']) ?>">

                        <!-- Card Header -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="bg-gradient-to-r from-blue-400 to-indigo-500 rounded-lg p-3 text-white">
                                <i class="fas fa-file-alt text-xl"></i>
                            </div>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                <i class="fas fa-check-circle mr-1"></i>
                                Published
                            </span>
                        </div>

                        <!-- Page Info -->
                        <div class="mb-4">
                            <h3 class="font-bold text-gray-800 text-lg mb-2"><?= htmlspecialchars($p['title']) ?></h3>
                            <div class="flex items-center space-x-2 mb-2">
                                <code class="bg-gray-100 px-2 py-1 rounded text-sm font-mono flex-1"><?= htmlspecialchars($p['slug']) ?></code>
                                <button onclick="copyToClipboard('<?= htmlspecialchars($p['slug']) ?>')"
                                    class="text-gray-400 hover:text-blue-500 transition-colors p-1"
                                    title="Copy slug">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <p class="text-sm text-gray-500">ID: #<?= $p['id'] ?></p>
                        </div>

                        <!-- Quick Actions -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="/page/<?= htmlspecialchars($p['slug']) ?>"
                                target="_blank"
                                class="text-blue-500 hover:text-blue-600 text-sm flex items-center space-x-1 transition-colors">
                                <i class="fas fa-external-link-alt"></i>
                                <span>View Live</span>
                            </a>
                            <div class="flex space-x-2">
                                <a href="/admin/pages/edit/<?= $p['id'] ?>"
                                    class="bg-blue-100 hover:bg-blue-200 text-blue-700 p-2 rounded-lg transition-all duration-300 transform hover:scale-110"
                                    title="Edit page">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="deletePage(<?= $p['id'] ?>, '<?= htmlspecialchars($p['title']) ?>')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-all duration-300 transform hover:scale-110"
                                    title="Delete page">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Empty State -->
        <?php if (empty($pages)): ?>
            <div class="text-center py-12">
                <i class="fas fa-file-alt text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Pages Found</h3>
                <p class="text-gray-500 mb-6">Start by creating your first static page!</p>
                <a href="/admin/pages/create"
                    class="bg-gradient-to-r from-emerald-500 to-green-500 hover:from-emerald-600 hover:to-green-600 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 kids-shadow hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i>
                    Create Your First Page
                </a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Quick Stats -->
    <div class="mt-8 grid md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 rounded-2xl p-6 text-white kids-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Pages</p>
                    <p class="text-2xl font-bold"><?= count($pages) ?></p>
                </div>
                <i class="fas fa-file-alt text-3xl text-blue-200"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl p-6 text-white kids-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Published</p>
                    <p class="text-2xl font-bold"><?= count($pages) ?></p>
                </div>
                <i class="fas fa-check-circle text-3xl text-green-200"></i>
            </div>
        </div>

        <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl p-6 text-white kids-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Last Updated</p>
                    <p class="text-lg font-bold">Recently</p>
                </div>
                <i class="fas fa-clock text-3xl text-purple-200"></i>
            </div>
        </div>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .page-row:hover {
        transform: translateX(5px);
        transition: transform 0.2s ease;
    }

    .page-card {
        transition: all 0.3s ease;
    }

    .page-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    /* Animation for page cards */
    .page-card {
        animation: fadeInUp 0.6s ease-in-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Search highlight */
    .search-highlight {
        background-color: #fef3cd;
        padding: 2px 4px;
        border-radius: 3px;
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

<script>
    let currentView = 'table';

    // Toggle between table and grid view
    function toggleView() {
        const tableView = document.getElementById('tableView');
        const gridView = document.getElementById('gridView');
        const viewIcon = document.getElementById('viewIcon');
        const viewText = document.getElementById('viewText');

        if (currentView === 'table') {
            tableView.classList.add('hidden');
            gridView.classList.remove('hidden');
            viewIcon.className = 'fas fa-list';
            viewText.textContent = 'Table View';
            currentView = 'grid';
        } else {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            viewIcon.className = 'fas fa-th';
            viewText.textContent = 'Grid View';
            currentView = 'table';
        }
    }

    // Search functionality
    document.getElementById('searchPages').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const tableRows = document.querySelectorAll('.page-row');
        const gridCards = document.querySelectorAll('.page-card');

        // Filter table rows
        tableRows.forEach(row => {
            const title = row.dataset.title;
            const slug = row.dataset.slug;
            const isVisible = title.includes(searchTerm) || slug.includes(searchTerm);
            row.style.display = isVisible ? '' : 'none';
        });

        // Filter grid cards
        gridCards.forEach(card => {
            const title = card.dataset.title;
            const slug = card.dataset.slug;
            const isVisible = title.includes(searchTerm) || slug.includes(searchTerm);
            card.style.display = isVisible ? '' : 'none';
        });
    });

    // Sort functionality
    document.getElementById('sortBy').addEventListener('change', function(e) {
        const sortBy = e.target.value;
        // Implementation for sorting - would need actual data to sort properly
        console.log('Sorting by:', sortBy);
    });

    // Copy to clipboard function
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success feedback
            const button = event.target.closest('button');
            const originalIcon = button.querySelector('i').className;
            button.querySelector('i').className = 'fas fa-check text-green-500';

            setTimeout(() => {
                button.querySelector('i').className = originalIcon;
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
        });
    }

    // Enhanced delete confirmation
    function deletePage(pageId, pageTitle) {
        const confirmDelete = confirm(`🗑️ Are you sure you want to delete the page "${pageTitle}"?\n\nThis action cannot be undone!`);

        if (confirmDelete) {
            // Show loading state
            const deleteBtn = event.target.closest('button');
            const originalContent = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            deleteBtn.disabled = true;

            // Redirect to delete URL
            window.location.href = `/admin/pages/delete/${pageId}`;
        }
    }

    // Initialize page animations
    document.addEventListener('DOMContentLoaded', function() {
        // Stagger animation for table rows
        const rows = document.querySelectorAll('.page-row');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 100);
        });

        // Stagger animation for grid cards
        const cards = document.querySelectorAll('.page-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Show success message if page was created/updated
    if (window.location.search.includes('success')) {
        const successDiv = document.createElement('div');
        successDiv.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-bounce';
        successDiv.innerHTML = `
            <div class="flex items-center space-x-2">
                <i class="fas fa-check-circle"></i>
                <span>✅ Page saved successfully!</span>
            </div>
        `;

        document.body.appendChild(successDiv);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }
</script>