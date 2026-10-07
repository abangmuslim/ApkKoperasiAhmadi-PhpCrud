<?php

require_once 'session.php';
require_once 'koneksi.php';
require_once 'helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php?halaman=loginuser");
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['error_login'] = 'Username dan password wajib diisi.';
    header("Location: ../index.php?halaman=loginuser");
    exit;
}

$query = "SELECT * FROM user WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($koneksi, $query);

if (!$stmt) {
    $_SESSION['error_login'] = 'Terjadi kesalahan pada sistem.';
    header("Location: ../index.php?halaman=loginuser");
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data || !password_verify($password, $data['password'])) {
    $_SESSION['error_login'] = 'Username atau password salah.';
    mysqli_stmt_close($stmt);
    header("Location: ../index.php?halaman=loginuser");
    exit;
}

$role = strtolower(trim($data['role']));

if ($role !== 'admin' && $role !== 'petugas') {
    $_SESSION['error_login'] = 'Akun tidak memiliki akses sebagai user.';
    mysqli_stmt_close($stmt);
    header("Location: ../index.php?halaman=loginuser");
    exit;
}

session_regenerate_id(true);

$_SESSION['iduser'] = $data['iduser'];
$_SESSION['namauser'] = $data['namauser'];
$_SESSION['role'] = $role;
$_SESSION['login'] = true;

unset($_SESSION['error_login']);

mysqli_stmt_close($stmt);

if ($role === 'admin') {
    header("Location: ../index.php?halaman=dashboardadmin");
    exit;
}

if ($role === 'petugas') {
    header("Location: ../index.php?halaman=dashboardpetugas");
    exit;
}

header("Location: ../index.php?halaman=loginuser");
exit;
