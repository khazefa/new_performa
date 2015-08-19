<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{
include "../../lib/koneksi.php";

$menu=$_GET['menu'];
$act=$_GET['act'];

// Hapus users
if ($menu=='users' AND $act=='hapus'){
    mysql_query("DELETE FROM users WHERE username='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input users
elseif ($menu=='users' AND $act=='input'){
if(empty($_POST['username']) || empty($_POST['nama']) || empty($_POST['email'])
 || empty($_POST['tlp']) || empty($_POST['akses']) || empty($_POST['blokir'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
	$pass=md5($_POST['password']);
    mysql_query("INSERT INTO users( username,
									password,
									nama_lengkap,
									email,
									no_telp,
									level,
									blokir)
                            VALUES('$_POST[username]',
								   '$pass',
								   '$_POST[nama]',
								   '$_POST[email]',
								   '$_POST[tlp]',
								   '$_POST[akses]',
								   '$_POST[blokir]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update users
elseif ($menu=='users' AND $act=='update'){
	$pass=md5($_POST['password']);
    mysql_query("UPDATE users SET password		= '$pass',
								  nama_lengkap	= '$_POST[nama]',
								  email			= '$_POST[email]',
								  no_telp		= '$_POST[tlp]',
								  level			= '$_POST[akses]',
								  blokir		= '$_POST[blokir]'   
                             WHERE username		= '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>