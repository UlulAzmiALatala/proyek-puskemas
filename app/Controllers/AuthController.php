<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LogAktivitasModel;

class AuthController extends BaseController
{
    public function register()
    {
        // Menampilkan halaman form registrasi
        return view('auth/register');
    }

    public function processRegister()
    {
        // 1. Validasi Input
        $rules = [
            'nama_lengkap' => 'required|min_length[3]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'password_confirm' => 'matches[password]'
        ];

        if (!$this->validate($rules)) {
            // Jika validasi gagal, kembalikan ke form dengan error dan input lama
            return redirect()->to('/register')->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Jika validasi berhasil, simpan data ke database
        $userModel = new UserModel();

        $data = [
            'nama_lengkap'  => $this->request->getPost('nama_lengkap'),
            'email'         => $this->request->getPost('email'),
            // Hashing password sebelum disimpan
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'pasien' // Default role untuk pendaftar baru
        ];

        $userModel->save($data);

        // 3. Redirect ke halaman login dengan pesan sukses
        return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Menampilkan form login untuk pasien
    public function loginPasien()
    {
        return view('auth/login');
    }

    // Menampilkan form login untuk admin
    public function loginAdmin()
    {
        return view('auth/login_admin');
    }

    // Memproses login dari form PASIEN (lebih ketat)
    public function processPasienLogin()
    {
        $rules = ['email' => 'required|valid_email', 'password' => 'required'];
        if (!$this->validate($rules)) {
            return redirect()->to('/login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        // Cek 1: Kredensial harus benar
        if (!$user || !password_verify($this->request->getPost('password'), $user['password_hash'])) {
            return redirect()->to('/login')->withInput()->with('error', 'Email atau Password salah.');
        }

        // Cek 2: Role TIDAK BOLEH admin
        if ($user['role'] === 'admin') {
            return redirect()->to('/login')->withInput()->with('error', 'Akun admin harus login melalui halaman login admin.');
        }

        return $this->createUserSessionAndRedirect($user);
    }

    // Memproses login dari form ADMIN (lebih ketat)
    public function processAdminLogin()
    {
        $rules = ['email' => 'required|valid_email', 'password' => 'required'];
        if (!$this->validate($rules)) {
            return redirect()->to('/admin/login')->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        // Cek 1: Kredensial harus benar
        if (!$user || !password_verify($this->request->getPost('password'), $user['password_hash'])) {
            return redirect()->to('/admin/login')->withInput()->with('error', 'Email atau Password salah.');
        }

        // Cek 2: Role HARUS admin
        if ($user['role'] !== 'admin') {
            return redirect()->to('/admin/login')->withInput()->with('error', 'Akun ini tidak memiliki hak akses sebagai admin.');
        }

        return $this->createUserSessionAndRedirect($user);
    }

    // Helper function untuk membuat session dan mencatat log
    private function createUserSessionAndRedirect($user)
    {
        $session = session();
        $sessionData = [
            'user_id'       => $user['id'],
            'nama_lengkap'  => $user['nama_lengkap'],
            'email'         => $user['email'],
            'role'          => $user['role'],
            'isLoggedIn'    => TRUE
        ];
        $session->set($sessionData);

        $logModel = new LogAktivitasModel();
        $logModel->save(['user_id' => $user['id'], 'aktivitas' => 'Login ke sistem.']);

        if ($user['role'] === 'admin') {
            return redirect()->to('/admin/dashboard');
        } else {
            return redirect()->to('/pasien/dashboard');
        }
    }

    public function logout()
    {
        $userRole = session()->get('role');
        session()->destroy();
        if ($userRole === 'admin') {
            return redirect()->to('/admin/login')->with('success', 'Anda berhasil logout.');
        } else {
            return redirect()->to('/')->with('success', 'Anda berhasil logout.');
        }
    }

    // Menampilkan halaman lupa password
    public function forgotPassword()
    {
        $from = $this->request->getGet('from');
        $back_link = ($from === 'admin') ? '/admin/login' : '/login';
        return view('auth/forgot_password', ['back_link' => $back_link]);
    }

    // Memproses permintaan reset
    public function processForgotPassword()
    {
        $rules = ['email' => 'required|valid_email|is_not_unique[users.email]'];
        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Email tidak ditemukan.');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('email', $this->request->getPost('email'))->first();

        $token = bin2hex(random_bytes(20));
        $expires = date('Y-m-d H:i:s', time() + 3600); // Token berlaku 1 jam

        $userModel->update($user['id'], ['reset_token' => $token, 'reset_expires' => $expires]);

        $email = \Config\Services::email();
        $email->setTo($user['email']);
        $email->setFrom('no-reply@puskesmas.com', 'Sistem Puskesmas');
        $email->setSubject('Reset Password Akun Anda');

        $resetLink = site_url('reset-password/' . $token);
        $message = "Halo {$user['nama_lengkap']},<br><br>Anda menerima email ini karena ada permintaan untuk mereset password akun Anda. Silakan klik link di bawah ini:<br><br>";
        $message .= "<a href='{$resetLink}'>Reset Password</a><br><br>";
        $message .= "Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.<br><br>Terima kasih.";
        $email->setMessage($message);

        if ($email->send()) {
            return redirect()->to('/login')->with('success', 'Link reset password telah dikirim ke email Anda.');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim email. Silakan coba lagi.');
        }
    }

    // Menampilkan form reset password jika token valid
    public function resetPassword($token)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('reset_token', $token)->where('reset_expires >', date('Y-m-d H:i:s'))->first();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Token reset tidak valid atau sudah kedaluwarsa.');
        }
        return view('auth/reset_password', ['token' => $token]);
    }

    // Memproses password baru
    public function processResetPassword($token)
    {
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('reset_token', $token)->where('reset_expires >', date('Y-m-d H:i:s'))->first();
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Token reset tidak valid atau sudah kedaluwarsa.');
        }

        $rules = ['password' => 'required|min_length[8]', 'password_confirm' => 'matches[password]'];
        if (!$this->validate($rules)) {
            return redirect()->to('/reset-password/' . $token)->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'password_hash' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'reset_token'   => null,
            'reset_expires' => null
        ];
        $userModel->update($user['id'], $data);

        return redirect()->to('/login')->with('success', 'Password Anda berhasil diubah! Silakan login kembali.');
    }
}
