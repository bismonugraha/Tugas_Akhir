<?php include_once('../header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary mb-2">DATA REKOMENDASI PENERIMA BANTUAN PKH</h6>
                <a href="#" class="btn btn-md btn-danger float-right" data-toggle="modal" data-target="#exportModal"><i class="fas fa-file-export"></i> FILTER DATA</a>
                <a href="<?= base_url('models/Ranking/Export_Excel.php'); ?>" class="btn btn-md btn-success float-right mr-2"><i class="fas fa-file-export"></i> EXPORT EXCEL</a>
            </div>
            <div class=" card-body">
                <div class="table-responsive">
                    <?php
                    $query = "SELECT tbl_alternatif.nama_pengurus, tbl_alternatif.alamat, 
                    tbl_proses_memcdm.agregasi_pakar, tbl_skalanilai.tingkat FROM tbl_proses_memcdm
                    INNER JOIN tbl_alternatif ON tbl_proses_memcdm.alternatif= tbl_alternatif.id_alternatif
                    INNER JOIN tbl_skalanilai ON tbl_proses_memcdm.agregasi_pakar= tbl_skalanilai.id ORDER BY agregasi_pakar DESC";
                    $query_run = mysqli_query($con, $query);
                    $no = 1;
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center'>No</th>
                                <th style='text-align:center'>Nama Pengurus</th>
                                <th style='text-align:center'>Alamat</th>
                                <th style='text-align:center'>Agregasi Pakar</th>
                                <th style='text-align:center'>Tingkat Kepentingan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_run) {
                                foreach ($query_run as $data) {
                            ?>
                                    <tr class="text-center">
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['nama_pengurus']; ?></td>
                                        <td><?= $data['alamat']; ?></td>
                                        <td><?= $data['agregasi_pakar']; ?></td>
                                        <td><?= $data['tingkat']; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------------------------------- Modal Print ------------------------->
<div class="modal fade" id="exportModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Print Filter</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="<?= base_url('models/Ranking/Export_pdf.php?act=submit'); ?>" method="POST">
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
                    <button type="submit" name="submit" class="btn btn-success">Print</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include_once('../footer.php'); ?>