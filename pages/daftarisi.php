<div class="card card-outline card-info shadow mt-4">
  <div class="card-header"><h5><i class="fas fa-list-ol mr-2"></i> Daftar Isi - Alur APK CV Digital Ahmad Muslim</h5></div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h6 class="text-primary">1. Struktur Folder (Tree Diagram)</h6>
        <pre class="bg-light p-3 rounded" style="font-size:.85rem">cvdigitalahmadimuslim/
├── index.php (router murni ?halaman=)
├── auth/loginuser.php & registrasipeserta.php
├── assets/image/peserta/ & user/
├── pages/
│   ├── dashboard.php (10 CV terbaru)
│   ├── component/header,navbar,footer
│   ├── cvdigital/index,tambah,edit,lihat
│   └── user/index,tambah,edit,lihat
├── proses/proseslogin, prosescvdigital, prosesuser
└── data/datapeserta.json & datauser.json</pre>
      </div>
      <div class="col-md-6">
        <h6 class="text-primary">2. Alur Materi PHP Fundamental</h6>
        <table class="table table-sm table-bordered">
          <tr><th>Materi</th><th>Implementasi</th></tr>
          <tr><td>Form & $_POST</td><td>Registrasi Peserta & Tambah CV</td></tr>
          <tr><td>isset() & empty()</td><td>Validasi di prosescvdigital.php</td></tr>
          <tr><td>$_FILES</td><td>Upload foto, simpan nama file sebagai string di JSON</td></tr>
          <tr><td>Array & Perulangan</td><td>explode skills, foreach data peserta</td></tr>
          <tr><td>Function</td><td>baca() & tulis() JSON, validasi()</td></tr>
          <tr><td>$_SESSION</td><td>Login user, tampilkan menu Kelola jika isset($_SESSION['login'])</td></tr>
          <tr><td>$_GET</td><td>Router ?halaman= dan ?id=</td></tr>
        </table>
        <a href="index.php?halaman=registerpeserta" class="btn btn-success btn-block"><i class="fas fa-play mr-1"></i> Mulai: Registrasi Peserta</a>
      </div>
    </div>
  </div>
</div>