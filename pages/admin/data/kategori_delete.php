<?php
include __DIR__ . '/../../../connector/koneksi.php';

if (!isset($_GET['id'])) {
    echo "ID kategori tidak ditemukan.";
    exit;
}

$id = intval($_GET['id']);

// Delete category
$stmt = $kon->prepare("DELETE FROM kategori WHERE kategori_id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: ../admin.php?p=kategori_list");
    exit;
} else {
    echo "Gagal menghapus kategori: " . $kon->error;
}
?>
