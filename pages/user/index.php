<?php
$file="data/datauser.json";
$data=file_exists($file)?(json_decode(file_get_contents($file),true)??[]):[];
?>
<div class="card card-outline card-primary shadow">
  <div class="card-header">
    <h3 class="card-title"><i class="fas fa-users mr-2"></i> Data User</h3>
    <div class="card-tools">
      <a href="index.php?halaman=tambahuser" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah User</a>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover">
      <thead><tr><th>#</th><th>Foto</th><th>Username</th><th>Nama</th><th>Role</th><th>Email</th><th>Aksi</th></tr></thead>
      <tbody>
      <?php if(empty($data)): ?>
        <tr><td colspan="7" class="text-center p-3">Belum ada user.</td></tr>
      <?php else: foreach($data as $row):
        $foto = $row['foto'] ?? 'default.png';
        $fotoPath="assets/image/user/".$foto;
        if(!file_exists($fotoPath)) $fotoPath="assets/image/peserta/".$foto; // fallback karena foto kamu tadi di folder peserta
        if(!file_exists($fotoPath)) $fotoPath="assets/dist/img/avatar.png";
      ?>
        <tr>
          <td><?= $row['id'] ?? '-' ?></td>
          <td><img src="<?= $fotoPath ?>" class="img-circle" style="width:35px;height:35px;object-fit:cover"></td>
          <td><b><?= htmlspecialchars($row['username'] ?? '') ?></b></td>
          <td><?= htmlspecialchars($row['nama'] ?? '') ?></td>
          <td><span class="badge badge-info"><?= htmlspecialchars($row['role'] ?? 'user') ?></span></td>
          <td><?= htmlspecialchars($row['email'] ?? '-') ?></td>
          <td>
            <a href="index.php?halaman=lihatuser&id=<?= $row['id'] ?? 0 ?>" class="btn btn-xs btn-info"><i class="fas fa-eye"></i></a>
            <a href="index.php?halaman=edituser&id=<?= $row['id'] ?? 0 ?>" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
            <a href="proses/prosesuser.php?aksi=hapus&id=<?= $row['id'] ?? 0 ?>" onclick="return confirm('Hapus user ini?')" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>
      <?php endforeach; endif; ?>
      </tbody>
    </table>
  </div>
</div>