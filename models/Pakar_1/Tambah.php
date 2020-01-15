<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar1       = $_POST['id_pakar1'];
    $id_alternatif   = $_POST['id_alternatif'];
    $periode         = $_POST['periode'];
    $k11             = $_POST['k11'];
    $k12             = $_POST['k12'];
    $k13             = $_POST['k13'];
    $k14             = $_POST['k14'];
    $k15             = $_POST['k15'];
    $k16             = $_POST['k16'];
    $k17             = $_POST['k17'];
}
$query = mysqli_query($con, "INSERT INTO tbl_pakar1 VALUES('$id_pakar1', '$id_alternatif', '$periode', '$k11', '$k12', '$k13', '$k14', '$k15', '$k16', '$k17')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/pakar1.php') . "';</script>";
}
