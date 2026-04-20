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
        $ordersCount = [
            'pending' => 0,
            'completed' => 0,
            'cancelled' => 0
        ];
        foreach ($allOrders as $order) {
            if (isset($ordersCount[$order['status']])) {
                $ordersCount[$order['status']]++;
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

        // Get revenue last 7 days
        $revenueData = [];
        $labels = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-{$i} days"));
            $labels[] = date('l', strtotime($date)); // Day name (Senin, Selasa, etc)
            
            $revenue = $db->table('orders')
                ->select('SUM(total_price) as total')
                ->where('DATE(created_at)', $date)
                ->where('status !=', 'pending')
                ->get()
                ->getRow();
            
            $revenueData[] = $revenue->total ?? 0;
        }

        $data = [
            'totalTables' => $totalTables,
            'totalMenu' => $totalMenu,
            'totalOrdersToday' => $totalOrdersToday,
            'totalUsers' => $totalUsers,
            'revenueToday' => $revenueToday->total ?? 0,
            'ordersCount' => $ordersCount,
            'recentOrders' => $recentOrders,
            'revenueLabels' => json_encode($labels),
            'revenueData' => json_encode($revenueData),
        ];

        return view('admin/dashboard', $data);
    }

    public function tables()
    {
        $model = new TableModel();
        $data['tables'] = $model->findAll();
        return view('admin/tables', $data);
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
        $model = new OrderModel();
        $data['orders'] = $model->findAll();
        return view('admin/orders', $data);
    }

    public function users()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('admin/users', $data);
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

    public function deleteMenu($id)
    {
        $model = new MenuModel();
        
        if ($model->delete($id)) {
            return redirect()->to('admin/menu')->with('success', 'Menu berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus menu');
        }
    }
}