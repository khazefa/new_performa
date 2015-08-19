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

// Hapus defect
if ($menu=='defek' AND $act=='hapus'){
    mysql_query("DELETE FROM defect WHERE id_defect='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input defect
elseif ($menu=='defek' AND $act=='input'){
if(empty($_POST['nama']) || empty($_POST['line'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO defect(nm_defect,
									id_line)
                            VALUES('$_POST[nama]',
								   '$_POST[line]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update defect
elseif ($menu=='defek' AND $act=='update'){
    mysql_query("UPDATE defect SET nm_defect	= '$_POST[nama]',
								   id_line		= '$_POST[line]',   
                             WHERE id_defect	= '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>