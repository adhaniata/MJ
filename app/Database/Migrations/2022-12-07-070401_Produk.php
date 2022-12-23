<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kategoriFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga_produk' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'stok' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'gambar' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'size' => [
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
        $this->forge->addKey('id_produk', true);  //setting primary key nya
        $this->forge->addForeignKey('id_kategoriFK', 'kategori', 'id_kategori', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->createTable('produk');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('produk');   //jika tabel didrop maka drop tabel pelanggan
    }
}
