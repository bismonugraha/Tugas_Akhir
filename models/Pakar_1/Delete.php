<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar1    = $_POST['id_hapus'];
}
$query = mysqli_query($con, "DELETE FROM tbl_pakar1 WHERE id_pakar1='$id_pakar1'");
if ($query) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "danger";
    echo "<script>window.location='" . base_url('views/pakar1.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
