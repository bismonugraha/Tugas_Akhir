<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar2       = $_POST['id_pakar2'];
    $id_alternatif   = $_POST['id_alternatif'];
    $periode         = $_POST['periode'];
    $k21             = $_POST['k21'];
    $k22             = $_POST['k22'];
    $k23             = $_POST['k23'];
    $k24             = $_POST['k24'];
    $k25             = $_POST['k25'];
    $k26             = $_POST['k26'];
    $k27             = $_POST['k27'];
}
$query = mysqli_query($con, "INSERT INTO tbl_pakar2 VALUES('$id_pakar2', '$id_alternatif', '$periode', '$k21', '$k22', '$k23', '$k24', '$k25', '$k26', '$k27')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/pakar2.php') . "';</script>";
}
