<?php
$isLoginUser = isset($_SESSION['loginuser']) || isset($_SESSION['login']);
$isLoginPelanggan = isset($_SESSION['loginpelanggan']);

$halaman = $_GET['halaman'] ?? 'home';
?>

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <h1 class="font-weight-bold">
                Daftar Isi
            </h1>
            <p class="text-muted mb-0">
                Peta navigasi dan struktur layanan Koperasi Ahmadi.
            </p>
        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <pre class="mb-0" style="font-family:monospace; font-size:15px; line-height:1.8; white-space:pre-wrap;"><strong>KOPERASI AHMADI</strong>
├── <strong>PUBLIC</strong>
│   ├── <a href="index.php?halaman=home">Home</a>
│   ├── <a href="index.php?halaman=daftarbarang">Daftar Barang</a>
│   │   └── <a href="index.php?halaman=detilbarang&id=1">Detail Barang</a>
│   ├── <a href="index.php?halaman=daftarkategori">Kategori</a>
│   │   └── <a href="index.php?halaman=detilkategori&id=1">Detail Kategori</a>
│   ├── <a href="index.php?halaman=tentang">Tentang</a>
│   ├── <a href="index.php?halaman=kontak">Kontak</a>
│   └── <a href="index.php?halaman=daftarisi">Daftar Isi</a>
<?php if ($isLoginPelanggan): ?>
│
├── <strong>PELANGGAN</strong>
│   ├── Dashboard Pelanggan
│   ├── Profil
│   └── Riwayat Penjualan
<?php else: ?>
│
├── <strong>PELANGGAN</strong>
│   ├── <a href="index.php?halaman=loginpelanggan">Login Pelanggan</a>
│   └── <a href="index.php?halaman=registerpelanggan">Registrasi Pelanggan</a>
<?php endif; ?>
<?php if ($isLoginUser): ?>
│
└── <strong>USER</strong>
    ├── Dashboard
    ├── User
    ├── Pelanggan
    ├── Suplier
    ├── Kategori
    ├── Merk
    ├── Barang
    ├── Penjualan
    └── Laporan
<?php else: ?>
│
└── <strong>USER</strong>
    └── <a href="index.php?halaman=loginuser">Login User</a>
<?php endif; ?></pre>

            </div>

        </div>

        <div class="text-center mt-4">

            <a
                href="index.php?halaman=home"
                class="btn btn-primary">

                <i class="fas fa-home mr-1"></i>
                Kembali ke Home

            </a>

        </div>

    </div>

</section>