<?= $this->extend('layout/pasien_layout') ?>

<?= $this->section('pasien_content') ?>

<div class="row g-4">
    <!-- Kolom Form Pendaftaran -->
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-calendar-plus-fill me-2"></i>Form Pendaftaran Antrian Online</h4>
            </div>
            <div class="card-body">
                <p class="card-text text-muted">Silakan pilih poli tujuan dan tanggal kunjungan yang Anda inginkan.</p>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <b>Gagal mendaftar:</b>
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="/pasien/pendaftaran" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="poli" class="form-label fw-bold">Pilih Poli:</label>

                        <select name="poli" id="poli" class="form-select">
                            <option value="">-- Pilih Poli --</option>
                            <option value="Poli Umum" <?= old('poli') == 'Poli Umum' ? 'selected' : '' ?>>Poli Umum</option>
                            <option value="Poli Gigi" <?= old('poli') == 'Poli Gigi' ? 'selected' : '' ?>>Poli Gigi</option>
                            <option value="Kesehatan Ibu dan Anak" <?= old('poli') == 'Kesehatan Ibu dan Anak' ? 'selected' : '' ?>>Kesehatan Ibu dan Anak (KIA)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_booking" class="form-label fw-bold">Pilih Tanggal Kunjungan:</label>

                        <input type="date" class="form-control" name="tanggal_booking" id="tanggal_booking" value="<?= old('tanggal_booking') ?>">
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-check-fill me-2"></i>Dapatkan Kode Booking</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Kolom Informasi -->
    <div class="col-lg-5">
        <div class="card bg-light border-0">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle-fill me-2"></i>Informasi Penting</h5>
                <ul class="list-unstyled mt-3">
                    <li class="d-flex mb-3">
                        <i class="bi bi-1-circle-fill text-primary me-3 fs-4"></i>
                        <div>
                            <strong>Pilih Poli & Tanggal</strong><br>
                            Pastikan Anda memilih poli dan tanggal kunjungan yang sesuai.
                        </div>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-2-circle-fill text-primary me-3 fs-4"></i>
                        <div>
                            <strong>Dapatkan Kode Booking</strong><br>
                            Setelah mendaftar, Anda akan menerima kode booking unik di halaman dasbor.
                        </div>
                    </li>
                    <li class="d-flex">
                        <i class="bi bi-3-circle-fill text-primary me-3 fs-4"></i>
                        <div>
                            <strong>Tunjukkan Kode ke Petugas</strong><br>
                            Tunjukkan kode booking Anda kepada petugas saat tiba di puskesmas untuk verifikasi.
                        </div>
                    </li>
                </ul>
                <hr>
                <p class="small text-muted">
                    Mohon datang 15 menit sebelum jadwal praktek dokter dimulai untuk proses administrasi.
                </p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>