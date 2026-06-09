<?php
session_start();
include "../config/koneksi.php";

$nama = $_POST['nama'];
$pass = $_POST['password'];

$q = mysqli_query($conn, "
    SELECT * FROM user 
    WHERE NAMA_USER='$nama' 
    AND PASSWORD='$pass'
");

$data = mysqli_fetch_assoc($q);
$cek = mysqli_num_rows($q);

if ($cek > 0) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $data['ID_USER'];
    $_SESSION['nama_user'] = $data['NAMA_USER'];

    header("Location: ../index.php");
} else {
    echo "Login gagal. <a href='login.php'>Coba lagi</a>";
}
