<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Puskesmas</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Kustom -->
    <link rel="stylesheet" href="/css/style.css">
    <!-- Favicon -->
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2328a745' class='bi bi-heart-pulse-fill' viewBox='0 0 16 16'%3E%3Cpath d='M1.475 9.271a.5.5 0 0 1 .705-.02l2.225 1.667a.5.5 0 0 1 .02.705l-2.225 1.667a.5.5 0 0 1-.725-.685l.559-1.677a.5.5 0 0 1 .168-.288l-.559-1.677a.5.5 0 0 1 .02-.705'/%3E%3Cpath d='M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3m0 6.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m-2.5-4a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5'/%3E%3Cpath d='M10.832 7.014a.5.5 0 0 1 .168.288l.559 1.677a.5.5 0 0 1-.725.685l-2.225-1.667a.5.5 0 0 1-.02-.705l2.225-1.667a.5.5 0 0 1 .705.02'/%3E%3Cpath d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314'/%3E%3C/svg%3E">
    <style>
        body {
            font-size: .875rem;
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            padding-top: .5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }

        .sidebar .nav-link {
            font-weight: 500;
            color: #333;
        }

        .sidebar .nav-link .bi {
            margin-right: 8px;
        }

        .sidebar .nav-link.active {
            color: #28a745;
            /* Warna hijau tema kita */
        }
    </style>
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="/admin/dashboard">
            <i class="bi bi-heart-pulse-fill"></i> Puskesmas Sehat
        </a>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <span class="px-3 text-white">Halo, <?= esc(session()->get('nama_lengkap')) ?></span>
                <a class="nav-link px-3 d-inline-block" href="/logout">Logout</a>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?= (uri_string() == 'admin/dashboard') ? 'active' : '' ?>" href="/admin/dashboard">
                                <i class="bi bi-grid-1x2-fill"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'admin/jadwal') === 0) ? 'active' : '' ?>" href="/admin/jadwal">
                                <i class="bi bi-calendar2-week-fill"></i> Manajemen Jadwal
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'admin/artikel') === 0) ? 'active' : '' ?>" href="/admin/artikel">
                                <i class="bi bi-file-earmark-text-fill"></i> Manajemen Artikel
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'admin/pendaftaran') === 0) ? 'active' : '' ?>" href="/admin/pendaftaran">
                                <i class="bi bi-clipboard2-data-fill"></i> Manajemen Pendaftaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'admin/pasien') === 0) ? 'active' : '' ?>" href="/admin/pasien">
                                <i class="bi bi-people-fill"></i> Manajemen Pasien
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (strpos(uri_string(), 'admin/admins') === 0) ? 'active' : '' ?>" href="/admin/admins">
                                <i class="bi bi-person-badge-fill"></i> Manajemen Admin
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <!-- Konten dari view lain akan dirender di sini -->
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>