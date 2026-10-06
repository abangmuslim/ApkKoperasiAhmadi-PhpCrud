<?php
require_once 'proses/koneksi.php';
require_once 'proses/helper.php';
require_once 'proses/session.php';

/*
|--------------------------------------------------------------------------
| ROUTING UTAMA
|--------------------------------------------------------------------------
*/

$halaman = $_GET['halaman'] ?? 'home';

/*
|--------------------------------------------------------------------------
| HALAMAN AUTH
|--------------------------------------------------------------------------
*/

$authPages = [
    'loginuser',
    'loginpelanggan',
    'registerpelanggan'
];

/*
|--------------------------------------------------------------------------
| HALAMAN LANDING
|--------------------------------------------------------------------------
*/

$landingPages = [
    'home',
    'daftarbarang',
    'detilbarang',
    'daftarkategori',
    'detilkategori',
    'tentang',
    'kontak',
    'daftarisi'
];

include 'views/component/header.php';
?>

<!-- ================================== -->
<!-- BODY YANG SUDAH DI PERMAK DAN SUDAH DI SETTING SEHINGGA DINAMIS SESUAI DENGAN HALAMAN YANG DI AKSES OLEH USER, PELANGGAN, ADMIN, PETUGAS DAN TAMU. JADI BODY INI AKAN BERUBAH SESUAI DENGAN HALAMAN YANG DI AKSES OLEH USER, PELANGGAN, ADMIN, PETUGAS DAN TAMU. -->
<!-- ================================== -->
<?php
$isPublic =
    in_array($halaman, $landingPages) ||
    in_array($halaman, $authPages) ||
    $halaman === 'logout';

if ($isPublic) {
    $bodyClass = 'hold-transition layout-top-nav';
} else {
    $bodyClass = 'hold-transition sidebar-mini layout-fixed';
}
?>

<body class="<?= $bodyClass; ?>">

<?php

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

if ($halaman === 'logout') {

    include 'views/auth/logout.php';
}

/*
|--------------------------------------------------------------------------
| ZONA TAMU / PUBLIC + AUTH
|--------------------------------------------------------------------------
*/

elseif (
    in_array($halaman, $landingPages) ||
    in_array($halaman, $authPages)
) {

?>

<div class="wrapper">

    <?php include 'views/component/tamu/navbar.php'; ?>

    <?php

    if (in_array($halaman, $authPages)) {

        include "views/auth/{$halaman}.php";

    } else {

        include "views/landing/{$halaman}.php";

    }

    ?>

    <?php include 'views/component/tamu/footer.php'; ?>

</div>

<?php

}

/*
|--------------------------------------------------------------------------
| USER (ADMIN / PETUGAS)
|--------------------------------------------------------------------------
*/

elseif (isset($_SESSION['iduser'])) {

?>

<div class="wrapper">

    <?php include 'views/component/user/navbar.php'; ?>

    <?php

    $sidebar =
        ($_SESSION['role'] == 'admin')
        ? 'sidebaradmin.php'
        : 'sidebarpetugas.php';

    include "views/component/user/$sidebar";

    ?>

    <div class="content-wrapper">

        <?php

        switch ($halaman) {

            /*
            ==================================================
            DASHBOARD
            ==================================================
            */

            case 'dashboardadmin':

                cekAdmin();

                include 'views/user/dashboard/dashboardadmin.php';
                break;

            case 'dashboardpetugas':

                cekPetugas();

                include 'views/user/dashboard/dashboardpetugas.php';
                break;

            /*
            ==================================================
            USER (ADMIN ONLY)
            ==================================================
            */

            case 'user':
            case 'createuser':
            case 'edituser':
            case 'showuser':

                cekAdmin();

                include "views/user/user/" .
                    str_replace(
                        ['user', 'createuser', 'edituser', 'showuser'],
                        ['index', 'create', 'edit', 'show'],
                        $halaman
                    ) . ".php";

                break;

            /*
            ==================================================
            PELANGGAN
            ==================================================
            */

            case 'pelanggan':
                include 'views/user/pelanggan/index.php';
                break;

            case 'createpelanggan':
                include 'views/user/pelanggan/create.php';
                break;

            case 'editpelanggan':
                include 'views/user/pelanggan/edit.php';
                break;

            case 'showpelanggan':
                include 'views/user/pelanggan/show.php';
                break;

            /*
            ==================================================
            SUPLIER
            ==================================================
            */

            case 'suplier':
                include 'views/user/suplier/index.php';
                break;

            case 'createsuplier':
                include 'views/user/suplier/create.php';
                break;

            case 'editsuplier':
                include 'views/user/suplier/edit.php';
                break;

            case 'showsuplier':
                include 'views/user/suplier/show.php';
                break;

            /*
            ==================================================
            KATEGORI
            ==================================================
            */

            case 'kategori':
                include 'views/user/kategori/index.php';
                break;

            case 'createkategori':
                include 'views/user/kategori/create.php';
                break;

            case 'editkategori':
                include 'views/user/kategori/edit.php';
                break;

            case 'showkategori':
                include 'views/user/kategori/show.php';
                break;

            /*
            ==================================================
            MERK
            ==================================================
            */

            case 'merk':
                include 'views/user/merk/index.php';
                break;

            case 'createmerk':
                include 'views/user/merk/create.php';
                break;

            case 'editmerk':
                include 'views/user/merk/edit.php';
                break;

            case 'showmerk':
                include 'views/user/merk/show.php';
                break;

            /*
            ==================================================
            BARANG
            ==================================================
            */

            case 'barang':
                include 'views/user/barang/index.php';
                break;

            case 'createbarang':
                include 'views/user/barang/create.php';
                break;

            case 'editbarang':
                include 'views/user/barang/edit.php';
                break;

            case 'showbarang':
                include 'views/user/barang/show.php';
                break;

            /*
            ==================================================
            PENJUALAN
            ==================================================
            */

            case 'penjualan':
                include 'views/user/penjualan/index.php';
                break;

            case 'createpenjualan':
                include 'views/user/penjualan/create.php';
                break;

            case 'editpenjualan':
                include 'views/user/penjualan/edit.php';
                break;

            case 'showpenjualan':
                include 'views/user/penjualan/show.php';
                break;

            /*
            ==================================================
            LAPORAN (ADMIN ONLY)
            ==================================================
            */

            case 'laporanharian':

                cekAdmin();

                include 'views/user/laporan/laporanharian.php';
                break;

            case 'laporanbulanan':

                cekAdmin();

                include 'views/user/laporan/laporanbulanan.php';
                break;

            case 'laporantahunan':

                cekAdmin();

                include 'views/user/laporan/laporantahunan.php';
                break;

            default:

                include 'views/errors/404.php';
                break;
        }

        ?>

    </div>

    <?php include 'views/component/user/footer.php'; ?>

</div>

<?php

}

/*
|--------------------------------------------------------------------------
| PELANGGAN
|--------------------------------------------------------------------------
*/

elseif (isset($_SESSION['idpelanggan'])) {

?>

<div class="wrapper">

    <?php include 'views/component/pelanggan/navbar.php'; ?>

    <?php include 'views/component/pelanggan/sidebar.php'; ?>

    <div class="content-wrapper">

        <?php

        switch ($halaman) {

            case 'dashboardpelanggan':
                include 'views/pelanggan/dashboardpelanggan.php';
                break;

            case 'profil':
                include 'views/pelanggan/profil.php';
                break;

            case 'riwayatpenjualan':
                include 'views/pelanggan/riwayatpenjualan.php';
                break;

            default:
                include 'views/errors/404.php';
                break;
        }

        ?>

    </div>

    <?php include 'views/component/pelanggan/footer.php'; ?>

</div>

<?php

}

/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
*/

else {

?>

<div class="wrapper">

    <?php include 'views/component/tamu/navbar.php'; ?>

    <?php include 'views/errors/404.php'; ?>

    <?php include 'views/component/tamu/footer.php'; ?>

</div>

<?php

}

include 'views/component/footerjs.php';
?>

</body>
</html>

