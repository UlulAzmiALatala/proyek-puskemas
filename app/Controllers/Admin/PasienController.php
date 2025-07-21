<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class PasienController extends BaseController
{
    // Menampilkan daftar semua pasien
    public function index()
    {
        $userModel = new UserModel();

        $data = [
            'title'   => 'Manajemen Pasien',
            // Ambil semua user dengan role 'pasien'
            'pasien'  => $userModel->where('role', 'pasien')->findAll(),
        ];

        return view('admin/pasien/index', $data);
    }

    // Menghapus data pasien
    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/admin/pasien')->with('success', 'Data pasien berhasil dihapus.');
    }
}
