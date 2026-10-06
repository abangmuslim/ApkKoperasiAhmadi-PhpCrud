<?php
session_start();
function baca($f){ return file_exists($f) ? (json_decode(file_get_contents($f),true) ?? []) : []; }
function tulis($f,$d){ file_put_contents($f, json_encode($d, JSON_PRETTY_PRINT)); }

$file = "../data/datauser.json";
$folderFoto = "../assets/image/user/";
if(!is_dir($folderFoto)) mkdir($folderFoto, 0777, true);
$aksi = $_GET['aksi'] ?? '';

if($aksi=='tambah'){
  if(!isset($_POST['username']) || empty(trim($_POST['username']))) die("<script>alert('Username wajib');history.back();</script>");
  $data = baca($file);
  $idBaru = empty($data) ? 1 : max(array_column($data,'id'))+1;

  $namaFoto='default.png';
  if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){
    $ext=strtolower(pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION));
    if(in_array($ext,['jpg','jpeg','png','webp','gif'])){
      $namaFoto="user_".$idBaru."_".time().".".$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'],$folderFoto.$namaFoto);
    }
  }

  $baru=[
    'id'=>$idBaru,
    'username'=>trim($_POST['username']),
    'password'=>trim($_POST['password']),
    'nama'=>trim($_POST['nama']),
    'role'=>$_POST['role'] ?? 'user',
    'email'=>trim($_POST['email'] ?? ''), // opsional, biar tidak error
    'foto'=>$namaFoto,
    'tanggal_buat'=>date('Y-m-d H:i:s')
  ];
  $data[]=$baru; tulis($file,$data);
  header("Location: ../index.php?halaman=user");
  exit;
}

if($aksi=='edit'){
  $data=baca($file);
  foreach($data as &$row){
    if($row['id']==$_POST['id']){
      if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){
        $ext=strtolower(pathinfo($_FILES['foto']['name'],PATHINFO_EXTENSION));
        if(in_array($ext,['jpg','jpeg','png','webp','gif'])){
          if(($row['foto'] ?? 'default.png')!='default.png' && file_exists($folderFoto.($row['foto'] ?? ''))) unlink($folderFoto.$row['foto']);
          $namaFoto="user_".$row['id']."_".time().".".$ext;
          move_uploaded_file($_FILES['foto']['tmp_name'],$folderFoto.$namaFoto);
          $row['foto']=$namaFoto;
        }
      }
      $row['username']=trim($_POST['username']);
      $row['password']=trim($_POST['password']);
      $row['nama']=trim($_POST['nama']);
      $row['role']=$_POST['role'] ?? $row['role'];
      $row['email']=trim($_POST['email'] ?? ($row['email'] ?? ''));
      break;
    }
  }
  tulis($file,$data);
  header("Location: ../index.php?halaman=user");
  exit;
}

if($aksi=='hapus'){
  $id=$_GET['id']??0;
  $data=baca($file);
  foreach($data as $r){ 
    $f = $r['foto'] ?? 'default.png';
    if($r['id']==$id && $f!='default.png' && file_exists($folderFoto.$f)) unlink($folderFoto.$f); 
  }
  $data=array_values(array_filter($data, fn($r)=>$r['id']!=$id));
  tulis($file,$data);
  header("Location: ../index.php?halaman=user");
  exit;
}
?>