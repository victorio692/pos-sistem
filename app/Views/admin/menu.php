<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Menu</title>
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
                <a href="<?= base_url('admin/menu') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-bowl-food w-5"></i>
                    <span>Menu</span>
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
                <div class="p-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Manajemen Menu</h2>
                        <p class="text-gray-500">Kelola semua menu restoran Anda</p>
                    </div>
                    <a href="<?= base_url('admin/menu/create') ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i> Tambah Menu
                    </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <?php if (count($menuByCategory) > 0) : ?>
                    <div class="space-y-5">
                        <?php 
                        $categoryIcons = [
                            'makanan' => 'fa-utensils',
                            'minuman' => 'fa-glass-water',
                            'snack' => 'fa-cookie',
                            'paket' => 'fa-box',
                        ];
                        ?>
                        <?php foreach ($menuByCategory as $category => $items) : ?>
                            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300 group">
                                <!-- Category Header - Simplified -->
                                <div class="px-6 py-4 border-b border-gray-100 cursor-pointer hover:bg-gray-50 transition duration-200" onclick="toggleCategory(this)">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <i class="fas fa-chevron-right text-gray-400 transition-transform duration-300 category-icon text-sm"></i>
                                            <i class="fas <?= $categoryIcons[strtolower($category)] ?? 'fa-bowl-food' ?> text-blue-500 text-lg"></i>
                                            <h3 class="text-gray-900 font-semibold text-base"><?= ucfirst($category) ?></h3>
                                            <span class="ml-2 px-2 py-1 bg-blue-50 text-blue-600 text-xs font-medium rounded-lg">
                                                <?= count($items) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Menu Items - Compact List -->
                                <div class="category-content overflow-hidden transition-all duration-300 max-h-none">
                                    <div class="p-5 space-y-3">
                                        <?php foreach ($items as $item) : ?>
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-all duration-200 group/item">
                                                <!-- Menu Info -->
                                                <div class="flex-1">
                                                    <div class="flex items-start gap-3">
                                                        <!-- Menu Icon -->
                                                        <div class="w-10 h-10 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:from-blue-200 group-hover/item:to-blue-300 transition-all duration-200 overflow-hidden">
                                                            <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                                                                <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover">
                                                            <?php else: ?>
                                                                <i class="fas fa-image text-gray-400 text-sm group-hover/item:text-blue-500"></i>
                                                            <?php endif; ?>
                                                        </div>
                                                        <!-- Name & Price -->
                                                        <div class="flex-1 min-w-0">
                                                            <h4 class="text-gray-900 font-semibold text-sm mb-1"><?= $item['name'] ?? '-' ?></h4>
                                                            <p class="text-blue-600 font-bold text-xs">Rp <?= number_format($item['price'] ?? 0, 0, ',', '.') ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Status & Actions -->
                                                <div class="flex items-center gap-2 ml-3">
                                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-lg border border-green-200 flex-shrink-0">
                                                        <i class="fas fa-check text-xs"></i>
                                                    </span>
                                                    <a href="<?= base_url('admin/menu/edit/' . $item['id']) ?>" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-all duration-200" title="Edit">
                                                        <i class="fas fa-pen-to-square text-sm"></i>
                                                    </a>
                                                    <button type="button" onclick="confirmDelete('<?= $item['id'] ?>')" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-all duration-200" title="Hapus">
                                                        <i class="fas fa-trash-alt text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-2xl border border-gray-200 shadow-sm">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-600 text-lg font-medium">Belum ada menu</p>
                        <p class="text-gray-500 text-sm mt-2">Mulai tambahkan menu baru untuk restoran Anda</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleCategory(header) {
            const content = header.nextElementSibling;
            const icon = header.querySelector('.category-icon');
            const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
            
            if (isOpen) {
                content.style.maxHeight = '0px';
                icon.classList.remove('rotate-90');
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('rotate-90');
            }
        }

        // Initialize all categories as open
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-content').forEach(content => {
                content.style.maxHeight = content.scrollHeight + 'px';
                content.previousElementSibling.querySelector('.category-icon').classList.add('rotate-90');
            });
        });

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus menu ini?')) {
                window.location.href = '<?= base_url('admin/menu/delete/') ?>' + id;
            }
        }
    </script>
        </div>
    </div>
</body>
</html>
