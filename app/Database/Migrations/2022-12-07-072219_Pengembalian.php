<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pengembalian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pengembalian' => [
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
            'alasan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'resi_pengembalian' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'rek_pengembalian' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'validasi' => [
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
        $this->forge->addKey('id_pengembalian', true);  //setting primary key nya
        $this->forge->addForeignKey('id_transaksiFK', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->createTable('pengembalian');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('pengembalian');   //jika tabel didrop maka drop tabel pelanggan
    }
}
