<?
    include '../www/connector/koneksi.php';
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

    <title>Komputer - Sehati Computer</title>

    <style>
        .blackbg{
            background-color: #000;
        }
        .darkbg{
            background-color: #333;
        }
        .darkf{
            color: #333;
        }
    </style>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar sticky-top navbar-expand bg-dark topbar mb-4 static-top shadow">


                    <div class="navbar-text text-start">
                        <h1 class="h4 my-auto mx-auto text-warning">Katalog - Printer</h1>    
                    </div>



                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 mx-auto"> <!-- Added mx-auto class here -->
                        <div class="card shadow mb-4">
                        <div class="card-header bg-dark py-3 text-center">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="mt-3 ml-3 font-weight-normal text-warning">Daftar Merk - Merk Printer</h6>
                                    </div>
                                    <div class="col-6">
                                        <a href="./menu_utama.php" class="btn btn-sm btn-danger mt-2">Kembali</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">

                            <div class="m-0">
                                    <p class="text-dark text-center">
                                        Silahkan Pilih berdasarkan merk yang anda inginkan
                                    </p>
                                </div>

                                <div class="m-0">
                                    <div class="row">
                                        <div class="col-6">
                                            <ul>
                                                <li><a href="kategori_printer.php?p=merk_PrinterCampur" class="btn btn-sm btn-dark mb-2">Semua Merk</a></li>
                                                <li><a href="kategori_printer.php?p=merk_PrinterEpson" class="btn btn-sm btn-dark mb-2">Epson</a></li>
                                                <li><a href="kategori_printer.php?p=merk_PrinterCanon" class="btn btn-sm btn-dark mb-2">Canon</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul>
                                                <li><a href="kategori_printer.php?p=merk_PrinterCartridge" class="btn btn-sm btn-dark mb-2">Cartridge</a></li>
                                                <li><a href="kategori_printer.php?p=merk_PrinterTinta" class="btn btn-sm btn-dark mb-2">Tinta</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-8">
                <br>

                <div class="container-fluid">
                <?php
                            $pages_dir='merk';
                            if(!empty ($_GET['p'])){
                            $pages=scandir($pages_dir,0);
                            unset($pages[0], $pages[1]);
                            $p=$_GET['p'];
                            if(in_array($p.".php", $pages)){
                                include($pages_dir.'/'.$p.'.php');
                            }else{
                                echo "<h1 class='text-danger'>Halaman tidak ditemukan</h1>";
                            }
                            }
                        ?>
                </div>
            </div>

                

                </div>
                </div>

                </div>

                

            </div>

            
            <!-- End of Main Content -->

            

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


