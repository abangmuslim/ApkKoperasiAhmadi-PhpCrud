<?php // pages/user/tambah.php - FINAL dengan Foto?>
<div class="card card-primary card-outline shadow">
  <div class="card-header bg-primary text-white">
    <h5><i class="fas fa-user-plus mr-2"></i> Tambah User Baru</h5>
  </div>
  <div class="card-body">
    <form method="POST" action="proses/prosesuser.php?aksi=tambah" enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Username *</label>
          <input type="text" name="username" class="form-control" placeholder="contoh: user" required>
        </div>
        <div class="col-md-6 mb-3">
          <label>Password *</label>
          <div class="input-group">
            <input type="password" name="password" id="passTambah" class="form-control" placeholder="user123" required>
            <div class="input-group-append">
              <div class="input-group-text" style="cursor:pointer" onclick="togglePass('passTambah','eyeTambah')">
                <i class="fas fa-eye" id="eyeTambah"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label>Nama Lengkap *</label>
          <input type="text" name="nama" class="form-control" placeholder="useristrator" required>
        </div>
        <div class="col-md-3 mb-3">
          <label>Role *</label>
          <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="operator">Operator</option>
          </select>
        </div>
        <div class="col-md-3 mb-3">
          <label>Email (Opsional)</label>
          <input type="email" name="email" class="form-control" placeholder="boleh dikosongkan">
        </div>
      </div>

      <div class="mb-3">
        <label>Foto Profil</label>
        <div class="custom-file">
          <input type="file" name="foto" class="custom-file-input" id="fotoTambah" accept="image/*" onchange="previewFoto(this,'previewTambah')">
          <label class="custom-file-label" for="fotoTambah">Pilih file foto...</label>
        </div>
        <small class="text-muted">Disimpan di <code>assets/image/user/</code> dan nama file disimpan sebagai string di JSON</small>
        <div class="mt-2">
          <img id="previewTambah" src="assets/dist/img/avatar.png" class="img-thumbnail" style="width:120px;height:120px;object-fit:cover;display:none">
        </div>
      </div>

      <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-1"></i> Simpan User</button>
      <a href="index.php?halaman=user" class="btn btn-secondary btn-block">Kembali ke Data User</a>
    </form>
  </div>
</div>

<script>
function togglePass(id, eyeId){
  const p=document.getElementById(id); const e=document.getElementById(eyeId);
  if(p.type==='password'){p.type='text'; e.classList.remove('fa-eye'); e.classList.add('fa-eye-slash');}
  else {p.type='password'; e.classList.add('fa-eye'); e.classList.remove('fa-eye-slash');}
}
function previewFoto(input, previewId){
  const preview=document.getElementById(previewId);
  const file=input.files[0];
  if(file){
    preview.style.display='block';
    preview.src=URL.createObjectURL(file);
    input.nextElementSibling.innerText=file.name;
  }
}
</script>