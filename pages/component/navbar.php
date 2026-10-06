<?php 
if (session_status() == PHP_SESSION_NONE) session_start(); 
$isLogin = isset($_SESSION['login']);
?>
<style>
  /* FINAL FIX: Lebar profesional, tidak fullscreen */
  @media (min-width: 1200px) {
    .main-header .container {
      max-width: 1360px !important;
      width: 95% !important;
    }
  }
  /* Biar menu tidak turun baris */
  .main-header .navbar-nav .nav-link {
    white-space: nowrap;
    padding-left: .65rem !important;
    padding-right: .65rem !important;
    font-size: .93rem;
  }
</style>

<nav class="main-header navbar navbar-expand-lg navbar-white navbar-light shadow-sm">
  <div class="container">
    <a href="index.php?halaman=home" class="navbar-brand">
      <b>CV</b>Digital
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="index.php?halaman=home" class="btn btn-danger"><i class="fas fa-home mr-1"></i> Home</a>
        </li>
        <li class="nav-item">
          <a href="index.php?halaman=contact" class="nav-link">Kontak</a>
        </li>
        <li class="nav-item">
          <a href="index.php?halaman=daftarisi" class="nav-link">Daftar Isi</a>
        </li>
        <li class="nav-item">
          <a href="index.php?halaman=tentang" class="nav-link">Tentang</a>
        </li>

        <?php if($isLogin): // MUNCUL SETELAH LOGIN - sesuai spek ?>
        <li class="nav-item">
          <a href="index.php?halaman=user" class="nav-link font-weight-bold text-primary">
            <i class="fas fa-users mr-1"></i> Kelola User
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?halaman=cvdigital" class="nav-link font-weight-bold text-primary">
            <i class="fas fa-book mr-1"></i> Kelola cvdigital
          </a>
        </li>
        <li class="nav-item">
          <a href="index.php?halaman=dashboard" class="nav-link font-weight-bold text-primary">
            <i class="fas fa-id-card mr-1"></i> Dashboard
          </a>
        </li>
        <?php endif; ?>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto align-items-center">
        <?php if(!$isLogin): // SEBELUM LOGIN ?>
          <li class="nav-item">
            <a href="index.php?halaman=loginuser" class="nav-link">
              <i class="fas fa-sign-in-alt mr-1"></i> Login User
            </a>
          </li>
          <li class="nav-item ml-1">
            <a href="index.php?halaman=registerpeserta" class="btn btn-primary ">
              <i class="fas fa-user-plus mr-1"></i> Registrasi Peserta
            </a>
          </li>
        <?php else: // SETELAH LOGIN ?>
          <li class="nav-item d-none d-xl-block">
            <span class="nav-link">Halo, <b><?= htmlspecialchars($_SESSION['nama'] ?? $_SESSION['username']) ?></b></span>
          </li>
          <li class="nav-item">
            <a href="proses/proseslogin.php?aksi=logout" class="btn btn-dark">
              <i class="fas fa-sign-out-alt mr-1"></i> Logout
            </a>
          </li>
        <?php endif; ?>

        <li class="nav-item ml-2">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit"><i class="fas fa-search"></i></button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search"><i class="fas fa-times"></i></button>
                </div>
              </div>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>