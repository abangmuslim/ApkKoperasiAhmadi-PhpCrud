<?php
session_start();
$halaman = $_GET['halaman'] ?? 'home';
$allowed = [
  'home','loginuser','registerpeserta','contact','daftarisi','tentang',
  'dashboard',
  'user','tambahuser','edituser','lihatuser',
  'cvdigital','tambahcv','editcv','lihatcv'
];
if(!in_array($halaman, $allowed)) $halaman = 'home';
$isHome = ($halaman === 'home');

include 'pages/component/header.php';
echo '<body class="hold-transition layout-top-nav"><div class="wrapper">';
include 'pages/component/navbar.php';

if($isHome){
    include 'pages/home.php';
} else {
    echo '<div class="content-wrapper"><div class="content"><div class="container py-3">';
    switch($halaman){
        // AUTH & PUBLIC
        case "loginuser": include "auth/loginuser.php"; break;
        case "registerpeserta": include "auth/registrasipeserta.php"; break;
        
        // HALAMAN DEPAN - YANG BARU
        case "contact": include "pages/contact.php"; break;
        case "daftarisi": include "pages/daftarisi.php"; break;
        case "tentang": include "pages/tentang.php"; break;
        
        // DASHBOARD - butuh login
        case "dashboard": 
          if(!isset($_SESSION['login'])) header("Location: index.php?halaman=loginuser");
          else include "pages/dashboard.php"; 
          break;

        // KELOLA user
        case "user": include "pages/user/index.php"; break;
        case "tambahuser": include "pages/user/tambah.php"; break;
        case "edituser": include "pages/user/edit.php"; break;
        case "lihatuser": include "pages/user/lihat.php"; break;

        // KELOLA CV DIGITAL - INI YANG KEMARIN KURANG
        case "cvdigital": include "pages/cvdigital/index.php"; break;
        case "tambahcv": include "pages/cvdigital/tambah.php"; break;
        case "editcv": include "pages/cvdigital/edit.php"; break;
        case "lihatcv": include "pages/cvdigital/lihat.php"; break; // <-- INI KUNCINYA
    }
    echo '</div></div></div>';
}

include 'pages/component/footer.php';
echo '</div></body></html>';