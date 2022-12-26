<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddidUserFkKeranjang extends Migration
{
    public function up()
    {
        $this->forge->addColumn('keranjang', [
            'id_userFK' => [
                'type'           => 'int',
                'constraint'     => 11,
                'unsigned'       => true,
                'after'          => 'id_keranjang',
            ]
        ]);
        $this->forge->addForeignKey('id_userFK', 'users', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('keranjang', 'id_userFK');
    }
}
