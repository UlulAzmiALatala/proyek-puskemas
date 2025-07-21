<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AdminController extends BaseController
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $userModel = new UserModel();
        $data = [
            'title'  => 'Manajemen Pengguna',
            'users' => $userModel->findAll() // Mengambil semua pengguna, bukan hanya admin
        ];
        return view('admin/admin/index', $data);
    }

    // Menampilkan form tambah admin
    public function create()
    {
        $data = [
            'title' => 'Tambah Admin Baru'
        ];
        return view('admin/admin/form', $data);
    }

    // Menyimpan admin baru
    public function store()
    {
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $userModel->save([
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'email'         => $this->request->getPost('email'),
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'admin' // Langsung set role sebagai admin
        ]);

        return redirect()->to('/admin/admins')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    // FUNGSI BARU: Mengubah role pengguna
    public function updateRole($id)
    {
        // Keamanan: Mencegah admin mengubah role-nya sendiri
        if (session()->get('user_id') == $id) {
            return redirect()->to('/admin/admins')->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        $userModel = new UserModel();
        $newRole = $this->request->getPost('role');

        // Validasi sederhana untuk role
        if (!in_array($newRole, ['admin', 'pasien'])) {
            return redirect()->to('/admin/admins')->with('error', 'Role tidak valid.');
        }

        $userModel->update($id, ['role' => $newRole]);

        return redirect()->to('/admin/admins')->with('success', 'Role pengguna berhasil diperbarui.');
    }

    // Menghapus pengguna
    public function delete($id)
    {
        // Keamanan: Mencegah admin menghapus akunnya sendiri
        if (session()->get('user_id') == $id) {
            return redirect()->to('/admin/admins')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to('/admin/admins')->with('success', 'Pengguna berhasil dihapus.');
    }
}
