<?= $this->extend('layout/app_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-lg border-0">
    <div class="card-header bg-dark text-white text-center">
        <h3 class="card-title mb-0 py-2">Admin Login</h3>
    </div>
    <div class="card-body p-4 p-md-5">
        <p class="text-center text-muted mb-4">Hanya untuk personel yang berwenang.</p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/admin/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-dark">Login</button>
            </div>
            <div class="text-center">
                <!-- DIUBAH: Ditambahkan ?from=admin -->
                <a href="/forgot-password?from=admin">Lupa Password?</a>
            </div>
        </form>
        <p class="text-center mt-4">
            <a href="/" class="text-muted"><i class="bi bi-arrow-left-circle"></i> Kembali ke Beranda</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>
