<?php
/*
|--------------------------------------------------------------------------
| DASHBOARD ADMIN
|--------------------------------------------------------------------------
| Zona    : User / Admin
| Layout  : AdminLTE
| Project : Aplikasi Koperasi Ahmadi
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| STATISTIK DATA MASTER
|--------------------------------------------------------------------------
*/

$totalUser = totalData($koneksi, 'user');
$totalPelanggan = totalData($koneksi, 'pelanggan');
$totalSuplier = totalData($koneksi, 'suplier');
$totalBarang = totalData($koneksi, 'barang');
$totalKategori = totalData($koneksi, 'kategori');
$totalMerk = totalData($koneksi, 'merk');


/*
|--------------------------------------------------------------------------
| TOTAL PENJUALAN / OMZET
|--------------------------------------------------------------------------
*/

$totalOmzet = totalPenjualan($koneksi);


/*
|--------------------------------------------------------------------------
| JUMLAH TRANSAKSI
|--------------------------------------------------------------------------
*/

$queryTotalTransaksi = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM penjualan"
);

$dataTotalTransaksi = mysqli_fetch_assoc(
    $queryTotalTransaksi
);

$totalTransaksi = $dataTotalTransaksi['total'] ?? 0;


/*
|--------------------------------------------------------------------------
| PENJUALAN TERBARU
|--------------------------------------------------------------------------
*/

$queryPenjualan = mysqli_query(
    $koneksi,
    "SELECT
        p.idpenjualan,
        p.idpelanggan,
        p.iduser,
        p.tanggalpenjualan,
        p.totalpenjualan,
        pl.namapelanggan,
        u.namauser
     FROM penjualan p

     LEFT JOIN pelanggan pl
        ON p.idpelanggan = pl.idpelanggan

     LEFT JOIN user u
        ON p.iduser = u.iduser

     ORDER BY p.idpenjualan DESC

     LIMIT 5"
);


/*
|--------------------------------------------------------------------------
| BARANG DENGAN STOK PALING SEDIKIT
|--------------------------------------------------------------------------
*/

$queryStok = mysqli_query(
    $koneksi,
    "SELECT
        idbarang,
        namabarang,
        stok
     FROM barang
     ORDER BY stok ASC
     LIMIT 5"
);


/*
|--------------------------------------------------------------------------
| PENJUALAN HARI INI
|--------------------------------------------------------------------------
*/

$queryHariIni = mysqli_query(
    $koneksi,
    "SELECT
        COUNT(*) AS transaksi,
        COALESCE(SUM(totalpenjualan), 0) AS omzet
     FROM penjualan
     WHERE tanggalpenjualan = CURDATE()"
);

$dataHariIni = mysqli_fetch_assoc(
    $queryHariIni
);

$transaksiHariIni = $dataHariIni['transaksi'] ?? 0;
$omzetHariIni = $dataHariIni['omzet'] ?? 0;


/*
|--------------------------------------------------------------------------
| PENJUALAN BULAN INI
|--------------------------------------------------------------------------
*/

$queryBulanIni = mysqli_query(
    $koneksi,
    "SELECT
        COUNT(*) AS transaksi,
        COALESCE(SUM(totalpenjualan), 0) AS omzet
     FROM penjualan
     WHERE MONTH(tanggalpenjualan) = MONTH(CURDATE())
     AND YEAR(tanggalpenjualan) = YEAR(CURDATE())"
);

$dataBulanIni = mysqli_fetch_assoc(
    $queryBulanIni
);

$transaksiBulanIni = $dataBulanIni['transaksi'] ?? 0;
$omzetBulanIni = $dataBulanIni['omzet'] ?? 0;


/*
|--------------------------------------------------------------------------
| PRODUK STOK HABIS
|--------------------------------------------------------------------------
*/

$queryStokHabis = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM barang
     WHERE stok <= 0"
);

$dataStokHabis = mysqli_fetch_assoc(
    $queryStokHabis
);

$totalStokHabis = $dataStokHabis['total'] ?? 0;


/*
|--------------------------------------------------------------------------
| BARANG STOK MENIPIS
|--------------------------------------------------------------------------
|
| Karena tabel barang tidak memiliki stokminimal,
| kita gunakan batas sederhana:
|
| stok <= 5 = perlu perhatian
|
*/

$queryStokMenipis = mysqli_query(
    $koneksi,
    "SELECT COUNT(*) AS total
     FROM barang
     WHERE stok > 0
     AND stok <= 5"
);

$dataStokMenipis = mysqli_fetch_assoc(
    $queryStokMenipis
);

$totalStokMenipis = $dataStokMenipis['total'] ?? 0;


/*
|--------------------------------------------------------------------------
| NAMA BULAN
|--------------------------------------------------------------------------
*/

$bulanSekarang = [
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember'
];

$namaBulan = $bulanSekarang[(int) date('n')];

?>


<!-- ==============================================================
     CONTENT HEADER
================================================================ -->

<div class="content-header">

    <div class="container-fluid">

        <div class="row mb-2 align-items-center">

            <div class="col-sm-8">

                <h1 class="m-0 font-weight-bold">

                    <i class="fas fa-tachometer-alt mr-2 text-danger"></i>

                    Dashboard Admin

                </h1>

                <p class="text-muted mb-0 mt-1">

                    Selamat datang kembali,

                    <strong>
                        <?= htmlspecialchars(
                            $_SESSION['namauser'] ?? 'Administrator'
                        ); ?>
                    </strong>

                    . Berikut ringkasan aktivitas
                    Koperasi Sekolah.

                </p>

            </div>


            <div class="col-sm-4">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="index.php?halaman=dashboardadmin">

                            <i class="fas fa-home"></i>

                        </a>

                    </li>

                    <li class="breadcrumb-item active">
                        Dashboard
                    </li>

                </ol>

            </div>

        </div>

    </div>

</div>



<!-- ==============================================================
     CONTENT
================================================================ -->

<div class="content">

    <div class="container-fluid">


        <!-- ==========================================================
             WELCOME BANNER
        =========================================================== -->

        <div class="card bg-danger shadow-sm mb-4">

            <div class="card-body">

                <div class="row align-items-center">

                    <div class="col-md-8">

                        <h3 class="font-weight-bold mb-2">

                            <i class="fas fa-store mr-2"></i>

                            Koperasi Ahmadi

                        </h3>

                        <p class="mb-3">

                            Pusat pengelolaan data dan aktivitas
                            Koperasi Sekolah.

                            Kelola barang, pelanggan, supplier,
                            transaksi dan laporan dalam satu sistem.

                        </p>

                        <a href="index.php?halaman=createpenjualan"
                           class="btn btn-light btn-sm mr-2">

                            <i class="fas fa-cash-register mr-1"></i>

                            Transaksi Baru

                        </a>

                        <a href="index.php?halaman=barang"
                           class="btn btn-outline-light btn-sm">

                            <i class="fas fa-boxes mr-1"></i>

                            Kelola Barang

                        </a>

                    </div>


                    <div class="col-md-4 text-center d-none d-md-block">

                        <i class="fas fa-store-alt"
                           style="
                           font-size:100px;
                           opacity:.18;
                           "></i>

                    </div>

                </div>

            </div>

        </div>



        <!-- ==========================================================
             STATISTIK MASTER
        =========================================================== -->

        <div class="row">


            <!-- USER -->

            <div class="col-lg-3 col-md-6">

                <div class="info-box shadow-sm">

                    <span class="info-box-icon bg-danger">

                        <i class="fas fa-user-shield"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            User Sistem
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalUser); ?>

                        </span>

                        <a href="index.php?halaman=user"
                           class="small text-muted">

                            Kelola User
                            <i class="fas fa-arrow-right ml-1"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- PELANGGAN -->

            <div class="col-lg-3 col-md-6">

                <div class="info-box shadow-sm">

                    <span class="info-box-icon bg-success">

                        <i class="fas fa-users"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Pelanggan
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalPelanggan); ?>

                        </span>

                        <a href="index.php?halaman=pelanggan"
                           class="small text-muted">

                            Kelola Pelanggan
                            <i class="fas fa-arrow-right ml-1"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- SUPPLIER -->

            <div class="col-lg-3 col-md-6">

                <div class="info-box shadow-sm">

                    <span class="info-box-icon bg-warning">

                        <i class="fas fa-truck"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Supplier
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalSuplier); ?>

                        </span>

                        <a href="index.php?halaman=suplier"
                           class="small text-muted">

                            Kelola Supplier
                            <i class="fas fa-arrow-right ml-1"></i>

                        </a>

                    </div>

                </div>

            </div>


            <!-- BARANG -->

            <div class="col-lg-3 col-md-6">

                <div class="info-box shadow-sm">

                    <span class="info-box-icon bg-info">

                        <i class="fas fa-boxes"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Barang
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalBarang); ?>

                        </span>

                        <a href="index.php?halaman=barang"
                           class="small text-muted">

                            Kelola Barang
                            <i class="fas fa-arrow-right ml-1"></i>

                        </a>

                    </div>

                </div>

            </div>

        </div>



        <!-- ==========================================================
             PENJUALAN HARI INI / BULAN INI / OMZET
        =========================================================== -->

        <div class="row">


            <!-- TRANSAKSI HARI INI -->

            <div class="col-lg-4 col-md-6">

                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3>
                            <?= angka($transaksiHariIni); ?>
                        </h3>

                        <p>
                            Transaksi Hari Ini
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-receipt"></i>

                    </div>

                    <span class="small-box-footer">

                        <?= date('d') . ' ' . $namaBulan . ' ' . date('Y'); ?>

                    </span>

                </div>

            </div>


            <!-- OMZET HARI INI -->

            <div class="col-lg-4 col-md-6">

                <div class="small-box bg-success">

                    <div class="inner">

                        <h3 style="font-size:25px;">

                            <?= rupiah($omzetHariIni); ?>

                        </h3>

                        <p>
                            Omzet Hari Ini
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-money-bill-wave"></i>

                    </div>

                    <span class="small-box-footer">

                        Penjualan hari ini

                    </span>

                </div>

            </div>


            <!-- OMZET BULAN -->

            <div class="col-lg-4 col-md-6">

                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3 style="font-size:25px;">

                            <?= rupiah($omzetBulanIni); ?>

                        </h3>

                        <p>
                            Omzet Bulan <?= $namaBulan; ?>
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-chart-line"></i>

                    </div>

                    <span class="small-box-footer">

                        <?= angka($transaksiBulanIni); ?>
                        transaksi bulan ini

                    </span>

                </div>

            </div>

        </div>



        <!-- ==========================================================
             PENJUALAN TERBARU
        =========================================================== -->

        <div class="row">


            <div class="col-lg-8">

                <div class="card card-outline card-danger shadow-sm">

                    <div class="card-header">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-receipt mr-2"></i>

                            Penjualan Terbaru

                        </h3>


                        <div class="card-tools">

                            <a href="index.php?halaman=penjualan"
                               class="btn btn-sm btn-outline-danger">

                                Lihat Semua

                                <i class="fas fa-arrow-right ml-1"></i>

                            </a>

                        </div>

                    </div>


                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover mb-0">

                                <thead class="thead-light">

                                    <tr>

                                        <th>
                                            #
                                        </th>

                                        <th>
                                            Pelanggan
                                        </th>

                                        <th>
                                            Petugas
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>

                                        <th class="text-right">
                                            Total
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>

                                <?php if (
                                    $queryPenjualan &&
                                    mysqli_num_rows($queryPenjualan) > 0
                                ): ?>

                                    <?php
                                    $no = 1;
                                    ?>

                                    <?php while (
                                        $penjualan =
                                        mysqli_fetch_assoc(
                                            $queryPenjualan
                                        )
                                    ): ?>

                                        <tr>

                                            <td>

                                                <span class="badge badge-light">
                                                    <?= $no++; ?>
                                                </span>

                                            </td>


                                            <td>

                                                <strong>

                                                    <?= htmlspecialchars(
                                                        $penjualan[
                                                            'namapelanggan'
                                                        ]
                                                        ??
                                                        'Umum'
                                                    ); ?>

                                                </strong>

                                            </td>


                                            <td>

                                                <small>

                                                    <i class="fas fa-user mr-1 text-muted"></i>

                                                    <?= htmlspecialchars(
                                                        $penjualan[
                                                            'namauser'
                                                        ]
                                                        ??
                                                        '-'
                                                    ); ?>

                                                </small>

                                            </td>


                                            <td>

                                                <small class="text-muted">

                                                    <?= tanggalIndonesia(
                                                        $penjualan[
                                                            'tanggalpenjualan'
                                                        ]
                                                    ); ?>

                                                </small>

                                            </td>


                                            <td class="text-right">

                                                <strong class="text-success">

                                                    <?= rupiah(
                                                        $penjualan[
                                                            'totalpenjualan'
                                                        ]
                                                    ); ?>

                                                </strong>

                                            </td>

                                        </tr>

                                    <?php endwhile; ?>

                                <?php else: ?>

                                    <tr>

                                        <td colspan="5"
                                            class="text-center text-muted py-4">

                                            <i class="fas fa-receipt fa-2x mb-2 d-block"></i>

                                            Belum ada transaksi penjualan.

                                        </td>

                                    </tr>

                                <?php endif; ?>

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>

            </div>



            <!-- ======================================================
                 STATUS STOK
            ======================================================= -->

            <div class="col-lg-4">

                <div class="card card-outline card-warning shadow-sm">

                    <div class="card-header">

                        <h3 class="card-title font-weight-bold">

                            <i class="fas fa-box-open mr-2"></i>

                            Status Stok

                        </h3>

                        <div class="card-tools">

                            <a href="index.php?halaman=barang"
                               class="btn btn-sm btn-outline-warning">

                                Barang

                            </a>

                        </div>

                    </div>


                    <div class="card-body">


                        <!-- STOK HABIS -->

                        <div class="d-flex align-items-center mb-3">

                            <div class="mr-3">

                                <span class="bg-danger text-white
                                             d-flex align-items-center
                                             justify-content-center
                                             rounded"
                                      style="
                                      width:45px;
                                      height:45px;
                                      ">

                                    <i class="fas fa-times"></i>

                                </span>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Stok Habis
                                </div>

                                <h4 class="mb-0 font-weight-bold">

                                    <?= angka($totalStokHabis); ?>

                                    <small class="text-muted">
                                        barang
                                    </small>

                                </h4>

                            </div>

                        </div>


                        <!-- STOK MENIPIS -->

                        <div class="d-flex align-items-center mb-3">

                            <div class="mr-3">

                                <span class="bg-warning text-white
                                             d-flex align-items-center
                                             justify-content-center
                                             rounded"
                                      style="
                                      width:45px;
                                      height:45px;
                                      ">

                                    <i class="fas fa-exclamation"></i>

                                </span>

                            </div>

                            <div>

                                <div class="text-muted small">
                                    Stok Menipis
                                </div>

                                <h4 class="mb-0 font-weight-bold">

                                    <?= angka($totalStokMenipis); ?>

                                    <small class="text-muted">
                                        barang
                                    </small>

                                </h4>

                            </div>

                        </div>


                        <hr>


                        <div class="text-muted small mb-2">

                            <i class="fas fa-info-circle mr-1"></i>

                            Barang dengan stok

                            <strong>≤ 5</strong>

                            dianggap membutuhkan perhatian.

                        </div>


                        <!-- DAFTAR STOK TERENDAH -->

                        <?php if (
                            $queryStok &&
                            mysqli_num_rows($queryStok) > 0
                        ): ?>

                            <div class="mt-3">

                                <?php while (
                                    $stok =
                                    mysqli_fetch_assoc(
                                        $queryStok
                                    )
                                ): ?>

                                    <?php
                                    $jumlahStok =
                                        (int) $stok['stok'];

                                    if ($jumlahStok <= 0) {
                                        $badge =
                                            'badge-danger';

                                        $status =
                                            'Habis';
                                    } elseif (
                                        $jumlahStok <= 5
                                    ) {
                                        $badge =
                                            'badge-warning';

                                        $status =
                                            'Menipis';
                                    } else {
                                        $badge =
                                            'badge-success';

                                        $status =
                                            'Aman';
                                    }
                                    ?>

                                    <div class="d-flex
                                                justify-content-between
                                                align-items-center
                                                mb-2">

                                        <div class="text-truncate"
                                             style="max-width:70%;">

                                            <i class="fas fa-box
                                                      mr-1 text-muted"></i>

                                            <?= htmlspecialchars(
                                                $stok[
                                                    'namabarang'
                                                ]
                                            ); ?>

                                        </div>


                                        <span class="badge <?= $badge; ?>">

                                            <?= angka(
                                                $jumlahStok
                                            ); ?>

                                            <?= $status; ?>

                                        </span>

                                    </div>

                                <?php endwhile; ?>

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>



        <!-- ==========================================================
             RINGKASAN DATA SISTEM
        =========================================================== -->

        <div class="row">


            <!-- KATEGORI -->

            <div class="col-md-3 col-6">

                <div class="info-box bg-light shadow-sm">

                    <span class="info-box-icon">

                        <i class="fas fa-tags text-primary"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Kategori
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalKategori); ?>

                        </span>

                    </div>

                </div>

            </div>


            <!-- MERK -->

            <div class="col-md-3 col-6">

                <div class="info-box bg-light shadow-sm">

                    <span class="info-box-icon">

                        <i class="fas fa-copyright text-info"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Merk
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalMerk); ?>

                        </span>

                    </div>

                </div>

            </div>


            <!-- TRANSAKSI -->

            <div class="col-md-3 col-6">

                <div class="info-box bg-light shadow-sm">

                    <span class="info-box-icon">

                        <i class="fas fa-shopping-cart text-success"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Total Transaksi
                        </span>

                        <span class="info-box-number">

                            <?= angka($totalTransaksi); ?>

                        </span>

                    </div>

                </div>

            </div>


            <!-- OMZET -->

            <div class="col-md-3 col-6">

                <div class="info-box bg-light shadow-sm">

                    <span class="info-box-icon">

                        <i class="fas fa-wallet text-danger"></i>

                    </span>

                    <div class="info-box-content">

                        <span class="info-box-text">
                            Total Omzet
                        </span>

                        <span class="info-box-number"
                              style="font-size:18px;">

                            <?= rupiah($totalOmzet); ?>

                        </span>

                    </div>

                </div>

            </div>

        </div>



        <!-- ==========================================================
             QUICK ACCESS
        =========================================================== -->

        <div class="card card-outline card-secondary shadow-sm">

            <div class="card-header">

                <h3 class="card-title font-weight-bold">

                    <i class="fas fa-bolt mr-2"></i>

                    Akses Cepat

                </h3>

            </div>


            <div class="card-body">

                <div class="row text-center">


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=createbarang"
                           class="btn btn-app">

                            <i class="fas fa-box"></i>

                            Barang

                        </a>

                    </div>


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=createpelanggan"
                           class="btn btn-app">

                            <i class="fas fa-user-plus"></i>

                            Pelanggan

                        </a>

                    </div>


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=createsuplier"
                           class="btn btn-app">

                            <i class="fas fa-truck"></i>

                            Supplier

                        </a>

                    </div>


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=createpenjualan"
                           class="btn btn-app">

                            <i class="fas fa-cash-register"></i>

                            Penjualan

                        </a>

                    </div>


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=user"
                           class="btn btn-app">

                            <i class="fas fa-users-cog"></i>

                            User

                        </a>

                    </div>


                    <div class="col-lg-2 col-md-4 col-6">

                        <a href="index.php?halaman=laporanharian"
                           class="btn btn-app">

                            <i class="fas fa-file-alt"></i>

                            Laporan

                        </a>

                    </div>


                </div>

            </div>

        </div>



        <!-- ==========================================================
             FOOTER DASHBOARD
        =========================================================== -->

        <div class="text-center text-muted small py-3">

            <i class="fas fa-shield-alt mr-1"></i>

            Login sebagai

            <strong>
                <?= htmlspecialchars(
                    $_SESSION['role'] ?? 'admin'
                ); ?>
            </strong>

            &nbsp;•&nbsp;

            Sistem Informasi Koperasi Sekolah

        </div>


    </div>

</div>