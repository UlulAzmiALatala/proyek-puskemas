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
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Tanggal Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pasien)): ?>
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data pasien.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($pasien as $p) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($p['nama_lengkap']) ?></td>
                                <td><?= esc($p['email']) ?></td>
                                <td><?= esc(date('d M Y, H:i', strtotime($p['created_at']))) ?></td>
                                <td>
                                    <a href="/admin/pasien/delete/<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('PERINGATAN: Menghapus akun pasien akan menghapus semua data pendaftaran terkait. Apakah Anda yakin?');"><i class="bi bi-trash-fill"></i> Hapus</a>
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