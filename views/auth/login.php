<div class="max-w-md mx-auto bg-white shadow rounded p-6">
    <h1 class="text-2xl font-bold mb-4">Login Admin</h1>
    <?php if (isset($error)): ?>
        <p class="text-red-500 mb-4"><?= $error ?></p>
    <?php endif; ?>
    <form method="post" action="/login">
        <input type="text" name="username" placeholder="Username" class="border p-2 w-full mb-3" required>
        <input type="password" name="password" placeholder="Password" class="border p-2 w-full mb-4" required>
        <button class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
    </form>
</div>