<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ranking Penilaian Pakar</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Ranking Pakar.xls");
    ?>
    <h4>Laporan Hasil Rekomendasi Penerima Bansos PKH</h4>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Pengurus</th>
            <th>Alamat</th>
            <th>Hasil Pakar</th>
            <th>Tingkat</th>
        </tr>
        <?php
        // koneksi database
        include '../../config/config.php';

        // menampilkan data ranking
        $query = mysqli_query($con, "SELECT tbl_alternatif.nama_pengurus, tbl_alternatif.alamat, tbl_proses_memcdm.agregasi_pakar, tbl_skalanilai.tingkat FROM tbl_proses_memcdm
        INNER JOIN tbl_alternatif ON tbl_proses_memcdm.alternatif= tbl_alternatif.id_alternatif
        INNER JOIN tbl_skalanilai ON tbl_proses_memcdm.agregasi_pakar= tbl_skalanilai.id
        ORDER BY agregasi_pakar DESC");
        $no = 1;
        while ($row = mysqli_fetch_array($query)) {
            ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama_pengurus']; ?></td>
            <td><?php echo $row['alamat']; ?></td>
            <td><?php echo $row['agregasi_pakar']; ?></td>
            <td><?php echo $row['tingkat']; ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>