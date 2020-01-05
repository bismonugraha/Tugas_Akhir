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
                <h6 class="m-0 font-weight-bold text-primary">REKAP PENILAIAN</h6>
                <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#resetModal">RESET PENILAIAN</a>
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
                                <th style='text-align:center; vertical-align: middle; background:darkgrey; color:black' rowspan='4'>Alternatif</th>
                                <th style='text-align:center; background:darkgrey; color:black' colspan=' 22'>Kriteria Penilaian</th>
                            </tr>
                            <tr>
                                <th style='text-align:center; background:darksalmon; color:black' colspan='7'>PENDAMPING 1</th>
                                <th style='text-align:center; background:darkseagreen; color:black' colspan='7'>PENDAMPING 2</th>
                                <th style='text-align:center; background:darkturquoise; color:black' colspan='8'>PENDAMPING 3</th>
                            </tr>
                            <tr style='background:gainsboro; color:black'>
                                <th style='text-align:center' colspan='1'>K1</th>
                                <th style='text-align:center' colspan='1'>K2</th>
                                <th style='text-align:center' colspan='1'>K3</th>
                                <th style='text-align:center' colspan='1'>K4</th>
                                <th style='text-align:center' colspan='1'>K5</th>
                                <th style='text-align:center' colspan='1'>K6</th>
                                <th style='text-align:center' colspan='1'>K7</th>
                                <th style='text-align:center' colspan='1'>K1</th>
                                <th style='text-align:center' colspan='1'>K2</th>
                                <th style='text-align:center' colspan='1'>K3</th>
                                <th style='text-align:center' colspan='1'>K4</th>
                                <th style='text-align:center' colspan='1'>K5</th>
                                <th style='text-align:center' colspan='1'>K6</th>
                                <th style='text-align:center' colspan='1'>K7</th>
                                <th style='text-align:center' colspan='1'>K1</th>
                                <th style='text-align:center' colspan='1'>K2</th>
                                <th style='text-align:center' colspan='1'>K3</th>
                                <th style='text-align:center' colspan='1'>K4</th>
                                <th style='text-align:center' colspan='1'>K5</th>
                                <th style='text-align:center' colspan='1'>K6</th>
                                <th style='text-align:center' colspan='1'>K7</th>
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
                                        $sql = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
                                        INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
                                        INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
                                        INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif LIKE '%$pencarian%'";
                                        $query = $sql;
                                        $queryJml = $sql;
                                    } else {
                                        $query = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
                                        INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
                                        INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
                                        INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif LIMIT $posisi, $batas";
                                        $queryJml = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
                                        INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
                                        INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
                                        INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif";
                                        $no = $posisi + 1;
                                    }
                                } else {
                                    $query = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
                                    INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
                                    INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
                                    INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif LIMIT $posisi, $batas";
                                    $queryJml = "SELECT  tbl_pakar1.*, tbl_pakar2.*, tbl_pakar3.* FROM tbl_proses_penilaian
                                    INNER JOIN tbl_pakar1 ON tbl_proses_penilaian.id_pakar1 = tbl_pakar1.id_alternatif
                                    INNER JOIN tbl_pakar2 ON tbl_proses_penilaian.id_pakar2 = tbl_pakar2.id_alternatif
                                    INNER JOIN tbl_pakar3 ON tbl_proses_penilaian.id_pakar3 = tbl_pakar3.id_alternatif";
                                    $no = $posisi + 1;
                                }
                                $sql_pakar = mysqli_query($con, $query) or die(mysqli_error($con));
                                while ($data = mysqli_fetch_array($sql_pakar)) { ?>

                                    <td style='text-align:center'><?= $data['id_alternatif'] ?></td>
                                    <td style='text-align:center'><?= $data['k11'] ?></td>
                                    <td style='text-align:center'><?= $data['k12'] ?></td>
                                    <td style='text-align:center'><?= $data['k13'] ?></td>
                                    <td style='text-align:center'><?= $data['k14'] ?></td>
                                    <td style='text-align:center'><?= $data['k15'] ?></td>
                                    <td style='text-align:center'><?= $data['k16'] ?></td>
                                    <td style='text-align:center'><?= $data['k17'] ?></td>
                                    <td style='text-align:center'><?= $data['k21'] ?></td>
                                    <td style='text-align:center'><?= $data['k22'] ?></td>
                                    <td style='text-align:center'><?= $data['k23'] ?></td>
                                    <td style='text-align:center'><?= $data['k24'] ?></td>
                                    <td style='text-align:center'><?= $data['k25'] ?></td>
                                    <td style='text-align:center'><?= $data['k26'] ?></td>
                                    <td style='text-align:center'><?= $data['k27'] ?></td>
                                    <td style='text-align:center'><?= $data['k31'] ?></td>
                                    <td style='text-align:center'><?= $data['k32'] ?></td>
                                    <td style='text-align:center'><?= $data['k33'] ?></td>
                                    <td style='text-align:center'><?= $data['k34'] ?></td>
                                    <td style='text-align:center'><?= $data['k35'] ?></td>
                                    <td style='text-align:center'><?= $data['k36'] ?></td>
                                    <td style='text-align:center'><?= $data['k37'] ?></td>
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
                <div class="text-center my-auto">
                    <?php if ($jml == "0") : ?>
                        <a href="<?= base_url('models/Proses_penilaian/Pendamping.php'); ?>" class="btn btn-primary" id="tampil">Tampilkan Hasil Penilaian</a>
                    <?php else : ?>
                        <button disabled="disabled" class="btn btn-primary">Sudah Tampil</button>
                    <?php endif ?>
                    <?php
                    $ambil = mysqli_query($con, "SELECT * FROM tbl_proses_memcdm");
                    $detail = $ambil->fetch_assoc();
                    if (!empty($detail)) : ?>
                        <button disabled="disabled" class="btn btn-primary">Sudah Diproses</button>
                    <?php else : ?>
                        <a href="<?= base_url('models/Proses/Proses.php'); ?>" class="btn btn-primary" id="proses">Proses Penilaian</a>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once('../footer.php'); ?>
<!----------------------------------- Modal Reset ------------------------->
<div class="modal fade" id="resetModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Reset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('models/Proses_penilaian/Reset.php?act=submit'); ?>" method="POST">
                <div class="modal-body">
                    <h5 align="center">Apakah anda yakin ingin mereset data yang telah di ada sebelumnya ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success" id="reset">Ya!! Reset</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>