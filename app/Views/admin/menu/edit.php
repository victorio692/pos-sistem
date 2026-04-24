<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
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
                <div class="p-8 flex justify-between items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Edit Menu</h2>
                        <p class="text-gray-500">Ubah informasi menu makanan atau minuman</p>
                    </div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <div class="max-w-2xl">
                    <!-- Alert Messages -->
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-center gap-3">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                            <span class="text-red-700"><?= session()->getFlashdata('error') ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Form Card -->
                    <div class="bg-white rounded-xl border border-gray-200 shadow-md overflow-hidden">
                        <form action="<?= base_url('admin/menu/update/' . $menu['id']) ?>" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                            <?= csrf_field() ?>

                            <!-- Nama Menu -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-utensils mr-2 text-blue-600"></i> Nama Menu
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    placeholder="Contoh: Nasi Goreng Spesial"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                                    required
                                    value="<?= old('name') ?? $menu['name'] ?>"
                                >
                            </div>

                            <!-- Kategori -->
                            <div>
                                <label for="category" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-tag mr-2 text-blue-600"></i> Kategori
                                </label>
                                <select 
                                    id="category" 
                                    name="category"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                                    required
                                    onchange="handleCategoryChange()"
                                >
                                    <option value="" disabled>Pilih Kategori</option>
                                    <?php if(!empty($categories)): ?>
                                        <?php foreach($categories as $cat): ?>
                                            <option value="<?= $cat['category'] ?>" <?= (old('category') ?? $menu['category']) == $cat['category'] ? 'selected' : '' ?>>
                                                <?= ucfirst($cat['category']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <option value="__new__">+ Tambah Kategori Baru</option>
                                </select>
                                <input 
                                    type="text" 
                                    id="newCategory" 
                                    placeholder="Masukkan nama kategori baru"
                                    class="w-full mt-2 px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200 hidden"
                                    name="newCategory"
                                    value="<?= old('newCategory') ?>"
                                >
                            </div>

                            <!-- Harga -->
                            <div>
                                <label for="price" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-money-bill-wave mr-2 text-blue-600"></i> Harga (Rp)
                                </label>
                                <input 
                                    type="text" 
                                    id="price" 
                                    name="price" 
                                    placeholder="Contoh: 25000"
                                    class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                                    required
                                    value="<?= old('price') ?? $menu['price'] ?>"
                                >
                                <p class="text-xs text-gray-500 mt-2">Format: 25000 (akan ditampilkan sebagai Rp 25.000)</p>
                            </div>

                            <!-- Foto Menu -->
                            <div>
                                <label for="image" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-image mr-2 text-blue-600"></i> Foto Menu
                                </label>
                                <div class="relative">
                                    <input 
                                        type="file" 
                                        id="image" 
                                        name="image" 
                                        accept="image/*"
                                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100"
                                    >
                                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF (Max 5MB) - Kosongkan jika tidak ingin mengubah foto</p>
                                </div>

                                <!-- Current Image -->
                                <?php if(!empty($menu['image']) && file_exists($menu['image'])): ?>
                                    <div id="currentImagePreview" class="mt-4">
                                        <p class="text-sm text-gray-600 mb-2">Foto Saat Ini:</p>
                                        <img src="<?= base_url($menu['image']) ?>" alt="Current" class="max-w-xs rounded-lg border border-gray-200">
                                    </div>
                                <?php endif; ?>

                                <!-- New Image Preview -->
                                <div id="imagePreview" class="mt-4 hidden">
                                    <p class="text-sm text-gray-600 mb-2">Foto Baru:</p>
                                    <img id="previewImage" src="" alt="Preview" class="max-w-xs rounded-lg border border-gray-200">
                                </div>
                            </div>

                            <!-- Buttons -->
                            <div class="flex gap-3 pt-6">
                                <a href="<?= base_url('admin/menu') ?>" class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-semibold transition duration-200 text-center border border-gray-300">
                                    <i class="fas fa-arrow-left mr-2"></i> Batal
                                </a>
                                <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
                                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatRupiah(value) {
            // Remove all non-digit characters
            const cleanValue = value.replace(/\D/g, '');
            if (!cleanValue) return '';
            // Format with thousands separator (dot)
            return parseInt(cleanValue).toLocaleString('id-ID');
        }

        function handleCategoryChange() {
            const categorySelect = document.getElementById('category');
            const newCategoryInput = document.getElementById('newCategory');
            
            if (categorySelect.value === '__new__') {
                newCategoryInput.classList.remove('hidden');
                newCategoryInput.focus();
                newCategoryInput.required = true;
            } else {
                newCategoryInput.classList.add('hidden');
                newCategoryInput.required = false;
                newCategoryInput.value = '';
            }
        }

        function formatPriceInput(input) {
            // Format display
            const formatted = formatRupiah(input.value);
            if (formatted && input.value !== formatted) {
                input.value = formatted;
            }
        }

        // Check on page load
        document.addEventListener('DOMContentLoaded', function() {
            handleCategoryChange();
            
            // Price formatter
            const priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function(e) {
                // Extract only digits
                const cleaned = e.target.value.replace(/\D/g, '');
                // Store only digits for form submission
                e.target.dataset.rawValue = cleaned;
            });
            priceInput.addEventListener('blur', function(e) {
                // Format on blur for display
                const cleaned = e.target.value.replace(/\D/g, '');
                if (cleaned) {
                    e.target.value = formatRupiah(cleaned);
                }
            });
            priceInput.addEventListener('focus', function(e) {
                // Show raw value on focus for editing
                e.target.value = e.target.value.replace(/\D/g, '');
            });
            
            // Image preview
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('imagePreview');
            const previewImage = document.getElementById('previewImage');
            const currentImagePreview = document.getElementById('currentImagePreview');
            
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        previewImage.src = event.target.result;
                        imagePreview.classList.remove('hidden');
                        // Hide current image when new image is selected
                        if (currentImagePreview) {
                            currentImagePreview.classList.add('hidden');
                        }
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.classList.add('hidden');
                    // Show current image again
                    if (currentImagePreview) {
                        currentImagePreview.classList.remove('hidden');
                    }
                }
            });
        });

        // Clean price before form submit
        document.querySelector('form').addEventListener('submit', function(e) {
            const priceInput = document.getElementById('price');
            // Send only digits to server
            priceInput.value = priceInput.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
