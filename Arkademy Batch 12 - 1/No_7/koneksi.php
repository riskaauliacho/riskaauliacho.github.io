<?php
$database = 'arkademy_pekerjaan'; //nama database
$user = 'root'; //nama user db
$pass = ''; //pass db
$host = 'localhost'; //host db, sesuaikan dengan settingan di komputer masing2.
$conn = mysqli_connect($host, $user, $pass, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}