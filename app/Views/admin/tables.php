<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Meja</title>
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
                <a href="<?= base_url('admin/tables') ?>" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-2 border-blue-600">
                    <i class="fas fa-chair w-5"></i>
                    <span>Meja</span>
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
                        <h2 class="text-3xl font-bold text-gray-900 mb-1">Manajemen Meja</h2>
                        <p class="text-gray-500">Kelola daftar meja restoran Anda</p>
                    </div>
                    <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus"></i> Tambah Meja
                    </button>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="p-8">
                <?php if (count($tables) > 0) : ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                        <?php foreach ($tables as $table) : ?>
                            <div class="bg-white rounded-xl border border-gray-200 p-6 hover:border-blue-300 transition duration-300 group shadow-md hover:shadow-lg cursor-pointer" data-table-id="<?= $table['id'] ?>">
                                <!-- Status Indicator -->
                                <div class="flex justify-between items-start mb-4">
                                    <div class="text-3xl">
                                        <i class="fas fa-chair text-gray-400 group-hover:text-blue-600 transition"></i>
                                    </div>
                                    <span class="px-3 py-1 <?= isset($table['status']) && $table['status'] === 'available' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-amber-100 text-amber-700 border border-amber-200' ?> rounded-full text-xs font-semibold">
                                        <?= ($table['status'] ?? 'available') === 'available' ? '✓ Kosong' : '◉ Terisi' ?>
                                    </span>
                                </div>

                                <!-- Details -->
                                <h3 class="text-gray-900 font-bold text-lg mb-2" data-table-name><?= $table['table_number'] ?? '-' ?></h3>
                                <div class="space-y-2 mb-4">
                                    <p class="text-gray-600 text-sm">
                                        <i class="fas fa-users mr-2 text-blue-600"></i>Kapasitas: <span class="text-gray-900 font-semibold" data-table-capacity><?= $table['capacity'] ?? '-' ?></span> orang
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2 pt-4 border-t border-gray-200">
                                    <button type="button" onclick="openEditModal('<?= $table['id'] ?>', '<?= $table['table_number'] ?>', '<?= $table['capacity'] ?>')" class="flex-1 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-600 rounded-lg font-medium transition duration-200 text-sm border border-blue-200">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button type="button" onclick="confirmDelete('<?= $table['id'] ?>', '<?= $table['table_number'] ?>')" class="flex-1 px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg font-medium transition duration-200 text-sm border border-red-200">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else : ?>
                    <div class="flex flex-col items-center justify-center py-16 bg-white rounded-xl border border-gray-200 shadow-sm">
                        <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-600 text-lg font-medium">Belum ada meja</p>
                        <p class="text-gray-500 text-sm mt-2">Mulai tambahkan meja baru untuk restoran Anda</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="createModalContent">
            <!-- Header -->
            <div class="bg-gradient-to-r from-green-50 to-green-100 px-6 py-6 border-b border-green-200 flex flex-col items-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-plus text-green-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Tambah Meja Baru</h3>
            </div>

            <!-- Form -->
            <form id="createTableForm" class="p-6 space-y-4">
                <!-- Nomor Meja -->
                <div>
                    <label for="createTableNumber" class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-chair mr-2 text-blue-600"></i>Nomor Meja
                    </label>
                    <input 
                        type="text" 
                        id="createTableNumber" 
                        name="table_number" 
                        placeholder="Contoh: 1, 2, VIP-A"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                        required
                    >
                </div>

                <!-- Kapasitas -->
                <div>
                    <label for="createTableCapacity" class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-users mr-2 text-blue-600"></i>Kapasitas (orang)
                    </label>
                    <input 
                        type="number" 
                        id="createTableCapacity" 
                        name="capacity" 
                        placeholder="Contoh: 4"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                        min="1"
                        required
                    >
                </div>

                <!-- Alert Messages -->
                <div id="createModalAlert" class="hidden p-3 rounded-lg border"></div>
            </form>

            <!-- Buttons -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex gap-3 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="closeCreateModal()" 
                    class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition duration-200"
                >
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button 
                    type="button" 
                    id="submitCreateBtn"
                    onclick="submitCreateTable()" 
                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-md hover:shadow-lg"
                >
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="editModalContent">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-6 border-b border-blue-200 flex flex-col items-center">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-edit text-blue-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Edit Meja</h3>
            </div>

            <!-- Form -->
            <form id="editTableForm" class="p-6 space-y-4">
                <input type="hidden" id="editTableId" name="id">
                
                <!-- Nomor Meja -->
                <div>
                    <label for="editTableNumber" class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-chair mr-2 text-blue-600"></i>Nomor Meja
                    </label>
                    <input 
                        type="text" 
                        id="editTableNumber" 
                        name="table_number" 
                        placeholder="Contoh: 1, 2, VIP-A"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                        required
                    >
                </div>

                <!-- Kapasitas -->
                <div>
                    <label for="editTableCapacity" class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-users mr-2 text-blue-600"></i>Kapasitas (orang)
                    </label>
                    <input 
                        type="number" 
                        id="editTableCapacity" 
                        name="capacity" 
                        placeholder="Contoh: 4"
                        class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition duration-200"
                        min="1"
                        required
                    >
                </div>

                <!-- Alert Messages -->
                <div id="editModalAlert" class="hidden p-3 rounded-lg border"></div>
            </form>

            <!-- Buttons -->
            <div class="px-6 py-4 bg-gray-50 rounded-b-xl flex gap-3 border-t border-gray-200">
                <button 
                    type="button" 
                    onclick="closeEditModal()" 
                    class="flex-1 px-4 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition duration-200"
                >
                    <i class="fas fa-times mr-2"></i>Batal
                </button>
                <button 
                    type="button" 
                    id="submitEditBtn"
                    onclick="submitEditTable()" 
                    class="flex-1 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold rounded-lg transition duration-200 shadow-md hover:shadow-lg"
                >
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50 transition-opacity duration-300">
        <div class="bg-white rounded-xl shadow-2xl max-w-sm w-full mx-4 transform transition-all duration-300 scale-95 opacity-0" id="deleteModalContent">
            <!-- Icon & Title -->
            <div class="bg-gradient-to-r from-red-50 to-red-100 px-6 py-6 border-b border-red-200 flex flex-col items-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900">Hapus Meja</h3>
            </div>

            <!-- Message -->
            <div class="px-6 py-6">
                <p class="text-gray-600 text-center">
                    Apakah Anda yakin ingin menghapus meja <strong id="deleteTableNumber"></strong>?
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
        let deleteTableId = null;
        let editTableId = null;

        // CREATE MODAL FUNCTIONS
        function openCreateModal() {
            document.getElementById('createTableNumber').value = '';
            document.getElementById('createTableCapacity').value = '';
            
            const createModal = document.getElementById('createModal');
            const createModalContent = document.getElementById('createModalContent');
            const createModalAlert = document.getElementById('createModalAlert');
            
            createModalAlert.classList.add('hidden');
            createModal.classList.remove('hidden');
            
            setTimeout(() => {
                createModalContent.classList.remove('scale-95', 'opacity-0');
                createModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeCreateModal() {
            const createModal = document.getElementById('createModal');
            const createModalContent = document.getElementById('createModalContent');
            
            createModalContent.classList.add('scale-95', 'opacity-0');
            createModalContent.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                createModal.classList.add('hidden');
            }, 300);
        }

        function submitCreateTable() {
            const tableNumber = document.getElementById('createTableNumber').value;
            const capacity = document.getElementById('createTableCapacity').value;
            const submitBtn = document.getElementById('submitCreateBtn');
            const createModalAlert = document.getElementById('createModalAlert');
            
            // Validasi
            if (!tableNumber.trim()) {
                showCreateAlert('Nomor meja tidak boleh kosong', 'error');
                return;
            }
            
            if (!capacity || capacity <= 0) {
                showCreateAlert('Kapasitas harus lebih dari 0', 'error');
                return;
            }
            
            // Submit via AJAX
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            
            fetch('<?= base_url('admin/tables/store') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'table_number': tableNumber,
                    'capacity': capacity,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showCreateAlert('Meja berhasil ditambahkan!', 'success');
                    setTimeout(() => {
                        // Reload page untuk menampilkan data terbaru
                        location.reload();
                    }, 1000);
                } else {
                    showCreateAlert(data.message || 'Gagal menambahkan meja', 'error');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showCreateAlert('Terjadi kesalahan saat menyimpan', 'error');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
            });
        }

        function showCreateAlert(message, type) {
            const createModalAlert = document.getElementById('createModalAlert');
            createModalAlert.textContent = message;
            createModalAlert.classList.remove('hidden');
            
            if (type === 'error') {
                createModalAlert.className = 'p-3 rounded-lg border bg-red-50 border-red-200 text-red-700';
            } else {
                createModalAlert.className = 'p-3 rounded-lg border bg-green-50 border-green-200 text-green-700';
            }
        }

        // Close create modal when clicking outside
        document.getElementById('createModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateModal();
            }
        });

        // Close create modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('createModal').classList.contains('hidden')) {
                closeCreateModal();
            }
        });

        // EDIT MODAL FUNCTIONS
        function openEditModal(id, tableNumber, capacity) {
            editTableId = id;
            document.getElementById('editTableId').value = id;
            document.getElementById('editTableNumber').value = tableNumber;
            document.getElementById('editTableCapacity').value = capacity;
            
            const editModal = document.getElementById('editModal');
            const editModalContent = document.getElementById('editModalContent');
            const editModalAlert = document.getElementById('editModalAlert');
            
            editModalAlert.classList.add('hidden');
            editModal.classList.remove('hidden');
            
            setTimeout(() => {
                editModalContent.classList.remove('scale-95', 'opacity-0');
                editModalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeEditModal() {
            const editModal = document.getElementById('editModal');
            const editModalContent = document.getElementById('editModalContent');
            
            editModalContent.classList.add('scale-95', 'opacity-0');
            editModalContent.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                editModal.classList.add('hidden');
                editTableId = null;
            }, 300);
        }

        function submitEditTable() {
            const id = document.getElementById('editTableId').value;
            const tableNumber = document.getElementById('editTableNumber').value;
            const capacity = document.getElementById('editTableCapacity').value;
            const submitBtn = document.getElementById('submitEditBtn');
            const editModalAlert = document.getElementById('editModalAlert');
            
            // Validasi
            if (!tableNumber.trim()) {
                showEditAlert('Nomor meja tidak boleh kosong', 'error');
                return;
            }
            
            if (!capacity || capacity <= 0) {
                showEditAlert('Kapasitas harus lebih dari 0', 'error');
                return;
            }
            
            // Submit via AJAX
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            
            fetch('<?= base_url('admin/tables/update/') ?>' + id, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    'table_number': tableNumber,
                    'capacity': capacity,
                    '<?= csrf_token() ?>': '<?= csrf_hash() ?>'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update table card in background
                    updateTableCard(id, tableNumber, capacity);
                    showEditAlert('Meja berhasil diperbarui!', 'success');
                    setTimeout(() => {
                        closeEditModal();
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
                    }, 1000);
                } else {
                    showEditAlert(data.message || 'Gagal memperbarui meja', 'error');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showEditAlert('Terjadi kesalahan saat menyimpan', 'error');
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Simpan';
            });
        }

        function showEditAlert(message, type) {
            const editModalAlert = document.getElementById('editModalAlert');
            editModalAlert.textContent = message;
            editModalAlert.classList.remove('hidden');
            
            if (type === 'error') {
                editModalAlert.className = 'p-3 rounded-lg border bg-red-50 border-red-200 text-red-700';
            } else {
                editModalAlert.className = 'p-3 rounded-lg border bg-green-50 border-green-200 text-green-700';
            }
        }

        function updateTableCard(id, tableNumber, capacity) {
            // Update semua kartu yang memiliki data-table-id yang sesuai
            const cards = document.querySelectorAll(`[data-table-id="${id}"]`);
            cards.forEach(card => {
                const nameEl = card.querySelector('[data-table-name]');
                const capacityEl = card.querySelector('[data-table-capacity]');
                if (nameEl) nameEl.textContent = tableNumber;
                if (capacityEl) capacityEl.textContent = capacity;
            });
        }

        // Close edit modal when clicking outside
        document.getElementById('editModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close edit modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('editModal').classList.contains('hidden')) {
                closeEditModal();
            }
        });

        // DELETE MODAL FUNCTIONS
        function confirmDelete(id, tableNumber) {
            deleteTableId = id;
            document.getElementById('deleteTableNumber').textContent = tableNumber;
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
                deleteTableId = null;
            }, 300);
        }

        function confirmDeleteAction() {
            if (deleteTableId) {
                window.location.href = '<?= base_url('admin/tables/delete/') ?>' + deleteTableId;
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
