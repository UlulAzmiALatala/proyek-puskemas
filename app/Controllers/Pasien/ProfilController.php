<?php

namespace App\Controllers\Pasien;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LogAktivitasModel; // Pastikan ini ada

class ProfilController extends BaseController
{
    // Menampilkan halaman profil
    public function index()
    {
        $userModel = new UserModel();
        $logModel = new LogAktivitasModel(); // Inisialisasi model log
        $userId = session()->get('user_id');

        $data = [
            'user' => $userModel->find($userId),
            // Ambil 5 aktivitas terakhir untuk user ini dan kirim ke view
            'aktivitas' => $logModel->where('user_id', $userId)
                ->orderBy('created_at', 'DESC')
                ->limit(5)
                ->findAll()
        ];

        return view('pasien/profil', $data);
    }

    // Memproses update profil (khususnya password)
    public function update()
    {
        $userModel = new UserModel();
        $userId = session()->get('user_id');

        if (empty($this->request->getPost('password'))) {
            return redirect()->to('/pasien/profil')->with('success', 'Tidak ada perubahan disimpan.');
        }

        // Validasi
        $rules = [
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update password
        $userModel->update($userId, [
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ]);

        // Catat log aktivitas
        $logModel = new LogAktivitasModel();
        $logModel->save([
            'user_id'   => $userId,
            'aktivitas' => 'Memperbarui password.'
        ]);

        return redirect()->to('/pasien/profil')->with('success', 'Password berhasil diperbarui.');
    }
}
