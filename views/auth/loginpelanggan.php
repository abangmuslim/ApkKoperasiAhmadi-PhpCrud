
<div class="d-flex justify-content-center py-4">
    <div class="card shadow-sm" style="width:100%;max-width:420px;border:1px solid #7e7e7e;border-radius:10px;">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle" style="width:60px;height:60px;">
                        <i class="fas fa-user fa-2x"></i>
                    </span>
                </div>
                <h4 class="font-weight-bold mb-1">Login Pelanggan</h4>
                <p class="text-muted mb-0 small">Masuk ke akun pelanggan Koperasi Ahmadi</p>
            </div>
            <form action="proses/prosesloginpelanggan.php" method="POST">
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-user mr-1 text-primary"></i> Username
                    </label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" autocomplete="username" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-lock mr-1 text-primary"></i> Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordPelanggan" class="form-control" placeholder="Masukkan password" autocomplete="current-password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordPelanggan" title="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login Pelanggan
                </button>
            </form>
            <div class="text-center mt-3">
                <p class="text-muted small mb-1">Belum memiliki akun?</p>
                <a href="index.php?halaman=registerpelanggan" class="text-primary small font-weight-bold">
                    <i class="fas fa-user-plus mr-1"></i> Registrasi Pelanggan
                </a>
            </div>
            <div class="text-center mt-2">
                <a href="index.php?halaman=home" class="text-muted small">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Home
                </a>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('togglePasswordPelanggan').addEventListener('click', function() {
    const password = document.getElementById('passwordPelanggan');
    const icon = this.querySelector('i');
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
        this.title = 'Sembunyikan password';
    } else {
        password.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
        this.title = 'Tampilkan password';
    }
});
</script>

