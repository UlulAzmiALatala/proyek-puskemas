<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TambahGambarHeaderKeArtikel extends Migration
{
    public function up()
    {
        $fields = [
            'gambar_header' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'after'      => 'slug'
            ],
        ];
        $this->forge->addColumn('artikel', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('artikel', 'gambar_header');
    }
}
