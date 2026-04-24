<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - RestoPOS</title>
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
                <a href="<?= base_url('admin/users') ?>" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-blue-50 rounded-lg transition duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span class="font-medium">User</span>
                </a>
                <a href="<?= base_url('admin/profile') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-user w-5"></i>
                    <span>Profil</span>
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
                            <h2 class="text-3xl font-bold text-gray-900 mb-1">Profil Saya</h2>
                            <p class="text-gray-500">Informasi dan statistik akun admin</p>
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
                <!-- PROFILE CARD -->
                <div class="bg-white rounded-xl border border-gray-200 shadow-lg mb-8 overflow-hidden">
                    <!-- HEADER GRADIENT -->
                    <div class="h-24 bg-gradient-to-r from-blue-500 to-blue-600"></div>
                    
                    <!-- PROFILE INFO -->
                    <div class="px-8 pb-6">
                        <!-- AVATAR + NAME -->
                        <div class="flex gap-6 items-start -mt-12 mb-6">
                            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center border-4 border-white shadow-lg">
                                <i class="fas fa-user text-white text-4xl"></i>
                            </div>
                            <div class="flex-1 pt-4">
                                <h3 class="text-2xl font-bold text-gray-900"><?= $user['full_name'] ?? 'Admin' ?></h3>
                                <p class="text-gray-500">@<?= $username ?></p>
                                <div class="mt-3">
                                    <span class="inline-block bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-semibold">
                                        <i class="fas fa-shield-alt mr-2"></i> Administrator
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- DIVIDER -->
                        <div class="border-t border-gray-200 my-6"></div>

                        <!-- STATS GRID -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- TOTAL ORDERS -->
                            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-gray-600 font-semibold text-sm">Total Pesanan</p>
                                    <i class="fas fa-receipt text-blue-600 text-xl"></i>
                                </div>
                                <p class="text-3xl font-bold text-gray-900"><?= $totalOrders ?></p>
                                <p class="text-xs text-gray-600 mt-2">Semua pesanan yang dikelola</p>
                            </div>

                            <!-- TOTAL REVENUE -->
                            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-gray-600 font-semibold text-sm">Total Revenue</p>
                                    <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                                </div>
                                <p class="text-3xl font-bold text-gray-900">Rp<?= number_format($totalRevenue, 0, ',', '.') ?></p>
                                <p class="text-xs text-gray-600 mt-2">Pendapatan keseluruhan</p>
                            </div>

                            <!-- ROLE INFO -->
                            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200">
                                <div class="flex items-center justify-between mb-3">
                                    <p class="text-gray-600 font-semibold text-sm">Status Akun</p>
                                    <i class="fas fa-check-circle text-purple-600 text-xl"></i>
                                </div>
                                <p class="text-3xl font-bold text-gray-900">Aktif</p>
                                <p class="text-xs text-gray-600 mt-2">Admin dengan akses penuh</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DETAILS SECTION -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- INFO PRIBADI -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-id-card text-blue-600"></i> Informasi Pribadi
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                <span class="text-gray-600 font-medium">Nama Lengkap</span>
                                <span class="font-bold text-gray-900"><?= $user['full_name'] ?? 'N/A' ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                <span class="text-gray-600 font-medium">Username</span>
                                <span class="font-bold text-gray-900"><?= $username ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                <span class="text-gray-600 font-medium">Email</span>
                                <span class="font-bold text-gray-900"><?= $user['email'] ?? 'N/A' ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                <span class="text-gray-600 font-medium">Role</span>
                                <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">Administrator</span>
                            </div>

                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                                <span class="text-gray-600 font-medium">Status</span>
                                <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <!-- AKTIVITAS -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <i class="fas fa-chart-line text-green-600"></i> Statistik Aktivitas
                        </h3>
                        
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                                <span class="text-gray-600 font-medium">Total Pesanan Dikelola</span>
                                <span class="font-bold text-gray-900 text-lg"><?= $totalOrders ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                                <span class="text-gray-600 font-medium">Total Revenue</span>
                                <span class="font-bold text-gray-900 text-lg">Rp<?= number_format($totalRevenue, 0, ',', '.') ?></span>
                            </div>
                            
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                                <span class="text-gray-600 font-medium">Rata-rata per Pesanan</span>
                                <span class="font-bold text-gray-900 text-lg">Rp<?= number_format($totalOrders > 0 ? $totalRevenue / $totalOrders : 0, 0, ',', '.') ?></span>
                            </div>

                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                                <span class="text-gray-600 font-medium">Tanggal Bergabung</span>
                                <span class="font-bold text-gray-900">
                                    <?= isset($user['created_at']) ? date('d M Y', strtotime($user['created_at'])) : 'N/A' ?>
                                </span>
                            </div>

                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                                <span class="text-gray-600 font-medium">Terakhir Update</span>
                                <span class="font-bold text-gray-900">
                                    <?= isset($user['updated_at']) ? date('d M Y H:i', strtotime($user['updated_at'])) : 'N/A' ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="<?= base_url('admin') ?>" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-900 rounded-lg font-semibold transition duration-200 flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
