<?php
include __DIR__ . '/../../../connector/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kategori_id = isset($_POST['kategori_id']) ? intval($_POST['kategori_id']) : 0;
    $nama_kategori = isset($_POST['nama_kategori']) ? trim($_POST['nama_kategori']) : '';

    if ($kategori_id <= 0 || $nama_kategori === '') {
        echo "Data tidak valid.";
        exit;
    }

    // Update category
    $stmt = $kon->prepare("UPDATE kategori SET nama_kategori = ? WHERE kategori_id = ?");
    $stmt->bind_param("si", $nama_kategori, $kategori_id);

    if ($stmt->execute()) {
        header("Location: ../admin.php?p=kategori_list");
        exit;
    } else {
        echo "Gagal mengupdate kategori: " . $kon->error;
    }
} else {
    echo "Metode request tidak valid.";
}
?>
