<?php
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$query = "SELECT barang.*, kategori.namakategori, merk.namamerk
          FROM barang
          LEFT JOIN kategori ON barang.idkategori = kategori.idkategori
          LEFT JOIN merk ON barang.idmerk = merk.idmerk
          WHERE barang.idbarang = $id
          LIMIT 1";

$result = mysqli_query($koneksi, $query);
$barang = mysqli_fetch_assoc($result);
?>

<section class="py-5 bg-light">

    <div class="container">

        <?php if ($barang): ?>

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="row align-items-center">

                        <div class="col-md-6 mb-4 mb-md-0">

                            <img
                                src="assets/images/barang/<?= htmlspecialchars($barang['gambar'] ?? 'default.jpg'); ?>"
                                alt="<?= htmlspecialchars($barang['namabarang']); ?>"
                                class="img-fluid rounded shadow-sm"
                                style="width:100%; max-height:450px; object-fit:cover;">

                        </div>

                        <div class="col-md-6">

                            <span class="badge badge-primary mb-2">
                                <?= htmlspecialchars($barang['namakategori'] ?? '-'); ?>
                            </span>

                            <h1 class="font-weight-bold mb-3">
                                <?= htmlspecialchars($barang['namabarang']); ?>
                            </h1>

                            <h3 class="text-primary font-weight-bold mb-4">
                                Rp <?= number_format($barang['harga'], 0, ',', '.'); ?>
                            </h3>

                            <div class="mb-3">

                                <p class="mb-2">
                                    <i class="fas fa-trademark text-primary mr-2"></i>
                                    <strong>Merk:</strong>
                                    <?= htmlspecialchars($barang['namamerk'] ?? '-'); ?>
                                </p>

                                <p class="mb-2">
                                    <i class="fas fa-boxes text-primary mr-2"></i>
                                    <strong>Stok:</strong>
                                    <?= htmlspecialchars($barang['stok'] ?? 0); ?>
                                </p>

                            </div>

                            <?php if (!empty($barang['deskripsi'])): ?>

                                <div class="mt-4">

                                    <h5 class="font-weight-bold">
                                        Deskripsi
                                    </h5>

                                    <p class="text-muted">
                                        <?= nl2br(htmlspecialchars($barang['deskripsi'])); ?>
                                    </p>

                                </div>

                            <?php endif; ?>

                            <div class="mt-4">

                                <a
                                    href="index.php?halaman=daftarbarang"
                                    class="btn btn-secondary mr-2">

                                    <i class="fas fa-arrow-left mr-1"></i>
                                    Kembali

                                </a>

                                <a
                                    href="index.php?halaman=loginpelanggan"
                                    class="btn btn-primary">

                                    <i class="fas fa-shopping-cart mr-1"></i>
                                    Login untuk Membeli

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php else: ?>

            <div class="text-center py-5">

                <i class="fas fa-box-open fa-4x text-muted mb-3"></i>

                <h3 class="font-weight-bold">
                    Barang Tidak Ditemukan
                </h3>

                <p class="text-muted">
                    Data barang yang Anda cari tidak tersedia.
                </p>

                <a
                    href="index.php?halaman=daftarbarang"
                    class="btn btn-primary">

                    <i class="fas fa-arrow-left mr-1"></i>
                    Kembali ke Daftar Barang

                </a>

            </div>

        <?php endif; ?>

    </div>

</section>