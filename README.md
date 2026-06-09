# UangKu - Aplikasi Web Pencatatan Keuangan Pribadi (CRUD)

**UangKu** adalah sebuah aplikasi manajemen dan pencatatan keuangan pribadi berbasis web yang dikembangkan menggunakan **PHP Native** dan **MySQL**. Proyek ini merupakan wujud integrasi dan kolaborasi dari tugas besar akhir semester (UAS) untuk dua mata kuliah:
1. **Desain Web:** Berfokus pada implementasi antarmuka pengguna (UI/UX) yang responsif, interaktif, dan fungsionalitas CRUD (*Create, Read, Update, Delete*) pada sisi klien.
2. **Basis Data Lanjut:** Berfokus pada arsitektur data, pemodelan data (*Conceptual, Logical, & Physical Data Model*), otomasi basis data via *Trigger*, pembuatan *View*, serta integritas data (transaksi dan *audit logging*).

---

## Laporan & Dokumentasi Proyek

Seluruh dokumentasi analisis, perancangan sistem, struktural basis data, dan implementasi antarmuka dapat diakses secara lengkap melalui tautan resmi Scribd berikut:

* **[Laporan UAS Desain Web (CRUD Keuangan Pribadi)](https://www.scribd.com/document/1011983364/Proyek-UAS-Desain-Web-APLIKASI-WEB-PENCATATAN-KEUANGAN-PRIBADI-UANGKU-BERBASIS-CRUD)**
* **[Laporan UAS Basis Data Lanjut (Arsitektur & Otomasi DBMS)](https://www.scribd.com/document/1011979701/Proyek-UAS-Basis-Data-Lanjut-APLIKASI-WEB-PENCATATAN-KEUANGAN-PRIBADI-UANGKU)**

---

## Fitur Utama

- **Autentikasi Pengguna & Proteksi Session:** Fitur login dan logout aman untuk memastikan isolasi data keuangan antar-pengguna terjamin.
- **Manajemen Akun/Dompet:** Pengelolaan multi-rekening atau dompet (misal: Tunai, Rekening Bank, E-Wallet) dengan saldo yang diperbarui secara otomatis.
- **Manajemen Transaksi CRUD Lengkap:** Pencatatan pemasukan dan pengeluaran keuangan harian secara detail.
- **Dropdown Dinamis & Pemilihan Multi-Tag:** Pengelompokan transaksi menggunakan kategori atau tag khusus secara fleksibel.
- **Otomatisasi Saldo (Database Triggers):** Mekanisme database `AFTER INSERT`, `BEFORE/AFTER DELETE`, dan `BEFORE UPDATE` untuk sinkronisasi saldo dompet secara *real-time* setiap kali transaksi dimodifikasi.
- **Audit Logging & Keamanan Data:** Pencatatan otomatis riwayat perubahan data pada level database guna memantau aktivitas manipulasi data untuk kebutuhan *auditing*.

---

## Teknologi yang Digunakan

- **Front-End:** HTML5, CSS3, JavaScript (Serta library pendukung tampilan visual)
- **Back-End:** PHP (Struktur Modular & Manajemen Session)
- **Database:** MySQL / MariaDB (Mengimplementasikan Relasi Tabel, *View*, *Trigger*, dan *Stored Procedures*)

---

## Arsitektur Basis Data (Database Architecture)

Aplikasi ini mengedepankan efisiensi pemrosesan data langsung di sisi DBMS dengan memanfaatkan:
- **Conceptual Data Model (CDM), Logical Data Model (LDM), & Physical Data Model (PDM)** terstruktur.
- **Database Triggers:** Menangani kalkulasi otomatis kolom `saldo_sekarang` pada tabel akun tanpa membebani logika aplikasi *back-end*.
- **MySQL Views:** Digunakan untuk mempercepat proses pembuatan query laporan transaksi gabungan yang kompleks.

---

## Langkah-langkah:

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/gravenths/uas-dw-uangku.git](https://github.com/gravenths/uas-dw-uangku.gi)
   cd uas-dw-uangku
