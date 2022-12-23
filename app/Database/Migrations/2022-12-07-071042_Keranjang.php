<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Keranjang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_keranjang' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_produkFK' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
            ],
            // 'id_userFK' => [
            //     'type'           => 'BIGINT',
            //     'constraint'     => 20,
            //     'unsigned'       => true,
            // ],
            'qty' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'total_harga' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
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
        $this->forge->addKey('id_keranjang', true);  //setting primary key nya
        $this->forge->addForeignKey('id_produkFK', 'produk', 'id_produk', 'CASCADE', 'CASCADE');
        //$this->forge->addForeignKey('id_userFK', 'users', 'id', 'CASCADE', 'CASCADE');    //untuk fk
        $this->forge->createTable('keranjang');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('keranjang');   //jika tabel didrop maka drop tabel pelanggan
    }
}
