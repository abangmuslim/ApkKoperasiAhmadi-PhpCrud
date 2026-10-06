<?php

$idpelanggan = $_SESSION['idpelanggan'];

$query = mysqli_query(
    $koneksi,
    "SELECT *
    FROM pelanggan
    WHERE idpelanggan='$idpelanggan'
    LIMIT 1"
);

$pelanggan = mysqli_fetch_assoc($query);

$foto = !empty($pelanggan['foto'])
    ? $pelanggan['foto']
    : 'default.png';

?>

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1>Profil Pelanggan</h1>
            </div>

            <div class="col-sm-6 text-right">

                <small class="text-muted">

                    <?= tanggalIndonesia(date('Y-m-d')); ?>

                </small>

            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

    <div class="card bg-gradient-primary">

        <div class="card-body">

            <h3>

                Profil Saya

            </h3>

            <p class="mb-0">

                Informasi akun pelanggan yang digunakan untuk bertransaksi pada Sistem Koperasi Sekolah.

            </p>

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">

            <div class="card card-primary card-outline">

                <div class="card-body box-profile">

                    <div class="text-center">

                        <img
                            src="assets/images/pelanggan/<?= $foto; ?>"
                            class="profile-user-img img-fluid img-circle"
                            style="width:150px;height:150px;object-fit:cover;"
                            alt="Foto Pelanggan">

                    </div>

                    <h3 class="profile-username text-center">

                        <?= $pelanggan['namapelanggan']; ?>

                    </h3>

                    <p class="text-muted text-center">

                        Pelanggan Koperasi

                    </p>

                    <ul class="list-group list-group-unbordered mb-3">

                        <li class="list-group-item">

                            <b>ID Pelanggan</b>

                            <span class="float-right">

                                <?= $pelanggan['idpelanggan']; ?>

                            </span>

                        </li>

                        <li class="list-group-item">

                            <b>Username</b>

                            <span class="float-right">

                                <?= $pelanggan['username']; ?>

                            </span>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

        <div class="col-lg-8">

            <div class="card card-outline card-primary">

                <div class="card-header">

                    <h3 class="card-title">

                        Data Profil

                    </h3>

                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <strong>

                                Nama Pelanggan

                            </strong>

                        </div>

                        <div class="col-md-8">

                            <?= $pelanggan['namapelanggan']; ?>

                        </div>

                    </div>

                    <hr>

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <strong>

                                Username

                            </strong>

                        </div>

                        <div class="col-md-8">

                            <?= $pelanggan['username']; ?>

                        </div>

                    </div>

                    <hr>

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <strong>

                                Nomor HP

                            </strong>

                        </div>

                        <div class="col-md-8">

                            <?= $pelanggan['nohp'] ?: '-'; ?>

                        </div>

                    </div>

                    <hr>

                    <div class="row mb-3">

                        <div class="col-md-4">

                            <strong>

                                Alamat

                            </strong>

                        </div>

                        <div class="col-md-8">

                            <?= $pelanggan['alamat'] ?: '-'; ?>

                        </div>

                    </div>

                    <hr>

                    <div class="row">

                        <div class="col-md-4">

                            <strong>

                                Status Akun

                            </strong>

                        </div>

                        <div class="col-md-8">

                            <span class="badge badge-success">

                                Aktif

                            </span>

                        </div>

                    </div>

                </div>

            </div>

            <div class="card card-outline card-info">

                <div class="card-header">

                    <h3 class="card-title">

                        Informasi Akun

                    </h3>

                </div>

                <div class="card-body">

                    <ul class="mb-0">

                        <li>
                            Gunakan akun ini untuk melakukan transaksi pada koperasi sekolah.
                        </li>

                        <li>
                            Pastikan nomor HP dan alamat selalu diperbarui apabila terjadi perubahan.
                        </li>

                        <li>
                            Jangan memberikan username dan password kepada orang lain.
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

</section>