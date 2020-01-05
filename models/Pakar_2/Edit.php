<?php
require_once '../../config/config.php';
if ($_GET['act'] == 'submit') {
    $id_pakar2      = $_POST['id_pakar2'];
    $id_alternatif  = $_POST['id_alternatif'];
    $k21            = $_POST['k21'];
    $k22            = $_POST['k22'];
    $k23            = $_POST['k23'];
    $k24            = $_POST['k24'];
    $k25            = $_POST['k25'];
    $k26            = $_POST['k26'];
    $k27            = $_POST['k27'];
}
$query = mysqli_query($con, "UPDATE tbl_pakar2 SET id_alternatif='$id_alternatif', k21='$k21', k22='$k22', k23='$k23', k24='$k24', k25='$k25', k26='$k26', k27='$k27' WHERE id_pakar2='$id_pakar2'");

if ($query) {
    $_SESSION['message'] = "Data berhasil diedit!";
    $_SESSION['msg_type'] = "primary";
    echo "<script>window.location='" . base_url('views/pakar2.php') . "';</script>";
} else {
    echo "ERROR, tidak berhasil" . mysqli_error($con);
}
