<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteIdKeranjangAndIdOngkirTransaksi extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('transaksi', 'transaksi_id_keranjangFK_foreign');
        $this->forge->dropForeignKey('transaksi', 'transaksi_id_ongkirFK_foreign');
        $this->forge->dropColumn('transaksi', ['id_keranjangFK', 'id_ongkirFK']);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
