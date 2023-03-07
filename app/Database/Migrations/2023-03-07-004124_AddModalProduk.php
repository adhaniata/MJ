<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddModalProduk extends Migration
{
    public function up()
    {
        $this->forge->addColumn('produk', [
            'modal_produk' => [
                'type'           => 'BIGINT',
                'null'           => true,
                'after'          => 'harga_produk',
            ]
        ]);
    }

    public function down()
    {
        //
    }
}
