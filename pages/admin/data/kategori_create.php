<?php
// Form to add new category
?>

<h4 class="mb-4">Tambah Kategori Baru</h4>
<form method="POST" action="data/kategori_create_proses.php">
    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="admin.php?p=kategori_list" class="btn btn-secondary">Batal</a>
</form>
