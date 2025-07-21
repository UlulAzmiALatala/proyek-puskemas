<?= $this->extend('layout/pasien_layout') ?>

<?= $this->section('pasien_content') ?>

<div class="row">
    <div class="col-12">
        <!-- Bagian Header Profil dengan Avatar -->
        <div class="d-flex align-items-center mb-4">
            <div class="flex-shrink-0">
                <div class="rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
                    <!-- Mengambil huruf pertama dari nama -->
                    <span class="fs-1 fw-bold"><?= substr(esc($user['nama_lengkap']), 0, 1) ?></span>
                </div>
            </div>
            <div class="flex-grow-1 ms-3">
                <h2 class="mb-0"><?= esc($user['nama_lengkap']) ?></h2>
                <p class="text-muted mb-0"><?= esc($user['email']) ?></p>
            </div>
        </div>

        <!-- Kartu dengan Navigasi Tab -->
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="profilTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info-tab-pane" type="button" role="tab" aria-controls="info-tab-pane" aria-selected="true"><i class="bi bi-person-circle me-2"></i>Informasi Profil</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="password-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="false"><i class="bi bi-key-fill me-2"></i>Ubah Password</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity-tab-pane" type="button" role="tab" aria-controls="activity-tab-pane" aria-selected="false"><i class="bi bi-list-check me-2"></i>Aktivitas Terbaru</button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content p-3" id="profilTabContent">
                    <!-- ... Konten Tab Informasi Profil dan Ubah Password tetap sama ... -->
                    <div class="tab-pane fade show active" id="info-tab-pane" role="tabpanel" aria-labelledby="info-tab" tabindex="0">
                        <h5 class="card-title mb-4">Detail Akun</h5>
                        <div class="row border-bottom py-2">
                            <div class="col-sm-3 fw-bold">Nama Lengkap</div>
                            <div class="col-sm-9">: <?= esc($user['nama_lengkap']) ?></div>
                        </div>
                        <div class="row border-bottom py-2 mt-2">
                            <div class="col-sm-3 fw-bold">Email</div>
                            <div class="col-sm-9">: <?= esc($user['email']) ?></div>
                        </div>
                        <div class="row py-2 mt-2">
                            <div class="col-sm-3 fw-bold">Tanggal Bergabung</div>
                            <div class="col-sm-9">: <?= esc(date('d F Y', strtotime($user['created_at']))) ?></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">
                        <h5 class="card-title">Form Ubah Password</h5>
                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                        <?php endif; ?>
                        <?php if (session()->getFlashdata('errors')): ?>
                            <div class="alert alert-danger">
                                <b>Gagal memperbarui:</b>
                                <ul>
                                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <form action="/pasien/profil" method="post">
                            <?= csrf_field() ?>
                            <p class="text-muted">Kosongkan kolom di bawah jika Anda tidak ingin mengubah password.</p>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password_confirm" class="form-label">Konfirmasi Password Baru</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control" name="password_confirm" id="password_confirm">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill me-2"></i>Update Password</button>
                        </form>
                    </div>

                    <div class="tab-pane fade" id="activity-tab-pane" role="tabpanel" aria-labelledby="activity-tab" tabindex="0">
                        <h5 class="card-title">Riwayat Aktivitas Akun</h5>
                        <p class="text-muted">Menampilkan 5 aktivitas terakhir Anda.</p>
                        <ul class="list-group list-group-flush">
                            <?php if (empty($aktivitas)): ?>
                                <li class="list-group-item">Belum ada aktivitas tercatat.</li>
                            <?php else: ?>
                                <?php foreach ($aktivitas as $log): ?>
                                    <?php
                                    // Logika untuk memilih ikon berdasarkan teks aktivitas
                                    $icon = 'bi-info-circle-fill'; // Ikon default
                                    $color = 'text-muted';

                                    if (strpos(strtolower($log['aktivitas']), 'login') !== false) {
                                        $icon = 'bi-box-arrow-in-right';
                                        $color = 'text-primary';
                                    } elseif (strpos(strtolower($log['aktivitas']), 'mendaftar') !== false) {
                                        $icon = 'bi-calendar-plus-fill';
                                        $color = 'text-success';
                                    } elseif (strpos(strtolower($log['aktivitas']), 'password') !== false) {
                                        $icon = 'bi-key-fill';
                                        $color = 'text-warning';
                                    }
                                    ?>
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="bi <?= $icon ?> <?= $color ?> me-3 fs-5"></i>
                                        <div>
                                            <?= esc($log['aktivitas']) ?>
                                            <small class="d-block text-muted"><?= \CodeIgniter\I18n\Time::parse($log['created_at'])->humanize() ?></small>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>