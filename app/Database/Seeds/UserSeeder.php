<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin'
            ],
            [
                'username' => 'kasir',
                'password' => password_hash('kasir123', PASSWORD_BCRYPT),
                'role' => 'kasir'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
