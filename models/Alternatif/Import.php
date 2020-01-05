<?php
error_reporting(0);
require_once '../../config/config.php';
require_once '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

if (isset($_FILES['fileAlternatif']['name']) && in_array($_FILES['fileAlternatif']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['fileAlternatif']['name']);
    $extension = end($arr_file);

    if ('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }

    $spreadsheet = $reader->load($_FILES['fileAlternatif']['tmp_name']);

    $sheetData = $spreadsheet->getActiveSheet()->toArray();
    for ($i = 0; $i < count($sheetData); $i++) {
        $id_alternatif = $sheetData[$i]['0'];
        $periode = $sheetData[$i]['1'];
        $alternatif = $sheetData[$i]['2'];
        $nama_pengurus = $sheetData[$i]['3'];
        $alamat = $sheetData[$i]['4'];
        $anak_sd = $sheetData[$i]['5'];
        $anak_smp = $sheetData[$i]['6'];
        $anak_sma = $sheetData[$i]['7'];
        $ibu_hamil = $sheetData[$i]['8'];
        $balita = $sheetData[$i]['9'];
        $lansia = $sheetData[$i]['10'];
        $disabilitas = $sheetData[$i]['11'];

        mysqli_query($con, "INSERT INTO tbl_alternatif(id_alternatif,periode,alternatif,nama_pengurus,alamat,anak_sd,anak_smp,anak_sma,ibu_hamil,balita,lansia,disabilitas) VALUES ('$id_alternatif','$periode','$alternatif','$nama_pengurus','$alamat','$anak_sd','$anak_smp','$anak_sma','$ibu_hamil','$balita','$lansia','$disabilitas')");
    }
    $_SESSION['message'] = "Data berhasil diimport!";
    $_SESSION['msg_type'] = "success";
    echo "<script>window.location='" . base_url('views/alternatif.php') . "';</script>";
}
