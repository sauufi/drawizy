<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Create New Page</h1>
    <form action="/admin/pages" method="post">
        <input type="text" name="title" placeholder="Page title" class="border p-2 w-full mb-4" required>
        <textarea id="contentEditor" name="content" class="border p-2 w-full h-60 mb-4"></textarea>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/7zr8q2qslb6wuby2zyescyf4eex8o1meaf5ysod973ubos3z/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#contentEditor',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
        height: 300
    });
</script>