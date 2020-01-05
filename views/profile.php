<?php include_once('../header.php'); ?>
<h1 class="h4 mb-3 text-gray-800"></h1>
<div class="row">
    <div class="col-lg-12 mx-auto">
        <div class="card text-center">
            <div class="card-header">
                <b>USER PROFILE</b>
            </div>
            <div class="card-body" style="color: #000000;">
                <img class="img-profile rounded-circle shadow p-1 mb-2 bg-white rounded" width="215px" height="210px" src="../assets/img/<?= @$_SESSION['image'] ?>">
                <h4 class="card-title"><?= @$_SESSION['nama_lengkap'] ?></h4>
                <h5 class="card-text">Lahir di <?= @$_SESSION['tempat_lahir']; ?>, pada tanggal <?= @$_SESSION['tanggal_lahir'] ?>. <br>
                    Bertugas sebagai <?= @$_SESSION['level'] ?>.</h5>
                <button class="btn btn-primary mt-4 editbtn">Setting Profile</button>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
</div>
<!----------------------------------- Modal edit --------------------------->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('models/Profile/Edit.php?act=submit'); ?>" class="form-horizontal" method="POST" id="form-save">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="control-label">Id</label>
                                <input class="form-control" type="text" name="id" value="<?= @$_SESSION['id'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Username</label>
                                <input class="form-control" type="text" name="username" value="<?= @$_SESSION['username'] ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="control-label">Nama Lengkap</label>
                                <input class="form-control" type="text" name="nama_lengkap" value="<?= @$_SESSION['nama_lengkap'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tempat Lahir</label>
                                <input class="form-control" type="text" name="tempat_lahir" value="<?= @$_SESSION['tempat_lahir'] ?>" />
                            </div>
                        </div>
                        <div class=" col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tanggal Lahir</label>
                                <input class="form-control" type="date" name="tanggal_lahir" value="<?= @$_SESSION['tanggal_lahir'] ?>" />
                            </div>
                        </div>
                    </div>
                    <div class=" form-group">
                        <label class="control-label">Alamat</label>
                        <input class="form-control" type="text" name="alamat" value="<?= @$_SESSION['alamat'] ?>" />
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile">
                        <label for="customFile" class="custom-file-label">Choose file</label>
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
<?php include_once('../footer.php'); ?>
<script type="text/javascript">
    // Modal Edit
    $(document).ready(function() {
        $('.editbtn').on('click', function() {
            $('#editModal').modal('show');
        });
    });

    // Tampil nama file upload
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>