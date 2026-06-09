<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];

$query = "
INSERT INTO transaksi 
(ID_USER, ID_AKUN, ID_KATEGORI, ID_SUB, TANGGAL, TIPE_TRANSAKSI, JUMLAH, KETERANGAN)
VALUES (
'$id_user',
'{$_POST['id_akun']}',
'{$_POST['id_kategori']}',
" . (!empty($_POST['id_sub']) ? "'".$_POST['id_sub']."'" : "NULL") . ",
'{$_POST['tanggal']}',
'{$_POST['tipe']}',
'{$_POST['jumlah']}',
'{$_POST['keterangan']}'
)";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("ERROR INSERT TRANSAKSI: " . mysqli_error($conn));
}

$id_transaksi = mysqli_insert_id($conn);

if (!empty($_POST['tag'])) {
    foreach ($_POST['tag'] as $id_tag) {
        mysqli_query($conn, "
        INSERT INTO diberi_transaksi_tag (ID_TAG, ID_TRANSAKSI)
        VALUES ('$id_tag', '$id_transaksi')
        ");
    }
}

header("Location: index.php");
