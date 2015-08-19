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
<script type="text/javascript">

function setGrup()
{
var shift = document.getElementById("shift").value;
var nama = document.getElementById("nama").value;
var line = document.getElementById("line").value;
var selectIndex=document.getElementById("line").selectedIndex;
var lines = document.getElementById("line").options[selectIndex].text;

	document.getElementById("grup").value = shift+'/'+nama+'/'+lines;
}
</script>
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{

$aksi="menu/leader/do_act.php";
switch($_GET[act]){
  // Tampil leader
  default:
      echo "<h2>Data Leader</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=leader&act=tambahleader';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Nama Leader</th><th>Shift</th><th>Jam Kerja</th><th>Grup Shift</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM lead_produksi ORDER BY id_lead DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr>
			 <td>$no</td>
             <td>$r[nm_lead]</td>
             <td>$r[shift]</td>
             <td>$r[jam_kerja]</td>
             <td>$r[grup_shift]</td>
			 <td><a href='?menu=leader&act=editleader&id=$r[id_lead]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=leader&act=hapus&id=$r[id_lead]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM lead_produksi"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahleader":
    echo "<form method='POST' action='$aksi?menu=leader&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>Nama leader</label></dt><dd><input type=text name='nama' size='40' id='nama' maxlength='30'></dd>
          <dt><label>Shift</label></dt><dd><input type=text name='shift' size='10' id='shift'></dd>
          <dt><label>Jam Kerja</label></dt><dd><input type=text name='jam_kerja' size='30'></dd>
          <dt><label>ID line</label></dt><dd>
		  <select name='line' id='line' onchange='setGrup();'>
			<option value='0'>-Pilih Line-</option>";
				$qry = mysql_query("select * from line order by nm_line");
				while($j = mysql_fetch_array($qry)){
					echo "<option value='$j[id_line]'>$j[nm_line]</option>";
				}
			echo "
			</select>
		  </dd>
		  <dt><label>Detail</label></dt><dd><div id='detailline'></div></dd>
          <dt><label>Grup Shift</label></dt><dd><input type=text name='grup' id='grup' size='40' placeholder='1/Randy/N1' readonly='readonly'></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editleader":
    $tampil = mysql_query("SELECT * FROM lead_produksi WHERE id_lead = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=leader&act=update'>
		  <input type='hidden' name='id' value='$r[id_lead]'>
          <fieldset>
          <legend>Edit Data</legend>
                    <dl class='inline'>
          <dt><label>Nama leader</label></dt><dd><input type=text name='nama' id='nama' size='40' value='$r[nm_lead]'></dd>
          <dt><label>Shift</label></dt><dd><input type=text name='shift' id='shift' size='10' value='$r[shift]'></dd>
          <dt><label>Jam Kerja</label></dt><dd><input type=text name='jam_kerja' size='30' value='$r[jam_kerja]'></dd>
          <dt><label>ID line</label></dt><dd>
		  <select name='line' id='line' onchange='setGrup();'>
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
          <dt><label>Grup Shift</label></dt><dd><input type=text name='grup' id='grup' size='40' value='$r[grup_shift]' readonly='readonly'></dd>
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