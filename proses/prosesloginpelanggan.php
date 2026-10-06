<?php

require_once 'session.php';
require_once 'koneksi.php';
require_once 'helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../index.php?halaman=loginpelanggan');
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username == '' || $password == '') {

    $_SESSION['error_login'] =
        'Username dan password wajib diisi';

    redirect('../index.php?halaman=loginpelanggan');
}

$stmt = mysqli_prepare(
    $koneksi,
    "SELECT *
     FROM pelanggan
     WHERE username=?
     LIMIT 1"
);

mysqli_stmt_bind_param(
    $stmt,
    "s",
    $username
);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

$pelanggan = mysqli_fetch_assoc($result);

if (!$pelanggan) {

    $_SESSION['error_login'] =
        'Username atau password salah';

    redirect('../index.php?halaman=loginpelanggan');
}


/*
|--------------------------------------------------------------------------
| PASSWORD
|--------------------------------------------------------------------------
| Mendukung password lama (plain text)
| dan password baru (hash)
|--------------------------------------------------------------------------
*/

$loginBerhasil = false;

if (
    password_verify(
        $password,
        $pelanggan['password']
    )
) {

    $loginBerhasil = true;

} elseif (
    $password === $pelanggan['password']
) {

    $loginBerhasil = true;
}

if (!$loginBerhasil) {

    $_SESSION['error_login'] =
        'Username atau password salah';

    redirect('../index.php?halaman=loginpelanggan');
}

session_regenerate_id(true);

$_SESSION['idpelanggan']   =
    $pelanggan['idpelanggan'];

$_SESSION['namapelanggan'] =
    $pelanggan['namapelanggan'];

$_SESSION['username'] =
    $pelanggan['username'];

$_SESSION['foto'] =
    $pelanggan['foto'];

$_SESSION['login'] = true;

unset($_SESSION['error_login']);

mysqli_stmt_close($stmt);

redirect(
    '../index.php?halaman=dashboardpelanggan'
);