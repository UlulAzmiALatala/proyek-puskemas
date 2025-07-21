<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pasien - Puskesmas Sehat</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Kustom -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2328a745' class='bi bi-heart-pulse-fill' viewBox='0 0 16 16'%3E%3Cpath d='M1.475 9.271a.5.5 0 0 1 .705-.02l2.225 1.667a.5.5 0 0 1 .02.705l-2.225 1.667a.5.5 0 0 1-.725-.685l.559-1.677a.5.5 0 0 1 .168-.288l-.559-1.677a.5.5 0 0 1 .02-.705'/%3E%3Cpath d='M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3m0 6.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m-2.5-4a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5'/%3E%3Cpath d='M10.832 7.014a.5.5 0 0 1 .168-.288l.559 1.677a.5.5 0 0 1-.725.685l-2.225-1.667a.5.5 0 0 1-.02-.705l2.225-1.667a.5.5 0 0 1 .705.02'/%3E%3Cpath d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314'/%3E%3C/svg%3E">
    <style>
        body {
            background-color: #f0f2f5;
            /* Latar belakang abu-abu yang lebih lembut */
        }

        .navbar-brand strong {
            font-size: 1.2rem;
        }

        .dropdown-menu {
            min-width: 220px;
        }

        .avatar-initial {
            width: 32px;
            height: 32px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: bold;
        }
    </style>
</head>

<body>

    <header class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/pasien/dashboard">
                <i class="bi bi-heart-pulse-fill"></i>
                <strong>Portal Pasien</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'pasien/dashboard') ? 'active' : '' ?>" href="/pasien/dashboard">Dasbor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (uri_string() == 'pasien/pendaftaran') ? 'active' : '' ?>" href="/pasien/pendaftaran">Daftar Antrian</a>
                    </li>
                </ul>

                <!-- Menu Dropdown Pengguna -->
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-initial me-2">
                            <?= substr(esc(session()->get('nama_lengkap')), 0, 1) ?>
                        </div>
                        <span><?= esc(session()->get('nama_lengkap')) ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <h6 class="dropdown-header">
                                <?= esc(session()->get('nama_lengkap')) ?><br>
                                <small class="text-muted"><?= esc(session()->get('email')) ?></small>
                            </h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/pasien/profil"><i class="bi bi-person-fill me-2"></i>Profil Saya</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </header>

    <main class="container my-4">
        <!-- Konten spesifik halaman pasien akan dirender di sini -->
        <?= $this->renderSection('pasien_content') ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>