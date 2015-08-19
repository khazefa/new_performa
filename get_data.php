<?php
session_start();
error_reporting(0);
include "lib/koneksi.php";

if(!empty($_GET['line'])){
$line = $_GET['line'];
$qry = mysql_query("SELECT * FROM line WHERE id_line='$line'");
$l   = mysql_fetch_array($qry);
echo "Spesifikasi: $l[spesifikasi]&nbsp; Satuan: $l[satuan]";
}

if(!empty($_GET['cust'])){
$cust = $_GET['cust'];
$qry1 = mysql_query("SELECT * FROM customer WHERE id_cust='$cust'");
$c   = mysql_fetch_array($qry1);
echo "Alamat Customer: $c[alamat_cust]";
}

$action=$_POST["action"];

if($action=="showparts"){
 $show=mysql_query("Select * from barang order by no_part desc");

 while($row=mysql_fetch_array($show)){
	echo "<option value='$row[no_part]'><b>$row[no_part] | $row[nm_part]</b></option>";
 }
}

if($action=="showdefek"){
	$qr = mysql_query("select d.id_defect,d.nm_defect,l.spesifikasi from defect d, line l where d.id_line=l.id_line");
	while($d = mysql_fetch_array($qr)){
		echo "<option value='$d[id_defect]'>$d[id_defect] | $d[nm_defect] | $d[spesifikasi]</option>";
	}
}
?>