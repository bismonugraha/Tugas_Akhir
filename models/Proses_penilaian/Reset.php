<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $query = mysqli_query($con, "DELETE a.*, b.* FROM tbl_proses_penilaian a, tbl_proses_memcdm b");
    if ($query) {
        $_SESSION['message'] = "Data berhasil direset!";
        $_SESSION['msg_type'] = "danger";
        echo "<script>window.location='" . base_url('views/a_kriteria.php') . "';</script>";
    } else {
        echo "ERROR, tidak berhasil" . mysqli_error($con);
    }
}
