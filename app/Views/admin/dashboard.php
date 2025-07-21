<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="/admin/pendaftaran" class="btn btn-sm btn-outline-secondary">Lihat Semua Pendaftaran</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Pasien</h5>
                        <p class="card-text display-4"><?= esc($total_pasien) ?></p>
                    </div>
                    <i class="bi bi-people-fill" style="font-size: 4rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-info shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Total Artikel</h5>
                        <p class="card-text display-4"><?= esc($total_artikel) ?></p>
                    </div>
                    <i class="bi bi-file-text-fill" style="font-size: 4rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card text-white bg-warning shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Pendaftaran Menunggu</h5>
                        <p class="card-text display-4"><?= esc($pendaftaran_menunggu) ?></p>
                    </div>
                    <i class="bi bi-clock-history" style="font-size: 4rem; opacity: 0.5;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-header">
        <h4 class="mb-0">5 Pendaftaran Antrian Terbaru</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Nama Pasien</th>
                        <th>Poli</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftaran_terbaru)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data pendaftaran.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($pendaftaran_terbaru as $p): ?>
                            <tr>
                                <td><code><?= esc($p['kode_booking']) ?></code></td>
                                <td><?= esc($p['nama_lengkap']) ?></td>
                                <td><?= esc($p['poli']) ?></td>
                                <td><?= esc(date('d M Y', strtotime($p['tanggal_booking']))) ?></td>
                                <td><span class="badge bg-warning text-dark"><?= esc(ucfirst($p['status'])) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>