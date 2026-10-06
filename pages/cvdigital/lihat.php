<?php
// pages/cvdigital/lihat.php - View CV dengan foto kanan atas
$id = $_GET['id'] ?? 0;
$file = "data/datapeserta.json";
$data = file_exists($file) ? (json_decode(file_get_contents($file), true) ?? []) : [];
$view = null;
foreach($data as $row){ if($row['id']==$id){ $view=$row; break; } }

if(!$view){
  echo '<div class="alert alert-danger m-4">Data CV dengan ID '.$id.' tidak ditemukan. <a href="index.php?halaman=cvdigital">Kembali</a></div>';
  return;
}
$foto = $view['foto'] ?? 'default.png';
$pathFoto = "assets/image/peserta/".$foto;
if(!file_exists($pathFoto)) $pathFoto = "assets/image/peserta/default.png";
?>
<div class="card card-primary card-outline shadow-lg">
  <div class="card-header">
    <h5 class="mb-0"><i class="fas fa-id-card mr-2"></i> Curriculum Vitae Digital</h5>
  </div>
  <div class="card-body p-4" id="areaCV">
    <!-- HEADER CV + FOTO KANAN ATAS -->
    <div class="row border-bottom pb-3 mb-3">
      <div class="col-md-8">
        <h2 class="font-weight-bold mb-0"><?= htmlspecialchars($view['nama_lengkap']) ?></h2>
        <p class="text-muted mb-1"><?= htmlspecialchars($view['cita_cita']) ?></p>
        <small class="text-muted">ID CV: #<?= $view['id'] ?> | Dibuat: <?= $view['tanggal_buat'] ?></small>
      </div>
      <div class="col-md-4 text-right">
        <img src="<?= $pathFoto ?>" alt="Foto <?= htmlspecialchars($view['nama_lengkap']) ?>" 
             class="img-thumbnail shadow" style="width:140px; height:180px; object-fit:cover;">
        <div class="mt-2"><small class="badge badge-info"><?= $foto ?></small></div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <h6 class="text-primary"><i class="fas fa-user mr-1"></i> Data Pribadi</h6>
        <table class="table table-sm table-borderless">
          <tr><td width="130">Tempat Lahir</td><td>: <?= htmlspecialchars($view['tempat_lahir']) ?></td></tr>
          <tr><td>Tanggal Lahir</td><td>: <?= date('d F Y', strtotime($view['tanggal_lahir'])) ?></td></tr>
          <tr><td>Alamat</td><td>: <?= nl2br(htmlspecialchars($view['alamat'])) ?></td></tr>
          <tr><td>Email</td><td>: <?= htmlspecialchars($view['email']) ?></td></tr>
          <tr><td>No HP</td><td>: <?= htmlspecialchars($view['no_hp']) ?></td></tr>
        </table>
      </div>
      <div class="col-md-6">
        <h6 class="text-primary"><i class="fas fa-graduation-cap mr-1"></i> Pendidikan</h6>
        <table class="table table-sm table-borderless">
          <tr><td width="130">Sekolah</td><td>: <?= htmlspecialchars($view['sekolah']) ?></td></tr>
          <tr><td>Jurusan</td><td>: <?= htmlspecialchars($view['jurusan']) ?></td></tr>
          <tr><td>Cita-cita</td><td>: <b><?= htmlspecialchars($view['cita_cita']) ?></b></td></tr>
        </table>

        <h6 class="text-primary mt-4"><i class="fas fa-code mr-1"></i> Keahlian</h6>
        <div>
          <?php foreach($view['skills'] as $skill): ?>
            <span class="badge badge-success mr-1 mb-1 p-2"><?= htmlspecialchars(trim($skill)) ?></span>
          <?php endforeach; ?>
        </div>
        <small class="text-muted d-block mt-1">Materi: Array & Perulangan</small>
      </div>
    </div>

    <div class="alert alert-light border mt-4">
      <small><i class="fas fa-info-circle mr-1"></i> Data ini disimpan di <code>data/datapeserta.json</code> dengan foto sebagai string <code><?= htmlspecialchars($view['foto']) ?></code> yang file fisiknya ada di <code>assets/image/peserta/</code>. Materi: Function, isset(), empty(), $_POST, $_FILES</small>
    </div>
  </div>
  <div class="card-footer text-right">
    <a href="index.php?halaman=cvdigital" class="btn btn-secondary"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar</a>
    <button onclick="window.print()" class="btn btn-primary"><i class="fas fa-print mr-1"></i> Cetak CV</button>
    <a href="index.php?halaman=editcv&id=<?= $view['id'] ?>" class="btn btn-warning"><i class="fas fa-edit mr-1"></i> Edit</a>
  </div>
</div>