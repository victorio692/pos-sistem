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
            <div class="bg-white border-b border-gray-300 sticky top-0 z-10 shadow-md">
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
                    <div class="bg-white rounded-xl border border-gray-300 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-hashtag mr-2 text-blue-600"></i> ID
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-chair mr-2 text-blue-600"></i> Meja
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-bowl-food mr-2 text-blue-600"></i> Menu
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-cubes mr-2 text-blue-600"></i> Jumlah
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-tag mr-2 text-blue-600"></i> Harga Total
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">
                                            <i class="fas fa-wallet mr-2 text-blue-600"></i> Metode Pembayaran
                                        </th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($orders as $order) : ?>
                                        <tr class="hover:bg-gray-50 transition duration-200">
                                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">#<?= $order['id'] ?? '-' ?></td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                    <?= $order['table_number'] ?? '-' ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                <?php if (!empty($order['items'])) : ?>
                                                    <div class="space-y-1">
                                                        <?php foreach ($order['items'] as $item) : ?>
                                                            <div class="text-xs">
                                                                <?= $item['name'] ?> <span class="text-gray-500">(<?= $item['quantity'] ?>)</span>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else : ?>
                                                    -
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 font-semibold">
                                                <?php $total_qty = 0; foreach ($order['items'] as $item) { $total_qty += $item['quantity']; } echo $total_qty; ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-blue-600 font-bold">
                                                Rp <?= number_format($order['total_price'] ?? 0, 0, ',', '.') ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <?php $paymentMethod = $order['payment_method'] ?? 'cash'; ?>
                                                <span class="inline-flex items-center gap-2 px-3 py-1 <?= 
                                                    $paymentMethod === 'card' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 
                                                    ($paymentMethod === 'transfer' ? 'bg-blue-100 text-blue-700 border border-blue-200' : 
                                                    ($paymentMethod === 'qris' ? 'bg-indigo-100 text-indigo-700 border border-indigo-200' : 
                                                    'bg-green-100 text-green-700 border border-green-200')) 
                                                ?> rounded-full text-xs font-semibold">
                                                    <i class="fas <?= 
                                                        $paymentMethod === 'card' ? 'fa-credit-card' : 
                                                        ($paymentMethod === 'transfer' ? 'fa-bank' : 
                                                        ($paymentMethod === 'qris' ? 'fa-qrcode' : 'fa-money-bill')) 
                                                    ?>"></i>
                                                    <?= 
                                                        $paymentMethod === 'qris' ? 'QRIS' : 
                                                        ($paymentMethod === 'card' ? 'Card' : 
                                                        ($paymentMethod === 'transfer' ? 'Transfer' : 'Cash'))
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-700">
                                                <?= date('d/m/Y H:i', strtotime($order['created_at'] ?? now())) ?>
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <a href="<?= base_url('admin/orders/detail/' . $order['id']) ?>" class="inline-flex items-center gap-2 px-3 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200 border border-blue-200 text-xs font-semibold">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- PAGINATION -->
                    <?php if ($totalPages > 1) : ?>
                    <div class="mt-8 bg-white rounded-xl border border-gray-300 shadow-lg p-6">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                            <!-- Info Text -->
                            <div class="text-sm text-gray-600 px-2 py-1">
                                Menampilkan <span class="font-semibold text-gray-900"><?= count($orders) ?></span> dari <span class="font-semibold text-gray-900"><?= $total ?></span> pesanan (Halaman <?= $page ?> dari <?= $totalPages ?>)
                            </div>

                        <!-- Pagination Controls -->
                        <div class="flex items-center gap-2 flex-wrap">
                            <!-- Previous Button -->
                            <?php if ($page > 1) : ?>
                                <a href="<?= base_url('admin/orders?page=' . ($page - 1)) ?>" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:shadow-md hover:border-gray-400 transition-all duration-200 flex items-center gap-2 font-medium">
                                    <i class="fas fa-chevron-left text-sm"></i>
                                    <span>Sebelumnya</span>
                                </a>
                            <?php else : ?>
                                <button disabled class="px-4 py-2 bg-gray-50 border border-gray-200 text-gray-400 rounded-lg cursor-not-allowed flex items-center gap-2 font-medium opacity-60">
                                    <i class="fas fa-chevron-left text-sm"></i>
                                    <span>Sebelumnya</span>
                                </button>
                            <?php endif; ?>

                            <!-- Page Numbers -->
                            <div class="flex items-center gap-1">
                                <?php 
                                $startPage = max(1, $page - 2);
                                $endPage = min($totalPages, $page + 2);
                                
                                if ($startPage > 1) : ?>
                                    <a href="<?= base_url('admin/orders?page=1') ?>" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-blue-50 hover:shadow-md hover:border-blue-300 transition-all duration-200 font-medium text-sm">1</a>
                                    <?php if ($startPage > 2) : ?>
                                        <span class="text-gray-500 font-medium">...</span>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php for ($i = $startPage; $i <= $endPage; $i++) : ?>
                                    <?php if ($i == $page) : ?>
                                        <button class="px-3 py-2 bg-blue-600 text-white rounded-lg font-semibold text-sm shadow-md hover:shadow-lg transition-shadow duration-200"><?= $i ?></button>
                                    <?php else : ?>
                                        <a href="<?= base_url('admin/orders?page=' . $i) ?>" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-blue-50 hover:shadow-md hover:border-blue-300 transition-all duration-200 font-medium text-sm"><?= $i ?></a>
                                    <?php endif; ?>
                                <?php endfor; ?>

                                <?php if ($endPage < $totalPages) : ?>
                                    <?php if ($endPage < $totalPages - 1) : ?>
                                        <span class="text-gray-500 font-medium">...</span>
                                    <?php endif; ?>
                                    <a href="<?= base_url('admin/orders?page=' . $totalPages) ?>" class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-blue-50 hover:shadow-md hover:border-blue-300 transition-all duration-200 font-medium text-sm"><?= $totalPages ?></a>
                                <?php endif; ?>
                            </div>

                            <!-- Next Button -->
                            <?php if ($page < $totalPages) : ?>
                                <a href="<?= base_url('admin/orders?page=' . ($page + 1)) ?>" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 hover:shadow-md hover:border-gray-400 transition-all duration-200 flex items-center gap-2 font-medium">
                                    <span>Berikutnya</span>
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </a>
                            <?php else : ?>
                                <button disabled class="px-4 py-2 bg-gray-50 border border-gray-200 text-gray-400 rounded-lg cursor-not-allowed flex items-center gap-2 font-medium opacity-60">
                                    <span>Berikutnya</span>
                                    <i class="fas fa-chevron-right text-sm"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border border-gray-300 shadow-lg">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-600 text-lg font-medium">Tidak ada pesanan</p>
                        <p class="text-gray-500 text-sm mt-2">Pesanan akan muncul ketika ada yang melakukan pemesanan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
