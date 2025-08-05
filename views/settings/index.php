<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Pengaturan Situs</h1>
    <form action="/admin/settings" method="post" enctype="multipart/form-data">
        <label class="block mb-2">Judul Website</label>
        <input type="text" name="site_title" value="<?= htmlspecialchars($setting['site_title']) ?>" class="border p-2 w-full mb-4" required>

        <label class="block mb-2">Deskripsi Website</label>
        <textarea name="site_description" class="border p-2 w-full mb-4"><?= htmlspecialchars($setting['site_description']) ?></textarea>

        <label class="block mb-2">Logo Website</label>
        <?php if ($setting['site_logo']): ?>
            <img src="/uploads/<?= $setting['site_logo'] ?>" alt="Logo" class="h-16 mb-2">
        <?php endif; ?>
        <input type="file" name="site_logo" class="border p-2 w-full mb-4" accept="image/*">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Perubahan</button>
    </form>
</div>