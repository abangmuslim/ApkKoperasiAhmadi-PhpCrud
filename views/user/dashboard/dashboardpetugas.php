<?php

$totalBarang     = totalData($koneksi, 'barang');
$totalPelanggan  = totalData($koneksi, 'pelanggan');
$totalKategori   = totalData($koneksi, 'kategori');
$totalPenjualan  = totalData($koneksi, 'penjualan');

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard Petugas</h1>
            </div>
            <div class="col-sm-6 text-right">
                <small class="text-muted">
                    <?= tanggalIndonesia(date('Y-m-d')); ?>
                </small>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        <div class="card bg-gradient-success">
            <div class="card-body">
                <h3>
                    Selamat Datang,
                    <?= $_SESSION['namauser']; ?>
                </h3>
                <p class="mb-0">
                    Kelola transaksi dan pelayanan pelanggan koperasi sekolah dengan mudah dan cepat.
                </p>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?= angka($totalBarang); ?></h3>
                        <p>Barang</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <a href="index.php?halaman=barang" class="small-box-footer">
                        Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= angka($totalPelanggan); ?></h3>
                        <p>Pelanggan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <a href="index.php?halaman=pelanggan" class="small-box-footer">
                        Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?= angka($totalKategori); ?></h3>
                        <p>Kategori</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="index.php?halaman=kategori" class="small-box-footer">
                        Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?= angka($totalPenjualan); ?></h3>
                        <p>Transaksi</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="index.php?halaman=penjualan" class="small-box-footer">
                        Detail <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-8">

                <div class="card card-success">

                    <div class="card-header">
                        <h3 class="card-title">
                            Aktivitas Petugas
                        </h3>
                    </div>

                    <div class="card-body">

                        <div class="row text-center">

                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=barang" class="btn btn-app">
                                    <i class="fas fa-box"></i>
                                    Barang
                                </a>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=pelanggan" class="btn btn-app">
                                    <i class="fas fa-user-friends"></i>
                                    Pelanggan
                                </a>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=suplier" class="btn btn-app">
                                    <i class="fas fa-truck"></i>
                                    Suplier
                                </a>
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <a href="index.php?halaman=penjualan" class="btn btn-app">
                                    <i class="fas fa-cash-register"></i>
                                    Penjualan
                                </a>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4">

                <div class="card card-outline card-success">

                    <div class="card-header">
                        <h3 class="card-title">
                            Informasi Akun
                        </h3>
                    </div>

                    <div class="card-body text-center">

                        <img
                            src="assets/images/user/<?=
                            $_SESSION['foto'] ?? 'default.png';
                            ?>"
                            class="img-circle elevation-2 mb-3"
                            width="100">

                        <h5>
                            <?= $_SESSION['namauser']; ?>
                        </h5>

                        <span class="badge badge-success">
                            <?= strtoupper($_SESSION['role']); ?>
                        </span>

                        <hr>

                        <a href="index.php?halaman=logout"
                           class="btn btn-danger btn-block">
                            Logout
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>