<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug_kategori' => [
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
        $this->forge->addKey('id_kategori', true);  //setting primary key nya
        //$this->forge->addForeignKey('', '', '', 'CASCADE', 'CASCADE');   /untuk fk
        $this->forge->createTable('kategori');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('kategori');   //jika tabel didrop maka drop tabel pelanggan
    }
}
