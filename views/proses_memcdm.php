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
                <h6 class="m-0 font-weight-bold text-primary mb-2">HASIL PROSES ME-MCDM</h6>
                <a href="#" class="btn btn-danger float-right" data-toggle="modal" data-target="#resetModal">RESET</a>
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
                            $sql = "SELECT * FROM tbl_proses_memcdm WHERE alternatif LIKE '%$pencarian%'";
                            $query = $sql;
                            $queryJml = $sql;
                        } else {
                            $query = "SELECT * FROM tbl_proses_memcdm LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM tbl_proses_memcdm";
                            $no = $posisi + 1;
                        }
                    } else {
                        $query = "SELECT * FROM tbl_proses_memcdm
                        INNER JOIN tbl_alternatif ON tbl_proses_memcdm.alternatif= tbl_alternatif.id_alternatif
                        INNER JOIN tbl_skalanilai ON tbl_proses_memcdm.agregasi_pakar= tbl_skalanilai.id
                        LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbl_proses_memcdm
                        INNER JOIN tbl_alternatif ON tbl_proses_memcdm.alternatif= tbl_alternatif.id_alternatif
                        INNER JOIN tbl_skalanilai ON tbl_proses_memcdm.agregasi_pakar= tbl_skalanilai.id";
                        $no = $posisi + 1;
                    }
                    $query_run = mysqli_query($con, $query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center'>No</th>
                                <th style='text-align:center'>Alternatif</th>
                                <th style='text-align:center'>Agregasi Kriteria P1</th>
                                <th style='text-align:center'>Agregasi Kriteria P2</th>
                                <th style='text-align:center'>Agregasi Kriteria P3</th>
                                <th style='text-align:center'>Agregasi Pakar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $nomor = 1;
                            if ($query_run) {
                                foreach ($query_run as $data) { ?>
                                    <tr>
                                        <td class="text-center"><?= $nomor++; ?></td>
                                        <td><?= $data['nama_pengurus']; ?></td>
                                        <td class="text-center"><?= $data['agregasi_kriteria1']; ?></td>
                                        <td class="text-center"><?= $data['agregasi_kriteria2']; ?></td>
                                        <td class="text-center"><?= $data['agregasi_kriteria3']; ?></td>
                                        <td class="text-center"><?= $data['agregasi_pakar']; ?></td>
                                    </tr>
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
<?php include_once('../footer.php'); ?>
<div class="modal fade" id="resetModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Konfirmasi Reset</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('models/Proses/Reset.php?act=submit'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">Periode</label>
                        <select for="periode" class="custom-select mr-sm-2" name="periode" id="periode" required>
                            <option value="">--Tahun--</option>
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
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-success">RESET</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>