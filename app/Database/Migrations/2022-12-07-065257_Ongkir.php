<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ongkir extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ongkir' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
            ],
            'gambar' => [
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
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_ongkir', true);  //setting primary key nya
        //$this->forge->addForeignKey('', '', '', 'CASCADE', 'CASCADE');   /untuk fk
        $this->forge->createTable('ongkir');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('ongkir');   //jika tabel didrop maka drop tabel pelanggan
    }
}
