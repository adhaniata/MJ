<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'username_admin' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'password_admin' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'nama_admin' => [
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
        $this->forge->addKey('id_admin', true);  //setting primary key nya
        //$this->forge->addForeignKey('', '', '', 'CASCADE', 'CASCADE');   /untuk fk
        $this->forge->createTable('admin');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('admin');   //jika tabel didrop maka drop tabel pelanggan
    }
}
