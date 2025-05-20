<?php
include __DIR__ . '/../../../connector/koneksi.php';

$query = "SELECT * FROM produk WHERE merk_produk = 'keyboard' AND kategori_id = '4'";
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
                            <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['nama_produk']); ?>" class="img-fluid" />
                            <hr>
                            <p class="card-text my-3"><?php echo htmlspecialchars($row['deskripsi_produk']); ?></p>
                            <hr>
                            <p class="card-text fw-bolder fs-1 text-primary">Harga Rp. <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                            <p class="card-text text-left">
                                        <?php 
                                            if ($row['stok_produk'] < 1) {
                                                echo "<div class='text-danger'>Stok Habis</div>";
                                            } else {
                                                echo "<div class='text-success'>Stok Tersedia</div>";
                                            }
                                        ?>
                            </p>
                            <hr>
                            <a href="https://wa.me/+6282115118515?text=Halo,%20saya%20ingin%20order%20Keyboard!" class="btn btn-dark btn-outline-success">Pesan Sekarang !</a>
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
