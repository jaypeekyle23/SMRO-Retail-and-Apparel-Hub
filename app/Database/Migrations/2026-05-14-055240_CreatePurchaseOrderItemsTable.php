<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseOrderItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'purchase_order_id'=> ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'variant_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'product_id'       => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'quantity'         => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'cost_price'       => ['type' => 'DECIMAL', 'constraint' => '10,2', 'default' => 0],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase_order_items');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_order_items');
    }
}