<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id             = $_POST['id'];
    $username       = $_POST['username'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $tempat_lahir   = $_POST['tempat_lahir'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
    $level          = $_POST['level'];
    $password       = MD5($_POST['password']);
    $sumber         = $_FILES['image']['tmp_name'];
    $target         = '../../assets/img/';
    $nama_gambar    = $_FILES['image']['name'];
}
$pindah = move_uploaded_file($sumber, $target . $nama_gambar);
$query =  mysqli_query($con, "INSERT INTO tbl_user VALUES('$id','$username','$nama_lengkap',
        '$tempat_lahir','$tanggal_lahir','$alamat','$nama_gambar','$password','$level')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
} else {
    $_SESSION['message'] = "Data gagal ditambahkan!";
    $_SESSION['msg_type'] = "danger";
    echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
}
