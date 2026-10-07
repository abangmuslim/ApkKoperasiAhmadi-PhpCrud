<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Tombol Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link"
               data-widget="pushmenu"
               href="#"
               role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>
    <!-- Menu Cepat -->
    <ul class="navbar-nav">
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=barang"
               class="nav-link">
                <i class="fas fa-box mr-1"></i>
                Barang
            </a>
        </li>
        <li class="nav-item d-none d-md-inline-block">
            <a href="index.php?halaman=penjualan"
               class="nav-link">
                <i class="fas fa-shopping-cart mr-1"></i>
                Penjualan
            </a>
        </li>
        <li class="nav-item dropdown d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle"
               href="#"
               data-toggle="dropdown">
                <i class="fas fa-file-alt mr-1"></i>
                Laporan
            </a>
            <div class="dropdown-menu">
                <a href="index.php?halaman=laporanharian"
                   class="dropdown-item">
                    <i class="fas fa-calendar-day mr-2"></i>
                    Laporan Harian
                </a>
                <a href="index.php?halaman=laporanbulanan"
                   class="dropdown-item">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    Laporan Bulanan
                </a>
                <a href="index.php?halaman=laporantahunan"
                   class="dropdown-item">
                    <i class="fas fa-chart-line mr-2"></i>
                    Laporan Tahunan
                </a>
            </div>
        </li>
    </ul>
    <!-- User Menu -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#"
               class="nav-link dropdown-toggle"
               data-toggle="dropdown">
                <img
                    src="assets/images/user/<?=
                    $_SESSION['foto'] ?? 'default.png';
                    ?>"
                    class="user-image img-circle elevation-2"
                    alt="User">
                <span class="d-none d-md-inline">
                    <?= $_SESSION['namauser'] ?? 'User'; ?>
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img
                        src="assets/images/user/<?=
                        $_SESSION['foto'] ?? 'default.png';
                        ?>"
                        class="img-circle elevation-2"
                        alt="User">
                    <p>
                        <?= $_SESSION['namauser'] ?? 'User'; ?>
                        <small>
                            <?= ucfirst($_SESSION['role'] ?? 'User'); ?>
                        </small>
                    </p>
                </li>
                <li class="user-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="#">
                                <i class="fas fa-user-circle mr-1"></i>
                                Profil Saya
                            </a>
                        </div>
                    </div>
                </li>
                <li class="user-footer">
                    <span class="btn btn-default btn-flat">
                        <?= ucfirst($_SESSION['role'] ?? 'User'); ?>
                    </span>
                    <a href="index.php?halaman=logout"
                       class="btn btn-danger btn-flat float-right">
                        Logout
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
