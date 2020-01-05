<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_hapus   = $_POST['id_hapus'];
}
$query = mysqli_query($con, "DELETE FROM tbl_user WHERE id='$id_hapus'");
if ($query) {
    $_SESSION['message'] = "Data berhasil dihapus!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
} else {
    $_SESSION['message'] = "Data gagal dihapus!";
    $_SESSION['msg_type'] = "danger";
    echo "<script>window.location='" . base_url('views/pengguna.php') . "';</script>";
}
