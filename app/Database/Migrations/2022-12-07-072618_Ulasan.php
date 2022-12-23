<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ulasan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ulasan' => [
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
            'isi_ulasan' => [
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
        $this->forge->addKey('id_ulasan', true);  //setting primary key nya
        $this->forge->addForeignKey('id_transaksiFK', 'transaksi', 'id_transaksi', 'CASCADE', 'CASCADE');   //untuk fk
        $this->forge->createTable('ulasan');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('ulasan');   //jika tabel didrop maka drop tabel pelanggan
    }
}
