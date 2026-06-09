<?php
include "../config/koneksi.php";

mysqli_query($conn, "DELETE FROM transaksi WHERE ID_TRANSAKSI='{$_GET['id']}'");

header("Location: index.php");
