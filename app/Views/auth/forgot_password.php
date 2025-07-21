<?= $this->extend('layout/app_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-lg border-0">
    <div class="card-body p-4 p-md-5">
        <h3 class="card-title text-center mb-3">Lupa Password</h3>
        <p class="text-center text-muted mb-4">Masukkan email Anda. Kami akan mengirimkan link untuk mereset password Anda.</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="/forgot-password" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
            </div>
        </form>
        <hr>
        <p class="text-center mb-0">
            Ingat password Anda?

            <a href="<?= esc($back_link ?? '/login', 'url') ?>">Kembali ke Login</a>
        </p>
    </div>
</div>

<?= $this->endSection() ?>