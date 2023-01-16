<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateIdtransaksiAddIdUserIdProduk extends Migration
{
    public function up()
    {
        $fields = [
            'id_userFk' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'after'          => 'id_transaksiFK',
            ],
            'id_produkFk' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'after'          => 'id_userFK',
            ],
        ];

        $this->forge->addColumn('ulasan', $fields);
    }

    public function down()
    {
        //
    }
}
