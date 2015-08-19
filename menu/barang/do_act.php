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

// Hapus barang
if ($menu=='barang' AND $act=='hapus'){
    mysql_query("DELETE FROM barang WHERE no_part='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input barang
elseif ($menu=='barang' AND $act=='input'){
if(empty($_POST['nopart']) || empty($_POST['nama']) || empty($_POST['cust']) 
|| empty($_POST['spek']) || empty($_POST['satuan']) || empty($_POST['luas'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO barang(no_part,
									nm_part,
									id_cust,
									spesifikasi,
									satuan,
									luas)
                            VALUES('$_POST[nopart]',
								   '$_POST[nama]',
								   '$_POST[cust]',
								   '$_POST[spek]',
								   '$_POST[satuan]',
								   '$_POST[luas]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update barang
elseif ($menu=='barang' AND $act=='update'){
    mysql_query("UPDATE barang SET nm_part		= '$_POST[nama]',
								   id_cust		= '$_POST[cust]',
								   spesifikasi	= '$_POST[spek]',
								   satuan		= '$_POST[satuan]',
								   luas			= '$_POST[luas]'  
                             WHERE no_part		= '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>