<?php
error_reporting(0);
include_once('../header.php');
?>

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
                <h6 class="m-0 font-weight-bold text-primary mb-2">DATA ALTERNATIF</h6>
                <div class="float-right">
                    <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahModal">TAMBAH <span class="fas fa-plus-circle"></span></a>
                    <a href="#" class="btn btn-sm btn-success mr-2" data-toggle="modal" data-target="#importModal">
                        Import File <span class="fas fa-file-excel"></span>
                    </a>
                </div>
                <div>
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
            <div class=" card-body">
                <div class="table-responsive">
                    <?php
                    $batas = 10;
                    $hal = @$_GET['hal'];
                    if (empty($hal)) {
                        $posisi = 0;
                        $hal = 1;
                    } else {
                        $posisi = ($hal - 1) * $batas;
                    }
                    $no = 1;
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {
                        $pencarian = trim(mysqli_real_escape_string($con, $_POST['pencarian']));
                        if ($pencarian != '') {
                            $sql = "SELECT * FROM tbl_alternatif WHERE periode LIKE '%$pencarian%'";
                            $query = $sql;
                            $queryJml = $sql;
                        } else {
                            $query = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif DESC LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif DESC";
                            $no = $posisi + 1;
                        }
                    } else {
                        $query = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif DESC LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbl_alternatif ORDER BY id_alternatif DESC";
                        $no = $posisi + 1;
                    }
                    $query_run = mysqli_query($con, $query);
                    ?>
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center; vertical-align: middle;' rowspan=' 4'>No</th>
                                <th style='text-align:center; vertical-align: middle;' rowspan=' 4'>Alternatif</th>
                                <th style='text-align:center; vertical-align: middle;' rowspan=' 4'>Nama</th>
                                <th style='text-align:center; vertical-align: middle;' rowspan=' 4'>Alamat</th>
                                <th style='text-align:center' colspan='7'>Jumlah Anggota Keluarga Yang Masuk Kriteria</th>
                                <th style='text-align:center; vertical-align: middle;' rowspan='4'>Aksi</th>
                            </tr>
                            <tr>
                                <th colspan='1' style='text-align:center'>SD</th>
                                <th colspan='1' style='text-align:center'>SMP</th>
                                <th colspan='1' style='text-align:center'>SMA</th>
                                <th colspan='1' style='text-align:center'>Ibu Hamil</th>
                                <th colspan='1' style='text-align:center'>Balita</th>
                                <th colspan='1' style='text-align:center'>Lansia</th>
                                <th colspan='1' style='text-align:center'>Disabilitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_run) {
                                foreach ($query_run as $data) {
                            ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['id_alternatif']; ?></td>
                                        <td><?= $data['nama_pengurus']; ?></td>
                                        <td><?= $data['alamat']; ?></td>
                                        <td><?= $data['anak_sd']; ?></td>
                                        <td><?= $data['anak_smp']; ?></td>
                                        <td><?= $data['anak_sma']; ?></td>
                                        <td><?= $data['ibu_hamil']; ?></td>
                                        <td><?= $data['balita']; ?></td>
                                        <td><?= $data['lansia']; ?></td>
                                        <td><?= $data['disabilitas']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#editModal<?= $data['id_alternatif'] ?>"><span class="fas fa-edit"></span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-circle btn-sm hapusbtn"><span class="fas fa-trash-alt"></span></button>
                                        </td>
                                    </tr>
                                    <!------------ Kode Otomatis Kode ---------------->
                                    <?php
                                    $carikode = mysqli_query($con, "SELECT id_alternatif from tbl_alternatif") or die(mysqli_error($con));
                                    $datakode = mysqli_fetch_array($carikode);
                                    $jumlah_data = mysqli_num_rows($carikode);
                                    if ($datakode) {
                                        $nilaikode = substr($jumlah_data[0], 1);
                                        $kode = (int) $nilaikode;
                                        $kode = $jumlah_data + 1;
                                        $kode_otomatis = "ALT" . str_pad($kode, 2, "0", STR_PAD_LEFT);
                                    } else {
                                        $kode_otomatis = "ALT1";
                                    }
                                    ?>
                                    <!----------------------------------------- Modal Tambah ---------------------------------------------->
                                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Tambah Data Alternatif</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('models/Alternatif/Tambah.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Kode</label>
                                                                    <input class="form-control" type="text" name="id_alternatif" value="<?= $kode_otomatis; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Pengurus</label>
                                                                    <input class="form-control" type="text" name="nama_pengurus" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat</label>
                                                                    <input class="form-control" type="text" name="alamat" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SD</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_sd" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SMP</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_smp" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SMA</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_sma" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Ibu Hamil</label>
                                                                    <input class="form-control" min="0" type="number" name="ibu_hamil" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Balita</label>
                                                                    <input class="form-control" min="0" type="number" name="balita" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Lansia</label>
                                                                    <input class="form-control" min="0" type="number" name="lansia" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Disabilitas</label>
                                                                    <input class="form-control" min="0" type="number" name="disabilitas" required>
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

                                    <!----------------------------------------- Modal edit ------------------------------------------------>
                                    <div class="modal fade" id="editModal<?= $data['id_alternatif'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Edit Data Alternatif</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('models/Alternatif/Edit.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Kode</label>
                                                                    <input class="form-control" type="text" name="id_alternatif" value="<?= $data['id_alternatif']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Pengurus</label>
                                                                    <input class="form-control" type="text" name="nama_pengurus" value="<?= $data['nama_pengurus']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tahun</label>
                                                                    <select class="custom-select mr-sm-2" name="periode" id="periode" required>
                                                                        <?php
                                                                        $periode = $data['periode'];
                                                                        if ($periode == "2024") echo "<option value='2024' selected>2025</option>";
                                                                        else echo "<option value='2024'>2024</option>";
                                                                        if ($periode == "2023") echo "<option value='2023' selected>2023</option>";
                                                                        else echo "<option value='2023'>2023</option>";
                                                                        if ($periode == "2022") echo "<option value='2022' selected>2022</option>";
                                                                        else echo "<option value='2022'>2022</option>";
                                                                        if ($periode == "2021") echo "<option value='2021' selected>2021</option>";
                                                                        else echo "<option value='2021'>2021</option>";
                                                                        if ($periode == "2020") echo "<option value='2020' selected>2020</option>";
                                                                        else echo "<option value='2020'>2020</option>";
                                                                        if ($periode == "2019") echo "<option value='2019' selected>2019</option>";
                                                                        else echo "<option value='2019'>2019</option>";
                                                                        if ($periode == "2018") echo "<option value='2018' selected>2018</option>";
                                                                        else echo "<option value='2018'>2018</option>";
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat</label>
                                                                    <input class="form-control" type="text" name="alamat" value="<?= $data['alamat']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SD</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_sd" value="<?= $data['anak_sd']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SMP</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_smp" value="<?= $data['anak_smp']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Anak SMA</label>
                                                                    <input class="form-control" min="0" type="number" name="anak_sma" value="<?= $data['anak_sma']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Ibu Hamil</label>
                                                                    <input class="form-control" min="0" type="number" name="ibu_hamil" value="<?= $data['ibu_hamil']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Balita</label>
                                                                    <input class="form-control" min="0" type="number" name="balita" value="<?= $data['balita']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Lansia</label>
                                                                    <input class="form-control" min="0" type="number" name="lansia" value="<?= $data['lansia']; ?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Disabilitas</label>
                                                                    <input class="form-control" min="0" type="number" name="disabilitas" value="<?= $data['disabilitas']; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" name="submit" type="submit">Simpan</button>
                                                            <button class="btn btn-secondary" data-dismiss="modal" aria-hidden="true">Keluar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!----------------------------------------- Modal Delete ---------------------------------------------->
                                    <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="<?= base_url('models/Alternatif/Delete.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                    <div class="modal-body">
                                                        <input class="form-control" type="hidden" name="id_hapus" id="id_hapus">
                                                        <h6 align="center">Apakah anda yakin ingin menghapus data ini?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="submit" class="btn btn-success">Ya!! Hapus</button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!----------------------------------------- Modal Import ---------------------------------------------->
                                    <div class="modal fade" id="importModal" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="<?= base_url('models/Alternatif/Import.php'); ?>" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="customFile" name="fileAlternatif">
                                                            <label for="customFile" class="custom-file-label">Choose file</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input class="btn btn-primary" type="submit" name="upload" value="Import">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
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
                                    echo "<li><a class=\"page-link\" href=\"?hal=$i\">$i</a></li>";
                                } else {
                                    echo "<li class=\"page-item active\"><a class=\"page-link\" href=\"?hal=$i\">$i</a></li>";
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
<?php include_once('../footer.php'); ?>
<script>
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
    // Tampil nama file upload
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>