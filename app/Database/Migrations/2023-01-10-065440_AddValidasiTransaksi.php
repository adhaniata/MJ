<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddValidasiTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'validasi' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
                'after'          => 'bukti_konfirmasi',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
