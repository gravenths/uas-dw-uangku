<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];

$akun = mysqli_query($conn, "
    SELECT * FROM akun 
    WHERE ID_USER = '$id_user'
");

$tag = mysqli_query($conn, "SELECT * FROM tag");

?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Transaksi</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background: #fff;
        color: #000;
        line-height: 1.4;
    }
    .container {
        width: 600px;
        margin: 40px auto;
        border: 2px solid #000;
        padding: 25px;
    }
    h3 {
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-top: 12px;
        font-weight: bold;
    }
    input[type="text"], 
    input[type="number"], 
    input[type="date"], 
    select {
        width: 100%;
        padding: 8px;
        margin-top: 4px;
        border: 1px solid #000;
        box-sizing: border-box;
    }
    .tag-box {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 8px;
        border: 1px solid #000;
        padding: 12px;
        margin-top: 5px;
        max-height: 150px;
        overflow-y: auto;
    }
    .tag-item {
        display: flex !important;
        align-items: center;
        margin-top: 0 !important;
        font-weight: normal;
        cursor: pointer;
    }
    .tag-item input[type="checkbox"] {
        width: auto;
        margin-right: 8px;
        cursor: pointer;
    }
    button {
        margin-top: 20px;
        padding: 10px 20px;
        background: #000;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    a {
        color: #000;
        text-decoration: none;
        margin-left: 10px;
    }
</style>
</head>

<body>
<div class="container">

<h3>Tambah Transaksi</h3>

<form method="post" action="simpan.php">



<label>Akun</label>
<select name="id_akun">
<?php while ($a = mysqli_fetch_assoc($akun)) : ?>
<option value="<?= $a['ID_AKUN'] ?>"><?= $a['NAMA_AKUN'] ?></option>
<?php endwhile; ?>
</select>

<label>Tipe Transaksi</label>
<select name="tipe" id="tipe" onchange="updateKategori()" required>
    <option value="">-- Pilih Tipe --</option>
    <option value="Pemasukan">Pemasukan</option>
    <option value="Pengeluaran">Pengeluaran</option>
</select>

<label>Kategori</label>
<select name="id_kategori" id="kategori" onchange="updateSub()" required>
    <option value="">-- Pilih Kategori --</option>
</select>

<label>Sub Kategori</label>
<select name="id_sub" id="sub">
    <option value="">-- Pilih Sub Kategori --</option>
</select>

<label>Tanggal</label>
<input type="date" name="tanggal" required>

<label>Jumlah</label>
<input type="number" name="jumlah" min="0" required>

<label>Keterangan</label>
<input type="text" name="keterangan">

<label>Tag</label>
<div class="tag-box">
<?php while ($t = mysqli_fetch_assoc($tag)) : ?>
<label class="tag-item">
    <input type="checkbox" name="tag[]" value="<?= $t['ID_TAG'] ?>">
    <?= htmlspecialchars($t['NAMA_TAG']) ?>
</label>
<?php endwhile; ?>
</div>

<button type="submit">Simpan</button>
<a href="index.php">Batal</a>

</form>
</div>

<?php
$kategori = mysqli_query($conn, "SELECT * FROM kategori");
$sub      = mysqli_query($conn, "SELECT * FROM sub_kategori");

$kategoriArr = [];
while ($k = mysqli_fetch_assoc($kategori)) $kategoriArr[] = $k;

$subArr = [];
while ($s = mysqli_fetch_assoc($sub)) $subArr[] = $s;
?>

<script>
const kategoriData = <?= json_encode($kategoriArr) ?>;
const subData = <?= json_encode($subArr) ?>;

function updateKategori() {
    const tipe = document.getElementById("tipe").value;
    const kategori = document.getElementById("kategori");
    kategori.innerHTML = "<option value=''>-- Pilih Kategori --</option>";

    kategoriData.forEach(k => {
        if (k.TIPE_TRANSAKSI === tipe) {
            let opt = document.createElement("option");
            opt.value = k.ID_KATEGORI;
            opt.text = k.NAMA_KATEGORI;
            kategori.appendChild(opt);
        }
    });

    document.getElementById("sub").innerHTML =
        "<option value=''>-- Pilih Sub Kategori --</option>";
}

function updateSub() {
    const idKategori = document.getElementById("kategori").value;
    const sub = document.getElementById("sub");
    sub.innerHTML = "<option value=''>-- Pilih Sub Kategori --</option>";

    subData.forEach(s => {
        if (s.ID_KATEGORI == idKategori) {
            let opt = document.createElement("option");
            opt.value = s.ID_SUB;
            opt.text = s.NAMA_SUB;
            sub.appendChild(opt);
        }
    });
}
</script>

</body>
</html>