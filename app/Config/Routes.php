<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// --- RUTE PUBLIK (Bisa diakses siapa saja) ---
$routes->get('/', 'Home::index');
$routes->get('/jadwal-dokter', 'Home::jadwal');
$routes->get('/artikel-kesehatan', 'Home::artikel'); // <-- Daftar artikel
$routes->get('/artikel/(:segment)', 'Home::artikelDetail/$1'); // <-- Detail artikel

// --- RUTE AUTENTIKASI ---
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');

// Rute Login Pasien
$routes->get('/login', 'AuthController::loginPasien');
$routes->post('/login', 'AuthController::processPasienLogin');

// Rute Login Admin
$routes->get('/admin/login', 'AuthController::loginAdmin');
$routes->post('/admin/login', 'AuthController::processAdminLogin');

// Rute Lupa Password & Logout
$routes->get('/logout', 'AuthController::logout');
$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->post('/forgot-password', 'AuthController::processForgotPassword');
$routes->get('/reset-password/(:segment)', 'AuthController::resetPassword/$1');
$routes->post('/reset-password/(:segment)', 'AuthController::processResetPassword/$1');


// --- GRUP RUTE PASIEN (Dilindungi Filter) ---
$routes->group('pasien', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'Pasien\Dashboard::index');
    $routes->get('pendaftaran', 'PendaftaranController::create'); // Menampilkan form
    $routes->post('pendaftaran', 'PendaftaranController::store'); // Menyimpan data
    $routes->get('profil', 'Pasien\ProfilController::index'); // <-- Rute baru untuk menampilkan profil
    $routes->post('profil', 'Pasien\ProfilController::update'); // <-- Rute baru untuk memproses update
});


// --- GRUP RUTE ADMIN (Dilindungi Filter) ---
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Manajemen Jadwal
    $routes->get('jadwal', 'Admin\JadwalController::index');
    $routes->get('jadwal/create', 'Admin\JadwalController::create');
    $routes->post('jadwal/create', 'Admin\JadwalController::store');
    $routes->get('jadwal/edit/(:num)', 'Admin\JadwalController::edit/$1');
    $routes->post('jadwal/edit/(:num)', 'Admin\JadwalController::update/$1');
    $routes->get('jadwal/delete/(:num)', 'Admin\JadwalController::delete/$1');

    // Manajemen Artikel
    $routes->get('artikel', 'Admin\ArtikelController::index');
    $routes->get('artikel/create', 'Admin\ArtikelController::create');
    $routes->post('artikel/create', 'Admin\ArtikelController::store');
    $routes->get('artikel/edit/(:num)', 'Admin\ArtikelController::edit/$1');
    $routes->post('artikel/edit/(:num)', 'Admin\ArtikelController::update/$1');
    $routes->get('artikel/delete/(:num)', 'Admin\ArtikelController::delete/$1');

    // Manajemen Pendaftaran
    $routes->get('pendaftaran', 'Admin\PendaftaranController::index');
    $routes->post('pendaftaran/status/(:num)', 'Admin\PendaftaranController::updateStatus/$1');

    // Manajemen Pasien
    $routes->get('pasien', 'Admin\PasienController::index');
    $routes->get('pasien/delete/(:num)', 'Admin\PasienController::delete/$1');

    // Manajemen Admin
    $routes->get('admins', 'Admin\AdminController::index');
    $routes->get('admins/create', 'Admin\AdminController::create');
    $routes->post('admins/create', 'Admin\AdminController::store');
    $routes->post('admins/role/(:num)', 'Admin\AdminController::updateRole/$1');
    $routes->get('admins/delete/(:num)', 'Admin\AdminController::delete/$1');
});
