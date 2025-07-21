<?= $this->extend('layout/app_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-lg border-0">
    <div class="card-body p-4 p-md-5">
        <h3 class="card-title text-center mb-4">Login Pasien</h3>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="text-center">
                <a href="/forgot-password">Lupa Password?</a>
            </div>
        </form>
        <hr>
        <p class="text-center mb-0">
            Belum punya akun? <a href="/register">Registrasi di sini</a>
        </p>
        <!-- Tombol Kembali ke Beranda -->
        <p class="text-center mt-3">
            <a href="/" class="text-muted"><i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>