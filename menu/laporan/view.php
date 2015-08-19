<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{
   echo "<h2>Laporan Transaksi</h2><hr>

          <form method=POST action='menu/laporan/cetaklaporan.php' target='_blank'>
		  <fieldset>
          <legend>Pilih periode laporan</legend>
          <table class='data'>
          <tr class='data'><td class='data'>Dari Tanggal</td><td class='data'> : ";        
          combotgl(1,31,'tgl_mulai',$tgl_skrg);
          combonamabln(1,12,'bln_mulai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_mulai',$thn_sekarang);

    echo "</td></tr>
          <tr class='data'><td class='data'>s/d Tanggal</td><td class='data'> : ";
          combotgl(1,31,'tgl_selesai',$tgl_skrg);
          combonamabln(1,12,'bln_selesai',$bln_sekarang);
          combothn(2000,$thn_sekarang,'thn_selesai',$thn_sekarang);

    echo "</td></tr>
          <tr class='data'><td class='data' colspan=2><input type=submit class='button' value=Cetak></td></tr>
          </table>
		  </fieldset>
          </form>";
}
?>
