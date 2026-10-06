<?php

$host     = "localhost";
$username = "root";
$password = "";
$database = "koperasiahmadi";

$koneksi = mysqli_connect(
    $host,
    $username,
    $password,
    $database
);

if (!$koneksi) {

    die(
        "Koneksi Database Gagal : " .
        mysqli_connect_error()
    );

}