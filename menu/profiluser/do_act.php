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
// Update users
if ($menu=='ubahpassword' AND $act=='update'){
	$pass=md5($_POST['password_new']);
    mysql_query("UPDATE users SET password		= '$pass',
								  nama_lengkap	= '$_POST[nama]',
								  email			= '$_POST[email]',
								  no_telp		= '$_POST[tlp]'  
                             WHERE username		= '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>