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
    $nama_gambar    = $_FILES['image']['name'];
    $sumber         = $_FILES['image']['tmp_name'];
    $target         = '../../assets/img/';
}
if ($nama_gambar != "") {
    move_uploaded_file($sumber, $target . $nama_gambar);
    $update = mysqli_query($con, "UPDATE tbl_user SET username='$username', nama_lengkap='$nama_lengkap',
            tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',alamat='$alamat',level='$level', 
            password='$password', image='$nama_gambar' WHERE id='$id'");
    if ($update) {
        $_SESSION['message']  = "Data berhasil diedit!";
        $_SESSION['msg_type'] = "success";
        echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
    } else {
        $_SESSION['message']  = "Data gagal diedit!";
        $_SESSION['msg_type'] = "danger";
        echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
    }
} else {
    $update = mysqli_query($con, "UPDATE tbl_user SET username='$username', nama_lengkap='$nama_lengkap',
            tempat_lahir='$tempat_lahir',tanggal_lahir='$tanggal_lahir',alamat='$alamat',level='$level',
            password='$password' WHERE id='$id'");
    if ($update) {
        $_SESSION['message']  = "Data berhasil diedit!";
        $_SESSION['msg_type'] = "success";
        echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
    } else {
        $_SESSION['message']  = "Data gagal diedit!";
        $_SESSION['msg_type'] = "danger";
        echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
    }
}
