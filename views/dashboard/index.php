<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-10">
    <!-- Total Images Card -->
    <div class="colorful-card border-l-pink-400 kids-shadow hover-bounce rounded-2xl p-6 transform transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Images</p>
                <h1 class="text-4xl font-bold text-gray-800 mt-2"><?= $imageCount ?></h1>
                <p class="text-pink-500 text-sm mt-1">
                    <i class="fas fa-images mr-1"></i>Coloring Collection
                </p>
            </div>
            <div class="stats-icon rounded-full p-4 kids-shadow">
                <i class="fas fa-images text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Categories Card -->
    <div class="colorful-card border-l-blue-400 kids-shadow hover-bounce rounded-2xl p-6 transform transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Categories</p>
                <h1 class="text-4xl font-bold text-gray-800 mt-2"><?= $categoryCount ?></h1>
                <p class="text-blue-500 text-sm mt-1">
                    <i class="fas fa-tags mr-1"></i>Different Themes
                </p>
            </div>
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-full p-4 kids-shadow">
                <i class="fas fa-tags text-white text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Total Downloadss Card -->
    <div class="colorful-card border-l-green-400 kids-shadow hover-bounce rounded-2xl p-6 transform transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Downloads</p>
                <h1 class="text-4xl font-bold text-gray-800 mt-2"><?= $downloadCount ?></h1>
                <p class="text-green-500 text-sm mt-1">
                    <i class="fas fa-download mr-1"></i>Kids Downloads
                </p>
            </div>
            <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-full p-4 kids-shadow">
                <i class="fas fa-download text-white text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Statistics Panel -->
<div class="bg-white kids-shadow rounded-3xl p-8 mb-8 border-t-4 border-purple-400">
    <div class="flex items-center mb-6">
        <div class="bg-gradient-to-r from-purple-400 to-pink-400 rounded-full p-3 mr-4">
            <i class="fas fa-chart-bar text-white text-xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Image Statistics per Category</h2>
            <p class="text-gray-600">View coloring image distribution by category</p>
        </div>
    </div>

    <!-- Stats Table -->
    <div class="mb-8 overflow-hidden rounded-2xl border border-gray-200">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                <tr>
                    <th class="p-4 text-left font-semibold">
                        <i class="fas fa-tag mr-2"></i>Category
                    </th>
                    <th class="p-4 text-right font-semibold">
                        <i class="fas fa-images mr-2"></i>Number of Images
                    </th>
                    <th class="p-4 text-center font-semibold">
                        <i class="fas fa-chart-pie mr-2"></i>Status
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach ($stats as $index => $row): ?>
                    <tr class="border-t border-gray-100 hover:bg-purple-50 transition-colors duration-200">
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="w-4 h-4 rounded-full mr-3 <?=
                                                                        $index % 4 == 0 ? 'bg-pink-400' : ($index % 4 == 1 ? 'bg-blue-400' : ($index % 4 == 2 ? 'bg-green-400' : 'bg-yellow-400'))
                                                                        ?>"></div>
                                <span class="font-medium text-gray-800"><?= $row['name'] ?></span>
                            </div>
                        </td>
                        <td class="p-4 text-right">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                <?= $row['total'] ?>
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <?php if ($row['total'] > 10): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i>Complete
                                </span>
                            <?php elseif ($row['total'] > 5): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i>In Progress
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i class="fas fa-plus-circle mr-1"></i>Needs to be Added
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Chart Section -->
    <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-chart-bar text-purple-500 mr-2"></i>
                Distribution Chart
            </h3>
            <div class="flex space-x-2">
                <button onclick="updateChart('bar')" class="px-3 py-1 bg-purple-500 text-white rounded-lg text-sm hover:bg-purple-600 transition-colors">
                    <i class="fas fa-chart-bar mr-1"></i>Bar
                </button>
                <button onclick="updateChart('doughnut')" class="px-3 py-1 bg-pink-500 text-white rounded-lg text-sm hover:bg-pink-600 transition-colors">
                    <i class="fas fa-chart-pie mr-1"></i>Pie
                </button>
            </div>
        </div>
        <div class="bg-white rounded-xl p-4 kids-shadow">
            <canvas id="categoryChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <a href="/dashboard/images/add" class="group bg-white rounded-2xl p-6 kids-shadow hover-bounce text-center transition-all duration-300 hover:bg-gradient-to-br hover:from-pink-500 hover:to-purple-600 hover:text-white">
        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">🎨</div>
        <h3 class="font-semibold text-gray-800 group-hover:text-white">Add Image</h3>
        <p class="text-sm text-gray-600 group-hover:text-purple-100 mt-1">Upload new image</p>
    </a>

    <a href="/dashboard/categories/add" class="group bg-white rounded-2xl p-6 kids-shadow hover-bounce text-center transition-all duration-300 hover:bg-gradient-to-br hover:from-blue-500 hover:to-cyan-600 hover:text-white">
        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">📂</div>
        <h3 class="font-semibold text-gray-800 group-hover:text-white">Add Category</h3>
        <p class="text-sm text-gray-600 group-hover:text-blue-100 mt-1">New Category</p>
    </a>

    <a href="/dashboard/settings" class="group bg-white rounded-2xl p-6 kids-shadow hover-bounce text-center transition-all duration-300 hover:bg-gradient-to-br hover:from-green-500 hover:to-emerald-600 hover:text-white">
        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">⚙️</div>
        <h3 class="font-semibold text-gray-800 group-hover:text-white">Settings</h3>
        <p class="text-sm text-gray-600 group-hover:text-green-100 mt-1">System Configuration</p>
    </a>

    <a href="/dashboard/users" class="group bg-white rounded-2xl p-6 kids-shadow hover-bounce text-center transition-all duration-300 hover:bg-gradient-to-br hover:from-yellow-500 hover:to-orange-600 hover:text-white">
        <div class="text-4xl mb-3 group-hover:scale-110 transition-transform">👥</div>
        <h3 class="font-semibold text-gray-800 group-hover:text-white">Manage Users</h3>
        <p class="text-sm text-gray-600 group-hover:text-yellow-100 mt-1">User Management</p>
    </a>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('categoryChart').getContext('2d');
    const chartData = {
        labels: <?= json_encode(array_column($stats, 'name')) ?>,
        datasets: [{
            label: 'Number of Images',
            data: <?= json_encode(array_column($stats, 'total')) ?>,
            backgroundColor: [
                'rgba(236, 72, 153, 0.7)', // Pink
                'rgba(59, 130, 246, 0.7)', // Blue  
                'rgba(34, 197, 94, 0.7)', // Green
                'rgba(251, 191, 36, 0.7)', // Yellow
                'rgba(139, 92, 246, 0.7)', // Purple
                'rgba(239, 68, 68, 0.7)', // Red
                'rgba(20, 184, 166, 0.7)', // Teal
                'rgba(249, 115, 22, 0.7)', // Orange
            ],
            borderColor: [
                'rgba(236, 72, 153, 1)',
                'rgba(59, 130, 246, 1)',
                'rgba(34, 197, 94, 1)',
                'rgba(251, 191, 36, 1)',
                'rgba(139, 92, 246, 1)',
                'rgba(239, 68, 68, 1)',
                'rgba(20, 184, 166, 1)',
                'rgba(249, 115, 22, 1)',
            ],
            borderWidth: 2,
            borderRadius: 8,
            borderSkipped: false,
        }]
    };

    let categoryChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        color: '#6B7280'
                    },
                    grid: {
                        color: 'rgba(156, 163, 175, 0.3)'
                    }
                },
                x: {
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutBounce'
            }
        }
    });

    function updateChart(type) {
        categoryChart.destroy();
        categoryChart = new Chart(ctx, {
            type: type,
            data: chartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: type === 'doughnut',
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            font: {
                                size: 12
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        titleColor: 'white',
                        bodyColor: 'white',
                        borderColor: 'rgba(255, 255, 255, 0.2)',
                        borderWidth: 1,
                        cornerRadius: 8,
                    }
                },
                scales: type === 'bar' ? {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#6B7280'
                        },
                        grid: {
                            color: 'rgba(156, 163, 175, 0.3)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            display: false
                        }
                    }
                } : {},
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    }

    // Fun animations on page load
    window.addEventListener('load', function() {
        const cards = document.querySelectorAll('.hover-bounce');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transform = 'translateY(-5px)';
                setTimeout(() => {
                    card.style.transform = 'translateY(0)';
                }, 200);
            }, index * 100);
        });
    });
</script>