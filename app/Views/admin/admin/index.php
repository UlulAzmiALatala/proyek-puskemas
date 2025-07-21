<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/admin/admins/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Admin Baru
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
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
                        <th>Role</th>
                        <th style="width: 300px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($users as $user) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($user['nama_lengkap']) ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td>
                                <?php $role_class = ($user['role'] == 'admin') ? 'bg-success' : 'bg-secondary'; ?>
                                <span class="badge <?= $role_class ?>"><?= esc(ucfirst($user['role'])) ?></span>
                            </td>
                            <td>
                                <?php if (session()->get('user_id') !== $user['id']): // Aksi tidak berlaku untuk diri sendiri 
                                ?>
                                    <form action="/admin/admins/role/<?= $user['id'] ?>" method="post" class="d-inline-flex">
                                        <?= csrf_field() ?>
                                        <select name="role" class="form-select form-select-sm w-auto me-2">
                                            <option value="pasien" <?= ($user['role'] == 'pasien') ? 'selected' : '' ?>>Pasien</option>
                                            <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-info">Update Role</button>
                                    </form>
                                    <a href="/admin/admins/delete/<?= $user['id'] ?>" class="btn btn-sm btn-danger d-inline-flex align-items-center" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted fst-italic">Tidak ada aksi</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>