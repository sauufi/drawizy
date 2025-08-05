<div class="bg-white p-6 shadow rounded">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Static Pages</h1>
        <a href="/admin/pages/create" class="bg-blue-500 text-white px-4 py-2 rounded">Add New</a>
    </div>
    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Title</th>
                <th class="p-2 text-left">Slug</th>
                <th class="p-2 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pages as $p): ?>
                <tr class="border-t">
                    <td class="p-2"><?= $p['title'] ?></td>
                    <td class="p-2"><?= $p['slug'] ?></td>
                    <td class="p-2 text-center">
                        <a href="/admin/pages/edit/<?= $p['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="/admin/pages/delete/<?= $p['id'] ?>" class="text-red-500 hover:underline ml-2" onclick="return confirm('Delete this page?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>