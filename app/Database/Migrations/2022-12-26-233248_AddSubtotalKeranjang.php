<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSubtotalKeranjang extends Migration
{
    public function up()
    {
        $this->forge->addColumn('keranjang', [
            'subtotal_harga' => [
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => true,
                'after'          => 'total_harga',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('keranjang', 'subtotal_harga');
    }
}
