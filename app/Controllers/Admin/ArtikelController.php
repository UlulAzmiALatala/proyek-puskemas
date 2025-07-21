<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ArtikelModel;

class ArtikelController extends BaseController
{
    // ... method index() dan create() tetap sama ...
    public function index()
    {
        $artikelModel = new ArtikelModel();
        $keyword = $this->request->getGet('keyword');
        if ($keyword) {
            $artikelModel->like('judul', $keyword);
        }
        $data = [
            'title'   => 'Manajemen Artikel Kesehatan',
            'artikel' => $artikelModel->paginate(10, 'default'),
            'pager'   => $artikelModel->pager,
            'keyword' => $keyword
        ];
        return view('admin/artikel/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Artikel Baru',
        ];
        return view('admin/artikel/form', $data);
    }

    // Menyimpan data baru
    public function store()
    {
        $rules = [
            'judul'  => 'required|min_length[5]|is_unique[artikel.judul]',
            'konten' => 'required|min_length[20]',
            'gambar_header' => [
                'rules' => 'uploaded[gambar_header]|max_size[gambar_header,2048]|is_image[gambar_header]|mime_in[gambar_header,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih sebuah gambar header.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                    'is_image' => 'File yang diupload bukan gambar.',
                    'mime_in'  => 'Hanya format JPG, JPEG, atau PNG yang diperbolehkan.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil file gambar
        $gambarFile = $this->request->getFile('gambar_header');
        // Buat nama file acak
        $namaGambar = $gambarFile->getRandomName();
        // Pindahkan file ke folder public/uploads/artikel
        $gambarFile->move('uploads/artikel', $namaGambar);

        $artikelModel = new ArtikelModel();
        $data = [
            'judul'         => $this->request->getPost('judul'),
            'slug'          => url_title($this->request->getPost('judul'), '-', true),
            'gambar_header' => $namaGambar, // Simpan nama file ke database
            'konten'        => $this->request->getPost('konten'),
            'penulis'       => session()->get('nama_lengkap'),
        ];

        $artikelModel->save($data);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel baru berhasil ditambahkan.');
    }

    // ... method edit() tetap sama ...
    public function edit($id)
    {
        $artikelModel = new ArtikelModel();
        $data = [
            'title'   => 'Edit Artikel',
            'artikel' => $artikelModel->find($id),
        ];
        if (empty($data['artikel'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan.');
        }
        return view('admin/artikel/form', $data);
    }

    // Memproses update data
    public function update($id)
    {
        $artikelModel = new ArtikelModel();
        $artikel_lama = $artikelModel->find($id);

        $judul_rule = ($artikel_lama['judul'] === $this->request->getPost('judul')) ? 'required|min_length[5]' : 'required|min_length[5]|is_unique[artikel.judul]';

        $rules = [
            'judul'  => $judul_rule,
            'konten' => 'required|min_length[20]',
            'gambar_header' => [ // Validasi gambar tidak wajib di-update
                'rules' => 'max_size[gambar_header,2048]|is_image[gambar_header]|mime_in[gambar_header,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 2MB.',
                    'is_image' => 'File yang diupload bukan gambar.',
                    'mime_in'  => 'Hanya format JPG, JPEG, atau PNG yang diperbolehkan.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $gambarFile = $this->request->getFile('gambar_header');
        $namaGambar = $artikel_lama['gambar_header']; // Default pakai nama gambar lama

        // Cek apakah ada gambar baru yang diupload
        if ($gambarFile->isValid() && !$gambarFile->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($artikel_lama['gambar_header'] && file_exists('uploads/artikel/' . $artikel_lama['gambar_header'])) {
                unlink('uploads/artikel/' . $artikel_lama['gambar_header']);
            }
            // Buat nama baru dan pindahkan
            $namaGambar = $gambarFile->getRandomName();
            $gambarFile->move('uploads/artikel', $namaGambar);
        }

        $data = [
            'judul'         => $this->request->getPost('judul'),
            'slug'          => url_title($this->request->getPost('judul'), '-', true),
            'gambar_header' => $namaGambar,
            'konten'        => $this->request->getPost('konten'),
        ];

        $artikelModel->update($id, $data);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil diperbarui.');
    }

    // Menghapus data
    public function delete($id)
    {
        $artikelModel = new ArtikelModel();
        $artikel = $artikelModel->find($id);

        // Hapus file gambar terkait jika ada
        if ($artikel['gambar_header'] && file_exists('uploads/artikel/' . $artikel['gambar_header'])) {
            unlink('uploads/artikel/' . $artikel['gambar_header']);
        }

        $artikelModel->delete($id);
        return redirect()->to('/admin/artikel')->with('success', 'Artikel berhasil dihapus.');
    }
}
