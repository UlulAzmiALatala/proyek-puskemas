<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;

class PendaftaranController extends BaseController
{
    public function index()
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil data pendaftaran dan gabungkan (JOIN) dengan data user
        $pendaftaran = $pendaftaranModel->select('pendaftaran.*, users.nama_lengkap')
            ->join('users', 'users.id = pendaftaran.user_id')
            ->orderBy('pendaftaran.created_at', 'DESC') //Urutkan dari yang terbaru
            ->findAll();

        $data = [
            'title'       => 'Manajemen Pendaftaran Antrian',
            'pendaftaran' => $pendaftaran
        ];

        return view('admin/pendaftaran/index', $data);
    }

    public function updateStatus($id)
    {
        $pendaftaranModel = new PendaftaranModel();

        // Ambil status baru dari form yang di-submit
        $newStatus = $this->request->getPost('status');

        // Update status di database
        $pendaftaranModel->update($id, ['status' => $newStatus]);

        return redirect()->to('/admin/pendaftaran')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
