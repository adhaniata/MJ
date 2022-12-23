<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_transaksi' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_userFK' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_keranjangFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'id_ongkirFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 255,
                'unsigned'       => true,
            ],
            'alamat' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'telp' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'total_tagihan' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'status_pembayaran' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_transaksi' => [
                'type'       => 'DATETIME',
                'null' => true,
            ],
            'no_resi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_pengiriman' => [
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
        $this->forge->addKey('id_transaksi', true);  //setting primary key nya
        $this->forge->addForeignKey('id_userFK', 'users', 'id', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->addForeignKey('id_keranjangFK', 'keranjang', 'id_keranjang', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->addForeignKey('id_ongkirFK', 'ongkir', 'id_ongkir', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->createTable('transaksi');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');   //jika tabel didrop maka drop tabel pelanggan
    }
}
