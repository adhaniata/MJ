<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddOngkirTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'ongkir' => [
                'type'           => 'int',
                'constraint'     => 11,
                'after'          => 'telp',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksi', 'ongkir');
    }
}
