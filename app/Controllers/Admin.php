<?php

namespace App\Controllers;

use App\Models\TableModel;
use App\Models\MenuModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        $tableModel = new TableModel();
        $menuModel  = new MenuModel();
        $orderModel = new OrderModel();
        $db = \Config\Database::connect();

        // Get statistics
        $totalTables = $tableModel->countAll();
        $totalMenu = $menuModel->countAll();
        $totalOrdersToday = $orderModel->where('DATE(created_at)', date('Y-m-d'))->countAllResults();
        $totalUsers = $db->table('users')->countAllResults();

        // Get revenue today
        $revenueToday = $db->table('orders')
            ->select('SUM(total_price) as total')
            ->where('DATE(created_at)', date('Y-m-d'))
            ->where('status !=', 'pending')
            ->get()
            ->getRow();

        // Get all orders with status
        $allOrders = $orderModel->findAll();
        $paymentMethodCount = [
            'cash' => 0,
            'card' => 0,
            'transfer' => 0,
            'qris' => 0
        ];
        foreach ($allOrders as $order) {
            $method = $order['payment_method'] ?? 'cash';
            if (isset($paymentMethodCount[$method])) {
                $paymentMethodCount[$method]++;
            } else {
                $paymentMethodCount['cash']++;
            }
        }

        // Get recent orders
        $recentOrders = $db->table('orders')
            ->select('orders.*, tables.table_number')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->orderBy('orders.created_at', 'DESC')
            ->limit(6)
            ->get()
            ->getResult();

        // Get order items for each recent order
        foreach ($recentOrders as $order) {
            $order->items = $db->table('order_items')
                ->select('order_items.quantity, menu.name')
                ->join('menu', 'menu.id = order_items.menu_id', 'left')
                ->where('order_items.order_id', $order->id)
                ->get()
                ->getResultArray();
        }

        // Get revenue last 7 days
        $revenueData = [];
        $revenueByPayment = [
            'cash' => [],
            'card' => [],
            'transfer' => [],
            'qris' => []
        ];
        $labels = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-{$i} days"));
            $dayName = date('D', strtotime($date));
            $dateFormatted = date('d M', strtotime($date));
            $labels[] = $dayName . ' ' . $dateFormatted;
            
            // Total revenue for the day
            $revenue = $db->table('orders')
                ->select('SUM(total_price) as total')
                ->where('DATE(created_at)', $date)
                ->get()
                ->getRow();
            
            $revenueData[] = $revenue->total ?? 0;
            
            // Revenue breakdown by payment method
            foreach (array_keys($revenueByPayment) as $method) {
                $methodRevenue = $db->table('orders')
                    ->select('SUM(total_price) as total')
                    ->where('DATE(created_at)', $date)
                    ->where('payment_method', $method)
                    ->get()
                    ->getRow();
                
                $revenueByPayment[$method][] = $methodRevenue->total ?? 0;
            }
        }

        $data = [
            'totalTables' => $totalTables,
            'totalMenu' => $totalMenu,
            'totalOrdersToday' => $totalOrdersToday,
            'totalUsers' => $totalUsers,
            'revenueToday' => $revenueToday->total ?? 0,
            'paymentMethodCount' => $paymentMethodCount,
            'recentOrders' => $recentOrders,
            'revenueLabels' => json_encode($labels),
            'revenueData' => json_encode($revenueData),
            'cashData' => json_encode($revenueByPayment['cash']),
            'cardData' => json_encode($revenueByPayment['card']),
            'transferData' => json_encode($revenueByPayment['transfer']),
            'qrisData' => json_encode($revenueByPayment['qris']),
        ];

        return view('admin/dashboard', $data);
    }

    public function tables()
    {
        $model = new TableModel();
        $data['tables'] = $model->findAll();
        return view('admin/tables', $data);
    }

    public function createTable()
    {
        return view('admin/tables/create');
    }

    public function storeTable()
    {
        $model = new TableModel();
        $request = $this->request;
        
        $tableNumber = $request->getPost('table_number');
        $capacity = $request->getPost('capacity');
        
        // Validasi
        if (empty($tableNumber)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Nomor meja tidak boleh kosong']);
            }
            return redirect()->back()->with('error', 'Nomor meja tidak boleh kosong')->withInput();
        }
        
        if (empty($capacity) || $capacity <= 0) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Kapasitas harus lebih dari 0']);
            }
            return redirect()->back()->with('error', 'Kapasitas harus lebih dari 0')->withInput();
        }
        
        $data = [
            'table_number' => $tableNumber,
            'capacity' => (int) $capacity,
            'status' => 'available'
        ];

        if ($model->insert($data)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true, 
                    'message' => 'Meja berhasil ditambahkan',
                    'data' => array_merge($data, ['id' => $model->getInsertID()])
                ]);
            }
            return redirect()->to('admin/tables')->with('success', 'Meja berhasil ditambahkan');
        } else {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal menambahkan meja']);
            }
            return redirect()->back()->with('error', 'Gagal menambahkan meja')->withInput();
        }
    }

    public function editTable($id)
    {
        $model = new TableModel();
        $table = $model->find($id);
        
        if (!$table) {
            return redirect()->to('admin/tables')->with('error', 'Meja tidak ditemukan');
        }
        
        $data = [
            'table' => $table,
            'title' => 'Edit Meja'
        ];
        
        return view('admin/tables/edit', $data);
    }

    public function updateTable($id)
    {
        $model = new TableModel();
        $request = $this->request;
        
        $table = $model->find($id);
        if (!$table) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Meja tidak ditemukan']);
            }
            return redirect()->to('admin/tables')->with('error', 'Meja tidak ditemukan');
        }
        
        $tableNumber = $request->getPost('table_number');
        $capacity = $request->getPost('capacity');
        
        // Validasi
        if (empty($tableNumber)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Nomor meja tidak boleh kosong']);
            }
            return redirect()->back()->with('error', 'Nomor meja tidak boleh kosong')->withInput();
        }
        
        if (empty($capacity) || $capacity <= 0) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Kapasitas harus lebih dari 0']);
            }
            return redirect()->back()->with('error', 'Kapasitas harus lebih dari 0')->withInput();
        }
        
        $data = [
            'table_number' => $tableNumber,
            'capacity' => (int) $capacity
        ];

        if ($model->update($id, $data)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true, 
                    'message' => 'Meja berhasil diperbarui',
                    'data' => ['id' => $id, 'table_number' => $tableNumber, 'capacity' => $capacity]
                ]);
            }
            return redirect()->to('admin/tables')->with('success', 'Meja berhasil diperbarui');
        } else {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Gagal memperbarui meja']);
            }
            return redirect()->back()->with('error', 'Gagal memperbarui meja')->withInput();
        }
    }

    public function deleteTable($id)
    {
        $model = new TableModel();
        
        if ($model->delete($id)) {
            return redirect()->to('admin/tables')->with('success', 'Meja berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus meja');
        }
    }

    public function menu()
    {
        $model = new MenuModel();
        $allMenus = $model->findAll();
        
        // Group menus by category
        $menuByCategory = [];
        foreach ($allMenus as $item) {
            $category = $item['category'] ?? 'Lainnya';
            if (!isset($menuByCategory[$category])) {
                $menuByCategory[$category] = [];
            }
            $menuByCategory[$category][] = $item;
        }
        
        // Sort categories alphabetically
        ksort($menuByCategory);
        
        $data['menuByCategory'] = $menuByCategory;
        return view('admin/menu', $data);
    }

    public function orders()
    {
        $db = \Config\Database::connect();
        $perPage = 10;
        
        // Get page number from query string with validation
        $page = (int) $this->request->getGet('page');
        if ($page < 1) {
            $page = 1;
        }
        
        // Count total orders
        $total = $db->table('orders')->countAllResults();
        
        // Calculate offset
        $offset = ($page - 1) * $perPage;
        
        // Get orders with pagination
        $orders = $db->table('orders')
            ->select('orders.id, orders.table_id, orders.total_price, orders.status, orders.created_at, orders.payment_method, tables.table_number')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->orderBy('orders.created_at', 'DESC')
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();
        
        // Get order items for each order
        foreach ($orders as &$order) {
            $order['items'] = $db->table('order_items')
                ->select('order_items.quantity, order_items.price, menu.name')
                ->join('menu', 'menu.id = order_items.menu_id', 'left')
                ->where('order_items.order_id', $order['id'])
                ->get()
                ->getResultArray();
        }
        
        // Calculate total pages
        $totalPages = ceil($total / $perPage);
        
        $data['orders'] = $orders;
        $data['page'] = $page;
        $data['perPage'] = $perPage;
        $data['total'] = $total;
        $data['totalPages'] = $totalPages;
        return view('admin/orders', $data);
    }

    public function detailOrder($id)
    {
        $db = \Config\Database::connect();
        
        // Get order with related table
        $order = $db->table('orders')
            ->select('orders.id, orders.table_id, orders.total_price, orders.status, orders.created_at, orders.guest_count, orders.payment_method, orders.payment_amount, tables.table_number')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->where('orders.id', $id)
            ->get()
            ->getRowArray();
        
        if (!$order) {
            return redirect()->to('admin/orders')->with('error', 'Pesanan tidak ditemukan');
        }
        
        // Get order items with menu details
        $order['items'] = $db->table('order_items')
            ->select('order_items.id, order_items.quantity, order_items.price, menu.name, menu.image')
            ->join('menu', 'menu.id = order_items.menu_id', 'left')
            ->where('order_items.order_id', $id)
            ->get()
            ->getResultArray();
        
        $data['order'] = $order;
        return view('admin/orders/detail', $data);
    }

    public function updateOrderStatus($id)
    {
        $db = \Config\Database::connect();
        $request = $this->request;
        
        $status = $request->getPost('status');
        
        // Validate status
        $validStatuses = ['pending', 'completed', 'cancelled'];
        if (!in_array($status, $validStatuses)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON(['success' => false, 'message' => 'Status tidak valid']);
            }
            return redirect()->back()->with('error', 'Status tidak valid');
        }
        
        // Update status
        $db->table('orders')
            ->where('id', $id)
            ->update(['status' => $status]);
        
        if ($request->isAJAX()) {
            return $this->response->setJSON(['success' => true, 'message' => 'Status pesanan berhasil diubah', 'status' => $status]);
        }
        
        return redirect()->back()->with('success', 'Status pesanan berhasil diubah');
    }

    public function users()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/users', $data);
    }

    public function createUser()
    {
        return view('admin/users/create');
    }

    public function storeUser()
    {
        $model = new UserModel();
        $request = $this->request;
        $session = session();

        // Validasi
        if (!$this->validate([
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]',
            'password' => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
            'role' => 'required|in_list[admin,kasir]'
        ])) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => implode(', ', $this->validator->getErrors())
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $request->getPost('username'),
            'full_name' => $request->getPost('full_name'),
            'password' => password_hash($request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $request->getPost('role')
        ];

        if ($model->insert($data)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'User berhasil ditambahkan'
                ]);
            }
            return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan');
        } else {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menambahkan user'
                ]);
            }
            return redirect()->back()->with('error', 'Gagal menambahkan user')->withInput();
        }
    }

    public function editUser($id)
    {
        $model = new UserModel();
        $data['user'] = $model->find($id);
        
        if (!$data['user']) {
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }
        
        return view('admin/users/edit', $data);
    }

    public function updateUser($id)
    {
        $model = new UserModel();
        $request = $this->request;

        // Cek user ada atau tidak
        $user = $model->find($id);
        if (!$user) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ]);
            }
            return redirect()->to('/admin/users')->with('error', 'User tidak ditemukan');
        }

        // Validasi
        $rules = [
            'username' => 'required|min_length[3]',
            'full_name' => 'required|min_length[3]',
            'role' => 'required|in_list[admin,kasir]'
        ];

        // Check unique hanya jika data berubah
        if ($request->getPost('username') !== $user['username']) {
            $rules['username'] .= '|is_unique[users.username]';
        }

        // Jika ada password, validasi
        if ($request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
            $rules['password_confirm'] = 'matches[password]';
        }

        if (!$this->validate($rules)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => implode(', ', $this->validator->getErrors())
                ]);
            }
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $request->getPost('username'),
            'full_name' => $request->getPost('full_name'),
            'role' => $request->getPost('role')
        ];

        if ($request->getPost('password')) {
            $data['password'] = password_hash($request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($model->update($id, $data)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'User berhasil diperbarui'
                ]);
            }
            return redirect()->to('/admin/users')->with('success', 'User berhasil diperbarui');
        } else {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal memperbarui user'
                ]);
            }
            return redirect()->back()->with('error', 'Gagal memperbarui user')->withInput();
        }
    }

    public function deleteUser($id)
    {
        $model = new UserModel();
        $request = $this->request;

        if ($model->delete($id)) {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'User berhasil dihapus'
                ]);
            }
            return redirect()->to('/admin/users')->with('success', 'User berhasil dihapus');
        } else {
            if ($request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Gagal menghapus user'
                ]);
            }
            return redirect()->to('/admin/users')->with('error', 'Gagal menghapus user');
        }
    }

    public function createMenu()
    {
        $db = \Config\Database::connect();
        $categories = $db->table('menu')
            ->distinct()
            ->select('category')
            ->where('category !=', '')
            ->where('category !=', null)
            ->orderBy('category', 'ASC')
            ->get()
            ->getResultArray();
        
        $data['categories'] = $categories;
        return view('admin/menu/create', $data);
    }

    public function storeMenu()
    {
        $model = new MenuModel();
        $request = $this->request;
        
        $category = $request->getPost('category');
        $price = $request->getPost('price');
        
        // Validasi harga
        if (empty($price) || $price === '0' || $price === 0) {
            return redirect()->back()->with('error', 'Harga tidak boleh kosong atau 0')->withInput();
        }
        
        // Jika kategori baru
        if ($category === '__new__') {
            $category = trim($request->getPost('newCategory'));
            if (empty($category)) {
                return redirect()->back()->with('error', 'Kategori tidak boleh kosong')->withInput();
            }
        }
        
        $imageFile = null;
        
        // Handle image upload
        $file = $request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validasi file
            $validMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $validMimes)) {
                return redirect()->back()->with('error', 'Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WebP')->withInput();
            }
            
            if ($file->getSize() > 5 * 1024 * 1024) { // 5MB
                return redirect()->back()->with('error', 'Ukuran file terlalu besar (max 5MB)')->withInput();
            }
            
            // Generate unique filename
            $newName = $file->getRandomName();
            $uploadPath = 'uploads/menu';
            
            // Create directory if not exists
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file
            if ($file->move($uploadPath, $newName)) {
                $imageFile = $uploadPath . '/' . $newName;
            } else {
                return redirect()->back()->with('error', 'Gagal upload gambar')->withInput();
            }
        }
        
        $data = [
            'name' => $request->getPost('name'),
            'description' => null,
            'price' => (int) $price,
            'category' => strtolower(trim($category)),
            'image' => $imageFile,
        ];

        if ($model->insert($data)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil ditambahkan');
        } else {
            return redirect()->back()->with('error', 'Gagal menambahkan menu')->withInput();
        }
    }

    public function editMenu($id)
    {
        $model = new MenuModel();
        $menu = $model->find($id);
        
        if (!$menu) {
            return redirect()->to('admin/menu')->with('error', 'Menu tidak ditemukan');
        }
        
        // Get all categories from database
        $db = \Config\Database::connect();
        $categories = $db->table('menu')
            ->distinct()
            ->select('category')
            ->orderBy('category', 'ASC')
            ->get()
            ->getResultArray();
        
        $data = [
            'menu' => $menu,
            'categories' => $categories,
            'title' => 'Edit Menu'
        ];
        
        return view('admin/menu/edit', $data);
    }

    public function updateMenu($id)
    {
        $model = new MenuModel();
        $request = $this->request;
        
        $menu = $model->find($id);
        if (!$menu) {
            return redirect()->to('admin/menu')->with('error', 'Menu tidak ditemukan');
        }
        
        $category = $request->getPost('category');
        $price = $request->getPost('price');
        
        // Validasi harga
        if (empty($price) || $price === '0' || $price === 0) {
            return redirect()->back()->with('error', 'Harga tidak boleh kosong atau 0')->withInput();
        }
        
        // Jika kategori baru
        if ($category === '__new__') {
            $category = trim($request->getPost('newCategory'));
            if (empty($category)) {
                return redirect()->back()->with('error', 'Kategori tidak boleh kosong')->withInput();
            }
        }
        
        $imageFile = $menu['image']; // Keep existing image by default
        
        // Handle image upload
        $file = $request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Validasi file
            $validMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            if (!in_array($file->getMimeType(), $validMimes)) {
                return redirect()->back()->with('error', 'Format file tidak didukung. Gunakan JPG, PNG, GIF, atau WebP')->withInput();
            }
            
            if ($file->getSize() > 5 * 1024 * 1024) { // 5MB
                return redirect()->back()->with('error', 'Ukuran file terlalu besar (max 5MB)')->withInput();
            }
            
            // Delete old image if exists
            if (!empty($menu['image']) && file_exists($menu['image'])) {
                unlink($menu['image']);
            }
            
            // Generate unique filename
            $newName = $file->getRandomName();
            $uploadPath = 'uploads/menu';
            
            // Create directory if not exists
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file
            if ($file->move($uploadPath, $newName)) {
                $imageFile = $uploadPath . '/' . $newName;
            } else {
                return redirect()->back()->with('error', 'Gagal upload gambar')->withInput();
            }
        }
        
        $data = [
            'name' => $request->getPost('name'),
            'description' => null,
            'price' => (int) $price,
            'category' => strtolower(trim($category)),
            'image' => $imageFile,
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui menu')->withInput();
        }
    }

    public function deleteMenu($id)
    {
        $model = new MenuModel();
        
        if ($model->delete($id)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus menu');
        }
    }

    public function profile()
    {
        $db = \Config\Database::connect();
        $userId = session()->get('id');
        $username = session()->get('username');

        // Get user data
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        // Get total orders managed
        $totalOrders = $db->table('orders')->countAllResults();
        
        // Get total revenue
        $revenueData = $db->table('orders')
            ->select('SUM(total_price) as total')
            ->get()
            ->getRow();
        
        $totalRevenue = $revenueData->total ?? 0;

        $data = [
            'user' => $user,
            'username' => $username,
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
        ];

        return view('admin/profile', $data);
    }
}