<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{

$aksi="menu/line/do_act.php";
switch($_GET[act]){
  // Tampil line
  default:
      echo "<h2>Data Line</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=line&act=tambahline';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Nama Line</th><th>Satuan</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM line ORDER BY id_line DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr>
			 <td>$no</td>
             <td>$r[nm_line]</td>
             <td>$r[satuan]</td>
			 <td><a href='?menu=line&act=editline&id=$r[id_line]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=line&act=hapus&id=$r[id_line]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM line"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahline":
    echo "<form method='POST' action='$aksi?menu=line&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>Nama line</label></dt><dd><input type=text name='nama' size='40' maxlength='20'></dd>
          <dt><label>Spesifikasi line</label></dt><dd><textarea name='spek' cols='50' rows='5' maxlength='32'></textarea></dd>
          <dt><label>Satuan</label></dt><dd><input type=text name='satuan' size='40' maxlength='10'></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editline":
    $tampil = mysql_query("SELECT * FROM line WHERE id_line = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=line&act=update'>
		  <input type='hidden' name='id' value='$r[id_line]'>
          <fieldset>
          <legend>Edit Data</legend>
          <dl class='inline'>
          <dt><label>Nama line</label></dt><dd><input type=text name='nama' size='40' value='$r[nm_line]'></dd>
          <dt><label>Spesifikasi line</label></dt><dd><textarea name='spek' cols='50' rows='5'>$r[spesifikasi]</textarea></dd>
          <dt><label>Satuan</label></dt><dd><input type=text name='satuan' size='40' value='$r[satuan]'></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;
}
}
?>
