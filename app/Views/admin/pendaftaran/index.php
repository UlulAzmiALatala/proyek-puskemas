<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Booking</th>
                        <th>Nama Pasien</th>
                        <th>Poli Tujuan</th>
                        <th>Tgl Booking</th>
                        <th style="width: 250px;">Status & Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pendaftaran)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data pendaftaran.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($pendaftaran as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><code><?= esc($p['kode_booking']) ?></code></td>
                                <td><?= esc($p['nama_lengkap']) ?></td>
                                <td><?= esc($p['poli']) ?></td>
                                <td><?= esc(date('d M Y', strtotime($p['tanggal_booking']))) ?></td>
                                <td>
                                    <form action="/admin/pendaftaran/status/<?= $p['id'] ?>" method="post" class="d-flex">
                                        <?= csrf_field() ?>
                                        <select name="status" class="form-select form-select-sm me-2">
                                            <option value="menunggu" <?= $p['status'] == 'menunggu' ? 'selected' : '' ?>>Menunggu</option>
                                            <option value="selesai" <?= $p['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                            <option value="batal" <?= $p['status'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-info">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>