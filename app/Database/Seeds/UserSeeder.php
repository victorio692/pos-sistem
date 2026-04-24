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
                'full_name' => 'Administrator',
                'password' => password_hash('admin123', PASSWORD_BCRYPT),
                'role' => 'admin'
            ],
            [
                'username' => 'kasir1',
                'full_name' => 'Kasir Satu',
                'password' => password_hash('kasir123', PASSWORD_BCRYPT),
                'role' => 'kasir'
            ],
            [
                'username' => 'kasir2',
                'full_name' => 'Kasir Dua',
                'password' => password_hash('kasir123', PASSWORD_BCRYPT),
                'role' => 'kasir'
            ]
        ];

        $this->db->table('users')->insertBatch($data);
    }
}
