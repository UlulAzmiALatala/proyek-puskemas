<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BuatTabelJadwal extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama_dokter' => ['type' => 'VARCHAR', 'constraint' => '255'],
            'poli' => ['type' => 'VARCHAR', 'constraint' => '100'],
            'hari' => ['type' => 'VARCHAR', 'constraint' => '50'],
            'jam_mulai' => ['type' => 'TIME'],
            'jam_selesai' => ['type' => 'TIME'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('jadwal');
    }

    public function down()
    {
        $this->forge->dropTable('jadwal');
    }
}
