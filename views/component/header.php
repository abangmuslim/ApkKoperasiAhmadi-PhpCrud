<!DOCTYPE html>

<html lang="id">

<head>


<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<meta
    name="description"
    content="Aplikasi Koperasi Ahmadi">

<meta
    name="author"
    content="Ahmadi Muslim, M.P">

<title>
    <?= $judul ?? 'Koperasi Ahmadi'; ?>
</title>


<!-- =====================================================
     FAVICON
====================================================== -->
<link
    rel="icon"
    type="image/png"
    href="assets/images/logo.png">


<!-- =====================================================
     GOOGLE FONT
====================================================== -->
<link
    rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">


<!-- =====================================================
     FONT AWESOME
====================================================== -->
<link
    rel="stylesheet"
    href="assets/plugins/fontawesome-free/css/all.min.css">


<!-- =====================================================
     ADMIN LTE
====================================================== -->
<link
    rel="stylesheet"
    href="assets/css/adminlte.min.css">


<!-- =====================================================
     CUSTOM CSS
====================================================== -->
<link
    rel="stylesheet"
    href="assets/css/style.css">


<!-- =====================================================
     GLOBAL LAYOUT
====================================================== -->
<style>

    /* Lebarkan container pada layar besar,
       tetapi tetap memiliki margin kiri dan kanan */
    @media (min-width: 1200px) {

        .container {
            max-width: 1360px !important;
            width: 85% !important;
        }

    }


    /* Mencegah menu navbar turun ke baris berikutnya */
    .navbar-nav .nav-item {
        white-space: nowrap;
    }


    /* Ukuran dan jarak menu navbar */
    .navbar .nav-link {
        padding-left: .7rem !important;
        padding-right: .7rem !important;
        font-size: .95rem;
    }

</style>


</head>
