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
                <div class="p-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-1">Manajemen Menu</h2>
                        <p class="text-sm text-gray-500">Kelola semua menu restoran Anda</p>
                    </div>
                    <a href="<?= base_url('admin/menu/create') ?>" class="inline-flex items-center gap-2 px-5 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold text-sm transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i> Tambah Menu
                    </a>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-6">
                <?php if (count($menuByCategory) > 0) : ?>
                    <!-- Category Filter Dropdown -->
                    <div class="mb-6 flex items-center gap-3">
                        <label for="categoryFilter" class="text-sm font-medium text-gray-700">Filter Kategori:</label>
                        <select id="categoryFilter" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent cursor-pointer hover:border-gray-400 transition-colors">
                            <option value="">Semua Kategori</option>
                            <?php foreach (array_keys($menuByCategory) as $category) : ?>
                                <option value="<?= strtolower($category) ?>"><?= ucfirst($category) ?> (<?= count($menuByCategory[$category]) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Menu Items Grid -->
                    <div class="grid grid-cols-3 gap-4">
                        <?php foreach ($menuByCategory as $category => $items) : ?>
                            <?php foreach ($items as $item) : ?>
                                <div class="menu-item flex flex-col p-4 bg-white rounded-lg border border-gray-200 hover:border-blue-300 hover:shadow-md transition-all duration-200 group/item" data-category="<?= strtolower($category) ?>">
                                    <!-- Menu Image -->
                                    <div class="w-full h-32 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center flex-shrink-0 group-hover/item:from-blue-100 group-hover/item:to-blue-200 transition-all duration-200 overflow-hidden mb-3">
                                        <?php if (!empty($item['image']) && file_exists($item['image'])): ?>
                                            <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <i class="fas fa-image text-gray-400 text-2xl group-hover/item:text-blue-500"></i>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <!-- Name & Price -->
                                    <h4 class="text-gray-900 font-semibold text-sm mb-2 line-clamp-2"><?= $item['name'] ?? '-' ?></h4>
                                    <p class="text-blue-600 font-bold text-sm mb-3">Rp <?= number_format($item['price'] ?? 0, 0, ',', '.') ?></p>
                                    
                                    <!-- Category Badge -->
                                    <div class="mb-3 inline-block">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-600 text-xs font-medium rounded">
                                            <?= ucfirst($category) ?>
                                        </span>
                                    </div>
                                    
                                    <!-- Actions -->
                                    <div class="flex items-center gap-2 mt-auto">
                                        <a href="<?= base_url('admin/menu/edit/' . $item['id']) ?>" class="flex-1 p-2 text-center text-blue-600 hover:bg-blue-100 rounded transition-all duration-200 text-sm font-medium" title="Edit">
                                            <i class="fas fa-pen-to-square mr-1"></i> Edit
                                        </a>
                                        <button type="button" onclick="confirmDelete('<?= $item['id'] ?>', '<?= $item['name'] ?>')" class="flex-1 p-2 text-center text-red-600 hover:bg-red-100 rounded transition-all duration-200 text-sm font-medium" title="Hapus">
                                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                                        </button>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
            <!-- Icon & Title -->
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-6 border-b border-red-200 flex flex-col items-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Hapus Menu</h3>
            </div>

            <!-- Message -->
            <div class="px-6 py-6">
                <p class="text-gray-600 text-center">
                    Apakah anda yakin ingin menghapus menu <strong id="deleteMenuName"></strong>? 
                </p>
            </div>

            <!-- Buttons -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex gap-3 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="closeDeleteModal()" 
                    class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition duration-200"
                >
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button 
                    type="button" 
                    onclick="confirmDeleteAction()" 
                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold rounded-lg transition duration-200 shadow-md hover:shadow-lg"
                >
                    <i class="fas fa-trash-alt mr-2"></i>Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        let deleteMenuId = null;

        // Filter menu items by category
        const filterSelect = document.getElementById('categoryFilter');
        const menuItems = document.querySelectorAll('.menu-item');

        filterSelect.addEventListener('change', function() {
            const selectedCategory = this.value;
            
            menuItems.forEach(item => {
                if (selectedCategory === '' || item.dataset.category === selectedCategory) {
                    item.style.display = '';
                    // Trigger animation on show
                    setTimeout(() => item.classList.add('show'), 0);
                } else {
                    item.style.display = 'none';
                }
            });
        });

        function confirmDelete(id, menuName) {
            deleteMenuId = id;
            document.getElementById('deleteMenuName').textContent = menuName;
            const deleteModal = document.getElementById('deleteModal');
            const deleteModalContent = document.getElementById('deleteModalContent');
            
            deleteModal.classList.remove('hidden');
            // Trigger animation
            setTimeout(() => {
                deleteModalContent.classList.remove('scale-95', 'opacity-0');
                deleteModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeDeleteModal() {
            const deleteModal = document.getElementById('deleteModal');
            const deleteModalContent = document.getElementById('deleteModalContent');
            
            deleteModalContent.classList.add('scale-95', 'opacity-0');
            deleteModalContent.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                deleteModal.classList.add('hidden');
                deleteMenuId = null;
            }, 300);
        }

        function confirmDeleteAction() {
            if (deleteMenuId) {
                window.location.href = '<?= base_url('admin/menu/delete/') ?>' + deleteMenuId;
            }
        }

        // Close modal when clicking outside (on background)
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>
