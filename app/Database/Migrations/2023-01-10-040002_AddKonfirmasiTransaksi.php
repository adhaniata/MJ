<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKonfirmasiTransaksi extends Migration
{
    public function up()
    {
        $this->forge->addColumn('transaksi', [
            'tgl_konfirmasi' => [
                'type'           => 'DATETIME',
                'null'           => true,
                'after'          => 'status_pembayaran',
            ],
            'bukti_konfirmasi' => [
                'type'           => 'VARCHAR',
                'null'           => true,
                'constraint'     => 100,
                'after'          => 'tgl_konfirmasi',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
