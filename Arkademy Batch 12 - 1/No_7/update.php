<?php
include 'koneksi.php';
if ($_POST['id']) {
    $id             = $_POST['id'];
    $nama           = $_POST['nama'];
    $pekerjaan      = $_POST['pekerjaan'];
    $gaji           = $_POST['gaji'];
    $query = "UPDATE nama SET nama.name = '$nama', nama.id_work = '$pekerjaan', nama.id_salary = '$gaji' WHERE nama.id = '$id'";
    if (mysqli_query($conn, $query)) {
        header("location:index.php");
    } else {
        echo "Gagal";
    }
} else {
    header("location:index.php");
}