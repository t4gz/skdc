<?php
include '../../connector/koneksi.php';

// Query to get categories
$query = "SELECT kategori_id, nama_kategori FROM kategori";
$kategori_result = mysqli_query($kon, $query);

$query2 = "SELECT toko_id, lokasi FROM toko";
$result2 = mysqli_query($kon, $query2);

// Ambil id produk dari parameter GET
if (!isset($_GET['id'])) {
    echo "ID produk tidak ditemukan.";
    exit;
}

$id = $_GET['id'];

// Query data produk berdasarkan id
$stmt = $kon->prepare("SELECT produk_id, nama_produk, kode_produk, merk_produk, toko_id, kategori_id, harga_produk, stok_produk, image, deskripsi_produk FROM produk WHERE produk_id = ?");
if (!$stmt) {
    die("Prepare failed: " . $kon->error);
}
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Produk tidak ditemukan.";
    exit;
}

$produk = $result->fetch_assoc();

$stmt->close();
$kon->close();
?>

<h4 class="mb-4">Edit Barang</h4>
<form method="POST" action="./dataBarang_update_proses.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($produk['produk_id']); ?>">
    <div class="mb-3">
        <label for="nama" class="form-label">Nama Produk</label>
        <input type="text" id="nama" name="nama" class="form-control" value="<?php echo htmlspecialchars($produk['nama_produk']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="kode" class="form-label">Kode Produk</label>
        <input type="text" id="kode" name="kode" class="form-control" value="<?php echo htmlspecialchars($produk['kode_produk']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="merk_produk" class="form-label">Merk Produk</label>
        <input type="text" id="merk_produk" name="merk_produk" class="form-control" value="<?php echo htmlspecialchars($produk['merk_produk']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select id="kategori_id" name="kategori_id" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php while ($row = mysqli_fetch_assoc($kategori_result)) : ?>
                <option value="<?php echo $row['kategori_id']; ?>" <?php if ($row['kategori_id'] == $produk['kategori_id']) echo 'selected'; ?>><?php echo $row['nama_kategori']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="toko_id" class="form-label">toko</label>
        <select id="toko_id" name="toko_id" class="form-control" required>
            <option value="">-- Pilih Toko --</option>
            <?php while ($row = mysqli_fetch_assoc($result2)) : ?>
                <option value="<?php echo $row['toko_id']; ?>" <?php if ($row['toko_id'] == $produk['toko_id']) echo 'selected'; ?>><?php echo $row['lokasi']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="harga" class="form-label">Harga</label>
        <input type="text" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($produk['harga_produk']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" id="stok" name="stok" class="form-control" value="<?php echo htmlspecialchars($produk['stok_produk']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3" required><?php echo htmlspecialchars($produk['deskripsi_produk']); ?></textarea>
    </div>
    <div class="mb-3">
        <label for="gambar" class="form-label">Gambar</label>
        <?php if (!empty($produk['image'])): ?>
            <img src="../uploads/<?php echo htmlspecialchars($produk['image']); ?>" alt="Gambar Produk" style="max-width:200px;"><br>
        <?php endif; ?>
        <input type="file" id="gambar" name="gambar" class="form-control-file">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
</create_file>
