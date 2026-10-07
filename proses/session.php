<?php

/*
|--------------------------------------------------------------------------
| SESSION
|--------------------------------------------------------------------------
*/

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*
|--------------------------------------------------------------------------
| SESSION TIMEOUT
|--------------------------------------------------------------------------
|
| Session akan berakhir setelah 1 jam tidak ada aktivitas.
|
*/

$timeout = 60 * 60;

/*
|--------------------------------------------------------------------------
| CEK AKTIVITAS SESSION
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['last_activity'])) {
    $selisihWaktu = time() - $_SESSION['last_activity'];

    if ($selisihWaktu > $timeout) {
        session_unset();
        session_destroy();

        header("Location: index.php?halaman=loginuser&pesan=timeout");
        exit;
    }
}

/*
|--------------------------------------------------------------------------
| UPDATE AKTIVITAS
|--------------------------------------------------------------------------
*/

$_SESSION['last_activity'] = time();
