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

// Hapus customer
if ($menu=='customer' AND $act=='hapus'){
    mysql_query("DELETE FROM customer WHERE id_cust='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input customer
elseif ($menu=='customer' AND $act=='input'){
if(empty($_POST['id_cust']) || empty($_POST['nama']) || empty($_POST['alamat']) 
|| empty($_POST['tlp'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO customer(id_cust,
                                    nm_cust,
									alamat_cust,
									tlp_cust)
                            VALUES('$_POST[id_cust]','$_POST[nama]',
								   '$_POST[alamat]','$_POST[tlp]')");
  header('location:../../layout.php?menu='.$menu);
}
}

// Update customer
elseif ($menu=='customer' AND $act=='update'){
    mysql_query("UPDATE customer SET id_cust = '$_POST[id_cust]',
									 nm_cust = '$_POST[nama]',
									 alamat_cust = '$_POST[alamat]',
									 tlp_cust = '$_POST[tlp]'   
                             WHERE id_cust   = '$_POST[id]'");
  header('location:../../layout.php?menu='.$menu);
}
}
?>