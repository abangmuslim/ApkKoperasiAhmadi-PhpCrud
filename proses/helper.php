<?php

/*
|--------------------------------------------------------------------------
| FORMAT RUPIAH
|--------------------------------------------------------------------------
*/

function rupiah($angka)
{
    return "Rp " . number_format($angka, 0, ',', '.');
}


/*
|--------------------------------------------------------------------------
| FORMAT ANGKA
|--------------------------------------------------------------------------
*/

function angka($angka)
{
    return number_format($angka, 0, ',', '.');
}


/*
|--------------------------------------------------------------------------
| FORMAT TANGGAL INDONESIA
|--------------------------------------------------------------------------
*/

function tanggalIndonesia($tanggal)
{
    if (empty($tanggal)) {
        return '-';
    }

    $timestamp = strtotime($tanggal);

    if (!$timestamp) {
        return '-';
    }

    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    return date('d', $timestamp) . ' ' .
        $bulan[(int) date('m', $timestamp)] . ' ' .
        date('Y', $timestamp);
}


/*
|--------------------------------------------------------------------------
| REDIRECT HALAMAN
|--------------------------------------------------------------------------
*/

function redirect($url)
{
    header("Location: $url");
    exit;
}


/*
|--------------------------------------------------------------------------
| CEK LOGIN USER
|--------------------------------------------------------------------------
*/

function cekLoginUser()
{
    if (!isset($_SESSION['iduser'])) {

        redirect('index.php?halaman=loginuser');
    }
}


/*
|--------------------------------------------------------------------------
| CEK LOGIN PELANGGAN
|--------------------------------------------------------------------------
*/

function cekLoginPelanggan()
{
    if (!isset($_SESSION['idpelanggan'])) {

        redirect('index.php?halaman=loginpelanggan');
    }
}


/*
|--------------------------------------------------------------------------
| CEK ROLE ADMIN
|--------------------------------------------------------------------------
*/

function cekAdmin()
{
    if (
        !isset($_SESSION['role']) ||
        $_SESSION['role'] != 'admin'
    ) {

        include_once 'views/errors/403.php';
        exit;
    }
}


/*
|--------------------------------------------------------------------------
| CEK ROLE PETUGAS
|--------------------------------------------------------------------------
*/

function cekPetugas()
{
    if (
        !isset($_SESSION['role']) ||
        $_SESSION['role'] != 'petugas'
    ) {

        include_once 'views/errors/403.php';
        exit;
    }
}


/*
|--------------------------------------------------------------------------
| AMANKAN INPUT
|--------------------------------------------------------------------------
*/

function bersih($data)
{
    global $koneksi;

    return htmlspecialchars(
        mysqli_real_escape_string(
            $koneksi,
            trim($data)
        )
    );
}


/*
|--------------------------------------------------------------------------
| UPLOAD FOTO
|--------------------------------------------------------------------------
*/

function uploadFoto($folder)
{
    if ($_FILES['foto']['error'] == 4) {

        return 'default.png';
    }

    $namaFile = $_FILES['foto']['name'];
    $tmpFile = $_FILES['foto']['tmp_name'];
    $ukuranFile = $_FILES['foto']['size'];
    $tipeFile = $_FILES['foto']['type'];

    $ekstensiValid = [
        'jpg',
        'jpeg',
        'png',
        'webp'
    ];

    $mimeValid = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    $ekstensi = strtolower(
        pathinfo(
            $namaFile,
            PATHINFO_EXTENSION
        )
    );

    if (!in_array($ekstensi, $ekstensiValid)) {

        return false;
    }

    if (!in_array($tipeFile, $mimeValid)) {

        return false;
    }

    if ($ukuranFile > 2 * 1024 * 1024) {

        return false;
    }

    $namaBaru =
        uniqid() .
        '.' .
        $ekstensi;

    move_uploaded_file(
        $tmpFile,
        $folder . '/' . $namaBaru
    );

    return $namaBaru;
}


/*
|--------------------------------------------------------------------------
| HAPUS FOTO
|--------------------------------------------------------------------------
*/

function hapusFoto($folder, $namaFile)
{
    if (
        $namaFile != 'default.png' &&
        file_exists($folder . '/' . $namaFile)
    ) {

        unlink($folder . '/' . $namaFile);
    }
}


/*
|--------------------------------------------------------------------------
| TOTAL DATA
|--------------------------------------------------------------------------
*/

function totalData($koneksi, $tabel)
{
    $query = mysqli_query(
        $koneksi,
        "SELECT COUNT(*) AS total FROM $tabel"
    );

    $data = mysqli_fetch_assoc($query);

    return $data['total'];
}


/*
|--------------------------------------------------------------------------
| TOTAL PENJUALAN
|--------------------------------------------------------------------------
*/

function totalPenjualan($koneksi)
{
    $query = mysqli_query(
        $koneksi,
        "SELECT SUM(totalpenjualan) AS total
         FROM penjualan"
    );

    $data = mysqli_fetch_assoc($query);

    return $data['total'] ?? 0;
}


/*
|--------------------------------------------------------------------------
| GENERATE FAKTUR
|--------------------------------------------------------------------------
*/

function generateFaktur()
{
    return 'TRX' .
        date('YmdHis') .
        rand(100, 999);
}


/*
|--------------------------------------------------------------------------
| STATUS MENU AKTIF
|--------------------------------------------------------------------------
*/

function menuAktif($menu)
{
    $halaman = $_GET['halaman'] ?? '';

    return ($halaman == $menu)
        ? 'active'
        : '';
}


/*
|--------------------------------------------------------------------------
| BADGE STATUS
|--------------------------------------------------------------------------
*/

function badgeStatus($status)
{
    if ($status == 'Aktif') {

        return '<span class="badge badge-success">Aktif</span>';
    }

    return '<span class="badge badge-danger">Tidak Aktif</span>';
}


/*
|--------------------------------------------------------------------------
| FOTO DEFAULT
|--------------------------------------------------------------------------
*/

function fotoUser($folder, $foto)
{
    if (empty($foto)) {

        return $folder . '/default.png';
    }

    return $folder . '/' . $foto;
}