<?php
include "../config/koneksi.php";

$id = $_POST['id_transaksi'];

mysqli_query($conn, "
UPDATE transaksi SET
    ID_AKUN = '{$_POST['id_akun']}',
    ID_KATEGORI = '{$_POST['id_kategori']}',
    ID_SUB = " . ($_POST['id_sub'] ? "'".$_POST['id_sub']."'" : "NULL") . ",
    TANGGAL = '{$_POST['tanggal']}',
    TIPE_TRANSAKSI = '{$_POST['tipe']}',
    JUMLAH = '{$_POST['jumlah']}',
    KETERANGAN = '{$_POST['keterangan']}'
WHERE ID_TRANSAKSI = '$id'
");

/* reset tag */
mysqli_query($conn, "
DELETE FROM diberi_transaksi_tag WHERE ID_TRANSAKSI='$id'
");

if (!empty($_POST['tag'])) {
    foreach ($_POST['tag'] as $id_tag) {
        mysqli_query($conn, "
        INSERT INTO diberi_transaksi_tag VALUES ('$id_tag', '$id')
        ");
    }
}

header("Location: index.php");
