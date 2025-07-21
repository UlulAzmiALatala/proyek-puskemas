<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
</div>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <b>Gagal menyimpan data:</b>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="<?= (isset($jadwal)) ? '/admin/jadwal/edit/' . $jadwal['id'] : '/admin/jadwal/create' ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                <input type="text" class="form-control" name="nama_dokter" id="nama_dokter" value="<?= old('nama_dokter', $jadwal['nama_dokter'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="poli" class="form-label">Poli</label>
                <input type="text" class="form-control" name="poli" id="poli" value="<?= old('poli', $jadwal['poli'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="hari" class="form-label">Hari</label>
                <input type="text" class="form-control" name="hari" id="hari" value="<?= old('hari', $jadwal['hari'] ?? '') ?>">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" name="jam_mulai" id="jam_mulai" value="<?= old('jam_mulai', $jadwal['jam_mulai'] ?? '') ?>">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" name="jam_selesai" id="jam_selesai" value="<?= old('jam_selesai', $jadwal['jam_selesai'] ?? '') ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan Jadwal</button>
            <a href="/admin/jadwal" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<?= $this->endSection() ?>