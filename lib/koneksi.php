<?php
$server		= "localhost";
$username	= "root";
$password	= "secret";
$database	= "dbs_plating";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Error ".mysql_error());
mysql_select_db($database) or die("Error ".mysql_error());
?>
