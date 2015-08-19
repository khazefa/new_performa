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

$aksi="menu/customer/do_act.php";
switch($_GET[act]){
  // Tampil customer
  default:
      echo "<h2>Data Customer</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=customer&act=tambahcustomer';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>ID Customer</th><th>Nama Lengkap</th><th>No Tlp</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM customer ORDER BY id_cust DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr>
			 <td>$no</td>
             <td>$r[id_cust]</td>
             <td>$r[nm_cust]</td>
             <td>$r[tlp_cust]</td>
			 <td><a href='?menu=customer&act=editcustomer&id=$r[id_cust]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=customer&act=hapus&id=$r[id_cust]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM customer"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahcustomer":
    echo "<form method='POST' action='$aksi?menu=customer&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>ID Customer</label></dt><dd><input type=text name='id_cust' size='10' maxlength='5'></dd>
          <dt><label>Nama Customer</label></dt><dd><input type=text name='nama' size='40' maxlength='30'></dd>
          <dt><label>Alamat Customer</label></dt><dd><textarea name='alamat' cols='50' rows='5'></textarea></dd>
          <dt><label>Tlp Customer</label></dt><dd><input type=number name='tlp' size='40' maxlength='15' placeholder='input hanya angka' required></dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editcustomer":
    $tampil = mysql_query("SELECT * FROM customer WHERE id_cust = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=customer&act=update'>
		  <input type='hidden' name='id' value='$r[id_cust]'>
          <fieldset>
          <legend>Edit Data</legend>
          <dl class='inline'>
          <dt><label>ID Customer</label></dt><dd><input type=text name='id_cust' size='10' value='$r[id_cust]' readonly='readonly'></dd>
          <dt><label>Nama Customer</label></dt><dd><input type=text name='nama' size='40' value='$r[nm_cust]'></dd>
          <dt><label>Alamat Customer</label></dt><dd><textarea name='alamat' cols='50' rows='5'>$r[alamat_cust]</textarea></dd>
          <dt><label>Tlp Customer</label></dt><dd><input type=number name='tlp' size='40' value='$r[tlp_cust]' placeholder='input hanya angka' required></dd>
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
