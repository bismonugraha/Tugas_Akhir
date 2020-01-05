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
                <h6 class="m-0 font-weight-bold text-primary mb-2">DATA PENGGUNA</h6><a href="#" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#tambahModal">TAMBAH <span class="fas fa-plus-circle"></span></a>
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
                            $sql = "SELECT * FROM tbl_user where username LIKE '%$pencarian%'";
                            $query = $sql;
                            $queryJml = $sql;
                        } else {
                            $query = "SELECT * FROM tbl_user LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM tbl_user";
                            $no = $posisi + 1;
                        }
                    } else {
                        $query = "SELECT * FROM tbl_user LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbl_user";
                        $no = $posisi + 1;
                    }
                    $query_run = mysqli_query($con, $query);
                    ?>
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($query_run) {
                                foreach ($query_run as $data) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $no++?></td>
                                        <td><?= $data['id']; ?></td>
                                        <td><img src="../assets/img/<?= $data['image']; ?>" width="50px" height="50px"></td>
                                        <td><?= $data['username']; ?></td>
                                        <td><?= $data['nama_lengkap']; ?></td>
                                        <td><?= $data['alamat']; ?></td>
                                        <td><?= $data['level']; ?></td>
                                        <td>
                                            <a href="" id="edit" class="btn btn-warning btn-circle btn-sm" data-toggle="modal" data-target="#editModal" data-id="<?= $data['id']; ?>" data-username="<?= $data['username']; ?>" data-nama="<?= $data['nama_lengkap']; ?>" data-tempat="<?= $data['tempat_lahir']; ?>" data-lahir=<?= $data['tanggal_lahir']; ?> data-alamat="<?= $data['alamat']; ?>" data-password="<?= $data['password']; ?>" data-image="<?= $data['image']; ?>" data-level="<?= $data['level']; ?>">
                                                <span class="fas fa-edit"></span>
                                            </a>
                                            <button class="btn btn-danger btn-circle btn-sm hapusbtn" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-------------------------- Kode Otomatis Pengguna ------------------------->
                                    <?php
                                            $carikode = mysqli_query($con, "SELECT id from tbl_user") or die(mysqli_error($con));
                                            $datakode = mysqli_fetch_array($carikode);
                                            $jumlah_data = mysqli_num_rows($carikode);
                                            if ($datakode) {
                                                $nilaikode = substr($jumlah_data[0], 1);
                                                $kode = (int) $nilaikode;
                                                $kode = $jumlah_data + 1;
                                                $pengguna = "PGN" . str_pad($kode, 2, "0", STR_PAD_LEFT);
                                            } else {
                                                $pengguna = "PGN01";
                                            }
                                            ?>
                                    <!----------------------------------- Modal Tambah ------------------------->
                                    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Tambah Data Pengguna</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('models/Pengguna/Tambah.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label class="control-label">Id</label>
                                                                    <input class="form-control" type="text" name="id" value="<?= $pengguna; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Username</label>
                                                                    <input class="form-control" type="text" name="username" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Lengkap</label>
                                                                    <input class="form-control" type="text" name="nama_lengkap" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tempat Lahir</label>
                                                                    <input class="form-control" type="text" name="tempat_lahir" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tanggal Lahir</label>
                                                                    <input class="form-control" type="date" name="tanggal_lahir" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat</label>
                                                                    <input class="form-control" type="text" name="alamat" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Password</label>
                                                                    <input class="form-control" type="text" name="password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Foto</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="image" required>
                                                                        <label for="image" class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Level</label>
                                                                    <select for="level" class="custom-select mr-sm-2" name="level" required>
                                                                        <option value="">--Pilih Level--</option>
                                                                        <option value="Operator">Operator</option>
                                                                        <option value="Pendamping1">Pendamping 1</option>
                                                                        <option value="Pendamping2">Pendamping 2</option>
                                                                        <option value="Pendamping3">Pendamping 3</option>
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

                                    <!----------------------------------- Modal edit --------------------------->
                                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Edit Data Pengguna</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <div class="modal-body" id="modal-edit">
                                                    <form action="<?= base_url('models/Pengguna/Edit.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <input type="hidden" name="id" id="id">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Username</label>
                                                                    <input type="hidden" id="id">
                                                                    <input class="form-control" type="text" name="username" id="username" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Nama Lengkap</label>
                                                                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tempat Lahir</label>
                                                                    <input class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Tanggal Lahir</label>
                                                                    <input class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Alamat</label>
                                                                    <input class="form-control" type="text" name="alamat" id="alamat" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Password</label>
                                                                    <input class="form-control" type="text" name="password" id="password" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Foto</label>
                                                                    <div class="custom-file">
                                                                        <input type="file" class="custom-file-input" name="image" id="image">
                                                                        <label for="image" class="custom-file-label">Choose file</label>
                                                                    </div>
                                                                    <div style="padding-top:5px;">
                                                                        <img src="" width="50px" id="pict">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Level</label>
                                                                    <select class="custom-select mr-sm-2" name="level" id="level" required>
                                                                        <?php
                                                                                $level = $data['level'];
                                                                                if ($level == "Operator") echo "<option value='Operator' selected>Operator</option>";
                                                                                else echo "<option value='Operator'>Operator</option>";
                                                                                if ($level == "Pendamping1") echo "<option value='Pendamping1' selected>Pendamping 1</option>";
                                                                                else echo "<option value='Pendamping1'>Pendamping 1</option>";
                                                                                if ($level == "Pendamping2") echo "<option value='Pendamping2' selected>Pendamping 2</option>";
                                                                                else echo "<option value='Pendamping2'>Pendamping 2</option>";
                                                                                if ($level == "Pendamping3") echo "<option value='Pendamping3' selected>Pendamping 3</option>";
                                                                                else echo "<option value='Pendamping3'>Pendamping 3</option>";
                                                                                ?>
                                                                    </select>
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

                                    <!----------------------------------- Modal Delete ------------------------->
                                    <div class="modal fade" id="hapusModal" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel">Konfirmasi Delete User</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="<?= base_url('models/Pengguna/Delete.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                                                    <div class="modal-body">
                                                        <input class="form-control" type="hidden" name="id_hapus" id="id_hapus">
                                                        <h6 align="center">Apakah anda yakin ingin menghapus data ini ?</h5>
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
<!-- Tampil add nama file upload -->
<script type="text/javascript">
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>

<!-- Hapus Data pengguna -->
<script>
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

<script>
    $(document).on("click", "#edit", function() {
        var id = $(this).data('id');
        var username = $(this).data('username');
        var nama = $(this).data('nama');
        var tempat = $(this).data('tempat');
        var lahir = $(this).data('lahir');
        var alamat = $(this).data('alamat');
        var pass = $(this).data('password');
        var level = $(this).data('level');
        var img = $(this).data('image');
        $("#modal-edit #id").val(id);
        $("#modal-edit #username").val(username);
        $("#modal-edit #nama_lengkap").val(nama);
        $("#modal-edit #tempat_lahir").val(tempat);
        $("#modal-edit #tanggal_lahir").val(lahir);
        $("#modal-edit #alamat").val(alamat);
        $("#modal-edit #password").val(pass);
        $("#modal-edit #level").val(level);
        $("#modal-edit #pict").attr("src", "../assets/img/" + img);

    })
</script>