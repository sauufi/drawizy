<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Edit Category</h1>
    <form action="/admin/categories/update/<?= $category['id'] ?>" method="post">
        <label class="block mb-2">Name</label>
        <input type="text" name="name" class="border p-2 w-full mb-4"
            value="<?= htmlspecialchars($category['name']) ?>" required>

        <label class="block mb-2">Slug</label>
        <input type="text" name="slug" class="border p-2 w-full mb-4"
            value="<?= htmlspecialchars($category['slug']) ?>">

        <label class="block mb-2">Description</label>
        <textarea name="description" class="border p-2 w-full mb-4"><?= htmlspecialchars($category['description']) ?></textarea>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
</div>