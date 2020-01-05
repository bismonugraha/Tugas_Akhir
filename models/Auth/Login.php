<?php
require_once '../../config/config.php';

$user = mysqli_escape_string($con, $_POST['username']);
$pass = mysqli_escape_string($con, MD5($_POST['password']));
$login = @$_POST['submit'];
$vercode = @$_POST['vercode'];

if ($login) {
    if ($vercode != $_SESSION["vercode"]) {
        $_SESSION['message'] = 'Validasi salah!';
        $_SESSION['msg_type'] = "danger";
        echo "<script>window.location='" . base_url('') . "';</script>";
    } else {
        $sql = mysqli_query($con, "SELECT * FROM tbl_user WHERE username = '$user' and password = '$pass'") or die(mysql_error());
        $data = mysqli_fetch_array($sql);
        $cek = mysqli_num_rows($sql);
        if ($cek > 0) {
            if ($data['level'] == "Operator") {
                @$_SESSION['Operator'] = $data['id'];
                @$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                @$_SESSION['username'] = $data['username'];
                @$_SESSION['tempat_lahir'] = $data['tempat_lahir'];
                @$_SESSION['tanggal_lahir'] = $data['tanggal_lahir'];
                @$_SESSION['alamat'] = $data['alamat'];
                @$_SESSION['level'] = $data['level'];
                @$_SESSION['id'] = $data['id'];
                @$_SESSION['image'] = $data['image'];
                echo "<script>window.location='" . base_url('') . "';</script>";
            } elseif ($data['level'] == "Pendamping1") {
                @$_SESSION['Pendamping1'] = $data['id'];
                @$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                @$_SESSION['username'] = $data['username'];
                @$_SESSION['tempat_lahir'] = $data['tempat_lahir'];
                @$_SESSION['tanggal_lahir'] = $data['tanggal_lahir'];
                @$_SESSION['alamat'] = $data['alamat'];
                @$_SESSION['level'] = $data['level'];
                @$_SESSION['id'] = $data['id'];
                @$_SESSION['image'] = $data['image'];
                echo "<script>window.location='" . base_url('') . "';</script>";
            } elseif ($data['level'] == "Pendamping2") {
                @$_SESSION['Pendamping2'] = $data['id'];
                @$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                @$_SESSION['username'] = $data['username'];
                @$_SESSION['tempat_lahir'] = $data['tempat_lahir'];
                @$_SESSION['tanggal_lahir'] = $data['tanggal_lahir'];
                @$_SESSION['alamat'] = $data['alamat'];
                @$_SESSION['level'] = $data['level'];
                @$_SESSION['id'] = $data['id'];
                @$_SESSION['image'] = $data['image'];
                echo "<script>window.location='" . base_url('') . "';</script>";
            } elseif ($data['level'] == "Pendamping3") {
                @$_SESSION['Pendamping3'] = $data['id'];
                @$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
                @$_SESSION['username'] = $data['username'];
                @$_SESSION['tempat_lahir'] = $data['tempat_lahir'];
                @$_SESSION['tanggal_lahir'] = $data['tanggal_lahir'];
                @$_SESSION['alamat'] = $data['alamat'];
                @$_SESSION['level'] = $data['level'];
                @$_SESSION['id'] = $data['id'];
                @$_SESSION['image'] = $data['image'];
                echo "<script>window.location='" . base_url('') . "';</script>";
            }
        } else {
            $_SESSION['message'] = 'Username atau Password salah!';
            $_SESSION['msg_type'] = "danger";
            echo "<script>window.location='" . base_url('') . "';</script>";
        }
    }
}
