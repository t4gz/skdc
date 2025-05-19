<?php
include __DIR__ . '/../../../connector/koneksi.php';

$query = "SELECT * FROM produk WHERE merk_produk = 'laptop_kantor' AND kategori_id = '2'";
$result = mysqli_query($kon, $query);
?>

<div class="container-fluid ">
<div class="row d-flex flex-wrap justify-content-center ">
        <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card mx-auto">
                        <div class="card-body">
                            <h5 class="card-header bg-dark text-center text-warning"><?php echo htmlspecialchars($row['nama_produk']); ?></h5>
                            <hr>
                            <p class="text-danger">gambar taruh sini ae</p>
                            <hr>
                            <p class="card-text my-3"><?php echo htmlspecialchars($row['deskripsi_produk']); ?></p>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                <p class="card-text fw-bolder fs-1 text-primary">Harga Mulai dari Rp. <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="card-text text-center">Stok: <?php echo htmlspecialchars($row['stok_produk']); ?></p>
                                </div>
                            </div>
                            <hr>
                            <a href="https://wa.me/+6282115118515?text=Halo,%20saya%20ingin%20order%20Laptop%20Buat%20Kantor!" class="btn btn-dark btn-outline-success">Pesan Sekarang !</a>
                        </div>
                    </div>  
                </div>
                <?php
            }
        } else {
            echo "Error fetching data: " . mysqli_error($kon);
        }
        ?>
    </div>
</div>
