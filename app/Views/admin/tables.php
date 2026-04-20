<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Meja</title>
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
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-chair w-5"></i>
                    <span>Meja</span>
                </a>
                <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">User</span>
                </a>
            </nav>

            <!-- Logout -->
            <div class="absolute bottom-0 w-72 p-4 border-t border-gray-200 bg-white">
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
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Manajemen Meja</h2>
                        <p class="text-gray-500">Kelola daftar meja restoran Anda</p>
                    </div>
                    <a href="<?= base_url('admin/tables/create') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i> Tambah Meja
                    </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <?php if (count($tables) > 0) : ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        <?php foreach ($tables as $table) : ?>
                            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 group shadow-md hover:shadow-lg cursor-pointer">
                                <!-- Status Indicator -->
                                <div class="flex justify-between items-start mb-4">
                                    <div class="text-3xl">
                                        <i class="fas fa-chair text-gray-400 group-hover:text-blue-600 transition"></i>
                                    </div>
                                    <span class="px-3 py-1 <?= isset($table['status']) && $table['status'] === 'available' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-amber-100 text-amber-700 border border-amber-200' ?> rounded-full text-xs font-semibold">
                                        <?= ($table['status'] ?? 'available') === 'available' ? '✓ Kosong' : '◉ Terisi' ?>
                                    </span>
                                </div>

                                <!-- Details -->
                                <h3 class="text-gray-900 font-bold text-lg mb-2"><?= $table['table_name'] ?? '-' ?></h3>
                                <div class="space-y-2 mb-4">
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-users mr-2 text-blue-600"></i>Kapasitas: <span class="text-gray-900 font-semibold"><?= $table['capacity'] ?? '-' ?></span> orang
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 pt-4 border-t border-gray-200">
                                    <button class="flex-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition duration-200 text-sm border border-blue-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="flex-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition duration-200 text-sm border border-red-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-600 text-lg font-medium">Belum ada meja</p>
                        <p class="text-gray-500 text-sm mt-2">Mulai tambahkan meja baru untuk restoran Anda</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
