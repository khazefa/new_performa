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

$aksi="menu/komentar/do_act.php";
switch($_GET[act]){
  // Tampil komentar
  default:
    echo "<form method='POST' action='$aksi?menu=komentar&act=input'>
          <fieldset>
          <legend>Hubungi Admin</legend>
		  <h3>Silahkan menghubungi admin pada formulir berikut.</h3>
          <dl class='inline'>
          <dt><label>Nama</label></dt><dd><input type=text name='nama' size='40' maxlength='30' value='$_SESSION[username]' readonly='readonly'></dd>
          <dt><label>Pesan</label></dt><dd><textarea name='pesan' cols='50' rows='10'></textarea></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
		  <hr>
		  <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=barang&act=tambahbarang';\"><br><br>
		  <table id='table1' class='gtable sortable'><thead>
          <tr><th>Nama</th><th>Pesan</th></tr></thead>";

			$tampil = mysql_query("SELECT * FROM komentar order by id_komentar desc limit 6");
		  
			$no = $posisi+1;
			while ($r=mysql_fetch_array($tampil)){ 
			   echo "<tr>
					 <td>$r[nama]</td>
					 <td>$r[pesan]</td>
					 </td>
					 </tr>";
			  $no++;
			  
			}
			echo "</table>
				  </div>
				  </fieldset>
				  </form>";
    break;

    case "editkomentar":
    $tampil = mysql_query("SELECT * FROM komentar WHERE no_part = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=komentar&act=update'>
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