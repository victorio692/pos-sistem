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
            if (isset($ordersCount[$order->status])) {
                $ordersCount[$order->status]++;
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

        $data = [
            'totalTables' => $totalTables,
            'totalMenu' => $totalMenu,
            'totalOrdersToday' => $totalOrdersToday,
            'totalUsers' => $totalUsers,
            'revenueToday' => $revenueToday->total ?? 0,
            'ordersCount' => $ordersCount,
            'recentOrders' => $recentOrders,
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
        $data['menu'] = $model->findAll();
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
}