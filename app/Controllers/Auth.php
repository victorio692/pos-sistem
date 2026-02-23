<?php

namespace App\Controllers;

use CodeIgniter\Database\BaseBuilder;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }

    public function prosesLogin()
    {
        $session = session();
        $db = \Config\Database::connect();
        
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        log_message('info', 'Login attempt with username: ' . $username);
        
        $user = $db->table('users')
            ->where('username', $username)
            ->get()
            ->getRow();

        if ($user) {
            log_message('info', 'User found: ' . $user->username);
            if (password_verify($password, $user->password)) {
                log_message('info', 'Password match successful');
                $session->set([
                    'id' => $user->id,
                    'username' => $user->username,
                    'role' => $user->role,
                    'logged_in' => true
                ]);

                if ($user->role === 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/tables');
                }
            } else {
                log_message('info', 'Password verification failed');
            }
        } else {
            log_message('info', 'User not found');
        }

        return redirect()->back()->with('error', 'Login gagal');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
