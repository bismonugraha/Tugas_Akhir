<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_kriteria = $_POST['id_kriteria'];
    $kode = $_POST['kode'];
    $kriteria = $_POST['kriteria'];
    $keterangan = $_POST['keterangan'];
}
$query = mysqli_query($con, "INSERT INTO tbl_kriteria VALUES('$id_kriteria','$kode','$kriteria','$keterangan')");
if ($query) {
    $_SESSION['message'] = "Data berhasil ditambahkan!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/kriteria.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
