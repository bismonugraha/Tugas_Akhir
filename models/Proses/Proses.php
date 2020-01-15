<?php
require_once '../../config/config.php';
$periode       = $_POST['periode'];

$NegasiK1 = 2;
$NegasiK2 = 2;
$NegasiK3 = 2;
$NegasiK4 = 4;
$NegasiK5 = 4;
$NegasiK6 = 5;
$NegasiK7 = 5;

$query = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif 
WHERE tbl_proses_penilaian.periode= $periode";
$sql   = mysqli_query($con, $query) or die(mysqli_error($con));
$no = 1;
while ($row = mysqli_fetch_array($sql)) {
    $carikode = mysqli_query($con, "SELECT id from tbl_proses_memcdm") or die(mysqli_error($con));
    $datakode = mysqli_fetch_array($carikode);
    $jumlah_data = mysqli_num_rows($carikode);
    if ($datakode) {
        $nilaikode = substr($jumlah_data[0], 1);
        $kode = (int) $nilaikode;
        $kode = $jumlah_data + 1;
        $kode_otomatis = "" . str_pad($kode, 1, "0", STR_PAD_LEFT);
    } else {
        $kode_otomatis = "1";
    }
    // Pakar1
    $NilaiK11 = $row['k11'];
    $NilaiK12 = $row['k12'];
    $NilaiK13 = $row['k13'];
    $NilaiK14 = $row['k14'];
    $NilaiK15 = $row['k15'];
    $NilaiK16 = $row['k16'];
    $NilaiK17 = $row['k17'];
    // Pakar2
    $NilaiK21 = $row['k21'];
    $NilaiK22 = $row['k22'];
    $NilaiK23 = $row['k23'];
    $NilaiK24 = $row['k24'];
    $NilaiK25 = $row['k25'];
    $NilaiK26 = $row['k26'];
    $NilaiK27 = $row['k27'];
    // Pakar3
    $NilaiK31 = $row['k31'];
    $NilaiK32 = $row['k32'];
    $NilaiK33 = $row['k33'];
    $NilaiK34 = $row['k34'];
    $NilaiK35 = $row['k35'];
    $NilaiK36 = $row['k36'];
    $NilaiK37 = $row['k37'];
    $Alternatif = $row['id_alternatif'];
    $Periode    = $row['periode'];
    $A_kriteria1 = min((max($NegasiK1, $NilaiK11)),
        (max($NegasiK2, $NilaiK12)),
        (max($NegasiK3, $NilaiK13)),
        (max($NegasiK4, $NilaiK14)),
        (max($NegasiK5, $NilaiK15)),
        (max($NegasiK6, $NilaiK16)),
        (max($NegasiK7, $NilaiK17))
    );
    $A_kriteria2 = min((max($NegasiK1, $NilaiK21)),
        (max($NegasiK2, $NilaiK22)),
        (max($NegasiK3, $NilaiK23)),
        (max($NegasiK4, $NilaiK24)),
        (max($NegasiK5, $NilaiK25)),
        (max($NegasiK6, $NilaiK26)),
        (max($NegasiK7, $NilaiK27))
    );
    $A_kriteria3 = min((max($NegasiK1, $NilaiK31)),
        (max($NegasiK2, $NilaiK32)),
        (max($NegasiK3, $NilaiK33)),
        (max($NegasiK4, $NilaiK34)),
        (max($NegasiK5, $NilaiK35)),
        (max($NegasiK6, $NilaiK36)),
        (max($NegasiK7, $NilaiK37))
    );
    $Agregasi_pakar = max((min($A_kriteria1, 3)),
        (min($A_kriteria2, 5)),
        (min($A_kriteria3, 7))
    );
    $query = mysqli_query($con, "INSERT INTO tbl_proses_memcdm VALUES('$kode_otomatis','$Alternatif',
            '$Periode','$A_kriteria1','$A_kriteria2','$A_kriteria3','$Agregasi_pakar')");
    if ($query) {
        echo "<script>window.location='" . base_url('views/proses_memcdm.php') . "';</script>";
    } else {
        echo "ERROR, tidak berhasil" . mysqli_error($con);
    }
}
