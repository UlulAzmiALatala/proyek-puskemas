<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel; // <-- Tambahkan ini

class Dashboard extends BaseController
{
    public function index()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data pendaftaran HANYA untuk user yang sedang login
        $riwayatPendaftaran = $pendaftaranModel->where('user_id', session()->get('user_id'))
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $data = [
            'nama_user' => session()->get('nama_lengkap'),
            'riwayat'   => $riwayatPendaftaran
        ];

        return view('pasien/dashboard', $data);
    }
}
