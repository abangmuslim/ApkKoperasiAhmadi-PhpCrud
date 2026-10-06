<?php
session_start();

function baca($f){ 
    return file_exists($f) ? (json_decode(file_get_contents($f),true) ?? []) : []; 
}
function tulis($f,$d){ 
    file_put_contents($f, json_encode($d, JSON_PRETTY_PRINT)); 
}
function validasi($post){
  $wajib=['nama_lengkap','tempat_lahir','tanggal_lahir','alamat','email','no_hp','sekolah','jurusan','skills','cita_cita'];
  foreach($wajib as $field){ 
    if(!isset($post[$field])) return "Field $field belum diset"; 
    if(empty(trim($post[$field]))) return "Field $field wajib diisi"; 
  }
  return true;
}

$aksi = $_GET['aksi'] ?? '';
$file = "../data/datapeserta.json";
$folderFoto = "../assets/image/peserta/";

// Pastikan folder foto ada
if(!is_dir($folderFoto)) mkdir($folderFoto, 0777, true);

// --- TAMBAH (Admin) & TAMBAH_PUBLIC (Registrasi Peserta) ---
if($aksi=='tambah' || $aksi=='tambah_public'){
  $cek=validasi($_POST); 
  if($cek!==true) die("<script>alert('$cek'); history.back();</script>");

  $data=baca($file); 
  $idBaru= empty($data) ? 1 : max(array_column($data,'id'))+1;

  // PROSES FOTO - disimpan sebagai string di JSON
  $namaFoto = 'default.png';
  if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){
    $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','webp'];
    if(in_array($ext, $allowed)){
      $namaFoto = "peserta_".$idBaru."_".time().".".$ext;
      move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$namaFoto);
    }
  }

  $skills=array_map('trim', explode(',', $_POST['skills']));
  $baru=[
    'id'=>$idBaru,
    'nama_lengkap'=>$_POST['nama_lengkap'],
    'tempat_lahir'=>$_POST['tempat_lahir'],
    'tanggal_lahir'=>$_POST['tanggal_lahir'],
    'alamat'=>$_POST['alamat'],
    'email'=>$_POST['email'],
    'no_hp'=>$_POST['no_hp'],
    'sekolah'=>$_POST['sekolah'],
    'jurusan'=>$_POST['jurusan'],
    'skills'=>$skills,
    'cita_cita'=>$_POST['cita_cita'],
    'foto'=>$namaFoto, // <-- string nama file
    'tanggal_buat'=>date('Y-m-d H:i:s')
  ];

  $data[]=$baru; 
  tulis($file,$data);

  if($aksi=='tambah_public'){ 
    header("Location: ../index.php?halaman=lihatcv&id=$idBaru"); 
  } else { 
    header("Location: ../index.php?halaman=cvdigital"); 
  } 
  exit;
}

// --- EDIT ---
if($aksi=='edit'){
  $cek=validasi($_POST); 
  if($cek!==true) die("<script>alert('$cek'); history.back();</script>");

  $data=baca($file); 
  $skills=array_map('trim', explode(',', $_POST['skills']));

  foreach($data as &$row){ 
    if($row['id']==$_POST['id']){ 
      // Jika ada foto baru diupload
      if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif','webp'];
        if(in_array($ext, $allowed)){
          // hapus foto lama jika bukan default
          if(isset($row['foto']) && $row['foto']!='default.png' && file_exists($folderFoto.$row['foto'])){
            unlink($folderFoto.$row['foto']);
          }
          $namaFotoBaru = "peserta_".$row['id']."_".time().".".$ext;
          move_uploaded_file($_FILES['foto']['tmp_name'], $folderFoto.$namaFotoBaru);
          $row['foto'] = $namaFotoBaru;
        }
      }

      $row['nama_lengkap']=$_POST['nama_lengkap']; 
      $row['tempat_lahir']=$_POST['tempat_lahir']; 
      $row['tanggal_lahir']=$_POST['tanggal_lahir']; 
      $row['alamat']=$_POST['alamat']; 
      $row['email']=$_POST['email']; 
      $row['no_hp']=$_POST['no_hp']; 
      $row['sekolah']=$_POST['sekolah']; 
      $row['jurusan']=$_POST['jurusan']; 
      $row['skills']=$skills; 
      $row['cita_cita']=$_POST['cita_cita']; 
      break; 
    } 
  }
  tulis($file,$data); 
  header("Location: ../index.php?halaman=cvdigital"); 
  exit;
}

// --- HAPUS ---
if($aksi=='hapus'){
  $id=$_GET['id']??0; 
  $data=baca($file); 

  // hapus file foto fisik
  foreach($data as $r){
    if($r['id']==$id && isset($r['foto']) && $r['foto']!='default.png'){
      if(file_exists($folderFoto.$r['foto'])) unlink($folderFoto.$r['foto']);
    }
  }

  $data=array_values(array_filter($data, fn($r)=> $r['id']!=$id)); 
  tulis($file,$data); 
  header("Location: ../index.php?halaman=cvdigital"); 
  exit;
}
?>