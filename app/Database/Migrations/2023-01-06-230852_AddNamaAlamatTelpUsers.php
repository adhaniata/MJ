<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNamaAlamatTelpUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'nama' => [
                'type'           => 'VARCHAR',
                'constraint'     => 100,
                'null'           => true,
                'after'          => 'username',
            ],
            'alamat' => [
                'type'           => 'TEXT',
                'null'           => true,
                'after'          => 'nama',
            ],
            'telp' => [
                'type'           => 'VARCHAR',
                'constraint'     => 50,
                'null'           => true,
                'after'          => 'alamat',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
