<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "sk");

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$kode = $_POST['kode'];
$harga = $_POST['harga'];
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
    $stmt = $koneksi->prepare("INSERT INTO produk (nama_produk, kode_produk, harga_produk, stok_produk, image, deskripsi_produk) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $nama, $kode, $harga, $stok, $gambar_unik, $deskripsi);

    if ($stmt->execute()) {
        header("Location: ../admin.php?p=listbarang"); // Redirect ke halaman list barang
        exit;
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Gagal upload gambar.";
}

$koneksi->close();
?>
