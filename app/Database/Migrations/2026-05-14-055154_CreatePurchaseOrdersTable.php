<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePurchaseOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'supplier_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'po_number'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'status'      => ['type' => 'ENUM', 'constraint' => ['pending', 'received', 'cancelled'], 'default' => 'pending'],
            'notes'       => ['type' => 'TEXT', 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('purchase_orders');
    }

    public function down()
    {
        $this->forge->dropTable('purchase_orders');
    }
}