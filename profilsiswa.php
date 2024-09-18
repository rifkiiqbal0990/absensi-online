<?php
    require 'fungsi.php';

    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }

    if(isset($_SESSION['login']) && $_SESSION['role'] == 'siswa'){
        header('location:kehadiran.php');
    }

    $id=$_GET['id'];

    $query="SELECT * FROM siswas WHERE id=$id";

    $querySiswa=mysqli_query($conn, $query);
    
    $detailData=mysqli_fetch_assoc($querySiswa);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Profil Siswa</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendor/owl-carousel/css/owl.theme.default.min.css">
    <link href="assets/vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> 



</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="assets/images/logo.png" alt="">
                <img class="logo-compact" src="assets/images/logo-text.png" alt="">
                <img class="brand-title" src="assets/images/logo-text.png" alt="">
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="profilsiswa.php?id=<?= $_SESSION['id'] ?>" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="logout.php" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                 <?php
                 if ($_SESSION['role']=='admin') { 
                 ?>
                    <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">  
                            <li><a href="dashboard.php">Dashboard</a></li>
                        </ul>
                    </li>
                    
                    <li class="nav-label">Data Siswa</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-app-store"></i><span class="nav-text">Master Data</span></a>
                        <ul aria-expanded="false">
                            <li><a href="listdatasiswa.php">List Data Siswa</a>
                            <li><a href="tambahdata.php">Tambah Data Siswa</a></li>
                            <li><a href="kehadiran.php">List Kehadiran Siswa</a></li>
                        </ul>
                    </li>
                 <?php
                 } else if($_SESSION['role']=='siswa'){
                 ?>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="bi bi-person-lines-fill"></i><span class="nav-text">Absensi</span></a>
                        <ul aria-expanded="false">
                            <li><a href="kehadiran.php">List Kehadiran Siswa</a></li>
                            <li><a href="isikehadiran.php">Isi Absensi</a></li>
                        </ul>
                        <?php 
                 }
                        ?>
                </ul>
            </div>


        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->    
            <div class="container-fluid">
                <div class="card">
                    <div class="stat-widget-two card-body">
                        <div class="stat-content">
                            <div class="stat-text text-left mt-0 text-primary">Hi, Welcome back!</div>    
                            <div class="text-left mt-0">Selamat datang di Absen IT</div>  
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Detail Data Siswa</h4>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Nama : <?= ($detailData['nama']) ?></p>
                                        </div>
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <p class="form-control-static">Jenis Kelamin : <?= ($detailData['jenis_kelamin']) ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Nis : <?= ($detailData['nis']) ?></p>
                                        </div>
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <p class="form-control-static">No Hp : <?= ($detailData['no_hp']) ?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Kelas : <?= ($detailData['kelas']) ?></p>
                                        </div>
                                        <div class="col-sm-3 mb-3 mb-sm-0">
                                            <p class="form-control-static">Asal Sekolah : <?= ($detailData['asal_sekolah']) ?></p> 
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Jurusan : <?= ($detailData['jurusan']) ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                            <p class="form-control-static">Alamat Sekolah : <?= ($detailData['alamat_sekolah']) ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Tanggal Awal Pkl : <?= ($detailData['tanggalawal_pkl']) ?></p>
                                    </div>
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                            <p class="form-control-static">Tanggal Akhir Pkl : <?= ($detailData['tanggalakhir_pkl']) ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-sm-3 mb-3 mb-sm-0">  
                                            <p class="form-control-static">Catatan Siswa : <?= ($detailData['catatan_siswa']) ?></p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="#" target="_blank">Kelompok 1</a> 2024</p>
                <p>Distributed by <a href="https://themewagon.com/" target="_blank">Themewagon</a></p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="assets/vendor/global/global.min.js"></script>
    <script src="assets/js/quixnav-init.js"></script>
    <script src="assets/js/custom.min.js"></script>


    <!-- Vectormap -->
    <script src="assets/vendor/raphael/raphael.min.js"></script>
    <script src="assets/vendor/morris/morris.min.js"></script>


    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="assets/vendor/chart.js/Chart.bundle.min.js"></script>

    <script src="assets/vendor/gaugeJS/dist/gauge.min.js"></script>

    <!--  flot-chart js -->
    <script src="assets/vendor/flot/jquery.flot.js"></script>
    <script src="assets/vendor/flot/jquery.flot.resize.js"></script>

    <!-- Owl Carousel -->
    <script src="assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

    <!-- Counter Up -->
    <script src="assets/vendor/jqvmap/js/jquery.vmap.min.js"></script>
    <script src="assets/vendor/jqvmap/js/jquery.vmap.usa.js"></script>
    <script src="assets/vendor/jquery.counterup/jquery.counterup.min.js"></script>


    <script src="assets/js/dashboard/dashboard-1.js"></script>

</body>

</html>