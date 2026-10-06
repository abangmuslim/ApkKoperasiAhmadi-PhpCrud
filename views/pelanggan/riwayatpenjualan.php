<?php

$idpelanggan = $_SESSION['idpelanggan'];

$queryRiwayat = mysqli_query(
    $koneksi,
    "SELECT *
    FROM penjualan
    WHERE idpelanggan='$idpelanggan'
    ORDER BY tanggalpenjualan DESC, idpenjualan DESC"
);

$dataRingkasan = mysqli_fetch_assoc(
    mysqli_query(
        $koneksi,
        "SELECT
        COUNT(*) AS totaltransaksi,
        SUM(totalpenjualan) AS totalbelanja
        FROM penjualan
        WHERE idpelanggan='$idpelanggan'"
    )
);

$totalTransaksi = $dataRingkasan['totaltransaksi'] ?? 0;
$totalBelanja = $dataRingkasan['totalbelanja'] ?? 0;

?>

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Riwayat Pembelian</h1>
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

                    Riwayat Belanja Pelanggan

                </h3>

                <p class="mb-0">

                    Seluruh transaksi pembelian Anda tersimpan secara otomatis dan dapat dilihat kembali kapan saja.

                </p>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

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

            <div class="col-md-6">

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

        </div>

        <div class="card card-outline card-primary">

            <div class="card-header">

                <h3 class="card-title">

                    Data Riwayat Pembelian

                </h3>

            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-hover table-striped">

                    <thead>

                        <tr>

                            <th width="60">No</th>
                            <th>Faktur</th>
                            <th>Tanggal</th>
                            <th>Total Belanja</th>
                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    if(mysqli_num_rows($queryRiwayat) > 0) :

                        $no = 1;

                        while($row = mysqli_fetch_assoc($queryRiwayat)) :

                    ?>

                        <tr>

                            <td>

                                <?= $no++; ?>

                            </td>

                            <td>

                                <span class="badge badge-secondary">

                                    TRX<?= str_pad($row['idpenjualan'], 5, '0', STR_PAD_LEFT); ?>

                                </span>

                            </td>

                            <td>

                                <?= tanggalIndonesia($row['tanggalpenjualan']); ?>

                            </td>

                            <td>

                                <strong class="text-success">

                                    <?= rupiah($row['totalpenjualan']); ?>

                                </strong>

                            </td>

                            <td>

                                <span class="badge badge-success">

                                    Selesai

                                </span>

                            </td>

                        </tr>

                    <?php

                        endwhile;

                    else :

                    ?>

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>

                                <br>

                                Belum ada riwayat pembelian.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card card-outline card-info">

            <div class="card-header">

                <h3 class="card-title">

                    Informasi

                </h3>

            </div>

            <div class="card-body">

                <ul class="mb-0">

                    <li>
                        Riwayat pembelian akan tersimpan secara otomatis.
                    </li>

                    <li>
                        Data transaksi digunakan sebagai arsip pembelian pelanggan.
                    </li>

                    <li>
                        Hubungi petugas koperasi apabila terdapat kesalahan data transaksi.
                    </li>

                </ul>

            </div>

        </div>

    </div>

</section>