<?php
// pages/dashboard.php - Dashboard Modern
if(session_status()==PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['login'])){
    header("Location: index.php?halaman=loginuser&error=Silakan login dulu");
    exit;
}

// Baca data JSON
$filePeserta = "data/datapeserta.json";
$fileuser = "data/datauser.json";
$dataPeserta = file_exists($filePeserta) ? (json_decode(file_get_contents($filePeserta), true) ?? []) : [];
$datauser = file_exists($fileuser) ? (json_decode(file_get_contents($fileuser), true) ?? []) : [];

// Statistik
$totalCV = count($dataPeserta);
$totaluser = count($datauser);
$totalSkill = 0;
foreach($dataPeserta as $p){ $totalSkill += count($p['skills'] ?? []); }

// Ambil 10 CV terbaru - urutkan tanggal_buat DESC
usort($dataPeserta, function($a,$b){
    return strtotime($b['tanggal_buat'] ?? '0') <=> strtotime($a['tanggal_buat'] ?? '0');
});
$terbaru = array_slice($dataPeserta, 0, 10);
?>
<!-- Content Header -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        <p class="text-muted">Selamat datang, <b><?= htmlspecialchars($_SESSION['nama']) ?></b> | Role: <?= htmlspecialchars($_SESSION['role']) ?></p>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="index.php?halaman=home">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes - Modern -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $totalCV ?></h3>
            <p>Total CV Digital</p>
          </div>
          <div class="icon"><i class="fas fa-id-card"></i></div>
          <a href="index.php?halaman=cvdigital" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><?= $totaluser ?></h3>
            <p>Total user / User</p>
          </div>
          <div class="icon"><i class="fas fa-users"></i></div>
          <a href="index.php?halaman=user" class="small-box-footer">Kelola <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
          <div class="inner">
            <h3><?= $totalSkill ?></h3>
            <p>Total Skill Terdata</p>
          </div>
          <div class="icon"><i class="fas fa-code"></i></div>
          <a href="#" class="small-box-footer">Materi Array <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3><?= date('d') ?></h3>
            <p><?= date('F Y') ?> - PHP Fundamental</p>
          </div>
          <div class="icon"><i class="fas fa-calendar-alt"></i></div>
          <a href="index.php?halaman=registerpeserta" class="small-box-footer">Form Peserta <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <!-- Tabel 10 CV Terakhir - Modern -->
    <div class="row">
      <div class="col-12">
        <div class="card card-outline card-primary shadow-sm">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-list mr-2"></i> 10 CV Digital Terbaru</h3>
            <div class="card-tools">
              <a href="index.php?halaman=cvdigital" class="btn btn-primary btn-sm"><i class="fas fa-eye mr-1"></i> Lihat Semua</a>
              <a href="index.php?halaman=tambahcv" class="btn btn-success btn-sm"><i class="fas fa-plus mr-1"></i> Tambah CV</a>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Nama Lengkap</th>
                  <th>Sekolah</th>
                  <th>Skill</th>
                  <th>Cita-cita</th>
                  <th>Tanggal Buat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if(empty($terbaru)): ?>
                <tr><td colspan="8" class="text-center p-4 text-muted">Belum ada data CV. <a href="index.php?halaman=registerpeserta">Buat CV pertama</a></td></tr>
                <?php else: 
                $no=1; foreach($terbaru as $row): 
                  $fotoPath = "assets/image/peserta/".($row['foto'] ?? 'default.png');
                  if(!file_exists($fotoPath)) $fotoPath = "assets/dist/img/avatar.png";
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><img src="<?= $fotoPath ?>" class="img-circle" style="width:35px;height:35px;object-fit:cover;"></td>
                  <td><b><?= htmlspecialchars($row['nama_lengkap']) ?></b><br><small class="text-muted"><?= htmlspecialchars($row['email']) ?></small></td>
                  <td><?= htmlspecialchars($row['sekolah']) ?><br><small><?= htmlspecialchars($row['jurusan']) ?></small></td>
                  <td>
                    <?php foreach(array_slice($row['skills'] ?? [],0,3) as $sk): ?>
                      <span class="badge badge-info"><?= htmlspecialchars($sk) ?></span>
                    <?php endforeach; ?>
                    <?php if(count($row['skills'] ?? [])>3) echo '<span class="badge badge-light">+'.(count($row['skills'])-3).'</span>'; ?>
                  </td>
                  <td><?= htmlspecialchars($row['cita_cita']) ?></td>
                  <td><small><?= date('d/m/Y H:i', strtotime($row['tanggal_buat'] ?? 'now')) ?></small></td>
                  <td>
                    <a href="index.php?halaman=lihatcv&id=<?= $row['id'] ?>" class="btn btn-xs btn-primary"><i class="fas fa-eye"></i></a>
                    <a href="index.php?halaman=editcv&id=<?= $row['id'] ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                  </td>
                </tr>
                <?php endforeach; endif; ?>
              </tbody>
            </table>
          </div>
          <div class="card-footer text-muted small">
            Menampilkan <?= count($terbaru) ?> dari <?= $totalCV ?> data | Data disimpan di <code>data/datapeserta.json</code> | Materi: Array, Perulangan, File JSON, Sorting
          </div>
        </div>
      </div>
    </div>

    <!-- Info Alur APK -->
    <div class="row">
      <div class="col-md-12">
        <div class="card bg-gradient-primary">
          <div class="card-body">
            <h5><i class="fas fa-lightbulb mr-2"></i>Alur APK - PHP Fundamental</h5>
            <p class="mb-0">Form Biodata <code>$_POST</code> → Validasi <code>isset() & empty()</code> → Upload Foto <code>$_FILES</code> → Simpan <code>foto sebagai string</code> di JSON → Tampil CV dengan Foto Kanan Atas | Route di <code>index.php</code> murni</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>