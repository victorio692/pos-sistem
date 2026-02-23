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

        $data = [
            'totalTables' => $tableModel->countAll(),
            'totalMenu'   => $menuModel->countAll(),
            'totalOrders' => $orderModel->where('DATE(created_at)', date('Y-m-d'))->countAllResults(),
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