<?php
$idpelanggan = $_SESSION['idpelanggan'];
$totalTransaksi = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS total
        FROM penjualan
        WHERE idpelanggan='$idpelanggan'"
    )
)['total'] ?? 0;
$totalBelanja = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT SUM(totalpenjualan) AS total
        FROM penjualan
        WHERE idpelanggan='$idpelanggan'"
    )
)['total'] ?? 0;
$barangTerbaru = mysqli_query(
    $koneksi,
    "SELECT *
    FROM barang
    ORDER BY idbarang DESC
    LIMIT 6"
);
$riwayat = mysqli_query(
    $koneksi,
    "SELECT *
    FROM penjualan
    WHERE idpelanggan='$idpelanggan'
    ORDER BY idpenjualan DESC
    LIMIT 5"
);
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard Pelanggan</h1>
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
    <div class="card bg-gradient-primary">
        <div class="card-body">
            <h3>
                Halo,
                <?= $_SESSION['namapelanggan']; ?>
                👋
            </h3>
            <p class="mb-0">
                Selamat datang di Sistem Koperasi Sekolah.
                Temukan kebutuhan sekolah Anda dengan mudah dan cepat.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-12">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>
                        <?= angka($totalTransaksi); ?>
                    </h3>
                    <p>
                        Total Transaksi
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?= rupiah($totalBelanja); ?>
                    </h3>
                    <p>
                        Total Belanja
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?= totalData($koneksi,'barang'); ?>
                    </h3>
                    <p>
                        Barang Tersedia
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Barang Terbaru
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <?php while($barang=mysqli_fetch_assoc($barangTerbaru)) : ?>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card card-outline card-primary">
                        <img
                            src="assets/images/barang/<?= $barang['foto']; ?>"
                            class="card-img-top"
                            style="height:220px;object-fit:cover;">
                        <div class="card-body">
                            <h5>
                                <?= $barang['namabarang']; ?>
                            </h5>
                            <p class="text-success mb-2">
                                <?= rupiah($barang['harga']); ?>
                            </p>
                            <span class="badge badge-primary">
                                Stok :
                                <?= angka($barang['stok']); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Riwayat Pembelian Terakhir
                    </h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no=1;
                        while($data=mysqli_fetch_assoc($riwayat)):
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                                <?= tanggalIndonesia($data['tanggalpenjualan']); ?>
                            </td>
                            <td>
                                <?= rupiah($data['totalpenjualan']); ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        Informasi Koperasi
                    </h3>
                </div>
                <div class="card-body">
                    <p>
                        <strong>Jam Operasional</strong>
                    </p>
                    <p>
                        Senin - Jumat<br>
                        07.30 - 15.00 WIB
                    </p>
                    <hr>
                    <p>
                        Selamat berbelanja di Koperasi Sekolah.
                        Dapatkan kebutuhan belajar dengan mudah,
                        cepat, dan terpercaya.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

