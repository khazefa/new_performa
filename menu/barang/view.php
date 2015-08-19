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
  $("#cust").change(function(){
    var cust = $("#cust").val();
    $.ajax({
        url: "get_data.php",
        data: "cust="+cust,
        cache: false,
        success: function(msg){
            $("#namacust").html(msg);
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

$aksi="menu/barang/do_act.php";
switch($_GET[act]){
  // Tampil barang
  default:
      echo "<h2>Data Barang</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=barang&act=tambahbarang';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>No Part</th><th>Nama Part</th><th>Customer</th><th>Satuan</th><th>Luas</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM barang ORDER BY no_part DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){    
		$c = mysql_fetch_array(mysql_query("select * from customer where id_cust='$r[id_cust]'"));   
       echo "<tr>
			 <td>$no</td>
             <td>$r[no_part]</td>
             <td>$r[nm_part]</td>
             <td>$c[nm_cust]</td>
             <td>$r[satuan]</td>
             <td>$r[luas]</td>
			 <td><a href='?menu=barang&act=editbarang&id=$r[no_part]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=barang&act=hapus&id=$r[no_part]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM barang"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahbarang":
    echo "<form method='POST' action='$aksi?menu=barang&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
		  <dt><label>No Part</label></dt><dd><input type=text name='nopart' size='40' maxlength='15'></dd>
          <dt><label>Nama Part</label></dt><dd><input type=text name='nama' size='40' maxlength='30'></dd>
          <dt><label>ID Customer</label></dt><dd>
		  <select name='cust' id='cust'>
			<option value='0'>-Pilih Customer-</option>";
				$qry = mysql_query("select * from customer order by nm_cust");
				while($j = mysql_fetch_array($qry)){
					echo "<option value='$j[id_cust]'>$j[nm_cust]</option>";
				}
			echo "
			</select>
		  </dd>
		  <dt><label>Detail</label></dt><dd><div id='namacust'></div></dd>
          <dt><label>Spesifikasi</label></dt><dd><input type=text name='spek' size='50' maxlength='30'></dd>
          <dt><label>Satuan</label></dt><dd><input type=text name='satuan' size='10' maxlength='15'></dd>
          <dt><label>Luas</label></dt><dd><input type=text name='luas' size='10'> dm2</dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editbarang":
    $tampil = mysql_query("SELECT * FROM barang WHERE no_part = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=barang&act=update'>
		  <input type='hidden' name='id' value='$r[no_part]'>
          <fieldset>
          <legend>Edit Data</legend>
                    <dl class='inline'>
          <dt><label>No Part</label></dt><dd><input type=text name='nama' size='40' value='$r[no_part]' readonly='readonly'></dd>
          <dt><label>Nama Part</label></dt><dd><input type=text name='nama' size='40' value='$r[nm_part]'></dd>
          <dt><label>ID Customer</label></dt><dd>
		  <select name='cust' id='cust'>
			<option value='0'>-Pilih Customer-</option>";
				$qry = mysql_query("select * from customer order by nm_cust");
				while($j = mysql_fetch_array($qry)){
					if ($r['id_cust']==$j['id_cust']){
					  echo "<option value=$j[id_cust] selected>$j[nm_cust]</option>";
					}
					else{
					  echo "<option value=$j[id_cust]>$j[nm_cust]</option>";
					}
				}
			echo "
			</select>
		  </dd>
          <dt><label>Spesifikasi</label></dt><dd><input type=text name='spek' size='50' value='$r[spesifikasi]'></dd>
          <dt><label>Satuan</label></dt><dd><input type=text name='satuan' size='10' value='$r[satuan]'></dd>
          <dt><label>Luas</label></dt><dd><input type=text name='luas' size='10' value='$r[luas]'> dm2</dd>
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