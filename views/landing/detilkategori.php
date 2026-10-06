<?php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$querykategori = "SELECT *
                  FROM kategori
                  WHERE idkategori = $id
                  LIMIT 1";

$resultkategori = mysqli_query($koneksi, $querykategori);
$kategori = mysqli_fetch_assoc($resultkategori);

$querybarang = "SELECT barang.*, merk.namamerk
                FROM barang
                LEFT JOIN merk ON barang.idmerk = merk.idmerk
                WHERE barang.idkategori = $id
                ORDER BY barang.idbarang DESC";

$resultbarang = mysqli_query($koneksi, $querybarang);
?>

<section class="py-5 bg-light">

    <div class="container">

        <?php if ($kategori): ?>

            <div class="text-center mb-5">

                <div class="mb-3">
                    <i class="fas fa-tags fa-3x text-primary"></i>
                </div>

                <h1 class="font-weight-bold">
                    <?= htmlspecialchars($kategori['namakategori']); ?>
                </h1>

                <p class="text-muted">
                    Produk yang tersedia dalam kategori ini.
                </p>

            </div>

            <div class="row">

                <?php if (mysqli_num_rows($resultbarang) > 0): ?>

                    <?php while ($barang = mysqli_fetch_assoc($resultbarang)): ?>

                        <div class="col-md-6 col-lg-4 mb-4">

                            <div class="card h-100 border-0 shadow-sm">

                                <img
                                    src="assets/images/barang/<?= htmlspecialchars($barang['gambar'] ?? 'default.jpg'); ?>"
                                    class="card-img-top"
                                    alt="<?= htmlspecialchars($barang['namabarang']); ?>"
                                    style="height:220px; object-fit:cover;">

                                <div class="card-body d-flex flex-column">

                                    <h5 class="font-weight-bold">
                                        <?= htmlspecialchars($barang['namabarang']); ?>
                                    </h5>

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

                        <div class="alert alert-warning text-center">

                            <i class="fas fa-box-open mr-1"></i>
                            Belum ada barang dalam kategori ini.

                        </div>

                    </div>

                <?php endif; ?>

            </div>

            <div class="text-center mt-3">

                <a
                    href="index.php?halaman=daftarkategori"
                    class="btn btn-secondary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Kategori

                </a>

            </div>

        <?php else: ?>

            <div class="text-center py-5">

                <i class="fas fa-tags fa-4x text-muted mb-3"></i>

                <h3 class="font-weight-bold">
                    Kategori Tidak Ditemukan
                </h3>

                <p class="text-muted">
                    Kategori yang Anda cari tidak tersedia.
                </p>

                <a
                    href="index.php?halaman=daftarkategori"
                    class="btn btn-primary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Kategori

                </a>

            </div>

        <?php endif; ?>

    </div>

</section>