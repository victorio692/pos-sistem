<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ReplaceEmailWithFullName extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('users', 'email');
        
        $this->forge->addColumn('users', [
            'full_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'username',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'full_name');
        
        $this->forge->addColumn('users', [
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'username',
            ],
        ]);
    }
}
