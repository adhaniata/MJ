<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateNoResiStatusPengiriman extends Migration
{
    public function up()
    {
        $fields = [
            'no_resi' => [
                'name' => 'no_resi',
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true
            ],
            'status_pengiriman' => [
                'name' => 'status_pengiriman',
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ]
        ];

        $this->forge->modifyColumn('transaksi', $fields);
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
