<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index.php?halaman=dashboardpetugas" class="brand-link">
        <span class="brand-text font-weight-light">
            Koperasi Ahmadi
        </span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="assets/images/user/<?=
                    $_SESSION['foto'] ?? 'default.png';
                ?>" class="img-circle elevation-2" alt="User">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    <?= $_SESSION['namauser']; ?>
                </a>
                <small class="text-light">
                    <?= ucfirst($_SESSION['role']); ?>
                </small>
            </div>

        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="index.php?halaman=dashboardpetugas"
                       class="nav-link <?= menuAktif('dashboardpetugas'); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>

                <li class="nav-item">
                    <a href="index.php?halaman=pelanggan"
                       class="nav-link <?= menuAktif('pelanggan'); ?>">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Pelanggan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=suplier"
                       class="nav-link <?= menuAktif('suplier'); ?>">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Suplier</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=kategori"
                       class="nav-link <?= menuAktif('kategori'); ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=merk"
                       class="nav-link <?= menuAktif('merk'); ?>">
                        <i class="nav-icon fas fa-copyright"></i>
                        <p>Merk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index.php?halaman=barang"
                       class="nav-link <?= menuAktif('barang'); ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Barang</p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>

                <li class="nav-item">
                    <a href="index.php?halaman=penjualan"
                       class="nav-link <?= menuAktif('penjualan'); ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Penjualan</p>
                    </a>
                </li>

                <li class="nav-header">AKUN</li>

                <li class="nav-item">
                    <a href="index.php?halaman=logout"
                       class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>