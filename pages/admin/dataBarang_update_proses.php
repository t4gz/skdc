<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../connector/koneksi.php';

// Ambil data dari form
$nama = isset($_POST['nama']) ? $_POST['nama'] : '';
$kode = isset($_POST['kode']) ? $_POST['kode'] : '';
$merk_produk = isset($_POST['merk_produk']) ? $_POST['merk_produk'] : '';
$toko_id = isset($_POST['toko_id']) ? $_POST['toko_id'] : '';
$kategori_id = isset($_POST['kategori_id']) ? $_POST['kategori_id'] : '';
$harga = isset($_POST['harga']) ? $_POST['harga'] : 0;
$stok = isset($_POST['stok']) ? $_POST['stok'] : 0;
$deskripsi = isset($_POST['deskripsi']) ? $_POST['deskripsi'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;

// Proses upload gambar (jika ada)
$gambar = isset($_FILES['gambar']['name']) ? $_FILES['gambar']['name'] : '';
$tmp = isset($_FILES['gambar']['tmp_name']) ? $_FILES['gambar']['tmp_name'] : '';

// Folder tujuan upload
$folder_upload = "../uploads/";

// Pastikan folder ada
if (!is_dir($folder_upload)) {
    mkdir($folder_upload, 0755, true);
}

if (!empty($gambar)) {
    // Buat nama file unik
    $gambar_unik = uniqid() . '_' . basename($gambar);
    $path_gambar = $folder_upload . $gambar_unik;

    if (move_uploaded_file($tmp, $path_gambar)) {
        // Update data dengan gambar baru
        $stmt = $kon->prepare("UPDATE produk SET nama_produk=?, kode_produk=?, merk_produk=?, toko_id=?, kategori_id=?, harga_produk=?, stok_produk=?, image=?, deskripsi_produk=? WHERE produk_id=?");
        if (!$stmt) {
            die("Prepare failed: " . $kon->error);
        }
        $stmt->bind_param("ssiisisssi", $nama, $kode, $merk_produk, $toko_id, $kategori_id, $harga, $stok, $gambar_unik, $deskripsi, $id);
    } else {
        echo "Gagal upload gambar.";
        exit;
    }
} else {
    // Update data tanpa mengubah gambar
    $stmt = $kon->prepare("UPDATE produk SET nama_produk=?, kode_produk=?, merk_produk=?, toko_id=?, kategori_id=?, harga_produk=?, stok_produk=?, deskripsi_produk=? WHERE produk_id=?");
    if (!$stmt) {
        die("Prepare failed: " . $kon->error);
    }
    $stmt->bind_param("ssiisissi", $nama, $kode, $merk_produk, $toko_id, $kategori_id, $harga, $stok, $deskripsi, $id);
}

if ($stmt->execute()) {
    header("Location: admin.php?p=listbarang"); // Redirect ke halaman list barang
    exit;
} else {
    echo "Gagal mengupdate data: " . $stmt->error;
}

$stmt->close();
$kon->close();
?>
