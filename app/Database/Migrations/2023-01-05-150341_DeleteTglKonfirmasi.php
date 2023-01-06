<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeleteTglKonfirmasi extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('konfirmasi', ['tgl_konfirmasi']);
    }

    public function down()
    {
        $this->forge->dropTable('konfirmasi');
    }
}
