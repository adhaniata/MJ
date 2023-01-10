<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIdUserTransaksi extends Migration
{
    public function up()
    {
        // $this->forge->addColumn('transaksi', [
        //     'id_userFK' => [
        //         'type'           => 'INT',
        //         'constraint'     => 11,
        //         'unsigned'       => true,
        //         'after'          => 'id_transaksi',
        //     ]
        // ]);
    }

    public function down()
    {
        // $this->forge->dropColumn('transaksi', 'id_userFK');
    }
}
