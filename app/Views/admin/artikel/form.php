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
        <form action="<?= (isset($artikel)) ? '/admin/artikel/edit/' . $artikel['id'] : '/admin/artikel/create' ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" name="judul" id="judul" value="<?= old('judul', $artikel['judul'] ?? '') ?>">
            </div>

            <div class="mb-3">
                <label for="gambar_header" class="form-label">Gambar Header</label>
                <input class="form-control" type="file" id="gambar_header" name="gambar_header">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Ukuran maks 2MB.</small>
            </div>

            <?php if (isset($artikel['gambar_header']) && !empty($artikel['gambar_header'])): ?>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini:</label><br>
                    <img src="/uploads/artikel/<?= esc($artikel['gambar_header']) ?>" alt="<?= esc($artikel['judul']) ?>" class="img-thumbnail" style="max-width: 200px; height: auto;">
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <label for="konten" class="form-label">Konten</label>
                <textarea class="form-control" name="konten" id="editor_konten" rows="10"><?= old('konten', $artikel['konten'] ?? '') ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary"><i class="bi bi-save-fill"></i> Simpan Artikel</button>
            <a href="/admin/artikel" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>

<script>
    tinymce.init({
        selector: '#editor_konten',
        plugins: 'lists link image table code help wordcount',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table | help'
    });
</script>

<?= $this->endSection() ?>