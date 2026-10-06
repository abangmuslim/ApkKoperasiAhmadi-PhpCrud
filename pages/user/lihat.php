<?php
$id=$_GET['id']??0; $file="data/datauser.json";
$data=file_exists($file)?(json_decode(file_get_contents($file),true)??[]):[];
$view=null; foreach($data as $r){ if(($r['id'] ?? 0)==$id){ $view=$r; break; } }
if(!$view){ echo '<div class="alert alert-danger m-3">User ID '.$id.' tidak ditemukan</div>'; return; }
$foto = $view['foto'] ?? 'default.png';
$fotoPath="assets/image/user/".$foto; 
if(!file_exists($fotoPath)) $fotoPath="assets/image/peserta/".$foto;
if(!file_exists($fotoPath)) $fotoPath="assets/dist/img/avatar.png";
?>
<div class="card card-outline card-primary">
  <div class="card-body">
    <div class="row">
      <div class="col-md-8">
        <h3><?= htmlspecialchars($view['nama'] ?? $view['username'] ?? '-') ?></h3>
        <p class="text-muted">@<?= htmlspecialchars($view['username'] ?? '-') ?> | Role: <?= htmlspecialchars($view['role'] ?? '-') ?></p>
        <table class="table table-sm">
          <tr><td width="120">Username</td><td>: <?= htmlspecialchars($view['username'] ?? '-') ?></td></tr>
          <tr><td>Password</td><td>: <?= htmlspecialchars($view['password'] ?? '-') ?> <small>(plain untuk pembelajaran)</small></td></tr>
          <tr><td>Nama</td><td>: <?= htmlspecialchars($view['nama'] ?? '-') ?></td></tr>
          <tr><td>Role</td><td>: <?= htmlspecialchars($view['role'] ?? '-') ?></td></tr>
          <tr><td>Email</td><td>: <?= htmlspecialchars($view['email'] ?? '-') ?></td></tr>
          <tr><td>Tanggal Buat</td><td>: <?= htmlspecialchars($view['tanggal_buat'] ?? '-') ?></td></tr>
          <tr><td>Foto File</td><td>: <code><?= htmlspecialchars($foto) ?></code></td></tr>
        </table>
      </div>
      <div class="col-md-4 text-right">
        <img src="<?= $fotoPath ?>" class="img-thumbnail" style="width:150px;height:150px;object-fit:cover">
        <div class="mt-2"><small class="badge badge-info"><?= htmlspecialchars($foto) ?></small></div>
      </div>
    </div>
  </div>
  <div class="card-footer"><a href="index.php?halaman=user" class="btn btn-secondary">Kembali</a> <a href="index.php?halaman=edituser&id=<?= $view['id'] ?? 0 ?>" class="btn btn-warning">Edit</a></div>
</div>