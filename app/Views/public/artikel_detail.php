<?= $this->extend('layout/public_layout') ?>

<?= $this->section('content') ?>

<!-- Gambar Header Artikel -->
<div class="container-fluid p-0">
    <div style="height: 40vh; background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('/uploads/artikel/<?= esc($artikel['gambar_header']) ?>'); background-size: cover; background-position: center;" class="d-flex align-items-center justify-content-center text-white">
        <div class="text-center">
            <h1 class="display-4 fw-bold"><?= esc($artikel['judul']) ?></h1>
            <p class="lead">Oleh: <?= esc($artikel['penulis']) ?> | Dipublikasikan pada <?= date('d F Y', strtotime($artikel['created_at'])) ?></p>
        </div>
    </div>
</div>

<div class="container my-5">
    <div class="row">
        <!-- Kolom Konten Artikel -->
        <div class="col-lg-8">
            <!-- DIUBAH: Ditambahkan style untuk word-wrap -->
            <article class="fs-5" style="line-height: 1.8; word-wrap: break-word;">
                <?= nl2br(esc($artikel['konten'])) ?>
            </article>
            <hr class="my-4">
            <!-- Tombol Share Media Sosial Fungsional -->
            <div>
                <strong>Bagikan artikel ini:</strong>
                <?php
                $share_url = urlencode(current_url());
                $share_title = urlencode($artikel['judul']);
                ?>
                <a href="https://api.whatsapp.com/send?text=<?= $share_title ?>%20<?= $share_url ?>" target="_blank" class="btn btn-outline-success btn-sm ms-2"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $share_url ?>" target="_blank" class="btn btn-outline-primary btn-sm ms-1"><i class="bi bi-facebook"></i> Facebook</a>
                <a href="https://twitter.com/intent/tweet?url=<?= $share_url ?>&text=<?= $share_title ?>" target="_blank" class="btn btn-outline-info btn-sm ms-1"><i class="bi bi-twitter"></i> Twitter</a>
            </div>
        </div>

        <!-- Kolom Sidebar -->
        <div class="col-lg-4">
            <div class="position-sticky" style="top: 6rem;">
                <div class="p-4 mb-3 bg-light rounded">
                    <h4 class="fst-italic">Tentang Penulis</h4>
                    <p class="mb-0">Artikel ini ditulis oleh <strong><?= esc($artikel['penulis']) ?></strong>, salah satu tenaga ahli di Puskesmas Sehat yang berdedikasi untuk memberikan informasi kesehatan yang akurat dan bermanfaat bagi masyarakat.</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-5">
    <a href="/artikel-kesehatan" class="btn btn-outline-secondary"><i class="bi bi-arrow-left-circle"></i> Kembali ke daftar artikel</a>
</div>

<?= $this->endSection() ?>