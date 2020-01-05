<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_alternatif = $_POST['id_alternatif'];
    $periode       = $_POST['periode'];
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
$query = mysqli_query($con, "UPDATE tbl_alternatif SET periode='$periode', nama_pengurus='$nama_pengurus', alamat='$alamat', anak_sd='$anak_sd', anak_smp='$anak_smp', anak_sma='$anak_sma', ibu_hamil='$ibu_hamil', balita='$balita', lansia='$lansia', disabilitas='$disabilitas' WHERE id_alternatif='$id_alternatif'");
if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/alternatif.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
