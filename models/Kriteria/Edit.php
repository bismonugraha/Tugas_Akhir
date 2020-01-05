<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $kode       = $_POST['kode'];
    $kriteria   = $_POST['kriteria'];
    $keterangan = $_POST['keterangan'];
}
$query = mysqli_query($con, "UPDATE tbl_kriteria SET kriteria='$kriteria', keterangan='$keterangan' WHERE kode='$kode'");
if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/kriteria.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
