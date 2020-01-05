<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar1      = $_POST['id_pakar1'];
    $id_alternatif  = $_POST['id_alternatif'];
    $k11            = $_POST['k11'];
    $k12            = $_POST['k12'];
    $k13            = $_POST['k13'];
    $k14            = $_POST['k14'];
    $k15            = $_POST['k15'];
    $k16            = $_POST['k16'];
    $k17            = $_POST['k17'];
}
$query = mysqli_query($con, "UPDATE tbl_pakar1 SET id_alternatif='$id_alternatif', k11='$k11', k12='$k12', k13='$k13', k14='$k14', k15='$k15', k16='$k16', k17='$k17' WHERE id_pakar1='$id_pakar1'");

if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/pakar1.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
