<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Puskesmas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2328a745' class='bi bi-heart-pulse-fill' viewBox='0 0 16 16'%3E%3Cpath d='M1.475 9.271a.5.5 0 0 1 .705-.02l2.225 1.667a.5.5 0 0 1 .02.705l-2.225 1.667a.5.5 0 0 1-.725-.685l.559-1.677a.5.5 0 0 1 .168-.288l-.559-1.677a.5.5 0 0 1 .02-.705'/%3E%3Cpath d='M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3m0 6.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m-2.5-4a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2a.5.5 0 0 1 .5-.5'/%3E%3Cpath d='M10.832 7.014a.5.5 0 0 1 .168-.288l.559 1.677a.5.5 0 0 1-.725.685l-2.225-1.667a.5.5 0 0 1-.02-.705l2.225-1.667a.5.5 0 0 1 .705.02'/%3E%3Cpath d='M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314'/%3E%3C/svg%3E">
    <style>
        body {
            /* Latar belakang gradien hijau yang lembut */
            background: #e0f2f1;
            background: linear-gradient(to right top, #e0f2f1, #b2dfdb, #80cbc4, #4db6ac, #26a69a);
        }

        /* DIUBAH: Menambahkan min-height ke container utama */
        .auth-container {
            min-height: 100vh;
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- DIUBAH: Menambahkan kelas auth-container dan align-items-center -->
        <div class="row justify-content-center align-items-center auth-container">
            <div class="col-md-6 col-lg-5">
                <!-- Logo dan Nama Puskesmas di atas form -->
                <div class="text-center mb-4">
                    <a href="/" class="text-decoration-none text-dark">
                        <h2 class="fw-bold"><i class="bi bi-heart-pulse-fill text-success"></i> Puskesmas Sehat</h2>
                    </a>
                </div>
                <!-- Konten (form login/registrasi) akan dirender di sini -->
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>