<?php // auth/loginuser.php - Versi dengan Label & Show/Hide Password ?>
<div class="d-flex justify-content-center align-items-center" style="min-height:80vh;">
  <div class="login-box" style="width:400px;">
    <div class="card card-outline card-primary shadow">
      <div class="card-header text-center">
        <a href="index.php?halaman=home" class="h1"><b>CV</b> Digital</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Silakan masuk untuk memulai sesi</p>

        <?php if(isset($_GET['error'])): ?>
          <div class="alert alert-danger py-2 small"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <form action="proses/proseslogin.php" method="post">
          
          <!-- Username dengan Label -->
          <div class="form-group">
            <label for="username">Username:</label>
            <div class="input-group">
              <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username Anda" required value="admin">
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
              </div>
            </div>
            <small class="text-muted">Contoh: admin, guru</small>
          </div>

          <!-- Password dengan Label + Mata -->
          <div class="form-group">
            <label for="password">Password:</label>
            <div class="input-group">
              <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password Anda" required value="admin123">
              <div class="input-group-append">
                <!-- Tombol Mata -->
                <div class="input-group-text" style="cursor:pointer;" onclick="togglePassword()">
                  <span class="fas fa-eye" id="eyeIcon"></span>
                </div>
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <small class="text-muted">Gunakan password yang terdaftar di JSON</small>
          </div>

          <div class="row mt-4">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">Remember Me</label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>

        <p class="mb-0 mt-3 text-center">
          <a href="index.php?halaman=registerpeserta">Registrasi sebagai Peserta</a>
        </p>
        <div class="alert alert-info mt-3 py-2 small">
          <b>Login Default:</b><br>
          Username: <code>admin</code> / Password: <code>admin123</code>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function togglePassword() {
  const pass = document.getElementById('password');
  const eye = document.getElementById('eyeIcon');
  if (pass.type === 'password') {
    pass.type = 'text';
    eye.classList.remove('fa-eye');
    eye.classList.add('fa-eye-slash');
  } else {
    pass.type = 'password';
    eye.classList.remove('fa-eye-slash');
    eye.classList.add('fa-eye');
  }
}
</script>