<h4 class="mb-4">Tambah Barang</h4>
<form method="POST" action="./dataBarang_create_proses.php" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input type="text" id="nama" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="kode" class="form-label">Kode Produk</label>
        <input type="text" id="kode" name="kode" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="number" id="harga" name="harga" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" id="stok" name="stok" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <input type="file" id="gambar" name="gambar" class="form-control-file" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
