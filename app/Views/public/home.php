<?= $this->extend('layout/public_layout') ?>

<?= $this->section('content') ?>

<style>
    /* Gaya untuk Hero Section dengan gambar latar */
    .hero-image {
        /* Ganti URL ini dengan URL gambar berkualitas tinggi yang relevan, misalnya dari Unsplash atau Pexels */
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=2070&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        color: white;
    }

    /* Efek hover pada kartu fitur */
    .feature-card {
        transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
    }

    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
    }

    .testimonial-card {
        background-color: #f8f9fa;
        border-left: 5px solid #28a745;
    }
</style>

<!-- Bagian Hero Section dengan Gambar Latar -->
<section class="hero-image text-center py-5">
    <div class="container py-5">
        <h1 class="display-4 fw-bold">Pelayanan Kesehatan Terpercaya untuk Anda dan Keluarga</h1>
        <p class="lead col-lg-8 mx-auto">Kami berkomitmen untuk memberikan pelayanan kesehatan primer yang berkualitas, mudah diakses, dan berpusat pada kebutuhan Anda.</p>
        <a href="/login" class="btn btn-light btn-lg mt-3">
            <i class="bi bi-calendar-plus-fill"></i> Daftar Antrian Online
        </a>
    </div>
</section>

<!-- Bagian Fitur Utama -->
<div class="container my-5">
    <div class="row text-center">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 feature-card">
                <div class="card-body p-4">
                    <i class="bi bi-calendar2-week-fill text-success" style="font-size: 3rem;"></i>
                    <h3 class="card-title mt-3">Jadwal Dokter</h3>
                    <p class="card-text">Lihat jadwal praktek dokter yang lengkap dan terkini untuk merencanakan kunjungan Anda.</p>
                    <a href="/jadwal-dokter" class="btn btn-outline-success">Lihat Jadwal</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 feature-card">
                <div class="card-body p-4">
                    <i class="bi bi-file-earmark-text-fill text-success" style="font-size: 3rem;"></i>
                    <h3 class="card-title mt-3">Artikel Kesehatan</h3>
                    <p class="card-text">Dapatkan informasi dan tips kesehatan terpercaya langsung dari para ahli kami.</p>
                    <a href="/artikel-kesehatan" class="btn btn-outline-success">Baca Artikel</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 feature-card">
                <div class="card-body p-4">
                    <i class="bi bi-box-arrow-in-right text-success" style="font-size: 3rem;"></i>
                    <h3 class="card-title mt-3">Portal Pasien</h3>
                    <p class="card-text">Akses riwayat pendaftaran Anda dan kelola profil dengan mudah setelah login.</p>
                    <a href="/login" class="btn btn-outline-success">Masuk Portal</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Artikel Terbaru & Jadwal Hari Ini -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">Artikel Kesehatan Terbaru</h2>
                <?php foreach ($artikel_terbaru as $artikel): ?>
                    <div class="d-flex align-items-center mb-3">
                        <img src="/uploads/artikel/<?= esc($artikel['gambar_header']) ?>" class="rounded me-3" alt="<?= esc($artikel['judul']) ?>" style="width: 150px; height: 100px; object-fit: cover;">
                        <div>
                            <h5><a href="/artikel/<?= esc($artikel['slug']) ?>" class="text-decoration-none text-dark fw-bold"><?= esc($artikel['judul']) ?></a></h5>
                            <p class="mb-1 text-muted small">Oleh: <?= esc($artikel['penulis']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header fw-bold">
                        Jadwal Hari Ini (<?= date('d M Y') ?>)
                    </div>
                    <ul class="list-group list-group-flush">
                        <?php if (empty($jadwal_hari_ini)): ?>
                            <li class="list-group-item">Tidak ada jadwal praktek dokter untuk hari ini.</li>
                        <?php else: ?>
                            <?php foreach ($jadwal_hari_ini as $jadwal): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong><?= esc($jadwal['nama_dokter']) ?></strong>
                                        <small class="d-block text-muted"><?= esc($jadwal['poli']) ?></small>
                                    </div>
                                    <span class="badge bg-success"><?= esc($jadwal['jam_mulai']) ?> - <?= esc($jadwal['jam_selesai']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Testimonial -->
<div class="container my-5">
    <h2 class="text-center mb-4">Apa Kata Mereka?</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 testimonial-card">
                <div class="card-body">
                    <p class="card-text fst-italic">"Pendaftaran online sangat membantu, tidak perlu antri lama lagi. Pelayanannya juga ramah dan profesional."</p>
                    <footer class="blockquote-footer mt-3">Budi Santoso, <cite title="Source Title">Pasien Poli Umum</cite></footer>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 testimonial-card">
                <div class="card-body">
                    <p class="card-text fst-italic">"Artikel kesehatannya sangat informatif dan mudah dipahami. Sangat bermanfaat untuk menjaga kesehatan keluarga."</p>
                    <footer class="blockquote-footer mt-3">Siti Aminah, <cite title="Source Title">Ibu Rumah Tangga</cite></footer>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 testimonial-card">
                <div class="card-body">
                    <p class="card-text fst-italic">"Fitur portal pasien memudahkan saya untuk melihat riwayat berobat. Semuanya jadi lebih terorganisir."</p>
                    <footer class="blockquote-footer mt-3">Ahmad Dahlan, <cite title="Source Title">Wiraswasta</cite></footer>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">Pertanyaan yang Sering Diajukan</h2>
        <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                        Bagaimana cara mendaftar antrian online?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Anda hanya perlu membuat akun pasien, login ke portal, lalu pilih menu "Daftar Antrian Baru". Pilih poli dan tanggal yang Anda inginkan, dan Anda akan langsung mendapatkan kode booking.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                        Apakah saya bisa menggunakan BPJS?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Tentu saja. Puskesmas Sehat melayani pasien umum maupun pasien yang menggunakan BPJS Kesehatan. Pastikan Anda membawa kartu BPJS Anda saat berkunjung.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                        Apa yang harus saya lakukan jika lupa password?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Pada halaman login, klik link "Lupa Password?". Anda akan diminta memasukkan email terdaftar Anda, dan kami akan mengirimkan link untuk mengatur ulang password Anda.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bagian Ajakan Bergabung -->
<section class="container my-5">
    <div class="p-5 text-center bg-body-tertiary rounded-3">
        <i class="bi bi-shield-check-fill text-success" style="font-size: 3rem;"></i>
        <h2 class="text-body-emphasis mt-3">Siap untuk Memulai?</h2>
        <p class="col-lg-8 mx-auto fs-5 text-muted">
            Buat akun Anda hari ini untuk mendapatkan akses penuh ke semua fitur kami, termasuk pendaftaran antrian online yang cepat dan mudah.
        </p>
        <div class="d-inline-flex gap-2 mb-5">
            <a href="/register" class="btn btn-primary btn-lg px-4 rounded-pill" type="button">Buat Akun Pasien</a>
            <a href="/login" class="btn btn-outline-secondary btn-lg px-4 rounded-pill" type="button">Login</a>
        </div>
    </div>
</section>

<?= $this->endSection() ?>