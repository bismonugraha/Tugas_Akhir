<?php
require_once "config/config.php";
if (!(@$_SESSION['Operator'] || @$_SESSION['Pendamping1'] || @$_SESSION['Pendamping2'] || @$_SESSION['Pendamping3'])) {
    echo "<script>window.location='" . base_url('views/login.php') . "';</script>";
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
    <title>SB Admin 2 - Blank</title>
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPK-PKH</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(); ?>">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <?php
            if ($_SESSION['level'] == 'Operator') {
                ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-bars"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Data Master:</h6>
                            <a class="collapse-item" href=" <?= base_url('views/skala_nilai.php'); ?>">
                                <span>Skala Nilai</span></a>
                            <a class="collapse-item" href="<?= base_url('views/kriteria.php'); ?>">
                                <span>Kriteria</span></a>
                            <a class="collapse-item" href="<?= base_url('views/alternatif.php'); ?>">
                                <span>Alternatif</span></a>
                            <a class="collapse-item" href="<?= base_url('views/pengguna.php'); ?>">
                                <span>Pengguna</span></a>
                        </div>
                    </div>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('views/a_kriteria.php'); ?>">
                        <i class="fas fa-pen-square"></i>
                        <span>Rekap Penilaian</span></a>
                </li>
                <hr class="sidebar-divider my-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('views/proses_memcdm.php'); ?>">
                        <i class="fas fa-poll"></i>
                        <span>Hasil Proses MEMCDM</span>
                    </a>
                </li>
                <hr class="sidebar-divider my-0">
            <?php } elseif ($_SESSION['level'] == 'Pendamping1') { ?>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('views/pakar1.php'); ?>">
                        <i class="fas fa-pen-square"></i>
                        <span>Penilaian Pendamping 1</span>
                    </a>
                </li>
                <hr class="sidebar-divider my-0">
            <?php } elseif ($_SESSION['level'] == 'Pendamping2') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('views/pakar2.php'); ?>">
                        <i class="fas fa-pen-square"></i>
                        <span>Penilaian Pendamping 2</span>
                    </a>
                </li>
                <hr class="sidebar-divider my-0">
            <?php } elseif ($_SESSION['level'] == 'Pendamping3') { ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('views/pakar3.php'); ?>">
                        <i class="fas fa-pen-square"></i>
                        <span>Penilaian Pendamping 3</span>
                    </a>
                </li>
                <hr class="sidebar-divider my-0">
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('views/ranking.php'); ?>">
                    <i class="fas fa-poll-h"></i>
                    <span>Ranking Penilaian</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <marquee behavior="" direction="">
                        <h4><b>SISTEM PENDUKUNG KEPUTUSAN UNTUK MENENTUKAN KELUARGA PENERIMA MANFAAT (KPM), PROGRAM KELUARGA HARAPAN</b></h4>
                    </marquee>
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= @$_SESSION['nama_lengkap']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/<?= @$_SESSION['image'] ?>">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('views/profile.php'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">