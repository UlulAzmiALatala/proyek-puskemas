<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user belum login
        if (!session()->get('isLoggedIn')) {

            // Cek apakah user mencoba mengakses area admin
            if (strpos(uri_string(), 'admin') === 0) {
                // Jika ya, redirect ke login admin
                return redirect()->to('/admin/login');
            }

            // Jika tidak, redirect ke login pasien biasa
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
