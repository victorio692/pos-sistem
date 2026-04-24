<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #<?= $order['id'] ?></title>
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
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-1">Detail Pesanan #<?= $order['id'] ?></h2>
                            <p class="text-gray-500">Meja <?= $order['table_number'] ?? '-' ?></p>
                        </div>
                        <a href="<?= base_url('admin/orders') ?>" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 hover:shadow-md text-gray-700 rounded-lg font-medium transition-all duration-200 flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <div class="grid grid-cols-3 gap-6">
                    <!-- LEFT: Order Items -->
                    <div class="col-span-2">
                        <!-- Order Items Card -->
                        <div class="bg-white rounded-xl border border-gray-300 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
                            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-gray-300">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-utensils text-blue-600"></i> Daftar Menu
                                </h3>
                            </div>
                            <div class="p-6">
                                <?php if (!empty($order['items'])) : ?>
                                    <div class="space-y-4">
                                        <?php foreach ($order['items'] as $item) : ?>
                                            <div class="flex items-start justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-gray-100 transition duration-200">
                                                <div class="flex-1">
                                                    <h4 class="font-semibold text-gray-900"><?= $item['name'] ?></h4>
                                                    <p class="text-sm text-gray-600 mt-1">Jumlah: <span class="font-semibold"><?= $item['quantity'] ?></span></p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="font-semibold text-blue-600">Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></p>
                                                    <p class="text-xs text-gray-500 mt-1">@ Rp <?= number_format($item['price'], 0, ',', '.') ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="text-center py-8">
                                        <i class="fas fa-inbox text-gray-300 text-4xl mb-2"></i>
                                        <p class="text-gray-500">Tidak ada menu items</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- RIGHT: Order Summary -->
                    <div>
                        <!-- Payment Card -->
                        <div class="bg-white rounded-xl border border-gray-300 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
                            <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-gray-300">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-wallet text-purple-600"></i> Pembayaran
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Metode Pembayaran</p>
                                    <?php $paymentMethod = $order['payment_method'] ?? 'cash'; ?>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center gap-2 px-4 py-2 <?= 
                                            $paymentMethod === 'card' ? 'bg-purple-100 text-purple-700 border border-purple-200' : 
                                            ($paymentMethod === 'transfer' ? 'bg-blue-100 text-blue-700 border border-blue-200' : 
                                            ($paymentMethod === 'qris' ? 'bg-indigo-100 text-indigo-700 border border-indigo-200' : 
                                            'bg-green-100 text-green-700 border border-green-200')) 
                                        ?> rounded-lg text-sm font-semibold">
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
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Total Harga</p>
                                    <p class="text-2xl font-bold text-blue-600 mt-1">Rp <?= number_format($order['total_price'] ?? 0, 0, ',', '.') ?></p>
                                </div>
                                <?php if ($order['payment_amount']) : ?>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Jumlah Pembayaran</p>
                                    <p class="text-lg text-gray-900 font-semibold mt-1">Rp <?= number_format($order['payment_amount'], 0, ',', '.') ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Order Info Card -->
                        <div class="bg-white rounded-xl border border-gray-300 overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-6 py-4 border-b border-gray-300">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="fas fa-info-circle text-amber-600"></i> Informasi
                                </h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Nomor Meja</p>
                                    <p class="text-lg font-semibold text-gray-900 mt-1"><?= $order['table_number'] ?? '-' ?></p>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Total Harga</p>
                                    <p class="text-2xl font-bold text-blue-600 mt-1">Rp <?= number_format($order['total_price'] ?? 0, 0, ',', '.') ?></p>
                                </div>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Waktu Pemesanan</p>
                                    <p class="text-sm text-gray-900 mt-1"><?= date('d/m/Y H:i:s', strtotime($order['created_at'])) ?></p>
                                </div>
                                <?php if ($order['guest_count']) : ?>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Jumlah Tamu</p>
                                    <p class="text-sm text-gray-900 mt-1"><?= $order['guest_count'] ?> Orang</p>
                                </div>
                                <?php endif; ?>
                                <?php if ($order['payment_method']) : ?>
                                <div class="border-t border-gray-200 pt-4">
                                    <p class="text-xs text-gray-600 font-semibold uppercase">Metode Pembayaran</p>
                                    <p class="text-sm text-gray-900 mt-1"><?= ucfirst($order['payment_method']) ?></p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>