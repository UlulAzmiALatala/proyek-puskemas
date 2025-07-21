<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PendaftaranModel;
use App\Models\LogAktivitasModel;

class PendaftaranController extends BaseController
{
    // Menampilkan form pendaftaran
    public function create()
    {
        return view('pasien/pendaftaran_form');
    }

    // Menyimpan data pendaftaran
    public function store()
    {
        // 1. Validasi
        $rules = [
            'poli' => 'required',
            'tanggal_booking' => 'required|valid_date'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Buat Kode Booking Unik
        $prefix = strtoupper(substr($this->request->getPost('poli'), 0, 2));
        $kode_booking = $prefix . '-' . date('Ymd') . '-' . mt_rand(100, 999);

        // 3. Simpan ke database
        $pendaftaranModel = new PendaftaranModel();
        $pendaftaranModel->save([
            'user_id' => session()->get('user_id'),
            'poli' => $this->request->getPost('poli'),
            'tanggal_booking' => $this->request->getPost('tanggal_booking'),
            'kode_booking' => $kode_booking,
            'status' => 'menunggu'
        ]);

        // 4. CATAT LOG AKTIVITAS 
        $logModel = new LogAktivitasModel();
        $logModel->save([
            'user_id'   => session()->get('user_id'),
            'aktivitas' => 'Mendaftar antrian baru untuk ' . $this->request->getPost('poli') . '.'
        ]);

        // 5. Redirect dengan pesan sukses
        $pesan = "Pendaftaran berhasil! Kode booking Anda adalah: <strong>$kode_booking</strong>. Silakan tunjukkan kode ini kepada petugas.";
        return redirect()->to('/pasien/dashboard')->with('success', $pesan);
    }
}
