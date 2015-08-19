<?php
include "koneksi.php";

$nama=$_POST[nama];
$komentar=$_POST[komentar];

$simpan=mysql_query("insert into komentar () values ('','$nama','$komentar')");

if ($simpan)
{
echo"Data Berhasil Di Simpan";
}
else
{
echo"Data Gagal Di Simpan";
}
?>