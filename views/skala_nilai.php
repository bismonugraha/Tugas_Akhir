<?php include_once('../header.php'); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary mb-2">DATA SKALA PENILAIAN</h6>
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
                            $sql = "SELECT * FROM tbl_skalanilai where tingkat LIKE '%$pencarian%'";
                            $query = $sql;
                            $queryJml = $sql;
                        } else {
                            $query = "SELECT * FROM tbl_skalanilai LIMIT $posisi, $batas";
                            $queryJml = "SELECT * FROM tbl_skalanilai";
                            $no = $posisi + 1;
                        }
                    } else {
                        $query = "SELECT * FROM tbl_skalanilai LIMIT $posisi, $batas";
                        $queryJml = "SELECT * FROM tbl_skalanilai";
                        $no = $posisi + 1;
                    }
                    $query_run = mysqli_query($con, $query);
                    ?>
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style='text-align:center'>No</th>
                                <th style='text-align:center'>Skala</th>
                                <th style='text-align:center'>Tingkat</th>
                                <th style='text-align:center'>Bobot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($query_run) {
                                foreach ($query_run as $data) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $data['id']; ?></td>
                                        <td><?= $data['skala']; ?></td>
                                        <td><?= $data['tingkat']; ?></td>
                                        <td><?= $data['bobot']; ?></td>
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