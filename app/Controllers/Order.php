<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Order extends BaseController
{
    public function new($tableNumber = null)
    {
        if ($tableNumber == null) {
            return redirect()->to('/tables');
        }

        return view('order/new', [
            'tableNumber' => $tableNumber
        ]);
    }

    public function store()
    {
        $tableNumber = $this->request->getPost('table');
        $customerName = $this->request->getPost('customer');
        $totalPerson  = $this->request->getPost('person');

        // Redirect to menu page after order is created
        return redirect()->to('/order/' . $tableNumber);
    }

    public function index($tableNumber = null)
    {
        if ($tableNumber == null) {
            return redirect()->to('/tables');
        }

        return view('order/index', [
            'table' => $tableNumber
        ]);
    }

    public function success()
    {
        return view('order/success');
    }
}
