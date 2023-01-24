<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStatusPengembalian extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pengembalian', [
            'status' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'null'           => true,
                'after'          => 'validasi',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('pengembalian');
    }
}
