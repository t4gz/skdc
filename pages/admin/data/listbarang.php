<?php
include __DIR__ . '/../../../connector/koneksi.php';
// Pencarian
$search_query = "";
if (isset($_POST['search'])) {
    $search_query = $_POST['search'];
}

// Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Query untuk menghitung jumlah total data
$count_query = "SELECT COUNT(*) as total FROM produk WHERE nama_produk LIKE ? OR kode_produk LIKE ?";
$stmt_count = $kon->prepare($count_query);
$search_param = '%' . $search_query . '%';
$stmt_count->bind_param("ss", $search_param, $search_param);
$stmt_count->execute();
$total_result = $stmt_count->get_result()->fetch_assoc();
$total_data = $total_result['total'];
$total_pages = ceil($total_data / $limit);

// Query untuk mengambil data dengan limit dan offset
$query = "SELECT * FROM produk WHERE nama_produk LIKE ? OR kode_produk LIKE ? LIMIT ? OFFSET ?";
$stmt = $kon->prepare($query);
$stmt->bind_param("ssii", $search_param, $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query failed: " . $kon->error);
}
?>

<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header bg-dark text-white">
            <h6 class="m-0 font-weight-bold text-warning text-center">List Barang - Barang</h6>
        </div>
        <div class="card-body">
            <!-- Form Pencarian -->
            <form method="POST" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari Nama atau Kode Produk" value="<?= htmlspecialchars($search_query) ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Nama Produk</th>
                            <th>Kode Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Gambar</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = $offset + 1; // Untuk nomor urut
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='text-center'>{$no}</td>";
                                echo "<td>{$row['nama_produk']}</td>";
                                echo "<td>{$row['kode_produk']}</td>";
                                echo "<td>Rp " . number_format($row['harga_produk'], 0, ',', '.') . "</td>";
                                echo "<td>{$row['stok_produk']}</td>";
                                echo "<td><img src='../uploads/{$row['image']}' alt='' class='img-thumbnail' width='150' height='80'></td>";
                                echo "<td>{$row['deskripsi_produk']}</td>";
                                echo "<td>
                                        <div class='btn-group' role='group'>
<a href='admin.php?p=dataBarang_update&id={$row['produk_id']}' class='btn btn-sm btn-success'>EDIT</a>
                                            <a href='dataBarang_delete.php?id={$row['produk_id']}' class='btn btn-sm btn-danger'>HAPUS</a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='8'>Tidak ada data.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right mb-3">
                <a href='admin.php?p=dataBarang_create' class="btn btn-primary">Tambah Barang</a>
            </div>
            <!-- Navigasi Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search_query) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php
$kon->close(); // Tutup kon
?>