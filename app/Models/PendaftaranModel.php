<?php

namespace App\Models;

use CodeIgniter\Model;

class PendaftaranModel extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['user_id', 'poli', 'tanggal_booking', 'kode_booking', 'status'];
    protected $useTimestamps    = true;
}
