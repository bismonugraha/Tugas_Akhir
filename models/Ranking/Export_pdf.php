<?php
require('../../phpfpdf/fpdf.php'); {
    date_default_timezone_set('Asia/Jakarta'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
}
include '../../config/config.php';
$periode       = $_POST['periode'];

$pdf = new FPDF('P', 'cm', 'A4');
$pdf->AddPage();
// Header
$pdf->SetFont('Times', 'B', 14);
$pdf->Image('../../assets/img/sleman.jpg', 0.5, 0.5, -520,);
$pdf->SetX(2.8);
$pdf->MultiCell(19.5, 1, 'Laporan Hasil Rekomendasi Penerima Bantuan Sosial', 0, 'C');
$pdf->SetX(2.8);
$pdf->MultiCell(19.5, 0, 'Program Keluarga Harapan', 0, 'C');
$pdf->SetX(2.8);
$pdf->MultiCell(19.5, 1, 'Desa Sinduadi, Dusun Jetis dan Trini', 0, 'C');
$pdf->SetFont('Times', '', 10);
$pdf->SetX(2.8);
$pdf->MultiCell(19.5, 0.3, 'Jl Magelang Km 4,5 (Sebelah SPBU Sinduadi), Mlati Sleman, DI Yogyakarta 55284, Indonesia', 0, 'C');

$pdf->Line(0.5, 3.8, 20.5, 3.8);
$pdf->SetLineWidth(0.1);
$pdf->Line(0.5, 3.9, 20.5, 3.9);
$pdf->SetLineWidth(0.1);
$pdf->Ln();
// End header
// Format Tanggal
$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(34, 1, "Printed On : " . date("D-d/m/Y H:i:s"), 0, 0, 'C');
$pdf->Ln();
// periode
$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(2.1, 1, "PERIODE : " . $periode, 0, 0, 'C');
// Tabel
$pdf->SetFont('Times', 'B', 8);
$pdf->SetLineWidth(0);
$pdf->Cell(0.5, 1, '', 0, 1);
$pdf->Cell(0.8, 1, 'NO', 1, 0, 'C');
$pdf->Cell(5, 1, 'NAMA PENGURUS', 1, 0, 'C');
$pdf->Cell(7, 1, 'ALAMAT', 1, 0, 'C');
$pdf->Cell(2.8, 1, 'HASIL PAKAR', 1, 0, 'C');
$pdf->Cell(3.5, 1, 'TINGKAT', 1, 1, 'C');

// Isi Data di tabel
$query = mysqli_query($con, "SELECT tbl_alternatif.nama_pengurus, tbl_alternatif.alamat, tbl_proses_memcdm.agregasi_pakar, tbl_skalanilai.tingkat FROM tbl_proses_memcdm
INNER JOIN tbl_alternatif ON tbl_proses_memcdm.alternatif= tbl_alternatif.id_alternatif
INNER JOIN tbl_skalanilai ON tbl_proses_memcdm.agregasi_pakar= tbl_skalanilai.id WHERE periode='$periode'
ORDER BY agregasi_pakar DESC");
$no = 1;
while ($row = mysqli_fetch_array($query)) {
    $pdf->SetFont('Times', '', 8);
    $pdf->Cell(0.8, 1, $no++, 1, 0, 'C');
    $pdf->Cell(5, 1, $row['nama_pengurus'], 1, 0, 'C');
    $pdf->Cell(7, 1, $row['alamat'], 1, 0, 'C');
    $pdf->Cell(2.8, 1, $row['agregasi_pakar'], 1, 0, 'C');
    $pdf->Cell(3.5, 1, $row['tingkat'], 1, 1, 'C');
}
$pdf->Output();
