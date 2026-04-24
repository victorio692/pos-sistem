<?php $validation = \Config\Services::validation(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="w-72 bg-white border-r border-gray-200 fixed h-screen overflow-y-auto shadow-lg">
            <!-- Logo -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fas fa-utensils text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-900 text-lg">RestoPOS</h1>
                        <p class="text-xs text-gray-500">Management System</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-1">
                <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-receipt w-5"></i>
                    <span class="font-medium">Pesanan</span>
                </a>
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-bowl-food w-5"></i>
                    <span class="font-medium">Menu</span>
                </a>
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-chair w-5"></i>
                    <span class="font-medium">Meja</span>
                </a>
                <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-users w-5"></i>
                    <span>User</span>
                </a>
                <a href="<?= base_url('admin/profile') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-user-circle w-5"></i>
                    <span class="font-medium">Profil</span>
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="absolute bottom-0 w-72 p-4 border-t border-gray-200 bg-white">
                <a href="<?= base_url('admin/profile') ?>" class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg text-gray-900 mb-3 border border-gray-200 hover:bg-blue-50 hover:border-blue-300 transition duration-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="text-sm flex-1">
                        <p class="font-semibold"><?= session()->get('username') ?></p>
                        <p class="text-xs text-gray-500"><?= ucfirst(session()->get('role')) ?></p>
                    </div>
                    <i class="fas fa-chevron-right text-gray-400"></i>
                </a>
                <a href="<?= base_url('logout') ?>" class="w-full px-4 py-3 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-center font-medium transition duration-200 border border-red-200 block">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="ml-72 flex-1 overflow-auto">
            <!-- HEADER -->
            <div class="bg-white border-b border-gray-200 sticky top-0 z-10 shadow-sm">
                <div class="p-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Tambah User</h2>
                        <p class="text-gray-500">Buat akun pengguna baru untuk sistem</p>
                    </div>
                    <a href="<?= base_url('admin/users') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- FORM CONTENT -->
            <div class="p-8">
                <div class="max-w-2xl mx-auto bg-white rounded-xl border border-gray-200 overflow-hidden shadow-md">
                    <div class="p-8">
                        <!-- Error Messages -->
                        <?php if ($validation->getErrors()): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fas fa-exclamation-circle text-red-600 mt-1"></i>
                                    <div>
                                        <h3 class="font-semibold text-red-900 mb-2">Validasi Gagal</h3>
                                        <ul class="text-sm text-red-700 space-y-1">
                                            <?php foreach ($validation->getErrors() as $error): ?>
                                                <li class="flex items-center gap-2">
                                                    <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                                    <?= $error ?>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('admin/users/store') ?>" method="POST" class="space-y-6">
                            <?= csrf_field() ?>

                            <!-- Username -->
                            <div>
                                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-user-circle text-blue-600 mr-2"></i> Username
                                </label>
                                <input type="text" id="username" name="username" value="<?= old('username') ?>" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan username" required>
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-id-card text-blue-600 mr-2"></i> Nama Lengkap
                                </label>
                                <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <!-- Role -->
                            <div>
                                <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-shield text-blue-600 mr-2"></i> Role
                                </label>
                                <select id="role" name="role" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    required>
                                    <option value="">Pilih Role</option>
                                    <option value="admin" <?= old('role') === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="kasir" <?= old('role') === 'kasir' ? 'selected' : '' ?>>Kasir</option>
                                </select>
                            </div>

                            <!-- Password -->
                            <div>
                                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock text-blue-600 mr-2"></i> Password
                                </label>
                                <input type="password" id="password" name="password" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Masukkan password (minimal 6 karakter)" required>
                                <p class="mt-1 text-xs text-gray-500">Minimal 6 karakter</p>
                            </div>

                            <!-- Password Confirm -->
                            <div>
                                <label for="password_confirm" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fas fa-lock text-blue-600 mr-2"></i> Konfirmasi Password
                                </label>
                                <input type="password" id="password_confirm" name="password_confirm" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Ulangi password" required>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-4 pt-4">
                                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg flex items-center justify-center gap-2">
                                    <i class="fas fa-save"></i> Simpan User
                                </button>
                                <a href="<?= base_url('admin/users') ?>" class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200 border border-gray-300 flex items-center justify-center gap-2">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
