<?php
require_once "config/config.php";
if (@$_SESSION['Operator'] || @$_SESSION['Pendamping1'] || @$_SESSION['Pendamping2'] || @$_SESSION['Pendamping3']) {
    echo "<script>window.location='" . base_url('views/beranda.php') . "';</script>";
} else {
    echo "<script>window.location='" . base_url('views/login.php') . "';</script>";
}
