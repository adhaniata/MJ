<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Konfirmasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_konfirmasi' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_transaksiFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'tgl_konfirmasi' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'bukti' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'validasi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'resi_pengembalian' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addKey('id_konfirmasi', true);  //setting primary key nya
        $this->forge->addForeignKey('id_transaksiFK', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->createTable('konfirmasi');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('konfirmasi');   //jika tabel didrop maka drop tabel pelanggan
    }
}
