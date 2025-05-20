<?php
session_start();
ob_start(); // Untuk output buffering

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../../css/tsany.css" rel="stylesheet" type="text/css">
    <title>Admin - Sehati Computer</title>
    <style>
        .blackbg {
            background-color: #000;
        }
        .darkbg {
            background-color: #333;
        }
        .darkf {
            color: #333;
        }
    </style>
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content pb-3">

                <!-- Topbar -->
                <nav class="navbar navbar-expand bg-dark topbar mb-4 static-top shadow">
                    <div class="navbar-text text-center">
                        <h1 class="h4 my-auto ml-5 text-warning">Panel Admin</h1>
                    </div>
                    <!-- User Info -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['username']; ?></span>
                                <i class="fas fa-user-circle fa-lg text-white"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="logout_admin.php">
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6 mx-auto">
                            <div class="card shadow mb-5">
                                <div class="card-header bg-dark py-3 text-center">
                                    <h6 class="m-0 font-weight-normal text-warning">Selamat datang Panel Admin Digital Sehati Computer</h6>
                                </div>
                                <div class="card-body">
                                    <div class="m-0">
                                        <p class="text-dark">
                                            Hi, Panel Admin ini akan memudahkan anda dalam mengatur data barang di Sehati Computer. 
                                            Silahkan mulai bernavigasi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="col-8">
                    <br>

                    <div class="container-fluid">
                        <div class="mb-3">
                            <a href="admin.php?p=kategori_list" class="btn btn-primary">Manajemen Kategori</a>
                        </div>
                        <?php
                            $pages_dir = 'data';
                            $pages_dir = 'data';
                            if (!empty($_GET['p'])) {
                                $p = $_GET['p'];
                            
                                // Cek dulu apakah ada di dalam folder data/
                                if (file_exists("$pages_dir/$p.php")) {
                                    include("$pages_dir/$p.php");
                                }
                                // Kalau tidak ada, cek di root folder admin
                                else if (file_exists("$p.php")) {
                                    include("$p.php");
                                }
                                else {
                                    echo "Halaman tidak ditemukan";
                                }
                            } else {
                                include("$pages_dir/listbarang.php");
                            }
                        ?>
                    </div>
                    <!-- end of page content -->
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-dark">
                <div class="container my-auto">
                    <div class="row">
                        <div class="col-6">
                            <div class="copyright text-warning fs-3">
                                <p style="text-align: start;">Sehati Computer 2025</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="copyright text-warning fs-3 ">
                                <p style="text-align: end;">Project by Tsany and Ziddan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>
</html>