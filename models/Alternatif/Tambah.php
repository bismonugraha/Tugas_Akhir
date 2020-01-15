<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_alternatif = $_POST['id_alternatif'];
    $nama_pengurus = $_POST['nama_pengurus'];
    $alamat        = $_POST['alamat'];
    $anak_sd       = $_POST['anak_sd'];
    $anak_smp      = $_POST['anak_smp'];
    $anak_sma      = $_POST['anak_sma'];
    $ibu_hamil     = $_POST['ibu_hamil'];
    $balita        = $_POST['balita'];
    $lansia        = $_POST['lansia'];
    $disabilitas   = $_POST['disabilitas'];
}
$query = mysqli_query($con, "INSERT INTO tbl_alternatif VALUES('$id_alternatif', '$nama_pengurus','$alamat','$anak_sd','$anak_smp','$anak_sma','$ibu_hamil','$balita','$lansia','$disabilitas')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/alternatif.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
