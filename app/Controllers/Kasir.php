<?php

namespace App\Controllers;

use App\Models\TableModel;
use App\Models\MenuModel;
use App\Models\OrderModel;

class Kasir extends BaseController
{
    protected $table;
    protected $menu;
    protected $order;
    protected $db;

    public function __construct()
    {
        $this->table = new TableModel();
        $this->menu = new MenuModel();
        $this->order = new OrderModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * Display table selection
     */
    public function index()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $tables = $this->table->findAll();

        $data = [
            'title' => 'Pilih Meja - POS Restoran',
            'tables' => $tables,
        ];

        // Set no-cache headers
        $this->response
            ->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->setHeader('Pragma', 'no-cache')
            ->setHeader('Expires', '0');

        return view('kasir/tables', $data);
    }

    /**
     * Input pesanan untuk meja tertentu
     */
    public function order($tableId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$tableId) {
            return redirect()->to('/kasir');
        }

        // Get table info
        $table = $this->table->find($tableId);
        if (!$table) {
            return redirect()->to('/kasir')->with('error', 'Meja tidak ditemukan');
        }

        // Get all menu
        $menu = $this->menu->findAll();
        
        // Define add-ons berdasarkan kategori menu
        $addons = [
            'makanan' => [
                ['id' => 1, 'name' => 'Extra Keju', 'price' => 5000],
                ['id' => 2, 'name' => 'Extra Telur', 'price' => 3000],
                ['id' => 3, 'name' => 'Saus Spesial', 'price' => 2000],
                ['id' => 4, 'name' => 'Bawang Merah Goreng', 'price' => 2500],
            ],
            'minuman' => [
                ['id' => 5, 'name' => 'Extra Es', 'price' => 1000],
                ['id' => 6, 'name' => 'Tambah Sirup', 'price' => 1500],
                ['id' => 7, 'name' => 'Tambah Gula', 'price' => 500],
            ],
            'snack' => [
                ['id' => 8, 'name' => 'Tambah Saus', 'price' => 1000],
                ['id' => 9, 'name' => 'Extra Keju', 'price' => 3000],
            ],
            'paket' => [
                ['id' => 10, 'name' => 'Extra Minuman', 'price' => 5000],
                ['id' => 11, 'name' => 'Extra Dessert', 'price' => 8000],
            ]
        ];
        
        // Set session untuk active table
        session()->set('active_table_id', $tableId);

        $data = [
            'title' => 'Input Pesanan - POS Restoran',
            'table' => $table,
            'table_id' => $tableId,
            'menu' => $menu,
            'addons' => $addons,
        ];

        return view('kasir/order', $data);
    }

    /**
     * Create order and return JSON response
     */
    public function createOrder()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $request = $this->request;
        
        // Get JSON data
        $data = json_decode($request->getBody(), true);
        
        $tableId = $data['table_id'] ?? null;
        $items = $data['items'] ?? [];
        $totalPrice = $data['total_price'] ?? 0;
        $guestCount = $data['guest_count'] ?? 1;

        if (!$tableId || empty($items)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data pesanan tidak lengkap']);
        }

        // Get table info to retrieve customer name
        $table = $this->table->find($tableId);
        $customerName = $table['customer_name'] ?? null;

        // Start transaction
        $this->db->transBegin();

        try {
            // Insert order with customer name
            $orderData = [
                'table_id' => $tableId,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'guest_count' => $guestCount,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            
            // Add customer name if exists
            if ($customerName) {
                $orderData['customer_name'] = $customerName;
            }
            
            $orderId = $this->order->insert($orderData);

            // Insert order items
            foreach ($items as $item) {
                $this->db->table('order_items')->insert([
                    'order_id' => $orderId,
                    'menu_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }

            // Update table status to occupied
            $this->table->update($tableId, ['status' => 'occupied', 'guest_count' => $guestCount]);

            // Commit transaction
            $this->db->transCommit();

            return $this->response->setJSON([
                'success' => true,
                'order_id' => $orderId,
                'message' => 'Pesanan berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            $this->db->transRollback();
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Display payment page for order
     */
    public function payment($orderId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$orderId) {
            return redirect()->to('/kasir');
        }

        // Get order with items
        $order = $this->order->find($orderId);
        if (!$order) {
            return redirect()->to('/kasir')->with('error', 'Pesanan tidak ditemukan');
        }

        // Get order items
        $orderItems = $this->db->table('order_items')
            ->select('order_items.*, menu.name, menu.price')
            ->join('menu', 'menu.id = order_items.menu_id')
            ->where('order_items.order_id', $orderId)
            ->get()
            ->getResultArray();

        $data = [
            'title' => 'Pembayaran - POS Restoran',
            'order' => $order,
            'orderItems' => $orderItems,
        ];

        return view('kasir/payment', $data);
    }

    /**
     * Process payment
     */
    public function processPayment()
    {
        try {
            $session = session();
            if (!$session->get('logged_in')) {
                return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Unauthorized']);
            }

            $request = $this->request;
            $data = json_decode($request->getBody(), true);

            $orderId = $data['order_id'] ?? null;
            $paymentMethod = $data['payment_method'] ?? 'cash';
            $amount = $data['amount'] ?? 0;
            
            log_message('debug', "[processPayment] Starting - Order ID: {$orderId}, Method: {$paymentMethod}, Amount: {$amount}");

            if (!$orderId) {
                return $this->response->setJSON(['success' => false, 'message' => 'Order ID tidak ditemukan']);
            }

            // Get order
            $order = $this->db->table('orders')
                ->where('id', $orderId)
                ->get()
                ->getFirstRow('array');

            if (!$order) {
                return $this->response->setJSON(['success' => false, 'message' => 'Pesanan tidak ditemukan']);
            }
            
            log_message('debug', "[processPayment] Order found: " . json_encode($order));

            // Update order status to completed
            $updateResult = $this->db->table('orders')
                ->where('id', $orderId)
                ->update([
                    'status' => 'completed',
                    'payment_method' => $paymentMethod,
                    'payment_amount' => $amount,
                ]);

            if ($updateResult === false) {
                throw new \Exception('Gagal update order: ' . $this->db->error()['message']);
            }

            // Update table status to occupied (pelanggan sedang makan)
            if (isset($order['table_id']) && !empty($order['table_id'])) {
                $tableId = $order['table_id'];
                log_message('debug', "[processPayment] Updating table {$tableId} to occupied");
                
                $tableUpdate = $this->db->table('tables')
                    ->where('id', $tableId)
                    ->update([
                        'status' => 'occupied'
                    ]);
                
                log_message('debug', "[processPayment] Table update result: " . ($tableUpdate ? 'SUCCESS' : 'FAILED'));
                
                if ($tableUpdate === false) {
                    throw new \Exception('Gagal update table: ' . $this->db->error()['message']);
                }
                
                // Verify update
                $verifyTable = $this->db->table('tables')->where('id', $tableId)->get()->getFirstRow('array');
                log_message('debug', "[processPayment] Verified table status: " . json_encode($verifyTable));
            }

            // Save payment record
            $insertResult = $this->db->table('payments')->insert([
                'order_id' => $orderId,
                'payment_method' => $paymentMethod,
                'amount' => $amount,
                'cash_received' => $data['cash_received'] ?? null,
                'change' => $data['change'] ?? 0,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            if ($insertResult === false) {
                throw new \Exception('Gagal insert payment: ' . $this->db->error()['message']);
            }

            return $this->response->setJSON([
                'success' => true,
                'order_id' => $orderId,
                'message' => 'Pembayaran berhasil diproses'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Payment error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Display receipt/completion page
     */
    public function receipt($orderId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$orderId) {
            return redirect()->to('/kasir');
        }

        // Get order with details
        $order = $this->order->find($orderId);
        if (!$order) {
            return redirect()->to('/kasir')->with('error', 'Pesanan tidak ditemukan');
        }

        // Get order items
        $orderItems = $this->db->table('order_items')
            ->select('order_items.*, menu.name')
            ->join('menu', 'menu.id = order_items.menu_id')
            ->where('order_items.order_id', $orderId)
            ->get()
            ->getResultArray();

        // Get payment info
        $payment = $this->db->table('payments')
            ->where('order_id', $orderId)
            ->get()
            ->getFirstRow('array');

        $data = [
            'title' => 'Struk - POS Restoran',
            'order' => $order,
            'orderItems' => $orderItems,
            'payment' => $payment,
        ];

        return view('kasir/receipt', $data);
    }

    /**
     * Get all tables as JSON (AJAX) - Always fetch fresh from database
     */
    public function getTables()
    {
        // Force fresh data from database, no caching
        $tables = $this->db->table('tables')
            ->select('*')
            ->get()
            ->getResultArray();
        
        return $this->response
            ->setHeader('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->setHeader('Pragma', 'no-cache')
            ->setHeader('Expires', '0')
            ->setJSON($tables);
    }

    /**
     * Get menu by category (AJAX)
     */
    public function getMenuByCategory($category = null)
    {
        $menu = $this->menu->where('category', $category)->findAll();
        return $this->response->setJSON($menu);
    }

    /**
     * Update table status
     */
    public function updateTableStatus($tableId, $status = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'error' => 'Unauthorized']);
        }

        $request = $this->request;
        
        // Log incoming request
        log_message('debug', "[updateTableStatus] Table ID: {$tableId}, Status param: {$status}");
        log_message('debug', "[updateTableStatus] Request method: " . $request->getMethod());

        // If status not in URL, try to get from POST JSON
        if (!$status || $request->getMethod() === 'POST') {
            $data = json_decode($request->getBody(), true);
            log_message('debug', "[updateTableStatus] POST data: " . json_encode($data));
            
            $status = $data['status'] ?? $status;
            $guestCount = $data['guest_count'] ?? null;
            $customerName = $data['customer_name'] ?? null;
        } else {
            $guestCount = null;
            $customerName = null;
        }

        log_message('debug', "[updateTableStatus] Status: {$status}, Guest count: " . ($guestCount ?? 'null') . ", Customer: " . ($customerName ?? 'null'));

        if (!$status) {
            log_message('warn', "[updateTableStatus] Status not found!");
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'error' => 'Status tidak ditemukan']);
        }

        // Build update data
        $updateData = ['status' => $status];
        if ($guestCount !== null) {
            $updateData['guest_count'] = $guestCount;
        }
        if ($customerName !== null) {
            $updateData['customer_name'] = $customerName;
        }

        log_message('debug', "[updateTableStatus] Updating table {$tableId} with data: " . json_encode($updateData));

        $updateResult = $this->table->update($tableId, $updateData);
        
        if ($updateResult === false) {
            log_message('error', "[updateTableStatus] Update failed for table {$tableId}");
            return $this->response->setStatusCode(500)->setJSON(['success' => false, 'error' => 'Update failed']);
        }

        // Verify update
        $verifyTable = $this->table->find($tableId);
        log_message('debug', "[updateTableStatus] After update - Table data: " . json_encode($verifyTable));

        return $this->response->setJSON(['success' => true, 'message' => 'Table status updated', 'table' => $verifyTable]);
    }

    /**
     * Finish table - mark table as available after customer finished eating
     */
    public function finishTable($tableId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        if (!$tableId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Table ID tidak ditemukan']);
        }

        try {
            // Get table
            $table = $this->table->find($tableId);
            if (!$table) {
                return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Meja tidak ditemukan']);
            }

            // Update table status to available and reset guest count
            $updateResult = $this->db->table('tables')
                ->where('id', $tableId)
                ->update([
                    'status' => 'available',
                    'guest_count' => 0
                ]);

            if ($updateResult === false) {
                throw new \Exception('Gagal update table: ' . $this->db->error()['message']);
            }

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Meja berhasil dibebaskan'
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Finish table error: ' . $e->getMessage());
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }


    /**
     * Display kasir profile
     */
    public function profile()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Get user data from session
        $userId = $session->get('user_id');
        $username = $session->get('username');
        
        // Get user from database for more details
        $user = $this->db->table('users')->where('id', $userId)->get()->getRow();
        
        // Get kasir stats - total transactions today
        $today = date('Y-m-d');
        $completedOrders = $this->db->table('orders')
            ->where('DATE(created_at)', $today)
            ->where('status', 'completed')
            ->countAllResults();
        
        // Get total revenue today
        $todayRevenue = $this->db->table('orders')
            ->where('DATE(created_at)', $today)
            ->where('status', 'completed')
            ->selectSum('total_price')
            ->get()
            ->getRow();

        $data = [
            'title' => 'Profil Kasir - POS Restoran',
            'user' => $user,
            'username' => $username,
            'completedOrders' => $completedOrders,
            'todayRevenue' => $todayRevenue->total_price ?? 0,
        ];

        return view('kasir/profile', $data);
    }

    /**
     * Display order history with filter and search
     */
    public function history()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = [
            'title' => 'Riwayat Transaksi - POS Restoran',
        ];

        return view('kasir/history', $data);
    }

    /**
     * Get history data with filter, search, and pagination (AJAX)
     */
    public function getHistoryData()
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $request = $this->request;
        $page = (int)($request->getGet('page') ?? 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        // Get filter parameters
        $filter = $request->getGet('filter') ?? 'today'; // today, yesterday, 7days, month
        $search = $request->getGet('search') ?? '';

        // Build query
        $query = $this->db->table('orders')
            ->select('orders.id, orders.table_id, orders.total_price, orders.status, orders.created_at, tables.table_number, payments.payment_method')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->join('payments', 'payments.order_id = orders.id', 'left')
            ->where('orders.status', 'completed');

        // Apply date filter
        switch ($filter) {
            case 'today':
                $query->where('DATE(orders.created_at)', date('Y-m-d'));
                break;
            case 'yesterday':
                $yesterday = date('Y-m-d', strtotime('-1 day'));
                $query->where('DATE(orders.created_at)', $yesterday);
                break;
            case '7days':
                $sevenDaysAgo = date('Y-m-d', strtotime('-6 day'));
                $query->where('DATE(orders.created_at) >=', $sevenDaysAgo);
                break;
            case 'month':
                $query->where('MONTH(orders.created_at)', date('m'))
                      ->where('YEAR(orders.created_at)', date('Y'));
                break;
        }

        // Apply search filter
        if (!empty($search)) {
            $query->groupStart()
                  ->like('orders.id', $search)
                  ->orLike('tables.table_number', $search)
                  ->groupEnd();
        }

        // Get total count
        $totalQuery = clone $query;
        $totalRecords = $totalQuery->countAllResults();

        // Get paginated data
        $orders = $query->orderBy('orders.created_at', 'DESC')
                       ->limit($perPage, $offset)
                       ->get()
                       ->getResultArray();

        // Get items for each order
        foreach ($orders as &$order) {
            $orderItems = $this->db->table('order_items')
                ->select('order_items.*, menu.name')
                ->join('menu', 'menu.id = order_items.menu_id')
                ->where('order_items.order_id', $order['id'])
                ->get()
                ->getResultArray();
            $order['items'] = $orderItems;
        }

        // Calculate summary
        $summaryQuery = $this->db->table('orders')
            ->where('orders.status', 'completed');

        switch ($filter) {
            case 'today':
                $summaryQuery->where('DATE(orders.created_at)', date('Y-m-d'));
                break;
            case 'yesterday':
                $yesterday = date('Y-m-d', strtotime('-1 day'));
                $summaryQuery->where('DATE(orders.created_at)', $yesterday);
                break;
            case '7days':
                $sevenDaysAgo = date('Y-m-d', strtotime('-6 day'));
                $summaryQuery->where('DATE(orders.created_at) >=', $sevenDaysAgo);
                break;
            case 'month':
                $summaryQuery->where('MONTH(orders.created_at)', date('m'))
                             ->where('YEAR(orders.created_at)', date('Y'));
                break;
        }

        if (!empty($search)) {
            $summaryQuery->groupStart()
                         ->like('orders.id', $search)
                         ->orLike('tables.table_number', $search)
                         ->groupEnd();
        }

        $totalOmzet = $summaryQuery->selectSum('total_price')->get()->getRow()->total_price ?? 0;
        $totalTransactions = $summaryQuery->countAllResults();

        $data = [
            'success' => true,
            'orders' => $orders,
            'pagination' => [
                'page' => $page,
                'per_page' => $perPage,
                'total' => $totalRecords,
                'total_pages' => ceil($totalRecords / $perPage)
            ],
            'summary' => [
                'total_omzet' => (float)$totalOmzet,
                'total_transactions' => $totalTransactions
            ]
        ];

        return $this->response->setJSON($data);
    }

    /**
     * Get order detail (AJAX)
     */
    public function getOrderDetail($orderId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return $this->response->setStatusCode(401)->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        if (!$orderId) {
            return $this->response->setStatusCode(400)->setJSON(['success' => false, 'message' => 'Order ID tidak ditemukan']);
        }

        // Get order detail
        $order = $this->db->table('orders')
            ->select('orders.*, tables.table_number')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->where('orders.id', $orderId)
            ->get()
            ->getFirstRow('array');

        if (!$order) {
            return $this->response->setStatusCode(404)->setJSON(['success' => false, 'message' => 'Pesanan tidak ditemukan']);
        }

        // Get order items
        $orderItems = $this->db->table('order_items')
            ->select('order_items.*, menu.name')
            ->join('menu', 'menu.id = order_items.menu_id')
            ->where('order_items.order_id', $orderId)
            ->get()
            ->getResultArray();

        // Get payment
        $payment = $this->db->table('payments')
            ->where('order_id', $orderId)
            ->get()
            ->getFirstRow('array');

        $data = [
            'success' => true,
            'order' => $order,
            'items' => $orderItems,
            'payment' => $payment
        ];

        return $this->response->setJSON($data);
    }

    /**
     * Print receipt (generate HTML for printing)
     */
    public function printReceipt($orderId = null)
    {
        $session = session();
        if (!$session->get('logged_in')) {
            return redirect()->to('/login');
        }

        if (!$orderId) {
            return redirect()->to('/kasir/history');
        }

        // Get order detail
        $order = $this->db->table('orders')
            ->select('orders.*, tables.table_number')
            ->join('tables', 'tables.id = orders.table_id', 'left')
            ->where('orders.id', $orderId)
            ->get()
            ->getFirstRow('array');

        if (!$order) {
            return redirect()->to('/kasir/history')->with('error', 'Pesanan tidak ditemukan');
        }

        // Get order items
        $orderItems = $this->db->table('order_items')
            ->select('order_items.*, menu.name')
            ->join('menu', 'menu.id = order_items.menu_id')
            ->where('order_items.order_id', $orderId)
            ->get()
            ->getResultArray();

        // Get payment
        $payment = $this->db->table('payments')
            ->where('order_id', $orderId)
            ->get()
            ->getFirstRow('array');

        $data = [
            'order' => $order,
            'items' => $orderItems,
            'payment' => $payment
        ];

        return view('kasir/print_receipt', $data);
    }
}
