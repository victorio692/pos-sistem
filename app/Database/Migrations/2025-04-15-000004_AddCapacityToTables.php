<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCapacityToTables extends Migration
{
    public function up()
    {
        $this->forge->addColumn('tables', [
            'capacity' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 2,
                'null' => false,
            ],
            'guest_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0,
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('tables', ['capacity', 'guest_count']);
    }
}
