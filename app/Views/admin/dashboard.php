<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - POS Restoran</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div class="w-64 bg-white shadow-lg fixed h-screen overflow-y-auto">
            <div class="p-6 border-b">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">🍽️</span>
                    </div>
                    <div>
                        <h1 class="font-bold text-gray-800">POS Restoran</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium">
                    <span>📊</span> Dashboard
                </a>
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition relative">
                    <span>📋</span> 
                    <span>Pesanan</span>
                    <?php if ($ordersCount['pending'] > 0) : ?>
                        <span class="absolute right-4 top-3 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center"><?= $ordersCount['pending'] ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>🍜</span> Menu
                </a>
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>🪑</span> Meja
                </a>
                <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-100 rounded-lg transition">
                    <span>👥</span> User
                </a>
            </nav>

            <div class="absolute bottom-0 w-64 p-4 border-t bg-gradient-to-r from-blue-500 to-purple-600">
                <div class="flex items-center gap-3 p-3 bg-white bg-opacity-20 rounded-lg text-white text-sm">
                    <span class="text-2xl">👤</span>
                    <div>
                        <p class="font-semibold"><?= session()->get('username') ?></p>
                        <p class="text-xs opacity-80"><?= ucfirst(session()->get('role')) ?></p>
                    </div>
                </div>
                <a href="<?= base_url('logout') ?>" class="w-full mt-3 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg text-center font-medium transition text-sm block">
                    🚪 Logout
                </a>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="ml-64 flex-1 overflow-auto">
            <!-- TOP BAR -->
            <div class="bg-white border-b sticky top-0 z-10">
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, <?= session()->get('username') ?>! 👋</h2>
                        <p class="text-gray-500 text-sm">Kelola bisnis restoran Anda dari sini</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <input type="text" placeholder="Cari..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-48">
                        <button class="p-2 hover:bg-gray-100 rounded-lg text-xl">🔔</button>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-6">
                <!-- STATS CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                    <!-- Total Meja -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Meja</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $totalTables ?></h3>
                                <p class="text-xs text-green-600 mt-2">✓ Tersedia</p>
                            </div>
                            <span class="text-4xl">🪑</span>
                        </div>
                    </div>

                    <!-- Total Menu -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Total Menu</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $totalMenu ?></h3>
                                <p class="text-xs text-green-600 mt-2">✓ Aktif</p>
                            </div>
                            <span class="text-4xl">🍜</span>
                        </div>
                    </div>

                    <!-- Revenue Hari Ini -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Pendapatan Hari Ini</p>
                                <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp <?= number_format($revenueToday, 0, ',', '.') ?></h3>
                                <p class="text-xs text-green-600 mt-2">↑ 12% vs kemarin</p>
                            </div>
                            <span class="text-4xl">💰</span>
                        </div>
                    </div>

                    <!-- Total Pesanan -->
                    <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Pesanan Hari Ini</p>
                                <h3 class="text-3xl font-bold text-gray-800 mt-2"><?= $totalOrdersToday ?></h3>
                                <p class="text-xs text-green-600 mt-2">✓ Dicatat</p>
                            </div>
                            <span class="text-4xl">📋</span>
                        </div>
                    </div>
                </div>

                <!-- ORDERS SUMMARY & CHART -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <!-- Orders Status -->
                    <div class="lg:col-span-1 bg-white rounded-lg shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Status Pesanan</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 bg-yellow-50 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-yellow-400 rounded-full"></span>
                                    <span class="text-gray-600 font-medium">Menunggu</span>
                                </div>
                                <span class="font-bold text-gray-800"><?= $ordersCount['pending'] ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="text-gray-600 font-medium">Selesai</span>
                                </div>
                                <span class="font-bold text-gray-800"><?= $ordersCount['completed'] ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <span class="w-3 h-3 bg-red-500 rounded-full"></span>
                                    <span class="text-gray-600 font-medium">Dibatalkan</span>
                                </div>
                                <span class="font-bold text-gray-800"><?= $ordersCount['cancelled'] ?></span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t">
                            <canvas id="orderChart" height="100"></canvas>
                        </div>
                    </div>

                    <!-- Revenue Chart -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-bold text-gray-800">📈 Tren Penjualan</h3>
                            <select class="px-3 py-1 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Hari Ini</option>
                                <option>Minggu Ini</option>
                                <option>Bulan Ini</option>
                            </select>
                        </div>
                        <canvas id="revenueChart" height="80"></canvas>
                    </div>
                </div>

                <!-- RECENT ORDERS -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">🕐 Pesanan Terbaru</h3>
                        <a href="<?= base_url('admin/orders') ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat semua →</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-200">
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Meja</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Total</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Status</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Waktu</th>
                                    <th class="text-left py-3 px-4 text-gray-600 font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (count($recentOrders) > 0) : ?>
                                    <?php foreach ($recentOrders as $order) : ?>
                                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                                            <td class="py-3 px-4">
                                                <span class="font-semibold text-gray-800">Meja #<?= $order->table_number ?? 'N/A' ?></span>
                                            </td>
                                            <td class="py-3 px-4 font-semibold text-gray-800">
                                                Rp <?= number_format($order->total_price, 0, ',', '.') ?>
                                            </td>
                                            <td class="py-3 px-4">
                                                <?php if ($order->status == 'pending') : ?>
                                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">⏳ Menunggu</span>
                                                <?php elseif ($order->status == 'completed') : ?>
                                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">✓ Selesai</span>
                                                <?php else : ?>
                                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">✕ Dibatalkan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-3 px-4 text-gray-600 text-sm"><?= date('H:i', strtotime($order->created_at)) ?></td>
                                            <td class="py-3 px-4">
                                                <a href="<?= base_url('admin/orders/detail/' . $order->id) ?>" class="text-blue-600 hover:text-blue-800 text-sm">Detail</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="py-8 px-4 text-center text-gray-500">
                                            Tidak ada pesanan hari ini
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Orders Chart
        const orderCtx = document.getElementById('orderChart');
        if (orderCtx) {
            new Chart(orderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Selesai', 'Dibatalkan'],
                    datasets: [{
                        data: [<?= $ordersCount['pending'] ?>, <?= $ordersCount['completed'] ?>, <?= $ordersCount['cancelled'] ?>],
                        backgroundColor: ['#FBBF24', '#10B981', '#EF4444'],
                        borderColor: ['#fff', '#fff', '#fff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Revenue Chart
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: [500000, 750000, 600000, 800000, 900000, 1200000, 1100000],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
