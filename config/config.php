<?php
session_start();

$con = new mysqli('localhost', 'root', '', 'tugas_akhir');
if ($con->connect_error) {
    die("Could not connect to the database!" . $con->connect_error);
}

// membuat function  base_url
function base_url($url = null)
{
    $base_url = "http://localhost/Tugas_Akhir";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}
