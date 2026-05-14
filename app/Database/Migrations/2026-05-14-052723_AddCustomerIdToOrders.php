<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCustomerIdToOrders extends Migration
{
    public function up()
    {
        $this->forge->addColumn('orders', [
            'customer_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
                'after'      => 'id'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('orders', 'customer_id');
    }
}