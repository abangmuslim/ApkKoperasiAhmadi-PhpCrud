<?php // auth/registrasipeserta.php - Sesuai LKPD Pertemuan 19 + Foto?>
<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-md-9">
      <div class="card card-outline card-primary shadow">
        <div class="card-header text-center">
          <h4><b>Form Biodata Peserta</b> - CV Digital</h4>
          <p class="text-muted small mb-0">Peserta tidak perlu login - langsung isi form (Pertemuan 19)</p>
        </div>
        <div class="card-body p-4">
          <!-- enctype penting untuk upload foto -->
          <form method="POST" action="proses/prosescvdigital.php?aksi=tambah_public" enctype="multipart/form-data">

            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Nama Lengkap *</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Ahmadi Muslim" required>
              </div>
              <div class="col-md-3 mb-3">
                <label>Tempat Lahir *</label>
                <input type="text" name="tempat_lahir" class="form-control" placeholder="Karang Baru" required>
              </div>
              <div class="col-md-3 mb-3">
                <label>Tanggal Lahir *</label>
                <input type="date" name="tanggal_lahir" class="form-control" required>
              </div>
            </div>

            <div class="mb-3">
              <label>Alamat *</label>
              <textarea name="alamat" class="form-control" placeholder="Jl. Pendidikan No.1" required></textarea>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Email *</label>
                <div class="input-group">
                  <input type="email" name="email" class="form-control" placeholder="email@smk.sch.id" required>
                  <div class="input-group-append"><div class="input-group-text"><i class="fas fa-envelope"></i></div></div>
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label>Nomor HP *</label>
                <div class="input-group">
                  <input type="text" name="no_hp" class="form-control" placeholder="0822-xxxx-xxxx" required>
                  <div class="input-group-append"><div class="input-group-text"><i class="fas fa-phone"></i></div></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label>Sekolah *</label>
                <input type="text" name="sekolah" class="form-control" value="SMKN 1 Karang Baru" required>
              </div>
              <div class="col-md-6 mb-3">
                <label>Jurusan *</label>
                <input type="text" name="jurusan" class="form-control" value="Rekayasa Perangkat Lunak" required>
              </div>
            </div>

            <!-- Foto - Fitur Tambahan -->
            <div class="mb-3">
              <label>Foto Profil (Opsional)</label>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                  <label class="custom-file-label" for="foto">Pilih file foto...</label>
                </div>
              </div>
              <small class="text-muted">Foto akan disimpan di assets/image/peserta/ dan namanya disimpan di JSON sebagai string</small>
            </div>

            <div class="mb-3">
              <label>Skill / Keterampilan (pisahkan koma) *</label>
              <input type="text" name="skills" class="form-control" placeholder="HTML, CSS, PHP, MySQL" required>
              <small class="text-muted">Materi Array - akan disimpan sebagai ["HTML","CSS","PHP"]</small>
            </div>

            <div class="mb-3">
              <label>Cita-cita Karier *</label>
              <input type="text" name="cita_cita" class="form-control" placeholder="Junior Web Developer" required>
            </div>

            <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fas fa-save mr-1"></i> Simpan & Lihat CV Saya</button>
            <a href="index.php?halaman=home" class="btn btn-secondary btn-block">Kembali ke Home</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// AdminLTE custom file label
document.querySelector('.custom-file-input').addEventListener('change', function(e){
  var fileName = document.getElementById("foto").files[0].name;
  var nextSibling = e.target.nextElementSibling
  nextSibling.innerText = fileName
});
</script>