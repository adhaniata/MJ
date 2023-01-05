<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransaksiDetail extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi_detail' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_transaksiFK' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'id_produkFK' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'total_harga' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'qty' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'subtotal_harga' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_transaksi_detail', TRUE);
        $this->forge->createTable('transaksi_detail', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi_detail');
    }
}
