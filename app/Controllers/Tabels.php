<?php

namespace App\Controllers;

class Tabels extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('kasir/tabels');
    }
}
