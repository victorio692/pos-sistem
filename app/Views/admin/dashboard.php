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
                    <!-- Payment Method Chart -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-md">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">
                            <i class="fas fa-wallet mr-2 text-blue-600"></i> Pembayaran
                        </h3>
                        
                        <div class="space-y-3 mb-6">
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg border border-green-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-money-bill text-green-600"></i>
                                    <span class="text-gray-700 font-medium">Cash</span>
                                </div>
                                <span class="font-bold text-green-600 text-lg"><?= $paymentMethodCount['cash'] ?? 0 ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg border border-purple-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-credit-card text-purple-600"></i>
                                    <span class="text-gray-700 font-medium">Card</span>
                                </div>
                                <span class="font-bold text-purple-600 text-lg"><?= $paymentMethodCount['card'] ?? 0 ?></span>
                            </div>
                            
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg border border-blue-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-bank text-blue-600"></i>
                                    <span class="text-gray-700 font-medium">Transfer</span>
                                </div>
                                <span class="font-bold text-blue-600 text-lg"><?= $paymentMethodCount['transfer'] ?? 0 ?></span>
                            </div>

                            <div class="flex items-center justify-between p-3 bg-indigo-50 rounded-lg border border-indigo-200">
                                <div class="flex items-center gap-3">
                                    <i class="fas fa-qrcode text-indigo-600"></i>
                                    <span class="text-gray-700 font-medium">QRIS</span>
                                </div>
                                <span class="font-bold text-indigo-600 text-lg"><?= $paymentMethodCount['qris'] ?? 0 ?></span>
                            </div>
                        </div>

                        <div class="h-64">
                            <canvas id="paymentMethodChart"></canvas>
                        </div>
                    </div>

                    <!-- Revenue Chart -->
                    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-6 shadow-md">
                        <div class="flex justify-between items-center mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">
                                    <i class="fas fa-chart-line mr-2 text-blue-600"></i> Tren Penjualan 7 Hari
                                </h3>
                                <p class="text-xs text-gray-500 mt-1">Klik legend untuk toggle data metode pembayaran</p>
                            </div>
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
                                        <i class="fas fa-list mr-2 text-blue-600"></i> Menu & Jumlah
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-wallet mr-2 text-blue-600"></i> Metode Pembayaran
                                    </th>
                                    <th class="text-left py-4 px-6 text-gray-700 font-semibold text-sm">
                                        <i class="fas fa-clock mr-2 text-blue-600"></i> Waktu
                                    </th>
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
                                                <div class="text-sm text-gray-700 space-y-1">
                                                    <?php foreach ($order->items as $item) : ?>
                                                        <div class="flex justify-between gap-2">
                                                            <span><?= $item['name'] ?></span>
                                                            <span class="text-gray-500">x<?= $item['quantity'] ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </td>
                                            <td class="py-4 px-6">
                                                <?php $paymentMethod = $order->payment_method ?? 'cash'; ?>
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
                                            <td class="py-4 px-6 text-gray-600 text-sm">
                                                <?php 
                                                    $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                    $dayOfWeek = $dayNames[date('w', strtotime($order->created_at))];
                                                    $dateFormatted = date('d M Y', strtotime($order->created_at));
                                                    $timeFormatted = date('H:i', strtotime($order->created_at));
                                                ?>
                                                <div><?= $dayOfWeek ?>, <?= $dateFormatted ?></div>
                                                <div class="text-xs text-gray-500"><?= $timeFormatted ?></div>
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

        // Payment Method Chart
        const paymentMethodCtx = document.getElementById('paymentMethodChart');
        if (paymentMethodCtx) {
            new Chart(paymentMethodCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Cash', 'Card', 'Transfer', 'QRIS'],
                    datasets: [{
                        data: [<?= $paymentMethodCount['cash'] ?? 0 ?>, <?= $paymentMethodCount['card'] ?? 0 ?>, <?= $paymentMethodCount['transfer'] ?? 0 ?>, <?= $paymentMethodCount['qris'] ?? 0 ?>],
                        backgroundColor: ['#10B981', '#A855F7', '#3B82F6', '#6366F1'],
                        borderColor: ['#fff', '#fff', '#fff', '#fff'],
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
                        label: 'Total Revenue',
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
                    },
                    {
                        label: 'Cash',
                        data: <?= $cashData ?>,
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#10B981',
                        pointRadius: 4,
                        hidden: true
                    },
                    {
                        label: 'Card',
                        data: <?= $cardData ?>,
                        borderColor: '#A855F7',
                        backgroundColor: 'rgba(168, 85, 247, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#A855F7',
                        pointRadius: 4,
                        hidden: true
                    },
                    {
                        label: 'Transfer',
                        data: <?= $transferData ?>,
                        borderColor: '#F59E0B',
                        backgroundColor: 'rgba(245, 158, 11, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#F59E0B',
                        pointRadius: 4,
                        hidden: true
                    },
                    {
                        label: 'QRIS',
                        data: <?= $qrisData ?>,
                        borderColor: '#6366F1',
                        backgroundColor: 'rgba(99, 102, 241, 0.05)',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4,
                        pointBackgroundColor: '#6366F1',
                        pointRadius: 4,
                        hidden: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 15,
                                font: { size: 12, weight: '500' },
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: { size: 13, weight: 'bold' },
                            bodyFont: { size: 12 },
                            borderColor: '#e5e7eb',
                            borderWidth: 1,
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f3f4f6' },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) {
                                        return 'Rp ' + (value / 1000000).toFixed(0) + 'J';
                                    } else if (value >= 1000) {
                                        return 'Rp ' + (value / 1000).toFixed(0) + 'K';
                                    }
                                    return 'Rp ' + value;
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

