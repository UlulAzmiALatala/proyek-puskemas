<?= $this->extend('layout/public_layout') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Artikel Kesehatan</h1>
            <p class="text-muted">Kumpulan informasi dan tips terpercaya untuk menjaga kesehatan Anda.</p>
        </div>
    </div>

    <div class="row">
        <?php if (empty($artikel)): ?>
            <div class="col">
                <div class="alert alert-info">Belum ada artikel yang dipublikasikan.</div>
            </div>
        <?php else: ?>
            <?php foreach ($artikel as $a) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow-sm border-0 feature-card">
                        <a href="/artikel/<?= esc($a['slug']) ?>">
                            <img src="/uploads/artikel/<?= esc($a['gambar_header']) ?>" class="card-img-top" alt="<?= esc($a['judul']) ?>" style="height: 200px; object-fit: cover;">
                        </a>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="/artikel/<?= esc($a['slug']) ?>" class="text-decoration-none text-dark fw-bold"><?= esc($a['judul']) ?></a></h5>
                            <p class="card-text text-muted small mb-4">
                                <i class="bi bi-person-fill"></i> <?= esc($a['penulis']) ?>
                                <span class="mx-2">|</span>
                                <i class="bi bi-calendar-event-fill"></i> <?= date('d M Y', strtotime($a['created_at'])) ?>
                            </p>
                            <p class="card-text flex-grow-1"><?= esc(substr($a['konten'], 0, 100)) ?>...</p>
                            <a href="/artikel/<?= esc($a['slug']) ?>" class="btn btn-success mt-auto">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Pagination Links -->
    <div class="mt-4">
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>