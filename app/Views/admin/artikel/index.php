<?= $this->extend('layout/admin_layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= esc($title) ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="/admin/artikel/create" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-lg"></i> Tambah Artikel Baru
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <form action="/admin/artikel" method="get" class="d-flex">

                    <input type="text" class="form-control form-control-sm me-2" name="keyword" placeholder="Cari judul artikel..." value="<?= esc($keyword ?? '') ?>">

                    <button type="submit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-search"></i> Cari</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($artikel)): ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data artikel yang ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + 1; ?>
                        <?php foreach ($artikel as $a) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= esc($a['judul']) ?></td>
                                <td><?= esc($a['penulis']) ?></td>
                                <td>
                                    <a href="/admin/artikel/edit/<?= $a['id'] ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <a href="/admin/artikel/delete/<?= $a['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"><i class="bi bi-trash-fill"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            <?= $pager->links() ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>