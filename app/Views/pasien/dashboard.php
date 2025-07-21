<?= $this->extend('layout/pasien_layout') ?>

<?= $this->section('pasien_content') ?>

<div class="row">
    <div class="col-12">
        <div class="card bg-primary text-white border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h3 class="card-title">Selamat Datang, <?= esc(session()->get('nama_lengkap')) ?>!</h3>
                <p class="card-text">Ini adalah pusat kendali Anda. Lihat status pendaftaran terakhir Anda atau buat pendaftaran baru dengan mudah.</p>
                <a href="/pasien/pendaftaran" class="btn btn-light mt-2"><i class="bi bi-plus-circle-fill"></i> Buat Pendaftaran Baru</a>
            </div>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0"><i class="bi bi-list-check me-2"></i>Riwayat Pendaftaran Anda</h4>
    </div>
    <div class="card-body">
        <?php if (empty($riwayat)): ?>
            <div class="alert alert-info">
                Anda belum memiliki riwayat pendaftaran. Silakan <a href="/pasien/pendaftaran" class="alert-link">daftar antrian baru</a>.
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Booking</th>
                            <th>Poli Tujuan</th>
                            <th>Tanggal Booking</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($riwayat as $r): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><code><?= esc($r['kode_booking']) ?></code></td>
                                <td><?= esc($r['poli']) ?></td>
                                <td><?= esc(date('d F Y', strtotime($r['tanggal_booking']))) ?></td>
                                <td>
                                    <?php
                                    $status_class = 'bg-warning text-dark';
                                    $status_icon = '<i class="bi bi-hourglass-split me-1"></i>';
                                    if ($r['status'] == 'selesai') {
                                        $status_class = 'bg-success';
                                        $status_icon = '<i class="bi bi-check-circle-fill me-1"></i>';
                                    }
                                    if ($r['status'] == 'batal') {
                                        $status_class = 'bg-danger';
                                        $status_icon = '<i class="bi bi-x-circle-fill me-1"></i>';
                                    }
                                    ?>
                                    <span class="badge <?= $status_class ?> p-2"><?= $status_icon ?><?= esc(ucfirst($r['status'])) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>