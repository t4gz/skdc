<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../../connector/koneksi.php';

// Get the product id from GET parameter
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Prepare DELETE statement
    $stmt = $kon->prepare("DELETE FROM produk WHERE produk_id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $kon->error);
    }
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect to listbarang page after successful deletion
        header("Location: admin.php?p=listbarang");
        exit;
    } else {
        echo "Failed to delete data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid product ID.";
}

$kon->close();
?>
