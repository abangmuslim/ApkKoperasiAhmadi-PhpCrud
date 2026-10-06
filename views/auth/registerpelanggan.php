
<div class="d-flex justify-content-center py-4">
    <div class="card shadow-sm" style="width:100%;max-width:420px;border:1px solid #7e7e7e;border-radius:10px;">
        <div class="card-body p-4">
            <div class="text-center mb-3">
                <div class="mb-2">
                    <span class="d-inline-flex align-items-center justify-content-center bg-success text-white rounded-circle" style="width:60px;height:60px;">
                        <i class="fas fa-user-plus fa-2x"></i>
                    </span>
                </div>
                <h4 class="font-weight-bold mb-1">Registrasi Pelanggan</h4>
                <p class="text-muted mb-0 small">Buat akun pelanggan Koperasi Ahmadi</p>
            </div>
            <form action="proses/prosespelanggan.php" method="POST">
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-user mr-1 text-success"></i> Nama Lengkap
                    </label>
                    <input type="text" name="namapelanggan" class="form-control" placeholder="Masukkan nama lengkap" autocomplete="name" required autofocus>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-at mr-1 text-success"></i> Username
                    </label>
                    <input type="text" name="username" class="form-control" placeholder="Buat username" autocomplete="username" required>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-lock mr-1 text-success"></i> Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="password" id="passwordRegister" class="form-control" placeholder="Buat password" autocomplete="new-password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordRegister" title="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label class="mb-1">
                        <i class="fas fa-lock mr-1 text-success"></i> Konfirmasi Password
                    </label>
                    <div class="input-group">
                        <input type="password" name="konfirmasi_password" id="konfirmasiPassword" class="form-control" placeholder="Ulangi password" autocomplete="new-password" required>
                        <div class="input-group-append">
                            <button type="button" class="btn btn-outline-secondary" id="toggleKonfirmasiPassword" title="Tampilkan password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-success btn-block">
                    <i class="fas fa-user-plus mr-1"></i> Registrasi
                </button>
            </form>
            <div class="text-center mt-3">
                <p class="text-muted small mb-1">Sudah memiliki akun?</p>
                <a href="index.php?halaman=loginpelanggan" class="text-primary small font-weight-bold">
                    <i class="fas fa-sign-in-alt mr-1"></i> Login Pelanggan
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
document.getElementById('togglePasswordRegister').addEventListener('click', function() {
    const password = document.getElementById('passwordRegister');
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
document.getElementById('toggleKonfirmasiPassword').addEventListener('click', function() {
    const password = document.getElementById('konfirmasiPassword');
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

