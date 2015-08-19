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

// Hapus leader
if ($menu=='leader' AND $act=='hapus'){
    mysql_query("DELETE FROM lead_produksi WHERE id_lead='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input leader
elseif ($menu=='leader' AND $act=='input'){
if(empty($_POST['nama']) || empty($_POST['shift']) || empty($_POST['jam_kerja']) 
|| empty($_POST['line']) || empty($_POST['grup'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO lead_produksi(nm_lead,
									shift,
									jam_kerja,
									id_line,
									grup_shift)
                            VALUES('$_POST[nama]',
								   '$_POST[shift]',
								   '$_POST[jam_kerja]',
								   '$_POST[line]',
								   '$_POST[grup]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update leader
elseif ($menu=='leader' AND $act=='update'){
    mysql_query("UPDATE lead_produksi SET nm_lead		= '$_POST[nama]',
								   shift		= '$_POST[shift]',
								   jam_kerja	= '$_POST[jam_kerja]',
								   id_line		= '$_POST[line]',
								   grup_shift	= '$_POST[grup]'  
                             WHERE id_lead		= '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>