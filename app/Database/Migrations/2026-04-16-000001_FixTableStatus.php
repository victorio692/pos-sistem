<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixTableStatus extends Migration
{
    public function up()
    {
        // First, update all NULL or empty status to 'available'
        $this->db->query("UPDATE tables SET status = 'available' WHERE status IS NULL OR status = ''");

        // Then modify the column to have a default value
        $this->forge->modifyColumn('tables', [
            'status' => [
                'name' => 'status',
                'type' => 'VARCHAR',
                'constraint' => 50,
                'default' => 'available',
                'null' => false,
            ]
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('tables', [
            'status' => [
                'name' => 'status',
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ]
        ]);
    }
}
