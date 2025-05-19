<?php
include __DIR__ . '/../../../connector/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID kategori tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Fetch category data
$stmt = $kon->prepare("SELECT * FROM kategori WHERE kategori_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Kategori tidak ditemukan.";
    exit;
}

$kategori = $result->fetch_assoc();
?>

<h4 class="mb-4">Edit Kategori</h4>
<form method="POST" action="data/kategori_update_proses.php">
    <input type="hidden" name="kategori_id" value="<?= htmlspecialchars($kategori['kategori_id']) ?>">
    <div class="mb-3">
        <label for="nama_kategori" class="form-label">Nama Kategori</label>
        <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" value="<?= htmlspecialchars($kategori['nama_kategori']) ?>" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    <a href="admin.php?p=kategori_list" class="btn btn-secondary">Batal</a>
</form>
