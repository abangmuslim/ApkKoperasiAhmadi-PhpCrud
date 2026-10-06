<div class="card card-primary card-outline shadow">
  <div class="card-header bg-primary text-white"><h5><i class="fas fa-plus mr-2"></i> Tambah CV Digital (Admin)</h5></div>
  <div class="card-body">
    <form method="POST" action="proses/prosescvdigital.php?aksi=tambah" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3"><label>Nama Lengkap *</label><input type="text" name="nama_lengkap" class="form-control" placeholder="Ahmadi Muslim" required></div>
        <div class="col-md-3 mb-3"><label>Tempat Lahir *</label><input type="text" name="tempat_lahir" class="form-control" required></div>
        <div class="col-md-3 mb-3"><label>Tanggal Lahir *</label><input type="date" name="tanggal_lahir" class="form-control" required></div>
      </div>
      <div class="mb-3"><label>Alamat *</label><textarea name="alamat" class="form-control" required></textarea></div>
      <div class="row">
        <div class="col-md-6 mb-3"><label>Email *</label><input type="email" name="email" class="form-control" required></div>
        <div class="col-md-6 mb-3"><label>No HP *</label><input type="text" name="no_hp" class="form-control" required></div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3"><label>Sekolah *</label><input type="text" name="sekolah" class="form-control" value="SMKN 1 Karang Baru" required></div>
        <div class="col-md-6 mb-3"><label>Jurusan *</label><input type="text" name="jurusan" class="form-control" value="Rekayasa Perangkat Lunak" required></div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Foto Profil</label>
          <div class="custom-file"><input type="file" name="foto" class="custom-file-input" id="fotoTambahCV" accept="image/*" onchange="previewFoto(this,'prevTambahCV')"><label class="custom-file-label">Pilih foto...</label></div>
          <img id="prevTambahCV" src="#" class="img-thumbnail mt-2" style="width:100px;height:100px;object-fit:cover;display:none">
        </div>
        <div class="col-md-6 mb-3"><label>Skill (pisahkan koma) *</label><input type="text" name="skills" class="form-control" placeholder="HTML, PHP, Python" required></div>
      </div>
      <div class="mb-3"><label>Cita-cita Karier *</label><input type="text" name="cita_cita" class="form-control" placeholder="Web Developer, Cyber Security" required></div>
      <button type="submit" class="btn btn-primary btn-block">Simpan CV</button>
      <a href="index.php?halaman=cvdigital" class="btn btn-secondary btn-block">Kembali</a>
    </form>
  </div>
</div>
<script>function previewFoto(i,p){const pr=document.getElementById(p); if(i.files[0]){pr.style.display='block'; pr.src=URL.createObjectURL(i.files[0]); i.nextElementSibling.innerText=i.files[0].name;}}</script>