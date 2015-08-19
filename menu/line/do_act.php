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

// Hapus line
if ($menu=='line' AND $act=='hapus'){
    mysql_query("DELETE FROM line WHERE id_line='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input line
elseif ($menu=='line' AND $act=='input'){
if(empty($_POST['nama']) || empty($_POST['spek']) || empty($_POST['satuan'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO line(  nm_line,
									spesifikasi,
									satuan)
                            VALUES('$_POST[nama]',
								   '$_POST[spek]','$_POST[satuan]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update line
elseif ($menu=='line' AND $act=='update'){
    mysql_query("UPDATE line SET nm_line	 = '$_POST[nama]',
								 spesifikasi = '$_POST[spek]',
								 satuan		 = '$_POST[satuan]'   
                             WHERE id_line   = '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>