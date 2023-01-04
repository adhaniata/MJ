<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'nama' => [
                'type'           => 'varchar',
                'constraint'     => '255',
                'after'          => 'id_ongkirFK',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('transaksi', 'nama');
    }
}
