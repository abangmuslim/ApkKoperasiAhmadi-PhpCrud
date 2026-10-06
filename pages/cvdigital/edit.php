<?php
$id=$_GET['id']??0; $file="data/datapeserta.json";
$data=file_exists($file)?(json_decode(file_get_contents($file),true)??[]):[];
$edit=null; foreach($data as $r){ if(($r['id']??0)==$id){ $edit=$r; break; } }
if(!$edit){ echo '<div class="alert alert-danger m-3">CV tidak ditemukan</div>'; return; }
$fotoLama=$edit['foto']??'default.png'; $pathLama="assets/image/peserta/".$fotoLama;
if(!file_exists($pathLama)) $pathLama="assets/dist/img/avatar.png";
?>
<div class="card card-warning card-outline shadow">
  <div class="card-header bg-warning text-white"><h5>Edit CV #<?= $edit['id']?> - <?= htmlspecialchars($edit['nama_lengkap']??'')?></h5></div>
  <div class="card-body">
    <form method="POST" action="proses/prosescvdigital.php?aksi=edit" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $edit['id']?>">
      <div class="row">
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-6 mb-3"><label>Nama Lengkap *</label><input type="text" name="nama_lengkap" value="<?= htmlspecialchars($edit['nama_lengkap']??'')?>" class="form-control" required></div>
            <div class="col-md-3 mb-3"><label>Tempat Lahir *</label><input type="text" name="tempat_lahir" value="<?= htmlspecialchars($edit['tempat_lahir']??'')?>" class="form-control" required></div>
            <div class="col-md-3 mb-3"><label>Tanggal Lahir *</label><input type="date" name="tanggal_lahir" value="<?= htmlspecialchars($edit['tanggal_lahir']??'')?>" class="form-control" required></div>
          </div>
          <div class="mb-3"><label>Alamat *</label><textarea name="alamat" class="form-control" required><?= htmlspecialchars($edit['alamat']??'')?></textarea></div>
          <div class="row">
            <div class="col-md-6 mb-3"><label>Email *</label><input type="email" name="email" value="<?= htmlspecialchars($edit['email']??'')?>" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label>No HP *</label><input type="text" name="no_hp" value="<?= htmlspecialchars($edit['no_hp']??'')?>" class="form-control" required></div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3"><label>Sekolah *</label><input type="text" name="sekolah" value="<?= htmlspecialchars($edit['sekolah']??'')?>" class="form-control" required></div>
            <div class="col-md-6 mb-3"><label>Jurusan *</label><input type="text" name="jurusan" value="<?= htmlspecialchars($edit['jurusan']??'')?>" class="form-control" required></div>
          </div>
          <div class="mb-3"><label>Skill (pisahkan koma) *</label><input type="text" name="skills" value="<?= htmlspecialchars(implode(', ', $edit['skills']??[]))?>" class="form-control" required></div>
          <div class="mb-3"><label>Cita-cita *</label><input type="text" name="cita_cita" value="<?= htmlspecialchars($edit['cita_cita']??'')?>" class="form-control" required></div>
        </div>
        <div class="col-md-4 text-center">
          <label>Foto Saat Ini</label><br>
          <img src="<?= $pathLama?>" class="img-thumbnail" style="width:150px;height:180px;object-fit:cover"><br>
          <small class="badge badge-info mt-2"><?= htmlspecialchars($fotoLama)?></small>
          <div class="mt-3 text-left">
            <label>Ganti Foto (opsional)</label>
            <div class="custom-file"><input type="file" name="foto" class="custom-file-input" id="fotoEditCV" accept="image/*" onchange="previewFoto(this,'prevEditCV')"><label class="custom-file-label">Pilih foto baru...</label></div>
            <img id="prevEditCV" src="#" class="img-thumbnail mt-2" style="width:150px;height:180px;object-fit:cover;display:none">
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-warning btn-block">Update CV</button>
      <a href="index.php?halaman=cvdigital" class="btn btn-secondary btn-block">Kembali</a>
    </form>
  </div>
</div>
<script>function previewFoto(i,p){const pr=document.getElementById(p); if(i.files[0]){pr.style.display='block'; pr.src=URL.createObjectURL(i.files[0]); i.nextElementSibling.innerText=i.files[0].name;}}</script>