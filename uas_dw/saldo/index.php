<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}
include "../config/koneksi.php";
$id_user = $_SESSION['id_user'];

$data = mysqli_query($conn, "
    SELECT * FROM akun
    WHERE ID_USER = '$id_user'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Saldo Akun</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #fff;
    color: #000;
}
.container {
    width: 600px;
    margin: 80px auto;
}
h3 {
    border-bottom: 2px solid #000;
    padding-bottom: 5px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}
th, td {
    border: 1px solid #000;
    padding: 8px;
    text-align: center;
}
a {
    color: #000;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
</style>
</head>

<body>
<div class="container">
<h3>Saldo Akun</h3>

<table>
<tr>
    <th>Nama Akun</th>
    <th>Tipe Akun</th>
    <th>Saldo Awal</th>
    <th>Saldo Sekarang</th>
</tr>

<?php while ($a = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= $a['NAMA_AKUN'] ?></td>
    <td><?= $a['TIPE_AKUN'] ?></td>
    <td><?= number_format($a['SALDO_AWAL']) ?></td>
    <td><b><?= number_format($a['SALDO_SEKARANG']) ?></b></td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="../index.php">← Kembali</a>
</div>
</body>
</html>
