<div class="max-w-6xl mx-auto">
    <!-- User Management Header -->
    <div class="bg-white kids-shadow rounded-2xl p-8 mb-8 transform hover:scale-[1.02] transition-all duration-300">
        <div class="text-center">
            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full p-4 w-20 h-20 mx-auto mb-4 kids-shadow">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">User Management</h1>
            <p class="text-gray-600">Manage your team members and their permissions 👥</p>
        </div>
    </div>

    <!-- Add New User Form -->
    <div class="bg-white kids-shadow rounded-2xl p-8 mb-8">
        <div class="mb-6">
            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-user-plus text-emerald-500 mr-3"></i>
                Add New User
            </h2>
            <p class="text-gray-600 mt-2">Create a new user account with appropriate permissions</p>
        </div>

        <form action="/dashboard/users" method="post" class="space-y-6" id="userForm">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Username Field -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-user text-blue-500"></i>
                        <span>Username</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                        name="username"
                        placeholder="Enter username"
                        required
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-blue-400 focus:ring-2 focus:ring-blue-100 transition-all duration-300 hover:border-blue-300">
                    <p class="text-xs text-gray-500 mt-2">Unique identifier for the user</p>
                </div>

                <!-- Password Field -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-lock text-purple-500"></i>
                        <span>Password</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="password"
                        name="password"
                        placeholder="Enter password"
                        required
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-purple-400 focus:ring-2 focus:ring-purple-100 transition-all duration-300 hover:border-purple-300">
                    <p class="text-xs text-gray-500 mt-2">Minimum 8 characters recommended</p>
                </div>

                <!-- Role Selection -->
                <div class="form-field">
                    <label class="flex items-center space-x-2 text-gray-700 font-semibold mb-3">
                        <i class="fas fa-shield-alt text-green-500"></i>
                        <span>Role</span>
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="role"
                        required
                        class="w-full border-2 border-gray-200 rounded-xl p-4 focus:border-green-400 focus:ring-2 focus:ring-green-100 transition-all duration-300 hover:border-green-300">
                        <option value="" disabled selected>Select role</option>
                        <option value="editor">👨‍💼 Editor</option>
                        <option value="admin">👑 Admin</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-2">Define user permissions</p>
                </div>

                <!-- Submit Button -->
                <div class="form-field flex items-center">
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 kids-shadow hover:shadow-lg flex items-center justify-center mt-2 space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>Add User</span>
                        <span>✨</span>
                    </button>
                </div>
            </div>

            <!-- Role Information -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-400 mt-1"></i>
                    <div>
                        <p class="text-blue-700 font-semibold mb-2">Role Permissions:</p>
                        <div class="grid md:grid-cols-2 gap-4 text-blue-600 text-sm">
                            <div>
                                <strong>👨‍💼 Editor:</strong>
                                <ul class="mt-1 space-y-1">
                                    <li>• Manage categories and images</li>
                                    <li>• Upload and edit content</li>
                                    <li>• Change own password</li>
                                </ul>
                            </div>
                            <div>
                                <strong>👑 Admin:</strong>
                                <ul class="mt-1 space-y-1">
                                    <li>• Full system access</li>
                                    <li>• Manage users and settings</li>
                                    <li>• System configuration</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Users List -->
    <div class="bg-white kids-shadow rounded-2xl p-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list text-purple-500 mr-3"></i>
                    Current Users
                </h2>
                <p class="text-gray-600 mt-2">Manage existing user accounts</p>
            </div>
            <div class="text-sm text-gray-500">
                Total Users: <span class="font-semibold text-gray-700"><?= count($users) ?></span>
            </div>
        </div>

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
                        <th class="text-left p-4 font-bold text-gray-700">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-user text-blue-500"></i>
                                <span>Username</span>
                            </div>
                        </th>
                        <th class="text-left p-4 font-bold text-gray-700">
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-shield-alt text-green-500"></i>
                                <span>Role</span>
                            </div>
                        </th>
                        <th class="text-center p-4 font-bold text-gray-700">
                            <div class="flex items-center justify-center space-x-2">
                                <i class="fas fa-cogs text-purple-500"></i>
                                <span>Actions</span>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition-all duration-200 user-row">
                            <td class="p-4">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-gradient-to-r from-blue-400 to-purple-500 rounded-full p-2 text-white text-sm font-bold w-10 h-10 flex items-center justify-center">
                                        <?= strtoupper(substr($user['username'], 0, 2)) ?>
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['username']) ?></div>
                                        <div class="text-sm text-gray-500">User ID: #<?= $user['id'] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <?php if ($user['role'] === 'admin'): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                        <i class="fas fa-crown mr-1"></i>
                                        Admin
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <i class="fas fa-user-edit mr-1"></i>
                                        Editor
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 text-center">
                                <button onclick="deleteUser(<?= $user['id'] ?>, '<?= htmlspecialchars($user['username']) ?>')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 hover:text-red-800 font-semibold py-2 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 mx-auto">
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Delete</span>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Mobile Card View -->
        <div class="md:hidden space-y-4">
            <?php foreach ($users as $user): ?>
                <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-4 border border-gray-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-gradient-to-r from-blue-400 to-purple-500 rounded-full p-2 text-white text-sm font-bold w-12 h-12 flex items-center justify-center">
                                <?= strtoupper(substr($user['username'], 0, 2)) ?>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800"><?= htmlspecialchars($user['username']) ?></div>
                                <div class="text-sm text-gray-500">ID: #<?= $user['id'] ?></div>
                                <?php if ($user['role'] === 'admin'): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800 mt-1">
                                        <i class="fas fa-crown mr-1"></i>Admin
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 mt-1">
                                        <i class="fas fa-user-edit mr-1"></i>Editor
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <button onclick="deleteUser(<?= $user['id'] ?>, '<?= htmlspecialchars($user['username']) ?>')"
                            class="bg-red-100 hover:bg-red-200 text-red-700 p-2 rounded-lg transition-all duration-300">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (empty($users)): ?>
            <div class="text-center py-12">
                <i class="fas fa-users text-gray-300 text-6xl mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Users Found</h3>
                <p class="text-gray-500">Start by adding your first user above!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .kids-shadow {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .form-field:focus-within {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    .form-field input:focus,
    .form-field select:focus {
        transform: scale(1.01);
    }

    .user-row:hover {
        transform: translateX(5px);
        transition: transform 0.2s ease;
    }

    /* Button ripple effect */
    @keyframes ripple {
        0% {
            transform: scale(0);
            opacity: 1;
        }

        100% {
            transform: scale(4);
            opacity: 0;
        }
    }

    button:active::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        background: white;
        transform: scale(0);
        animation: ripple 0.6s linear;
        left: 50%;
        top: 50%;
    }

    /* Custom animations */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Role badge animations */
    .role-badge {
        transition: all 0.3s ease;
    }

    .role-badge:hover {
        transform: scale(1.1);
    }
</style>

<script>
    // Enhanced delete confirmation
    function deleteUser(userId, username) {
        // Custom confirmation dialog
        const confirmDelete = confirm(`🗑️ Are you sure you want to delete user "${username}"?\n\nThis action cannot be undone!`);

        if (confirmDelete) {
            // Show loading state
            const deleteBtn = event.target.closest('button');
            const originalContent = deleteBtn.innerHTML;
            deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Deleting...';
            deleteBtn.disabled = true;

            // Redirect to delete URL
            window.location.href = `/dashboard/users/delete/${userId}`;
        }
    }

    // Form validation and enhancement
    document.getElementById('userForm').addEventListener('submit', function(e) {
        const username = this.querySelector('input[name="username"]').value;
        const password = this.querySelector('input[name="password"]').value;
        const role = this.querySelector('select[name="role"]').value;

        // Basic validation
        if (username.length < 3) {
            alert('⚠️ Username must be at least 3 characters long!');
            e.preventDefault();
            return;
        }

        if (password.length < 6) {
            alert('⚠️ Password must be at least 6 characters long!');
            e.preventDefault();
            return;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating User...';
        submitBtn.disabled = true;

        // Reset form after submission
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
    });

    // Add animation to newly added rows
    document.addEventListener('DOMContentLoaded', function() {
        const rows = document.querySelectorAll('.user-row');
        rows.forEach((row, index) => {
            setTimeout(() => {
                row.classList.add('fade-in');
            }, index * 100);
        });

        // Enhanced tooltips for role badges
        const roleBadges = document.querySelectorAll('.role-badge');
        roleBadges.forEach(badge => {
            badge.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.1)';
            });

            badge.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        });
    });

    // Auto-clear form after successful submission
    if (window.location.search.includes('success')) {
        document.getElementById('userForm').reset();

        // Show success message
        const successDiv = document.createElement('div');
        successDiv.className = 'bg-green-50 border-l-4 border-green-400 p-4 mb-6 rounded-r-lg fade-in';
        successDiv.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                <p class="text-green-700">✅ User created successfully!</p>
            </div>
        `;

        document.querySelector('#userForm').prepend(successDiv);

        // Auto-remove success message after 5 seconds
        setTimeout(() => {
            successDiv.remove();
        }, 5000);
    }
</script>