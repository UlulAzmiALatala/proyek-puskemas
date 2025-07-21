<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\JadwalModel; // Jangan lupa use modelnya

class JadwalController extends BaseController
{
    public function index()
    {
        $jadwalModel = new JadwalModel();
        $data = [
            'title' => 'Manajemen Jadwal Dokter',
            'jadwal' => $jadwalModel->findAll()
        ];

        return view('admin/jadwal/index', $data);
    }
    // Method untuk menampilkan form tambah data
    public function create()
    {
        $data = [
            'title' => 'Tambah Jadwal Dokter Baru',
        ];

        return view('admin/jadwal/form', $data);
    }

    // Method untuk menyimpan data baru
    public function store()
    {
        // 1. Validasi input
        $rules = [
            'nama_dokter' => 'required|min_length[3]',
            'poli'        => 'required',
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form dengan error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Simpan data ke database
        $jadwalModel = new JadwalModel();
        $jadwalModel->save([
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'poli'        => $this->request->getPost('poli'),
            'hari'        => $this->request->getPost('hari'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ]);

        // 3. Redirect ke halaman daftar jadwal dengan pesan sukses
        return redirect()->to('/admin/jadwal')->with('success', 'Jadwal baru berhasil ditambahkan.');
    }
    // Menampilkan form edit
    public function edit($id)
    {
        $jadwalModel = new JadwalModel();
        $data = [
            'title'  => 'Edit Jadwal Dokter',
            'jadwal' => $jadwalModel->find($id) // Ambil data jadwal berdasarkan ID
        ];

        // Jika data tidak ditemukan, tampilkan error 404
        if (empty($data['jadwal'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal tidak ditemukan.');
        }

        return view('admin/jadwal/form', $data);
    }

    // Memproses data yang di-update
    public function update($id)
    {
        // Validasi (sama seperti saat create)
        $rules = [
            'nama_dokter' => 'required|min_length[3]',
            'poli'        => 'required',
            'hari'        => 'required',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update data di database
        $jadwalModel = new JadwalModel();
        $jadwalModel->update($id, [
            'nama_dokter' => $this->request->getPost('nama_dokter'),
            'poli'        => $this->request->getPost('poli'),
            'hari'        => $this->request->getPost('hari'),
            'jam_mulai'   => $this->request->getPost('jam_mulai'),
            'jam_selesai' => $this->request->getPost('jam_selesai'),
        ]);

        return redirect()->to('/admin/jadwal')->with('success', 'Data jadwal berhasil diperbarui.');
    }
    // Menghapus data jadwal
    public function delete($id)
    {
        $jadwalModel = new JadwalModel();

        // Hapus data berdasarkan ID
        $jadwalModel->delete($id);

        return redirect()->to('/admin/jadwal')->with('success', 'Data jadwal berhasil dihapus.');
    }
}
