<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TableSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Table 2 seater
            ['table_number' => 1, 'capacity' => 2, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 2, 'capacity' => 2, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 3, 'capacity' => 2, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            
            // Table 4 seater
            ['table_number' => 4, 'capacity' => 4, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 5, 'capacity' => 4, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 6, 'capacity' => 4, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 7, 'capacity' => 4, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            
            // Table 6 seater
            ['table_number' => 8, 'capacity' => 6, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            ['table_number' => 9, 'capacity' => 6, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
            
            // Table 12 seater (VIP)
            ['table_number' => 10, 'capacity' => 12, 'status' => 'available', 'created_at' => date('Y-m-d H:i:s')],
        ];

        $this->db->table('tables')->insertBatch($data);
    }
}
