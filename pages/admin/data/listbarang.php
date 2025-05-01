<?php
$koneksi = new mysqli("localhost", "root", "", "sk");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tabel produk
$query = "SELECT * FROM produk";
$result = $koneksi->query($query);

if (!$result) {
    die("Query failed: " . $koneksi->error);
}
?>

<!-- DataTales Example -->
<div class="card-header py-3 bg-dark">
    <h6 class="m-0 font-weight-normal text-warning text-center" style="font-size: large;">List Barang - Barang</h6>
</div>
<div class="table-responsive">
    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
        <thead class="text-center">
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
            $no = 1; // Untuk nomor urut
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='text-center'>{$no}</td>";
                    echo "<td>{$row['nama_produk']}</td>";
                    echo "<td>{$row['kode_produk']}</td>";
                    echo "<td>Rp " . number_format($row['harga_produk'], 0, ',', '.') . "</td>";
                    echo "<td>{$row['stok_produk']}</td>";
                    echo "<td><img src='{$row['image']}' alt='' class='rounded mx-auto d-block' width='160' height='90'></td>";
                    echo "<td>{$row['deskripsi_produk']}</td>";
                    echo "<td>
                            <div class='row'>
                                <div class='col-sm-6'>
                                    <a href='edit.php?id={$row['produk_id']}' class='btn btn-sm btn-success'>EDIT</a>
                                </div>
                                <div class='col-sm-6'>
                                    <a href='hapus.php?id={$row['produk_id']}' class='btn btn-sm btn-danger'>HAPUS</a>
                                </div>
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

<?php
$koneksi->close(); // Tutup koneksi
?>