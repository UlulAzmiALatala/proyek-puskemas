<?= $this->extend('layout/app_layout') ?>

<?= $this->section('content') ?>

<div class="card shadow-lg border-0">
    <div class="card-body p-4 p-md-5">
        <h3 class="card-title text-center mb-4">Atur Password Baru</h3>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/reset-password/<?= esc($token) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password_confirm" class="form-label">Konfirmasi Password Baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" class="form-control" name="password_confirm" id="password_confirm" required>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>