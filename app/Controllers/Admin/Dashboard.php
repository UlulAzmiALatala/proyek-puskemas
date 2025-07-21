<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ArtikelModel;
use App\Models\PendaftaranModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Inisialisasi model
        $userModel = new UserModel();
        $artikelModel = new ArtikelModel();
        $pendaftaranModel = new PendaftaranModel();

        // Ambil 5 pendaftaran terbaru dengan join ke tabel user
        $pendaftaran_terbaru = $pendaftaranModel->select('pendaftaran.*, users.nama_lengkap')
            ->join('users', 'users.id = pendaftaran.user_id')
            ->orderBy('pendaftaran.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'title'               => 'Admin Dashboard',
            'total_pasien'        => $userModel->where('role', 'pasien')->countAllResults(),
            'total_artikel'       => $artikelModel->countAllResults(),
            'pendaftaran_menunggu' => $pendaftaranModel->where('status', 'menunggu')->countAllResults(),
            'pendaftaran_terbaru' => $pendaftaran_terbaru
        ];

        return view('admin/dashboard', $data);
    }
}
