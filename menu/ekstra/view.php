<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  $("#line").change(function(){
    var line = $("#line").val();
    $.ajax({
        url: "get_data.php",
        data: "line="+line,
        cache: false,
        success: function(msg){
            $("#detailline").html(msg);
        }
    });
  });
});

</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{

$aksi="menu/ekstra/do_act.php";
switch($_GET[act]){
  // Tampil defek
  default:
      echo "<h2>Data Defect</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=defek&act=tambahdefek';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Nama Defect</th><th>Spesifikasi</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM defect ORDER BY id_defect DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
		$l = mysql_fetch_array(mysql_query("select * from line where id_line='$r[id_line]'"));
       echo "<tr>
			 <td>$no</td>
             <td>$r[nm_defect]</td>
             <td>$l[spesifikasi]</td>
			 <td><a href='?menu=defek&act=editdefek&id=$r[id_defect]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=defek&act=hapus&id=$r[id_defect]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM defect"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahdefek":
    echo "<form method='POST' action='$aksi?menu=defek&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>Nama Defect</label></dt><dd><input type=text name='nama' size='40' maxlength='30'></dd>
          <dt><label>ID line</label></dt><dd>
		  <select name='line' id='line'>
			<option value='0'>-Pilih Line-</option>";
				$qry = mysql_query("select * from line order by nm_line");
				while($j = mysql_fetch_array($qry)){
					echo "<option value='$j[id_line]'>$j[nm_line]</option>";
				}
			echo "
			</select>
		  </dd>
		  <dt><label>Detail</label></dt><dd><div id='detailline'></div></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editdefek":
    $tampil = mysql_query("SELECT * FROM defect WHERE id_defect = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=defek&act=update'>
		  <input type='hidden' name='id' value='$r[id_defect]'>
          <fieldset>
          <legend>Edit Data</legend>
          <dl class='inline'>
          <dt><label>Nama Defect</label></dt><dd><input type=text name='nama' size='40' value='$r[nm_defect]'></dd>
          <dt><label>ID line</label></dt><dd>
		  <select name='line' id='line'>
			<option value='0'>-Pilih Line-</option>";
				$qry = mysql_query("select * from line order by nm_line");
				while($j = mysql_fetch_array($qry)){
					if ($r['id_line']==$j['id_line']){
					  echo "<option value=$j[id_line] selected>$j[nm_line]</option>";
					}
					else{
					  echo "<option value=$j[id_line]>$j[nm_line]</option>";
					}
				}
			echo "
			</select>
		  </dd>
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
