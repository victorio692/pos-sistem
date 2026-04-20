<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan</title>
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
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-receipt w-5"></i>
                    <span>Pesanan</span>
                </a>
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-bowl-food w-5"></i>
                    <span class="font-medium">Menu</span>
                </a>
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-chair w-5"></i>
                    <span class="font-medium">Meja</span>
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
                <div class="p-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Daftar Pesanan</h2>
                        <p class="text-gray-500">Pantau dan kelola semua pesanan restoran</p>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <?php if (count($orders) > 0) : ?>
                    <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border border-slate-700 overflow-hidden shadow-xl">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-800/50 border-b border-slate-700">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-hashtag mr-2 text-amber-400"></i> ID
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-chair mr-2 text-amber-400"></i> Meja
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-bowl-food mr-2 text-amber-400"></i> Menu
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-cubes mr-2 text-amber-400"></i> Jumlah
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-tag mr-2 text-amber-400"></i> Harga
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">
                                            <i class="fas fa-spinner mr-2 text-amber-400"></i> Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-slate-300">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-700">
                                    <?php foreach ($orders as $order) : ?>
                                        <tr class="hover:bg-slate-700/30 transition duration-200">
                                            <td class="px-6 py-4 text-sm text-slate-300 font-medium">#<?= $order['id'] ?? '-' ?></td>
                                            <td class="px-6 py-4 text-sm text-slate-300"><?= $order['table_id'] ?? '-' ?></td>
                                            <td class="px-6 py-4 text-sm text-slate-300"><?= $order['menu_id'] ?? '-' ?></td>
                                            <td class="px-6 py-4 text-sm text-slate-300 font-semibold"><?= $order['quantity'] ?? '0' ?></td>
                                            <td class="px-6 py-4 text-sm text-amber-400 font-bold">Rp <?= number_format($order['price'] ?? 0, 0, ',', '.') ?></td>
                                            <td class="px-6 py-4 text-sm">
                                                <span class="inline-flex items-center gap-2 px-3 py-1 <?= ($order['status'] ?? 'pending') === 'completed' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-blue-500/20 text-blue-400 border border-blue-500/30' ?> rounded-full text-xs font-semibold">
                                                    <i class="fas <?= ($order['status'] ?? 'pending') === 'completed' ? 'fa-check-circle' : 'fa-hourglass-half' ?>"></i>
                                                    <?= ($order['status'] ?? 'pending') === 'completed' ? 'Selesai' : 'Pending' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <button class="inline-flex items-center gap-2 px-3 py-2 text-blue-400 hover:bg-blue-500/20 rounded-lg transition duration-200 border border-blue-500/30">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="flex flex-col items-center justify-center py-16 bg-gradient-to-br from-slate-800 to-slate-900 rounded-xl border border-slate-700">
                        <i class="fas fa-inbox text-slate-600 text-5xl mb-4"></i>
                        <p class="text-slate-400 text-lg font-medium">Tidak ada pesanan</p>
                        <p class="text-slate-500 text-sm mt-2">Pesanan akan muncul ketika ada yang melakukan pemesanan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
