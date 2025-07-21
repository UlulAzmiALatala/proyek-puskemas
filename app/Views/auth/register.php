<?= $this->extend('layout/app_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-lg border-0">
    <div class="card-body p-4 p-md-5">
        <h3 class="card-title text-center mb-4">Buat Akun Baru</h3>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/register" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="<?= old('nama_lengkap') ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= old('email') ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Registrasi</button>
            </div>
        </form>
        <hr>
        <p class="text-center mb-0">
            Sudah punya akun? <a href="/login">Login di sini</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>