<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$id_user_login = $_SESSION['id_user'];

$data = mysqli_query($conn, "
    SELECT v.*, t.ID_USER
    FROM v_transaksi_lengkap v
    JOIN transaksi t ON v.ID_TRANSAKSI = t.ID_TRANSAKSI
    ORDER BY v.TANGGAL DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Transaksi</title>
<style>
body {
    font-family: Arial;
    background: #fff;
    color: #000;
}
.container {
    width: 95%;
    margin: 40px auto;
}
h3 {
    border-bottom: 2px solid #000;
    padding-bottom: 5px;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}
th, td {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
}
a {
    color: #000;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
.action a {
    margin: 0 5px;
}
</style>
</head>

<body>
<div class="container">
<h3>Data Transaksi</h3>

<a href="tambah.php">+ Tambah Transaksi</a>

<table>
<tr>
    <th>User</th>
    <th>Akun</th>
    <th>Kategori</th>
    <th>Sub</th>
    <th>Tanggal</th>
    <th>Tipe</th>
    <th>Jumlah</th>
    <th>Keterangan</th>
    <th>Aksi</th>
</tr>

<?php while ($d = mysqli_fetch_assoc($data)) : ?>
<tr>
    <td><?= htmlspecialchars($d['NAMA_USER']) ?></td>
    <td><?= htmlspecialchars($d['NAMA_AKUN']) ?></td>
    <td><?= htmlspecialchars($d['NAMA_KATEGORI']) ?></td>
    <td><?= $d['NAMA_SUB'] ?? '-' ?></td>
    <td><?= $d['TANGGAL'] ?></td>
    <td><?= $d['TIPE_TRANSAKSI'] ?></td>
    <td><?= number_format($d['JUMLAH']) ?></td>
    <td><?= htmlspecialchars($d['KETERANGAN']) ?></td>
    <td class="action">

        <?php if ($d['ID_USER'] == $id_user_login) : ?>
            <a href="edit.php?id=<?= $d['ID_TRANSAKSI'] ?>">Edit</a> |
            <a href="hapus.php?id=<?= $d['ID_TRANSAKSI'] ?>"
               onclick="return confirm('Hapus transaksi ini?')">Hapus</a>
        <?php else : ?>
            -
        <?php endif; ?>

    </td>
</tr>
<?php endwhile; ?>
</table>

<br>
<a href="../index.php">← Kembali</a>
</div>
</body>
</html>
