<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar3       = $_POST['id_pakar3'];
    $id_alternatif   = $_POST['id_alternatif'];
    $periode         = $_POST['periode'];
    $k31             = $_POST['k31'];
    $k32             = $_POST['k32'];
    $k33             = $_POST['k33'];
    $k34             = $_POST['k34'];
    $k35             = $_POST['k35'];
    $k36             = $_POST['k36'];
    $k37             = $_POST['k37'];
}
$query = mysqli_query($con, "INSERT INTO tbl_pakar3 VALUES('$id_pakar3', '$id_alternatif', '$periode', '$k31', '$k32', '$k33', '$k34', '$k35', '$k36', '$k37')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/pakar3.php') . "';</script>";
}
