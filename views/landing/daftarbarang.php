<?php
$query = "SELECT barang.*, kategori.namakategori, merk.namamerk
          FROM barang
          LEFT JOIN kategori ON barang.idkategori = kategori.idkategori
          LEFT JOIN merk ON barang.idmerk = merk.idmerk
          ORDER BY barang.idbarang DESC";

$result = mysqli_query($koneksi, $query);
?>

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <h1 class="font-weight-bold">
                Daftar Barang
            </h1>
            <p class="text-muted mb-0">
                Temukan berbagai kebutuhan yang tersedia di Koperasi Ahmadi.
            </p>
        </div>

        <div class="row">

            <?php if (mysqli_num_rows($result) > 0): ?>

                <?php while ($barang = mysqli_fetch_assoc($result)): ?>

                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="card h-100 shadow-sm border-0">

                            <img
                                src="assets/images/barang/<?= htmlspecialchars($barang['gambar'] ?? 'default.jpg'); ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($barang['namabarang']); ?>"
                                style="height:220px; object-fit:cover;">

                            <div class="card-body d-flex flex-column">

                                <h5 class="card-title font-weight-bold">
                                    <?= htmlspecialchars($barang['namabarang']); ?>
                                </h5>

                                <p class="text-muted mb-1">
                                    <i class="fas fa-tag mr-1"></i>
                                    <?= htmlspecialchars($barang['namakategori'] ?? '-'); ?>
                                </p>

                                <p class="text-muted mb-2">
                                    <i class="fas fa-trademark mr-1"></i>
                                    <?= htmlspecialchars($barang['namamerk'] ?? '-'); ?>
                                </p>

                                <h5 class="text-primary font-weight-bold mt-auto mb-3">
                                    Rp <?= number_format($barang['harga'], 0, ',', '.'); ?>
                                </h5>

                                <a
                                    href="index.php?halaman=detilbarang&id=<?= $barang['idbarang']; ?>"
                                    class="btn btn-primary">

                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat Detail

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Belum ada barang yang tersedia.
                    </div>
                </div>

            <?php endif; ?>

        </div>

    </div>

</section>