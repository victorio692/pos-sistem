<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RestoPOS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <a href="<?= base_url('admin') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= base_url('admin/orders') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200 relative">
                    <i class="fas fa-receipt w-5"></i>
                    <span class="font-medium">Pesanan</span>
                    <?php if ($ordersCount['pending'] > 0) : ?>
                        <span class="absolute right-4 top-3 bg-red-500 text-white text-xs rounded-full px-2 py-0.5 font-bold text-xs"><?= $ordersCount['pending'] ?></span>
                    <?php endif; ?>
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

            <!-- User Info & Logout -->
            <div class="absolute bottom-0 w-72 p-4 border-t border-gray-200 bg-white">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg text-gray-900 mb-3 border border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    <div class="text-sm">
                        <p class="font-semibold"><?= session()->get('username') ?></p>
                        <p class="text-xs text-gray-500"><?= ucfirst(session()->get('role')) ?></p>
                    </div>
                </div>
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
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-1">Selamat Datang, <?= session()->get('username') ?>! 👋</h2>
                            <p class="text-gray-500">Pantau dan kelola bisnis restoran Anda</p>
                        </div>
                        <div class="text-right">
                            <p class="text-gray-400 text-sm">Hari ini</p>
                            <p class="text-gray-900 text-lg font-semibold"><?= date('l, d M Y', time()) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <!-- STATS CARDS -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Total Meja -->
                    <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 shadow-md hover:shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition">
                                <i class="fas fa-chair text-blue-600 text-lg"></i>
                            </div>
                            <span class="text-blue-600 text-sm font-semibold">+12%</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Meja</p>
                        <h3 class="text-3xl font-bold text-gray-900"><?= $totalTables ?></h3>
                        <p class="text-xs text-green-600 mt-3">
                            <i class="fas fa-check-circle mr-1"></i> Siap Gunakan
                        </p>
                    </div>

                    <!-- Total Menu -->
                    <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 shadow-md hover:shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center group-hover:bg-amber-200 transition">
                                <i class="fas fa-bowl-food text-amber-600 text-lg"></i>
                            </div>
                            <span class="text-blue-600 text-sm font-semibold">+5%</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Total Menu</p>
                        <h3 class="text-3xl font-bold text-gray-900"><?= $totalMenu ?></h3>
                        <p class="text-xs text-green-600 mt-3">
                            <i class="fas fa-check-circle mr-1"></i> Menu Aktif
                        </p>
                    </div>

                    <!-- Revenue Hari Ini -->
                    <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 shadow-md hover:shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition">
                                <i class="fas fa-chart-line text-green-600 text-lg"></i>
                            </div>
                            <span class="text-green-600 text-sm font-semibold">↑ 15%</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pendapatan Hari Ini</p>
                        <h3 class="text-2xl font-bold text-gray-900">Rp <?= number_format($revenueToday, 0, ',', '.') ?></h3>
                        <p class="text-xs text-green-600 mt-3">
                            <i class="fas fa-arrow-up mr-1"></i> vs hari kemarin
                        </p>
                    </div>

                    <!-- Total Pesanan -->
                    <div class="group bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 shadow-md hover:shadow-lg">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition">
                                <i class="fas fa-receipt text-purple-600 text-lg"></i>
                            </div>
                            <span class="text-blue-600 text-sm font-semibold">+8%</span>
                        </div>
                        <p class="text-gray-500 text-sm font-medium mb-1">Pesanan Hari Ini</p>
                        <h3 class="text-3xl font-bold text-gray-900"><?= $totalOrdersToday ?></h3>
                        <p class="text-xs text-blue-600 mt-3">
                            <i class="fas fa-check-circle mr-1"></i> Dicatat
                        </p>
                    </div>
                </div>

                <!-- CHARTS & STATUS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Orders Status -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-md">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">
                            <i class="fas fa-chart-pie mr-2 text-blue-600"></i> Status Pesanan
                        </h3>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 bg-blue-400 rounded-full"></span>
                                    <span class="text-gray-700 font-medium">Menunggu</span>
                                </div>
                                <span class="font-bold text-blue-600 text-lg"><?= $ordersCount['pending'] ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 bg-green-400 rounded-full"></span>
                                    <span class="text-gray-700 font-medium">Selesai</span>
                                </div>
                                <span class="font-bold text-green-600 text-lg"><?= $ordersCount['completed'] ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-red-50 rounded-lg border border-red-200">
                                <div class="flex items-center gap-3">
                                    <span class="w-3 h-3 bg-red-400 rounded-full"></span>
                                    <span class="text-gray-700 font-medium">Dibatalkan</span>
                                </div>
                                <span class="font-bold text-red-600 text-lg"><?= $ordersCount['cancelled'] ?></span>
                            </div>
                        </div>

                        <div class="h-64">
                            <canvas id="orderChart"></canvas>
                        </div>
                    </div>

                    <!-- Revenue Chart -->
                    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-md">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-bold text-gray-900">
                                <i class="fas fa-chart-line mr-2 text-blue-600"></i> Tren Penjualan 7 Hari
                            </h3>
                            <select class="px-3 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>Hari Ini</option>
                                <option>Minggu Ini</option>
                                <option>Bulan Ini</option>
                            </select>
                        </div>
                        <div class="h-64">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- RECENT ORDERS -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900">
                            <i class="fas fa-clock mr-2 text-blue-600"></i> Pesanan Terbaru
                        </h3>
                        <a href="<?= base_url('admin/orders') ?>" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition">
                            Lihat semua <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-chair mr-2 text-blue-600"></i> Meja
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-tag mr-2 text-blue-600"></i> Total
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-spinner mr-2 text-blue-600"></i> Status
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-clock mr-2 text-blue-600"></i> Waktu
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <?php if (count($recentOrders) > 0) : ?>
                                    <?php foreach ($recentOrders as $order) : ?>
                                        <tr class="hover:bg-gray-50 transition duration-200">
                                            <td class="py-4 px-6">
                                                <span class="font-semibold text-gray-900">
                                                    <i class="fas fa-chair mr-2 text-blue-600"></i> #<?= $order->table_number ?? 'N/A' ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-6 font-bold text-blue-600">
                                                Rp <?= number_format($order->total_price, 0, ',', '.') ?>
                                            </td>
                                            <td class="py-4 px-6">
                                                <?php if ($order->status == 'pending') : ?>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 border border-blue-200 rounded-full text-xs font-semibold">
                                                        <i class="fas fa-hourglass-half"></i> Menunggu
                                                    </span>
                                                <?php elseif ($order->status == 'completed') : ?>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-green-100 text-green-700 border border-green-200 rounded-full text-xs font-semibold">
                                                        <i class="fas fa-check-circle"></i> Selesai
                                                    </span>
                                                <?php else : ?>
                                                    <span class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 border border-red-200 rounded-full text-xs font-semibold">
                                                        <i class="fas fa-times-circle"></i> Dibatalkan
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="py-4 px-6 text-gray-600 text-sm"><?= date('H:i', strtotime($order->created_at)) ?></td>
                                            <td class="py-4 px-6">
                                                <a href="<?= base_url('admin/orders/detail/' . $order->id) ?>" class="inline-flex items-center gap-2 px-3 py-2 text-blue-600 hover:bg-blue-50 rounded-lg transition duration-200 border border-blue-200 text-sm font-medium">
                                                    <i class="fas fa-eye"></i> Lihat
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" class="py-8 px-6 text-center text-gray-500">
                                            <i class="fas fa-inbox text-2xl mb-2 block"></i>
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
        // Chart config dengan warna light theme
        Chart.defaults.color = '#6b7280';
        Chart.defaults.borderColor = '#e5e7eb';

        // Orders Chart
        const orderCtx = document.getElementById('orderChart');
        if (orderCtx) {
            new Chart(orderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Menunggu', 'Selesai', 'Dibatalkan'],
                    datasets: [{
                        data: [<?= $ordersCount['pending'] ?>, <?= $ordersCount['completed'] ?>, <?= $ordersCount['cancelled'] ?>],
                        backgroundColor: ['#60A5FA', '#10B981', '#EF4444'],
                        borderColor: ['#fff', '#fff', '#fff'],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: { size: 12, weight: '500' }
                            }
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
                    labels: <?= $revenueLabels ?>,
                    datasets: [{
                        label: 'Revenue (Rp)',
                        data: <?= $revenueData ?>,
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3B82F6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 15,
                                font: { size: 12, weight: '500' }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6' },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000).toFixed(1) + 'J';
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
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
                    <span>🍽️</span> Meja
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
                            <span class="text-4xl">🍽️</span>
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
