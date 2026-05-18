<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReturnsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'order_id'     => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'variant_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'product_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'quantity'     => ['type' => 'INT', 'constraint' => 11, 'default' => 1],
            'reason'       => ['type' => 'TEXT', 'null' => true],
            'refund_amount'=> ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'status'       => ['type' => 'ENUM', 'constraint' => ['pending', 'approved', 'rejected'], 'default' => 'pending'],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('returns');
    }

    public function down()
    {
        $this->forge->dropTable('returns');
    }
}