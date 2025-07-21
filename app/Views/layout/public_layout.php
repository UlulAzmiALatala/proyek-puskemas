<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Puskesmas Sehat') ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- CSS Kustom -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2328a745' class='bi bi-heart-pulse-fill' viewBox='0 0 16 16'%3E%3Cpath d='M1.475 9.271a.5.5 0 0 1 .705-.02l2.225 1.667a.5.5 0 0 1 .02.705l-2.225 1.667a.5.5 0 0 1-.725-.685l.559-1.677a.5.5 0 0 1 .168-.288l-.559-1.677a.5.5 0 0 1 .02-.705'/%3E%3Cpath d='M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3m0 6.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m-2.5-4a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5'/%3E%3Cpath d='M10.832 7.014a.5.5 0 0 1 .168-.288l.559 1.677a.5.5 0 0 1-.725.685l-2.225-1.667a.5.5 0 0 1-.02-.705l2.225-1.667a.5.5 0 0 1 .705.02'/%3E%3Cpath d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314'/%3E%3C/svg%3E">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            transition: background-color 0.3s ease-in-out;
        }

        .footer {
            background-color: #2c3e50;
            /* Warna biru gelap yang lebih modern */
            color: #bdc3c7;
            /* Warna teks abu-abu terang */
        }

        .footer a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: white;
        }

        .footer h5 {
            color: white;
        }
    </style>
</head>

<body class="d-flex flex-column vh-100">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">
                    <i class="bi bi-heart-pulse-fill"></i>
                    Puskesmas Sehat
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= (uri_string() == 'jadwal-dokter') ? 'active' : '' ?>" href="/jadwal-dokter">Jadwal Dokter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'artikel') === 0) ? 'active' : '' ?>" href="/artikel-kesehatan">Artikel</a>
                        </li>
                        <li class="nav-item dropdown ms-lg-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Login
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/login">Login sebagai Pasien</a></li>
                                <li><a class="dropdown-item" href="/admin/login">Login sebagai Admin</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a href="/register" class="btn btn-outline-light">Registrasi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1" style="padding-top: 56px;">
        <!-- Konten dinamis dari setiap halaman akan ditampilkan di sini -->
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="footer mt-auto py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Puskesmas Sehat</h5>
                    <p>Memberikan pelayanan kesehatan primer yang berkualitas, terjangkau, dan merata untuk seluruh lapisan masyarakat.</p>
                    <div class="mt-4">
                        <a href="#" class="me-3 fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3 fs-4"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-3 fs-4"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Link Cepat</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/">Beranda</a></li>
                        <li class="mb-2"><a href="/jadwal-dokter">Jadwal Dokter</a></li>
                        <li class="mb-2"><a href="/artikel-kesehatan">Artikel</a></li>
                        <li class="mb-2"><a href="/login">Portal Pasien</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <h5 class="text-uppercase mb-4">Kontak Kami</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill me-2"></i> Jl. Sehat Selalu No. 1, Yogyakarta</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill me-2"></i> (0274) 123456</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill me-2"></i> kontak@puskesmas-sehat.com</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3 mt-4" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2025 Sistem Informasi Puskesmas.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>