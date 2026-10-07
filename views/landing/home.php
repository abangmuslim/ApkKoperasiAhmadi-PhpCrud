<?php
/*
|--------------------------------------------------------------------------
| DATA HOMEPAGE
|--------------------------------------------------------------------------
|
| koneksi.php dan helper.php sudah dipanggil melalui index.php
|
*/
/*
|--------------------------------------------------------------------------
| STATISTIK
|--------------------------------------------------------------------------
*/
// Total barang
$totalBarang = totalData($koneksi, 'barang');
// Total pelanggan
$totalPelanggan = totalData($koneksi, 'pelanggan');
// Total kategori
$totalKategori = totalData($koneksi, 'kategori');
/*
|--------------------------------------------------------------------------
| KATEGORI UNGGULAN
|--------------------------------------------------------------------------
|
| Mengambil maksimal 4 kategori dari database.
|
*/
$queryKategori = mysqli_query(
    $koneksi,
    "SELECT *
     FROM kategori
     ORDER BY idkategori DESC
     LIMIT 4"
);
/*
|--------------------------------------------------------------------------
| PRODUK TERBARU
|--------------------------------------------------------------------------
|
| Mengambil 4 barang terbaru berdasarkan idbarang.
|
*/
$queryBarang = mysqli_query(
    $koneksi,
    "SELECT
        barang.*,
        kategori.namakategori
     FROM barang
     LEFT JOIN kategori
        ON barang.idkategori = kategori.idkategori
     ORDER BY barang.idbarang DESC
     LIMIT 4"
);
?>
<!-- =====================================================
     HERO SECTION
===================================================== -->
<section
    class="text-center text-white"
    style="
        height: 60vh;
        background: url('assets/images/slider/hero.jpg') center center/cover no-repeat;
        position: relative;
    ">
    <div
        style="
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,.55);
        ">
    </div>
    <div
        class="d-flex flex-column justify-content-center align-items-center h-100 px-3"
        style="position: relative;">
        <h1 class="display-4 font-weight-bold">
            Selamat Datang di<br>
            Koperasi Ahmadi
        </h1>
        <p class="lead">
            Solusi kebutuhan barang koperasi yang mudah,
            cepat, dan terpercaya.
        </p>
        <a
            href="index.php?halaman=daftarbarang"
            class="btn btn-primary btn-lg mt-2">
            <i class="fas fa-shopping-basket mr-2"></i>
            Lihat Produk
        </a>
    </div>
</section>
<!-- =====================================================
     TENTANG SINGKAT
===================================================== -->
<section class="content">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h2>Tentang Koperasi</h2>
                <p class="lead">
                    Koperasi Ahmadi menyediakan berbagai
                    kebutuhan anggota dan masyarakat dengan
                    harga terjangkau serta pelayanan yang
                    profesional.
                </p>
            </div>
        </div>
    </div>
</section>
<!-- =====================================================
     STATISTIK
===================================================== -->
<section class="content">
    <div class="container">
        <div class="row">
            <!-- TOTAL BARANG -->
            <div class="col-md-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>
                            <?= angka($totalBarang); ?>
                        </h3>
                        <p>Produk</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="index.php?halaman=daftarbarang"
                       class="small-box-footer">
                        Lihat Produk
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- TOTAL PELANGGAN -->
            <div class="col-md-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            <?= angka($totalPelanggan); ?>
                        </h3>
                        <p>Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="index.php?halaman=registerpelanggan"
                       class="small-box-footer">
                        Daftar Sekarang
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- TOTAL KATEGORI -->
            <div class="col-md-4">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= angka($totalKategori); ?>
                        </h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="index.php?halaman=daftarkategori"
                       class="small-box-footer">
                        Lihat Kategori
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =====================================================
     KATEGORI UNGGULAN
===================================================== -->
<section class="content">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Kategori Unggulan</h2>
            <p class="text-muted">
                Pilihan kategori produk di Koperasi Ahmadi.
            </p>
        </div>
        <div class="row">
            <?php if (mysqli_num_rows($queryKategori) > 0): ?>
                <?php while ($kategori = mysqli_fetch_assoc($queryKategori)): ?>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <i class="fas fa-tags fa-3x mb-3"></i>
                                <h5>
                                    <?= htmlspecialchars(
                                        $kategori['namakategori']
                                    ); ?>
                                </h5>
                                <a href="index.php?halaman=detilkategori&idkategori=<?= $kategori['idkategori']; ?>"
                                   class="btn btn-outline-primary btn-sm mt-2">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        Belum ada kategori tersedia.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- =====================================================
     PRODUK TERBARU
===================================================== -->
<section class="content">
    <div class="container">
        <div class="text-center mb-4">
            <h2>Produk Terbaru</h2>
            <p class="text-muted">
                Produk terbaru yang tersedia di koperasi.
            </p>
        </div>
        <div class="row">
            <?php if (mysqli_num_rows($queryBarang) > 0): ?>
                <?php while ($barang = mysqli_fetch_assoc($queryBarang)): ?>
                    <div class="col-md-3">
                        <div class="card h-100">
                            <?php
                            $foto = !empty($barang['foto'])
                                ? $barang['foto']
                                : 'default.png';
                            $pathFoto =
                                'assets/images/barang/' . $foto;
                            ?>
                            <img src="<?= $pathFoto; ?>"
                                 class="card-img-top"
                                 alt="<?= htmlspecialchars(
                                     $barang['namabarang']
                                 ); ?>"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= htmlspecialchars(
                                        $barang['namabarang']
                                    ); ?>
                                </h5>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-tag mr-1"></i>
                                    <?= htmlspecialchars(
                                        $barang['namakategori']
                                        ?? '-'
                                    ); ?>
                                </p>
                                <h5 class="text-primary">
                                    <?= rupiah($barang['harga']); ?>
                                </h5>
                                <p class="mb-3">
                                    Stok:
                                    <strong>
                                        <?= angka($barang['stok']); ?>
                                    </strong>
                                </p>
                                <a href="index.php?halaman=detilbarang&idbarang=<?= $barang['idbarang']; ?>"
                                   class="btn btn-primary btn-block">
                                    <i class="fas fa-eye mr-1"></i>
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="alert alert-info text-center">
                        Belum ada produk tersedia.
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- TOMBOL SEMUA PRODUK -->
        <div class="text-center mt-4">
            <a href="index.php?halaman=daftarbarang"
               class="btn btn-outline-primary">
                Lihat Semua Produk
                <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</section>
<!-- =====================================================
     CTA
===================================================== -->
<section class="content">
    <div class="container">
        <div class="card bg-primary">
            <div class="card-body text-center text-white">
                <h3>
                    Bergabung Menjadi Pelanggan
                </h3>
                <p>
                    Daftar sekarang untuk menikmati
                    kemudahan transaksi dan informasi produk.
                </p>
                <a href="index.php?halaman=registerpelanggan"
                   class="btn btn-light">
                    <i class="fas fa-user-plus mr-1"></i>
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</section>
