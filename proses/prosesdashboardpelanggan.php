<?php
// proses/proseslogin.php - Login pakai JSON (Pertemuan 19)
session_start();

function baca($f){ 
    return file_exists($f) ? (json_decode(file_get_contents($f), true) ?? []) : []; 
}

$fileuser = "../data/datauser.json";

// --- LOGOUT ---
if(isset($_GET['aksi']) && $_GET['aksi']=='logout'){
    session_unset();
    session_destroy();
    header("Location: ../index.php?halaman=home");
    exit;
}

// --- PROSES LOGIN ---
if(isset($_POST['login'])){

    // 1. VALIDASI isset() & empty() - Materi Pertemuan 11 & 13
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        header("Location: ../index.php?halaman=loginuser&error=Field belum diset (isset)");
        exit;
    }
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if(empty($username) || empty($password)){
        header("Location: ../index.php?halaman=loginuser&error=Username dan Password wajib diisi (empty)");
        exit;
    }

    // 2. BACA JSON - Materi Function
    if(!file_exists($fileuser)){
        // buat default user jika file belum ada
        $default = [
            ['id'=>1,'username'=>'user','password'=>'user123','nama'=>'useristrator','role'=>'user']
        ];
        file_put_contents($fileuser, json_encode($default, JSON_PRETTY_PRINT));
    }

    $datauser = baca($fileuser);
    $loginBerhasil = false;
    $userData = null;

    // 3. PERULANGAN & PERCABANGAN untuk cek login
    foreach($datauser as $user){
        // Cocokkan username & password (plain text untuk pembelajaran Fundamental)
        if($user['username'] === $username && $user['password'] === $password){
            $loginBerhasil = true;
            $userData = $user;
            break;
        }
    }

    // 4. SET SESSION & REDIRECT KE DASHBOARD
    if($loginBerhasil){
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $userData['id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['nama'] = $userData['nama'] ?? $userData['username'];
        $_SESSION['role'] = $userData['role'] ?? 'user';

        // Masuk ke dashboard setelah login - sesuai ketentuan
        header("Location: ../index.php?halaman=dashboard");
        exit;
    } else {
        header("Location: ../index.php?halaman=loginuser&error=Username atau Password salah! Cek data/datauser.json");
        exit;
    }

} else {
    // jika akses langsung tanpa POST
    header("Location: ../index.php?halaman=loginuser");
    exit;
}
?>