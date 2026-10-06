<?php
$query = "SELECT kategori.*, COUNT(barang.idbarang) AS jumlahbarang
          FROM kategori
          LEFT JOIN barang ON barang.idkategori = kategori.idkategori
          GROUP BY kategori.idkategori
          ORDER BY kategori.idkategori DESC";

$result = mysqli_query($koneksi, $query);
?>

<section class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">
            <h1 class="font-weight-bold">
                Daftar Kategori
            </h1>
            <p class="text-muted mb-0">
                Jelajahi produk berdasarkan kategori yang tersedia.
            </p>
        </div>

        <div class="row">

            <?php if (mysqli_num_rows($result) > 0): ?>

                <?php while ($kategori = mysqli_fetch_assoc($result)): ?>

                    <div class="col-md-6 col-lg-4 mb-4">

                        <div class="card h-100 border-0 shadow-sm">

                            <div class="card-body text-center p-4">

                                <div class="mb-3">
                                    <i class="fas fa-tags fa-3x text-primary"></i>
                                </div>

                                <h4 class="font-weight-bold">
                                    <?= htmlspecialchars($kategori['namakategori']); ?>
                                </h4>

                                <p class="text-muted mb-4">
                                    <?= (int) $kategori['jumlahbarang']; ?> produk tersedia
                                </p>

                                <a
                                    href="index.php?halaman=detilkategori&id=<?= $kategori['idkategori']; ?>"
                                    class="btn btn-primary">

                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat Kategori

                                </a>

                            </div>

                        </div>

                    </div>

                <?php endwhile; ?>

            <?php else: ?>

                <div class="col-12">

                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle mr-1"></i>
                        Belum ada kategori yang tersedia.
                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</section>