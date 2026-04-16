<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColumnsToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'guest_count' => [
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1,
                'null' => false,
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true,
            ],
            'payment_amount' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', ['guest_count', 'payment_method', 'payment_amount']);
    }
}
