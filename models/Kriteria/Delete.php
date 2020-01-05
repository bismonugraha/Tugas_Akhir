<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $kode   = $_POST['id_hapus'];
}
$query = mysqli_query($con, "DELETE FROM tbl_kriteria WHERE kode='$kode'");
if ($query) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "danger";
    echo "<script>window.location='" . base_url('views/kriteria.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
