<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalModel extends Model
{
    protected $table            = 'jadwal';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['nama_dokter', 'poli', 'hari', 'jam_mulai', 'jam_selesai'];
    protected $useTimestamps    = true;
}
