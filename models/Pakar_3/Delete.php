<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar3    = $_POST['id_hapus'];
}
$query = mysqli_query($con, "DELETE FROM tbl_pakar3 WHERE id_pakar3='$id_pakar3'");
if ($query) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "danger";
    echo "<script>window.location='" . base_url('views/pakar3.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
