<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar3      = $_POST['id_pakar3'];
    $id_alternatif  = $_POST['id_alternatif'];
    $k31            = $_POST['k31'];
    $k32            = $_POST['k32'];
    $k33            = $_POST['k33'];
    $k34            = $_POST['k34'];
    $k35            = $_POST['k35'];
    $k36            = $_POST['k36'];
    $k37            = $_POST['k37'];
}
$query = mysqli_query($con, "UPDATE tbl_pakar3 SET id_alternatif='$id_alternatif', k31='$k31', k32='$k32', k33='$k33', k34='$k34', k35='$k35', k36='$k36', k37='$k37' WHERE id_pakar3='$id_pakar3'");

if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/pakar3.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
