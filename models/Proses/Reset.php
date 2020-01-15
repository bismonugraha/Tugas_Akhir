<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $periode = $_POST['periode'];
    $query = mysqli_query($con, "DELETE FROM tbl_proses_memcdm WHERE periode=$periode");
    if ($query) {
        $_SESSION['message'] = "Data berhasil direset!";
        $_SESSION['msg_type'] = "danger";
        echo "<script>window.location='" . base_url('views/proses_memcdm.php') . "';</script>";
    } else {
        echo "ERROR, tidak berhasil" . mysqli_error($con);
    }
}
