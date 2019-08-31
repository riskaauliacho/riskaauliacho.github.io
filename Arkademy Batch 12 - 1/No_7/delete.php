<?php
include 'koneksi.php';
$id = $_GET['id'];
$query = "DELETE FROM nama WHERE nama.id = '$id'";
if (mysqli_query($conn, $query)) {
    header("location:index.php");
} else {
    echo "Gagal";
}