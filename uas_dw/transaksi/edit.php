<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

$id = mysqli_real_escape_string($conn, $_GET['id']);

$q = mysqli_query($conn, "SELECT * FROM transaksi WHERE ID_TRANSAKSI='$id'");
$data = mysqli_fetch_assoc($q);

$id_user = $_SESSION['id_user'];

$akun = mysqli_query($conn, "
    SELECT * FROM akun 
    WHERE ID_USER = '$id_user'
");

$tag  = mysqli_query($conn, "SELECT * FROM tag");

$tag_pilih = [];
$tq = mysqli_query($conn, "SELECT ID_TAG FROM diberi_transaksi_tag WHERE ID_TRANSAKSI='$id'");
while ($r = mysqli_fetch_assoc($tq)) {
    $tag_pilih[] = $r['ID_TAG'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #000;
            line-height: 1.4;
        }
        .container {
            width: 500px; /* Ukuran sedikit diperlebar agar grid tag lebih lega */
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
        /* Selektor spesifik agar checkbox tidak kena width 100% */
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
        /* Penataan Grid untuk Tag */
        .tag-box {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
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
            padding: 10px;
            width: 100%;
            background: #000;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background: #333;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #000;
            text-decoration: none;
            font-size: 0.9em;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h3>Edit Transaksi</h3>

    <form method="post" action="update.php">
        <input type="hidden" name="id_transaksi" value="<?= $data['ID_TRANSAKSI'] ?>">

        <label>User ID</label>
        <input type="number" value="<?= $data['ID_USER'] ?>" readonly style="background: #eee;">

        <label>Akun</label>
        <select name="id_akun" required>
            <?php while ($a = mysqli_fetch_assoc($akun)) : ?>
                <option value="<?= $a['ID_AKUN'] ?>" <?= $a['ID_AKUN'] == $data['ID_AKUN'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['NAMA_AKUN']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Tipe Transaksi</label>
        <select name="tipe" id="tipe" onchange="updateKategori()" required>
            <option value="Pemasukan" <?= $data['TIPE_TRANSAKSI'] == 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
            <option value="Pengeluaran" <?= $data['TIPE_TRANSAKSI'] == 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
        </select>

        <label>Kategori</label>
        <select name="id_kategori" id="kategori" onchange="updateSub()" required></select>

        <label>Sub Kategori</label>
        <select name="id_sub" id="sub"></select>

        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?= $data['TANGGAL'] ?>" required>

        <label>Jumlah</label>
        <input type="number" name="jumlah" min="0" value="<?= $data['JUMLAH'] ?>" required>

        <label>Keterangan</label>
        <input type="text" name="keterangan" value="<?= htmlspecialchars($data['KETERANGAN']) ?>">

        <label>Tag</label>
        <div class="tag-box">
            <?php while ($t = mysqli_fetch_assoc($tag)) : ?>
                <label class="tag-item">
                    <input type="checkbox" name="tag[]" value="<?= $t['ID_TAG'] ?>" <?= in_array($t['ID_TAG'], $tag_pilih) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($t['NAMA_TAG']) ?>
                </label>
            <?php endwhile; ?>
        </div>

        <button type="submit">Update Transaksi</button>
        <a href="index.php">Batal & Kembali</a>
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
const currentKategori = "<?= $data['ID_KATEGORI'] ?>";
const currentSub = "<?= $data['ID_SUB'] ?>";

function updateKategori() {
    const tipe = document.getElementById("tipe").value;
    const kategori = document.getElementById("kategori");
    kategori.innerHTML = "";

    kategoriData.forEach(k => {
        if (k.TIPE_TRANSAKSI === tipe) {
            let opt = document.createElement("option");
            opt.value = k.ID_KATEGORI;
            opt.text = k.NAMA_KATEGORI;
            if (k.ID_KATEGORI == currentKategori) opt.selected = true;
            kategori.appendChild(opt);
        }
    });

    updateSub();
}

function updateSub() {
    const idKategori = document.getElementById("kategori").value;
    const sub = document.getElementById("sub");
    sub.innerHTML = "<option value=''>-</option>";

    subData.forEach(s => {
        if (s.ID_KATEGORI == idKategori) {
            let opt = document.createElement("option");
            opt.value = s.ID_SUB;
            opt.text = s.NAMA_SUB;
            if (s.ID_SUB == currentSub) opt.selected = true;
            sub.appendChild(opt);
        }
    });
}

// Inisialisasi awal saat halaman dimuat
updateKategori();
</script>

</body>
</html>