<?php
include 'koneksi.php';
if ($_POST['nama']) {
    $nama           = $_POST['nama'];
    $pekerjaan      = $_POST['pekerjaan'];
    $gaji           = $_POST['gaji'];
    $query = "INSERT INTO nama VALUES('', '$nama', $pekerjaan, $gaji)";
    if (mysqli_query($conn, $query)) {
        header("location:index.php");
    } else {
        echo "Gagal";
    }
}