<?php
require_once '../../config/config.php';

$query = "SELECT * FROM tbl_pakar1;";
$query .= "SELECT * FROM tbl_pakar2;";
$query .= "SELECT * FROM tbl_pakar3;";

if (mysqli_multi_query($con, $query)) {
    do {
        if ($result = mysqli_store_result($con)) {
            $no = 1;
            while ($row = mysqli_fetch_array($result)) {
                $id = $no++;
                $pakar = @$row['id_alternatif'];
                $periode = @$row['periode'];
                $query = mysqli_query($con, "INSERT INTO tbl_proses_penilaian VALUES
                ('$id', '$periode','$pakar','$pakar','$pakar')");
            }
            mysqli_free_result($result);
        }
        if ($query) {
            echo "<script>window.location='" . base_url('views/a_kriteria.php') . "';</script>";
        } else {
            echo "";
        }
    } while (mysqli_next_result($con));
}
