<?php

require_once 'session.php';
require_once 'koneksi.php';
require_once 'helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('../index.php?halaman=registerpelanggan');
}

$namapelanggan = bersih($_POST['namapelanggan'] ?? '');
$username      = bersih($_POST['username'] ?? '');
$password      = $_POST['password'] ?? '';
$nohp          = bersih($_POST['nohp'] ?? '');
$alamat        = bersih($_POST['alamat'] ?? '');


/*
|--------------------------------------------------------------------------
| VALIDASI
|--------------------------------------------------------------------------
*/

if (
    empty($namapelanggan) ||
    empty($username) ||
    empty($password)
) {

    $_SESSION['error_register'] =
        'Nama pelanggan, username dan password wajib diisi.';

    redirect('../index.php?halaman=registerpelanggan');
}


/*
|--------------------------------------------------------------------------
| CEK USERNAME
|--------------------------------------------------------------------------
*/

$cek = mysqli_query(
    $koneksi,
    "SELECT idpelanggan
    FROM pelanggan
    WHERE username='$username'
    LIMIT 1"
);

if (mysqli_num_rows($cek) > 0) {

    $_SESSION['error_register'] =
        'Username sudah digunakan.';

    redirect('../index.php?halaman=registerpelanggan');
}


/*
|--------------------------------------------------------------------------
| UPLOAD FOTO
|--------------------------------------------------------------------------
*/

$foto = 'default.png';

if (
    isset($_FILES['foto']) &&
    $_FILES['foto']['error'] != 4
) {

    $upload = uploadFoto(
        '../assets/images/pelanggan'
    );

    if ($upload === false) {

        $_SESSION['error_register'] =
            'Format foto harus JPG, PNG atau WEBP maksimal 2 MB.';

        redirect('../index.php?halaman=registerpelanggan');
    }

    $foto = $upload;
}


/*
|--------------------------------------------------------------------------
| HASH PASSWORD
|--------------------------------------------------------------------------
*/

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


/*
|--------------------------------------------------------------------------
| SIMPAN DATA
|--------------------------------------------------------------------------
*/

$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO pelanggan
    (
        namapelanggan,
        username,
        password,
        nohp,
        alamat,
        foto
    )
    VALUES
    (
        ?, ?, ?, ?, ?, ?
    )"
);

mysqli_stmt_bind_param(
    $stmt,
    "ssssss",
    $namapelanggan,
    $username,
    $passwordHash,
    $nohp,
    $alamat,
    $foto
);

$berhasil = mysqli_stmt_execute($stmt);

mysqli_stmt_close($stmt);


/*
|--------------------------------------------------------------------------
| HASIL
|--------------------------------------------------------------------------
*/

if ($berhasil) {

    $_SESSION['success_register'] =
        'Registrasi berhasil. Silakan login.';

    redirect('../index.php?halaman=loginpelanggan');

} else {

    $_SESSION['error_register'] =
        'Registrasi gagal disimpan.';

    redirect('../index.php?halaman=registerpelanggan');
}