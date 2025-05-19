<?php
include __DIR__ . '/../../../connector/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kategori = isset($_POST['nama_kategori']) ? trim($_POST['nama_kategori']) : '';

    if ($nama_kategori === '') {
        echo "Nama kategori tidak boleh kosong.";
        exit;
    }

    // Insert new category
    $stmt = $kon->prepare("INSERT INTO kategori (nama_kategori) VALUES (?)");
    $stmt->bind_param("s", $nama_kategori);

    if ($stmt->execute()) {
        header("Location: ../admin.php?p=kategori_list");
        exit;
    } else {
        echo "Gagal menambahkan kategori: " . $kon->error;
    }
} else {
    echo "Metode request tidak valid.";
}
?>
