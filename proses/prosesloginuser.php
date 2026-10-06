<?php

// =====================================================
// PROSES LOGIN USER
// Admin & Petugas
// =====================================================

// Pastikan session aktif
require_once 'session.php';

// Koneksi database
require_once 'koneksi.php';

// Helper
require_once 'helper.php';


// =====================================================
// CEK REQUEST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?halaman=loginuser");
    exit;
}


// =====================================================
// AMBIL DATA FORM
// =====================================================

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';


// =====================================================
// VALIDASI FORM
// =====================================================

if ($username === '' || $password === '') {

    $_SESSION['error_login'] = 'Username dan password wajib diisi.';

    header("Location: ../index.php?halaman=loginuser");
    exit;
}


// =====================================================
// CARI USER
// =====================================================

$query = "SELECT *
          FROM user
          WHERE username = ?
          LIMIT 1";

$stmt = mysqli_prepare($koneksi, $query);

if (!$stmt) {

    $_SESSION['error_login'] = 'Terjadi kesalahan pada sistem.';

    header("Location: ../index.php?halaman=loginuser");
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data   = mysqli_fetch_assoc($result);


// =====================================================
// CEK USER
// =====================================================

if (!$data) {

    $_SESSION['error_login'] = 'Username atau password salah.';

    mysqli_stmt_close($stmt);

    header("Location: ../index.php?halaman=loginuser");
    exit;
}


// =====================================================
// VERIFIKASI PASSWORD
// =====================================================

if (!password_verify($password, $data['password'])) {

    $_SESSION['error_login'] = 'Username atau password salah.';

    mysqli_stmt_close($stmt);

    header("Location: ../index.php?halaman=loginuser");
    exit;
}


// =====================================================
// CEK ROLE
// =====================================================

$role = strtolower(trim($data['role']));

if ($role !== 'admin' && $role !== 'petugas') {

    $_SESSION['error_login'] = 'Akun tidak memiliki akses sebagai user.';

    mysqli_stmt_close($stmt);

    header("Location: ../index.php?halaman=loginuser");
    exit;
}


// =====================================================
// LOGIN BERHASIL
// =====================================================

// Regenerasi session ID untuk mencegah session fixation
session_regenerate_id(true);


// Session user
$_SESSION['iduser']   = $data['iduser'];
$_SESSION['namauser'] = $data['namauser'];
$_SESSION['role']     = $role;


// Penanda login user
$_SESSION['login'] = true;


// Bersihkan pesan error login jika ada
unset($_SESSION['error_login']);


// Tutup statement
mysqli_stmt_close($stmt);


// =====================================================
// REDIRECT BERDASARKAN ROLE
// =====================================================

if ($role === 'admin') {

    header("Location: ../index.php?halaman=dashboardadmin");
    exit;
}

if ($role === 'petugas') {

    header("Location: ../index.php?halaman=dashboardpetugas");
    exit;
}


// Fallback
header("Location: ../index.php?halaman=loginuser");
exit;