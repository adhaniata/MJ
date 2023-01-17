<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIduserAndIsiUlasanTransaksiDetail extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi_detail', [
            'id_userFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'null'           => true,
                'after'          => 'id_produkFK',
            ],
            'isi_ulasan' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
                'after'          => 'subtotal_harga',
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
