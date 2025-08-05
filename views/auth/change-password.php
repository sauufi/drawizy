<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Ganti Password</h1>
    <?php if (isset($error)): ?>
        <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p class="text-green-500 mb-4"><?= $success ?></p>
    <?php endif; ?>
    <form method="post" action="/admin/change-password">
        <input type="password" name="current_password" placeholder="Password lama" class="border p-2 w-full mb-3" required>
        <input type="password" name="new_password" placeholder="Password baru" class="border p-2 w-full mb-3" required>
        <input type="password" name="confirm_password" placeholder="Konfirmasi password baru" class="border p-2 w-full mb-4" required>
        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Simpan</button>
    </form>
</div>