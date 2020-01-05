<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id             = $_POST['id'];
    $username       = $_POST['username'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $tempat_lahir   = $_POST['tempat_lahir'];
    $tanggal_lahir  = $_POST['tanggal_lahir'];
    $alamat         = $_POST['alamat'];
}
$query = mysqli_query($con, "UPDATE tbl_user SET username='$username', nama_lengkap='$nama_lengkap', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', alamat='$alamat', password='$password' WHERE id='$id'");
if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/profile.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
