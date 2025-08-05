<div class="bg-white p-6 shadow rounded max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Manajemen User</h1>
    <form action="/admin/users" method="post" class="mb-4 flex space-x-2">
        <input type="text" name="username" placeholder="Username" required class="border p-2 flex-1">
        <input type="password" name="password" placeholder="Password" required class="border p-2 flex-1">
        <select name="role" class="border p-2" required>
            <option value="editor">Editor</option>
            <option value="admin">Admin</option>
        </select>
        <button class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
    </form>
    <table class="w-full border">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Username</th>
                <th class="p-2 text-left">Role</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-t">
                    <td class="p-2"><?= $user['username'] ?></td>
                    <td class="p-2"><?= ucfirst($user['role']) ?></td>
                    <td class="p-2 text-center">
                        <a href="/admin/users/delete/<?= $user['id'] ?>" class="text-red-500 hover:underline" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>