<?php
$conn = mysqli_connect("localhost", "root", "", "uangku_bdl");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
