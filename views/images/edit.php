<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Image</h1>
    <form action="/admin/images/update/<?= $image['id'] ?>" method="post" enctype="multipart/form-data">
        <label class="block mb-2">Title</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($image['title']) ?>" class="border p-2 w-full mb-4" required>

        <label class="block mb-2">Slug</label>
        <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($image['slug']) ?>" class="border p-2 w-full mb-4" required>
        <div id="slugWarning" class="text-red-500 mb-4 hidden">This slug already exists!</div>

        <label class="block mb-2">Category</label>
        <select name="category_id" class="border p-2 w-full mb-4" required>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>" <?= $c['id'] == $image['category_id'] ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label class="block mb-2">Meta Title</label>
        <input type="text" name="meta_title" value="<?= htmlspecialchars($image['meta_title'] ?? '') ?>" class="border p-2 w-full mb-4">

        <label class="block mb-2">Meta Description</label>
        <textarea name="meta_description" class="border p-2 w-full mb-4"><?= htmlspecialchars($image['meta_description'] ?? '') ?></textarea>

        <label class="block mb-2">PDF File</label>
        <?php if ($image['filename']): ?>
            <a href="/uploads/<?= $image['filename'] ?>" target="_blank" class="text-blue-500 underline"><?= $image['filename'] ?></a>
        <?php endif; ?>
        <input type="file" name="pdf_file" class="border p-2 w-full mb-4">
        <input type="hidden" name="existing_filename" value="<?= htmlspecialchars($image['filename']) ?>">

        <label class="block mb-2">Thumbnail Image</label>
        <?php if ($image['preview']): ?>
            <img src="/uploads/<?= $image['preview'] ?>" alt="Preview" class="w-24 h-24 object-cover rounded mb-2">
        <?php endif; ?>
        <input type="file" name="thumb_file" class="border p-2 w-full mb-4">
        <input type="hidden" name="existing_preview" value="<?= htmlspecialchars($image['preview']) ?>">

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>

<script>
    document.getElementById('title').addEventListener('input', function() {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });
    document.getElementById('slug').addEventListener('blur', function() {
        fetch('/admin/images/check-slug?slug=' + encodeURIComponent(this.value) + '&id=<?= $image['id'] ?>')
            .then(res => res.json())
            .then(data => {
                const warning = document.getElementById('slugWarning');
                data.unique ? warning.classList.add('hidden') : warning.classList.remove('hidden');
            });
    });
</script>