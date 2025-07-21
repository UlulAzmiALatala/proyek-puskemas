<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/admin/jadwal/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Jadwal Baru
        </a>
    </div>
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
                        <th>Nama Dokter</th>
                        <th>Poli</th>
                        <th>Hari</th>
                        <th>Jam Praktek</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($jadwal)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data jadwal.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($jadwal as $j) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($j['nama_dokter']) ?></td>
                                <td><?= esc($j['poli']) ?></td>
                                <td><?= esc($j['hari']) ?></td>
                                <td><?= esc($j['jam_mulai']) ?> - <?= esc($j['jam_selesai']) ?></td>
                                <td>
                                    <a href="/admin/jadwal/edit/<?= $j['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="/admin/jadwal/delete/<?= $j['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?');"><i class="bi bi-trash-fill"></i> Hapus</a>
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