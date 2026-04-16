<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'order_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'payment_method' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'comment' => 'cash, card, qris',
            ],
            'amount' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
            ],
            'cash_received' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
                'null' => true,
            ],
            'change' => [
                'type' => 'DECIMAL',
                'constraint' => [10, 2],
                'default' => 0,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('order_id', 'orders', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
