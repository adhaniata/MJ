<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Chatbot extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_chatbot' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'pertanyaan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jawaban' => [
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
        $this->forge->addKey('id_chatbot', true);  //setting primary key nya
        //$this->forge->addForeignKey('', '', '', 'CASCADE', 'CASCADE');   /untuk fk
        $this->forge->createTable('chatbot');    //untuk ngasih nama tabel
    }

    public function down()
    {
        $this->forge->dropTable('chatbot');   //jika tabel didrop maka drop tabel pelanggan
    }
}
