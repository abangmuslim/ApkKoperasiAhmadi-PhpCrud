<?php // pages/home.php - Homepage Carousel CV Digital ?>
<div id="heroCarousel" class="carousel slide" data-ride="carousel" data-interval="5000">
  <ol class="carousel-indicators">
    <li data-target="#heroCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#heroCarousel" data-slide-to="1"></li>
    <li data-target="#heroCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <!-- SLIDE 1 - pakai asset kamu -->
    <div class="carousel-item active">
      <div style="height:90vh; background:url('assets/image/slider/slider1.jpg') center center/cover no-repeat; position:relative;">
        <div style="position:absolute; inset:0; background:rgba(0,0,0,.55);"></div>
        <div class="d-flex flex-column justify-content-center align-items-center text-center text-white h-100 px-3" style="position:relative;">
          <h1 class="display-3 font-weight-bold">Selamat Datang di<br>CV Digital</h1>
          <p class="lead">Bangun profil profesionalmu dalam satu platform digital.</p>
          <a href="index.php?halaman=registerpeserta" class="btn btn-primary btn-lg mt-2"><i class="fas fa-user-plus mr-2"></i> Registrasi Peserta</a>
        </div>
      </div>
    </div>
    <!-- SLIDE 2 -->
    <div class="carousel-item">
      <div style="height:90vh; background:url('assets/image/slider/slider2.jpg') center center/cover no-repeat; position:relative;">
        <div style="position:absolute; inset:0; background:rgba(0,0,0,.55);"></div>
        <div class="d-flex flex-column justify-content-center align-items-center text-center text-white h-100 px-3" style="position:relative;">
          <h1 class="display-3 font-weight-bold">Tampilkan Potensi Terbaikmu</h1>
          <p class="lead">Lengkapi biodata, pendidikan, dan keahlianmu.</p>
          <a href="index.php?halaman=registerpeserta" class="btn btn-primary btn-lg mt-2">Mulai Sekarang <i class="fas fa-arrow-right ml-2"></i></a>
        </div>
      </div>
    </div>
    <!-- SLIDE 3 -->
    <div class="carousel-item">
      <div style="height:90vh; background:url('assets/image/slider/slider3.jpg') center center/cover no-repeat; position:relative;">
        <div style="position:absolute; inset:0; background:rgba(0,0,0,.55);"></div>
        <div class="d-flex flex-column justify-content-center align-items-center text-center text-white h-100 px-3" style="position:relative;">
          <h1 class="display-3 font-weight-bold">Jadikan Profilmu<br>Lebih Profesional</h1>
          <p class="lead">Sederhana, rapi, dan mudah diperkenalkan ke perusahaan.</p>
          <a href="index.php?halaman=registerpeserta" class="btn btn-primary btn-lg mt-2">Buat CV Digital <i class="fas fa-arrow-right ml-2"></i></a>
        </div>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev"><span class="carousel-control-prev-icon"></span></a>
  <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next"><span class="carousel-control-next-icon"></span></a>
</div>

<!-- Section bawah carousel - biar tidak kosong, untuk penilaian Teaching Factory -->
<section class="py-5 bg-white">
  <div class="container text-center">
    <h4>Alur CV Digital - PHP Fundamental</h4>
    <p class="text-muted">Form Biodata → $_POST → Validasi isset() & empty() → Simpan JSON → Tampil CV</p>
    <div class="row mt-4">
      <div class="col-md-4"><div class="card shadow-sm p-3"><i class="fas fa-edit fa-2x text-primary mb-2"></i><h6>Input Biodata</h6><small>Variabel & Tipe Data</small></div></div>
      <div class="col-md-4"><div class="card shadow-sm p-3"><i class="fas fa-check fa-2x text-success mb-2"></i><h6>Validasi</h6><small>Percabangan & Function</small></div></div>
      <div class="col-md-4"><div class="card shadow-sm p-3"><i class="fas fa-file-alt fa-2x text-warning mb-2"></i><h6>Output CV</h6><small>Array & Perulangan</small></div></div>
    </div>
  </div>
</section>