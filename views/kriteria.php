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
                <h6 class="m-0 font-weight-bold text-primary mb-2">DATA KRITERIA</h6><a href="#" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#tambahModal">TAMBAH <span class="fas fa-plus-circle"></span></a>
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
            <div class="card-body">
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
                            $sql = "SELECT * FROM tbl_kriteria where keterangan LIKE '%$pencarian%'";
                            $query = $sql;
                            $queryJml = $sql;
                        } else {
                            $query = "SELECT * FROM tbl_kriteria LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM tbl_kriteria";
                            $no = $posisi + 1;
                        }
                    } else {
                        $query = "SELECT * FROM tbl_kriteria LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbl_kriteria";
                        $no = $posisi + 1;
                    }
                    $query_run = mysqli_query($con, $query);
                    ?>
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Kode</th>
                                <th>Kriteria</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_run) {
                                foreach ($query_run as $data) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['kode']; ?></td>
                                        <td><?= $data['kriteria']; ?></td>
                                        <td><?= $data['keterangan']; ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#editModal<?= $data['id_kriteria'] ?>"><span class="fas fa-edit"></span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-circle btn-sm hapusbtn"><span class="fas fa-trash-alt"></span></button>
                                        </td>
                                    </tr>
                                    <!------------ Kode Otomatis Kode ---------------->
                                    <?php
                                            $carikode = mysqli_query($con, "SELECT id_kriteria from tbl_kriteria") or die(mysqli_error($con));
                                            $datakode = mysqli_fetch_array($carikode);
                                            $jumlah_data = mysqli_num_rows($carikode);
                                            if ($datakode) {
                                                $nilaikode = substr($jumlah_data[0], 1);
                                                $kode = (int) $nilaikode;
                                                $kode = $jumlah_data + 1;
                                                $kode_otomatis = str_pad($kode, 1, STR_PAD_LEFT);
                                            } else {
                                                $kode_otomatis = "1";
                                            }
                                            ?>
                                    <!----------------------------------- Modal Tambah ------------------------->
                                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Tambah Data Kriteria</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('models/Kriteria/Tambah.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                        <div class="form-group">
                                                            <label class="control-label">ID</label>
                                                            <input class="form-control" type="text" name="id_kriteria" value="<?= $kode_otomatis; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Kode</label>
                                                            <input class="form-control" type="text" name="kode" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Kriteria</label>
                                                            <input class="form-control" type="text" name="kriteria" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Keterangan</label>
                                                            <input class="form-control" type="text" name="keterangan" required />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success" name="submit" type="submit">Simpan</button>
                                                            <button class="btn btn-reset" type="reset">Reset</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!----------------------------------- Modal edit --------------------------->
                                    <div class="modal fade" id="editModal<?= $data['id_kriteria'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Edit Data Kriteria</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('models/Kriteria/Edit.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode</label>
                                                            <input class="form-control" type="text" name="kode" value="<?= $data['kode']; ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Kriteria</label>
                                                            <input class="form-control" type="text" name="kriteria" value="<?= $data['kriteria']; ?>" required />
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Keterangan</label>
                                                            <input class="form-control" type="text" name="keterangan" value="<?= $data['keterangan']; ?>" required />
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

                                    <!----------------------------------- Modal Delete ------------------------->
                                    <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="<?= base_url('models/Kriteria/Delete.php?act=submit'); ?>" method="POST">
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