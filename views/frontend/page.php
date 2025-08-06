<!-- Hero Section -->
<div class="text-center mb-12 relative">
    <div class="absolute inset-0 bg-gradient-to-r from-pink-100 via-purple-100 to-blue-100 rounded-3xl opacity-60"></div>
    <div class="relative z-10 py-12">
        <h1 class="text-5xl md:text-6xl font-kids text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500 mb-6">
            🎨 <?= htmlspecialchars($page['title']) ?> 🌟
        </h1>
    </div>
</div>

<!-- Page Section -->
<div class="max-w-6xl mx-auto mb-16">
    <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl p-8 shadow-xl border-4 border-white relative overflow-hidden">
        <div class="absolute top-4 right-4 text-5xl opacity-10">📋</div>
        <div class="absolute bottom-4 left-4 text-4xl opacity-10">⚖️</div>

        <div class="relative z-10">
            <div class="space-y-4 text-gray-700 font-semibold leading-relaxed">
                <?= $page['content'] ?>
            </div>
        </div>
    </div>
</div>