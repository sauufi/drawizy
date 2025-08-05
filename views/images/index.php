<div class="flex justify-between mb-4">
    <h1 class="text-2xl font-bold">Daftar Gambar</h1>
    <a href="/admin/images/create" class="bg-blue-500 text-white px-4 py-2 rounded">Upload Baru</a>
</div>
<div class="bg-white shadow rounded">
    <table class="w-full">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2">Gambar</th>
                <th class="p-2">Judul</th>
                <th class="p-2">Kategori</th>
                <th class="p-2">Download</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($images as $img): ?>
                <tr class="border-t">
                    <td class="p-2"><img src="/uploads/<?= $img['preview'] ?>" class="h-16"></td>
                    <td class="p-2"><?= $img['title'] ?></td>
                    <td class="p-2"><?= $img['category_name'] ?></td>
                    <td class="p-2"><?= $img['downloads'] ?></td>
                    <td class="p-2">
                        <a href="/admin/images/edit/<?= $img['id'] ?>" class="text-blue-500 hover:underline">Edit</a>
                        <a href="/admin/images/delete/<?= $img['id'] ?>" class="text-red-500 hover:underline ml-2" onclick="return confirm('Delete this image?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>