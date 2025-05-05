<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../connector/koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$kode = $_POST['kode'];
$merk_produk = $_POST['merk_produk'];
$toko_id = $_POST['toko_id'];
$kategori_id = $_POST['kategori_id'];
$harga = $_POST['harga'];
$harga = str_replace(['.', ','], '', $harga);
$harga = (int)$harga;
$stok = $_POST['stok'];
$deskripsi = $_POST['deskripsi'];

// Proses upload gambar
$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];

// Folder tujuan upload
$folder_upload = "../uploads/";

// Pastikan folder ada
if (!is_dir($folder_upload)) {
    mkdir($folder_upload, 0755, true);
}

// Buat nama file unik (optional tapi disarankan)
$gambar_unik = uniqid() . '_' . basename($gambar);
$path_gambar = $folder_upload . $gambar_unik;

if (move_uploaded_file($tmp, $path_gambar)) {
    // Simpan data ke database (simpan hanya nama file agar tidak tergantung struktur folder)
    $stmt = $kon->prepare("INSERT INTO produk (nama_produk, kode_produk, merk_produk, toko_id, kategori_id, harga_produk, stok_produk, image, deskripsi_produk) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $kon->error);
    }
$stmt->bind_param("sssiiisss", $nama, $kode, $merk_produk, $toko_id ,$kategori_id, $harga, $stok, $gambar_unik, $deskripsi);

    if ($stmt->execute()) {
        header("Location: admin.php?p=listbarang"); // Redirect ke halaman list barang
        exit;
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Gagal upload gambar.";
}

$kon->close();
?>
