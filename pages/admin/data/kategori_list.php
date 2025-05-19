<?php
include __DIR__ . '/../../../connector/koneksi.php';

// Fetch all categories
$query = "SELECT * FROM kategori ORDER BY kategori_id ASC";
$result = mysqli_query($kon, $query);
?>

<h4 class="mb-4">Manajemen Kategori</h4>
<div class="mb-3">
    <a href="admin.php?p=kategori_create" class="btn btn-primary">Tambah Kategori Baru</a>
</div>

<table class="table table-bordered table-striped text-center">
    <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['kategori_id']) ?></td>
                    <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                    <td>
                        <a href="admin.php?p=kategori_update&id=<?= $row['kategori_id'] ?>" class="btn btn-sm btn-success">Edit</a>
                        <a href="data/kategori_delete.php?id=<?= $row['kategori_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="3">Tidak ada data kategori.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
