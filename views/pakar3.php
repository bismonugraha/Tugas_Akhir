<?php include_once('../header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <?php
        if (isset($_SESSION['message'])) : ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?> col-md-3 text-center" role="alert">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DATA PENILAIAN PENDAMPING</h6><a href="#" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#tambahModal">TAMBAH <span class="fas fa-plus-circle"></span></a>
                <div class="mt-2">
                    <form action="" class="form-inline" method="POST">
                        <div class="form-group">
                            <input type="text" name="pencarian" class="form-control mr-2" placeholder="Pencarian">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-md btn-primary"><span class="fas fa-search" aria-hidden="true"></span></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center; vertical-align: middle' rowspan='2'>No</th>
                                <th style='text-align:center; vertical-align: middle' rowspan='2'>Kode</th>
                                <th style='text-align:center; vertical-align: middle' rowspan='2'>Alt</th>
                                <th style='text-align:center; vertical-align: middle' rowspan='2'>Nama Pengurus</th>
                                <th style='text-align:center' colspan=' 8'>Kriteria Penilaian Pendamping 3</th>
                            </tr>
                            <tr>
                                <th style='text-align:center' colspan='1'>K1</th>
                                <th style='text-align:center' colspan='1'>K2</th>
                                <th style='text-align:center' colspan='1'>K3</th>
                                <th style='text-align:center' colspan='1'>K4</th>
                                <th style='text-align:center' colspan='1'>K5</th>
                                <th style='text-align:center' colspan='1'>K6</th>
                                <th style='text-align:center' colspan='1'>K7</th>
                                <th style='text-align:center' colspan='1'>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <?php
                                $batas = 10;
                                $hal = @$_GET['hal1'];
                                if (empty($hal)) {
                                    $posisi = 0;
                                    $hal = 1;
                                } else {
                                    $posisi = ($hal - 1) * $batas;
                                }
                                $no = 1;
                                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                                    @$pencarian = trim(mysqli_real_escape_string($con, $_POST['pencarian']));
                                    if ($pencarian != '') {
                                        $sql = "SELECT * FROM tbl_pakar3 and id_alternatif LIKE '%$pencarian%'";
                                        $query = $sql;
                                        $queryJml = $sql;
                                    } else {
                                        $query = "SELECT * FROM tbl_pakar3 ORDER BY id_pakar3 DESC LIMIT $posisi, $batas";
                                        $queryJml = "SELECT * FROM tbl_pakar3 ORDER BY id_pakar3 DESC";
                                        $no = $posisi + 1;
                                    }
                                } else {
                                    $query = "SELECT * FROM tbl_pakar3
                                            INNER JOIN tbl_alternatif ON tbl_pakar3.id_alternatif = tbl_alternatif.id_alternatif ORDER BY id_pakar3 DESC LIMIT $posisi, $batas";
                                    $queryJml = "SELECT * FROM tbl_pakar3
                                            INNER JOIN tbl_alternatif ON tbl_pakar3.id_alternatif = tbl_alternatif.id_alternatif ORDER BY id_pakar3 DESC";
                                    $no = $posisi + 1;
                                }
                                $sql_pakar = mysqli_query($con, $query) or die(mysqli_error($con));
                                while ($data = mysqli_fetch_array($sql_pakar)) { ?>
                                    <td style='text-align:center'><?= $no++ ?></td>
                                    <td style='text-align:center'><?= $data['id_pakar3'] ?></td>
                                    <td style='text-align:center'><?= $data['id_alternatif'] ?></td>
                                    <td style='text-align:center'><?= $data['nama_pengurus'] ?></td>
                                    <td style='text-align:center'><?= $data['k31'] ?></td>
                                    <td style='text-align:center'><?= $data['k32'] ?></td>
                                    <td style='text-align:center'><?= $data['k33'] ?></td>
                                    <td style='text-align:center'><?= $data['k34'] ?></td>
                                    <td style='text-align:center'><?= $data['k35'] ?></td>
                                    <td style='text-align:center'><?= $data['k36'] ?></td>
                                    <td style='text-align:center'><?= $data['k37'] ?></td>
                                    <td style='text-align:center'>
                                        <button class="btn btn-warning btn-circle btn-sm editbtn" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-circle btn-sm hapusbtn" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </td>
                            </tr>
                        <?php
                                }
                        ?>
                        </tbody>
                    </table>
                </div>
                <?php
                if (@$_POST['pencarian'] == '') { ?>
                    <div class="float-left;">
                        <?php
                        $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
                        echo "Jumlah Data : <b>$jml</b>";
                        ?>
                    </div>
                    <div class="float-right">
                        <ul class="pagination pagination-sm">
                            <?php
                            $jml_hal = ceil($jml / $batas);
                            for ($i = 1; $i <= $jml_hal; $i++) {
                                if ($i != $hal) {
                                    echo "<li><a class=\"page-link\" href=\"?hal1=$i\">$i</a></li>";
                                } else {
                                    echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"?hal1=$i\">$i</a></li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                } else {
                    echo "<div style=\"float:left;\">";
                    $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
                    echo "Data Hasil Pecarian : <b>$jml</b>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!----------------------------------- Kode Otomatis ------------------------->
<?php
$carikode = mysqli_query($con, "SELECT id_pakar3 from tbl_pakar3") or die(mysqli_error($con));
$datakode = mysqli_fetch_array($carikode);
$jumlah_data = mysqli_num_rows($carikode);
if ($datakode) {
    $nilaikode = substr($jumlah_data[0], 1);
    $kode = (int) $nilaikode;
    $kode = $jumlah_data + 1;
    $kode_otomatis = "PP" . str_pad($kode, 3, "0", STR_PAD_LEFT);
} else {
    $kode_otomatis = "PP001";
}
?>
<!----------------------------------- Modal Tambah ------------------------->
<div class="modal fade bd-example-modal-lg" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollable">Tambah Penilaian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6 class="alert-heading">KETERANGAN!</h6>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style='text-align:center'>K1</th>
                            <th style='text-align:center'>K2</th>
                            <th style='text-align:center'>K3</th>
                            <th style='text-align:center'>K4</th>
                            <th style='text-align:center'>K5</th>
                            <th style='text-align:center'>K6</th>
                            <th style='text-align:center'>K7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Kriteria 1</td>
                            <td>Kriteria 2</td>
                            <td>Kriteria 3</td>
                            <td>Kriteria 4</td>
                            <td>Kriteria 5</td>
                            <td>Kriteria 6</td>
                            <td>Kriteria 7</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h6 class="alert-heading">PETUNJUK PENILAIAN!</h6>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style='text-align:center'>STP</th>
                            <th style='text-align:center'>TP</th>
                            <th style='text-align:center'>KP</th>
                            <th style='text-align:center'>P</th>
                            <th style='text-align:center'>LP</th>
                            <th style='text-align:center'>SP</th>
                            <th style='text-align:center'>MP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Sangat Tidak Penting</td>
                            <td>Tidak Penting</td>
                            <td>Kurang Penting</td>
                            <td>Penting</td>
                            <td>Lebih Penting</td>
                            <td>Sangat Penting</td>
                            <td>Mutlak Penting</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('models/Pakar_3/Tambah.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Kode</label>
                                <input class="form-control" type="text" name="id_pakar3" value="<?= $kode_otomatis; ?>" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Periode</label>
                                <select for="periode" class="custom-select mr-sm-2" name="periode" id="periode" required>
                                    <option value="">--Periode--</option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Alternatif</label>
                                <select onchange="changeAdd(this.value)" class="custom-select mr-sm-2" name="id_alternatif" id="id_alternatif" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_alternatif") or die(mysqli_error($con));
                                    $jsArray = "var dtAlt = new Array();\n";
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['id_alternatif'] . '">' . $data_nilai['id_alternatif'] . '</option>';
                                        $jsArray .= "dtAlt['" . $data_nilai['id_alternatif'] . "'] = {
                                                    nama_pengurus:'" . addslashes($data_nilai['nama_pengurus']) . "',
                                                    anak_sd:'" . addslashes($data_nilai['anak_sd']) . "',
                                                    anak_smp:'" . addslashes($data_nilai['anak_smp']) . "',
                                                    anak_sma:'" . addslashes($data_nilai['anak_sma']) . "',
                                                    ibu_hamil:'" . addslashes($data_nilai['ibu_hamil']) . "',
                                                    balita:'" . addslashes($data_nilai['balita']) . "',
                                                    lansia:'" . addslashes($data_nilai['lansia']) . "',
                                                    disabilitas:'" . addslashes($data_nilai['disabilitas']) . "'};\n";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="forms" style="display:none;">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="control-label">Ibu Hamil</label>
                                    <input class="form-control" type="text" name="nama_pengurus" id="nama_pengurus" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Anak SD</label>
                                    <input class="form-control" type="number" name="anak_sd" id="anak_sd" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Anak SMP</label>
                                    <input class="form-control" type="number" name="anak_smp" id="anak_smp" readonly>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="control-label">Anak SMA</label>
                                    <input class="form-control" type="number" name="anak_sma" id="anak_sma" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Ibu Hamil</label>
                                    <input class="form-control" type="number" name="ibu_hamil" id="ibu_hamil" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Balita</label>
                                    <input class="form-control" type="number" name="balita" id="balita" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Lansia</label>
                                    <input class="form-control" type="number" name="lansia" id="lansia" readonly>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Disabilitas</label>
                                    <input class="form-control" type="number" name="disabilitas" id="disabilitas" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K1</label>
                                <select class="custom-select mr-sm-2" name="k31" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K2</label>
                                <select class="custom-select mr-sm-2" name="k32" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K3</label>
                                <select class="custom-select mr-sm-2" name="k33" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K4</label>
                                <select class="custom-select mr-sm-2" name="k34" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K5</label>
                                <select class="custom-select mr-sm-2" name="k35" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K6</label>
                                <select class="custom-select mr-sm-2" name="k36" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K7</label>
                                <select class="custom-select mr-sm-2" name="k37" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" name="submit" type="submit">Simpan</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!----------------------------------- Modal Edit ------------------------->
<div class="modal fade bd-example-modal-lg" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalScrollable">Edit Penilaian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="alert alert-warning" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h6 class="alert-heading">KETERANGAN!</h6>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style='text-align:center'>K1</th>
                            <th style='text-align:center'>K2</th>
                            <th style='text-align:center'>K3</th>
                            <th style='text-align:center'>K4</th>
                            <th style='text-align:center'>K5</th>
                            <th style='text-align:center'>K6</th>
                            <th style='text-align:center'>K7</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Kriteria 1</td>
                            <td>Kriteria 2</td>
                            <td>Kriteria 3</td>
                            <td>Kriteria 4</td>
                            <td>Kriteria 5</td>
                            <td>Kriteria 6</td>
                            <td>Kriteria 7</td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h6 class="alert-heading">PETUNJUK PENILAIAN!</h6>
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style='text-align:center'>STP</th>
                            <th style='text-align:center'>TP</th>
                            <th style='text-align:center'>KP</th>
                            <th style='text-align:center'>P</th>
                            <th style='text-align:center'>LP</th>
                            <th style='text-align:center'>SP</th>
                            <th style='text-align:center'>MP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Sangat Tidak Penting</td>
                            <td>Tidak Penting</td>
                            <td>Kurang Penting</td>
                            <td>Penting</td>
                            <td>Lebih Penting</td>
                            <td>Sangat Penting</td>
                            <td>Mutlak Penting</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('models/Pakar_3/Edit.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Kode</label>
                                <input class="form-control" type="text" name="id_pakar3" id="id_pakar3" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Alternatif</label>
                                <input class="form-control" type="text" name="id_alternatif" id="id_alternatiff" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">Nama Pengurus</label>
                                <input class="form-control" type="text" name="nama_pengurus" id="nama_penguruss" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K1</label>
                                <select class="custom-select mr-sm-2" name="k31" id="k31" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K2</label>
                                <select class="custom-select mr-sm-2" name="k32" id="k32" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K3</label>
                                <select class="custom-select mr-sm-2" name="k33" id="k33" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="control-label">K4</label>
                                <select class="custom-select mr-sm-2" name="k34" id="k34" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K5</label>
                                <select class="custom-select mr-sm-2" name="k35" id="k35" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K6</label>
                                <select class="custom-select mr-sm-2" name="k36" id="k36" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="control-label">K7</label>
                                <select class="custom-select mr-sm-2" name="k37" id="k37" required>
                                    <option value="">... Pilih ...</option>
                                    <?php
                                    $sql_nilai = mysqli_query($con, "SELECT * FROM tbl_skalanilai") or die(mysqli_error($con));
                                    while ($data_nilai = mysqli_fetch_array($sql_nilai)) {
                                        echo '<option value="' . $data_nilai['bobot'] . '">' . $data_nilai['skala'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" name="submit" type="submit">UPDATE</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!----------------------------------- Modal Delete ------------------------->
<div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Delete User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('models/Pakar_3/Delete.php?act=submit'); ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_hapus" id="id_hapus">
                    <h5 align="center">Apakah anda yakin ingin menghapus data ini ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success">Ya!! Hapus</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once('../footer.php'); ?>
<script>
    // Edit Data Penilaian Pendamping
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editModal').modal('show');
            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#id_pakar3').val(data[1]);
            $('#id_alternatiff').val(data[2]);
            $('#nama_penguruss').val(data[3]);
            $('#k31').val(data[4]);
            $('#k32').val(data[5]);
            $('#k33').val(data[6]);
            $('#k34').val(data[7]);
            $('#k35').val(data[8]);
            $('#k36').val(data[9]);
            $('#k37').val(data[10]);
        });
    });
    // Hapus Data Penilaian Pendamping
    $(document).ready(function() {
        $('.hapusbtn').on('click', function() {
            $('#hapusModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            console.log(data);
            $('#id_hapus').val(data[1]);
        });
    });
</script>

<script type="text/javascript">
    <?php
    echo $jsArray;
    ?>

    function changeAdd(id_alternatif) {
        $('.forms').show();
        document.getElementById('nama_pengurus').value = dtAlt[id_alternatif].nama_pengurus;
        document.getElementById('anak_sd').value = dtAlt[id_alternatif].anak_sd;
        document.getElementById('anak_smp').value = dtAlt[id_alternatif].anak_smp;
        document.getElementById('anak_sma').value = dtAlt[id_alternatif].anak_sma;
        document.getElementById('ibu_hamil').value = dtAlt[id_alternatif].ibu_hamil;
        document.getElementById('balita').value = dtAlt[id_alternatif].balita;
        document.getElementById('lansia').value = dtAlt[id_alternatif].lansia;
        document.getElementById('disabilitas').value = dtAlt[id_alternatif].disabilitas;
    }
</script>