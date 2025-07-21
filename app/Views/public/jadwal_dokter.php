<?= $this->extend('layout/public_layout') ?>

<?= $this->section('content') ?>

<div class="container my-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">Jadwal Praktek Dokter</h1>
            <p class="text-muted">Temukan jadwal praktek dokter kami yang ter-update setiap harinya.</p>
        </div>
    </div>

    <?php foreach ($jadwal_per_hari as $hari => $jadwals) : ?>
        <?php
        // Cek apakah kartu ini untuk hari ini
        $is_today = ($hari === $hari_ini);
        ?>
        <div class="card shadow-sm mb-4 <?= $is_today ? 'border-success border-2' : '' ?>">
            <div class="card-header <?= $is_today ? 'bg-success-subtle' : 'bg-success text-white' ?>">
                <h4 class="mb-0 d-flex justify-content-between align-items-center">
                    <?= esc($hari) ?>
                    <?php if ($is_today): ?>
                        <span class="badge bg-light text-success border border-success">Hari Ini</span>
                    <?php endif; ?>
                </h4>
            </div>
            <div class="card-body">
                <?php if (empty($jadwals)): ?>
                    <p class="text-muted fst-italic">Tidak ada jadwal praktek untuk hari ini.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <tbody>
                                <?php foreach ($jadwals as $j) : ?>
                                    <tr>
                                        <td>
                                            <h5 class="mb-0 fw-bold"><?= esc($j['nama_dokter']) ?></h5>
                                            <small class="text-muted"><?= esc($j['poli']) ?></small>
                                        </td>
                                        <td class="text-end">
                                            <span class="badge bg-success fs-6">
                                                <i class="bi bi-clock-fill"></i>
                                                <?= esc(date('H:i', strtotime($j['jam_mulai']))) ?> - <?= esc(date('H:i', strtotime($j['jam_selesai']))) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>