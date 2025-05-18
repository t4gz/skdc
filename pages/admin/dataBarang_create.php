<?php
include '../../connector/koneksi.php';

// Query to get categories
$query = "SELECT kategori_id, nama_kategori FROM kategori";
$result = mysqli_query($kon, $query);

$query2 = "SELECT toko_id, lokasi FROM toko";
$result2 = mysqli_query($kon, $query2);
?>

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
        <label for="merk_produk" class="form-label">merk_produk</label>
        <input type="text" id="merk_produk" name="merk_produk" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select id="kategori_id" name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <option value="<?php echo $row['kategori_id']; ?>"><?php echo $row['nama_kategori']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="toko_id" class="form-label">toko</label>
        <select id="toko_id" name="toko_id" class="form-control" required>
            <option value="">-- Pilih Toko --</option>
            <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                <option value="<?php echo $row['toko_id']; ?>"><?php echo $row['lokasi']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" id="harga" name="harga" class="form-control" required>
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
