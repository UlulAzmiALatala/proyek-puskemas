<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelPendaftaran extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'poli' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'tanggal_booking' => ['type' => 'DATE'],
            'kode_booking' => ['type' => 'VARCHAR', 'constraint' => '50', 'unique' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['menunggu', 'selesai', 'batal'], 'default' => 'menunggu'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pendaftaran');
    }

    public function down()
    {
        $this->forge->dropTable('pendaftaran');
    }
}
