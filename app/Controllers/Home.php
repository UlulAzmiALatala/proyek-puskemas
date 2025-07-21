<?php

namespace App\Controllers;

use App\Models\JadwalModel;
use App\Models\ArtikelModel;

class Home extends BaseController
{
    public function index()
    {
        $artikelModel = new ArtikelModel();
        $jadwalModel = new JadwalModel();

        // Mengambil nama hari ini dalam Bahasa Indonesia
        $dayMap = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $nama_hari_ini = $dayMap[date('l')];

        $data = [
            'title'           => 'Selamat Datang di Puskesmas Sehat',
            'artikel_terbaru' => $artikelModel->orderBy('created_at', 'DESC')->limit(3)->findAll(),
            'jadwal_hari_ini' => $jadwalModel->where('hari', $nama_hari_ini)->findAll()
        ];

        return view('public/home', $data);
    }

    // Method untuk menampilkan jadwal publik (dikelompokkan per hari)
    public function jadwal()
    {
        $jadwalModel = new \App\Models\JadwalModel();
        $semua_jadwal = $jadwalModel->findAll();

        // Urutan hari yang benar
        $urutan_hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $jadwal_per_hari = [];
        // Inisialisasi array dengan semua hari agar urutannya benar
        foreach ($urutan_hari as $hari) {
            $jadwal_per_hari[$hari] = [];
        }

        // Kelompokkan data jadwal ke dalam array per hari
        foreach ($semua_jadwal as $j) {
            $jadwal_per_hari[$j['hari']][] = $j;
        }

        // Mengambil nama hari ini dalam Bahasa Indonesia
        $dayMap = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $nama_hari_ini = $dayMap[date('l')];

        $data = [
            'title'           => 'Jadwal Praktek Dokter',
            'jadwal_per_hari' => $jadwal_per_hari,
            'hari_ini'        => $nama_hari_ini // Kirim nama hari ini ke view
        ];
        return view('public/jadwal_dokter', $data);
    }


    // Method untuk menampilkan daftar artikel dengan pagination
    public function artikel()
    {
        $artikelModel = new ArtikelModel();
        $data = [
            'title'   => 'Artikel Kesehatan',
            // Mengambil 6 artikel per halaman, diurutkan dari yang terbaru
            'artikel' => $artikelModel->orderBy('created_at', 'DESC')->paginate(6, 'default'),
            'pager'   => $artikelModel->pager
        ];
        return view('public/artikel_list', $data);
    }

    // Method untuk menampilkan satu artikel
    public function artikelDetail($slug)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->where('slug', $slug)->first();

        // Jika artikel tidak ditemukan
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Halaman tidak ditemukan.');
        }

        $data = [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ];
        return view('public/artikel_detail', $data);
    }
}
