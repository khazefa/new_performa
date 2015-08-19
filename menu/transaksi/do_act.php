<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{
include "../../lib/koneksi.php";
include "../../lib/function_settime.php";

$menu=$_GET['menu'];
$act=$_GET['act'];

// Hapus transaksi
if ($menu=='transaksi' AND $act=='hapus'){
    mysql_query("DELETE FROM transaksi WHERE no_trans='$_GET[id]'");    
  header('location:../../layout.php?menu='.$menu);
}

// Input transaksi
elseif ($menu=='transaksi' AND $act=='input'){
if(empty($_POST['tk']) || empty($_POST['ak']) || empty($_POST['aj']) || empty($_POST['s'])){
	echo "<script>alert('Harap isi data dengan lengkap.');window.location='javascript:history.go(-1)'</script>";
}else{
    mysql_query("INSERT INTO transaksi(no_trans,
                                    tgl_trans,
									id_lead,
									target_kerja,
									actual_kerja,
									efisiensi,
									jml_org,
									actual_jam,
									man_hour,
									stop_line)
                            VALUES('$_POST[no_trans]',
								   '$_POST[tanggal]',
								   '$_POST[lead]',
								   '$_POST[tk]',
								   '$_POST[ak]',
								   '$_POST[ef]',
								   '$_POST[jo]',
								   '$_POST[aj]',
								   '$_POST[mh]',
								   '$_POST[s]')") or die(mysql_error());
								   
	foreach ($_POST['rows'] as $key => $count ){
		$notrans = $_POST['notrans_'.$count];
		$nopart = $_POST['nopart_'.$count];
		$jt = $_POST['jt_'.$count];
		$ok = $_POST['ok_'.$count];
		$ng = $_POST['ng_'.$count];
		$defek = $_POST['defek_'.$count];
		
    mysql_query("INSERT INTO detail_trans(no_trans,
									no_part,
                                    jml_target,
									OK,
									NG,
									id_defect)
                            VALUES('$notrans',
								  '$nopart',
								   '$jt',
								   '$ok',
								   '$ng',
								   '$defek')") or die(mysql_error());
								   
	}
								   
  header('location:../../layout.php?menu='.$menu);
}
}
}
?>