<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Page</h1>
    <form action="/admin/pages/update/<?= $page['id'] ?>" method="post">
        <label class="block mb-2">Title</label>
        <input type="text" id="pageTitle" name="title" value="<?= htmlspecialchars($page['title']) ?>" class="border p-2 w-full mb-4" required>

        <label class="block mb-2">Slug</label>
        <input type="text" id="pageSlug" name="slug" value="<?= htmlspecialchars($page['slug']) ?>" class="border p-2 w-full mb-4" required>
        <div id="slugWarningPage" class="text-red-500 text-sm hidden">This slug already exists!</div>

        <label class="block mb-2">Content</label>
        <textarea id="contentEditor" name="content" class="border p-2 w-full h-60 mb-4" required><?= htmlspecialchars($page['content']) ?></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Changes</button>
    </form>
</div>

<!-- TinyMCE for WYSIWYG -->
<script src="https://cdn.tiny.cloud/1/7zr8q2qslb6wuby2zyescyf4eex8o1meaf5ysod973ubos3z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#contentEditor',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
        height: 300
    });

    // Auto-generate slug
    document.getElementById('pageTitle').addEventListener('input', function() {
        const slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('pageSlug').value = slug;
    });

    // Check slug uniqueness
    document.getElementById('pageSlug').addEventListener('blur', function() {
        fetch('/admin/pages/check-slug?slug=' + encodeURIComponent(this.value) + '&id=<?= $page['id'] ?>')
            .then(r => r.json())
            .then(data => {
                const w = document.getElementById('slugWarningPage');
                data.unique ? w.classList.add('hidden') : w.classList.remove('hidden');
            });
    });
</script>