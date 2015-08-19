<script>
function confirmdelete(delUrl) {
	if (confirm("Anda yakin ingin menghapus?")) {
	document.location = delUrl;
	}
}

function angka(e) {
   if (!/^[0-9]+$/.test(e.value)) {
      e.value = e.value.substring(0,e.value.length-1);
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

$aksi="menu/users/do_act.php";
switch($_GET[act]){
  // Tampil users
  default:
      echo "<h2>Data Users</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=users&act=tambahusers';\"><br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>Username</th><th>Nama Lengkap</th><th>No Tlp</th><th>Level</th><th>Disable</th><th>Aksi</th></tr></thead>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM users ORDER BY username DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){       
       echo "<tr>
			 <td>$no</td>
             <td>$r[username]</td>
             <td>$r[nama_lengkap]</td>
             <td>$r[no_telp]</td>
             <td>$r[level]</td>
             <td>$r[blokir]</td>
			 <td><a href='?menu=users&act=editusers&id=$r[username]' title='Edit'><img src='images/icons/edit.png' alt='Edit' /></a>
                 <a href=javascript:confirmdelete('$aksi?menu=users&act=hapus&id=$r[username]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM users"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
	echo "<div class=pages>$linkHalaman</div>";
    break;
    
    case "tambahusers":
    echo "<form method='POST' action='$aksi?menu=users&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>Username</label></dt><dd><input type=text name='username' size='20'></dd>
          <dt><label>Password</label></dt><dd><input type=password name='password' size='20'></dd>
          <dt><label>Nama Lengkap</label></dt><dd><input type=text name='nama' size='40'></dd>
          <dt><label>Email</label></dt><dd><input type=email name='email' size='40' placeholder='isi email yang valid' required></dd>
          <dt><label>No Telepon</label></dt><dd><input type=number name='tlp' size='40' placeholder='input hanya angka' required></dd>
          <dt><label>Hak Akses</label></dt><dd><select name='akses'>
												<option value='admin'>Administrator</option>
												<option value='user'>Staff</option>
											   </select></dd>
          <dt><label>Disable</label></dt><dd><input type=radio name='blokir' value='Y'>Ya &nbsp;<input type=radio name='blokir' value='N'>Tidak</dd>
          </dl>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "editusers":
    $tampil = mysql_query("SELECT * FROM users WHERE username = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=users&act=update'>
		  <input type='hidden' name='id' value='$r[username]'>
          <fieldset>
          <legend>Edit Data</legend>
          <dl class='inline'>
          <dt><label>Username</label></dt><dd><input type=text name='username' size='20' value='$r[username]' readonly='readonly'></dd>
          <dt><label>Ubah Password</label></dt><dd><input type=password name='password' size='20' value='$r[password]'></dd>
          <dt><label>Nama Lengkap</label></dt><dd><input type=text name='nama' size='40' value='$r[nama_lengkap]'></dd>
          <dt><label>Email</label></dt><dd><input type=email name='email' size='40' value='$r[email]' placeholder='isi email yang valid' required></dd>
          <dt><label>No Telepon</label></dt><dd><input type=number name='tlp' size='40' value='$r[no_telp]' placeholder='input hanya angka' required></dd>
          <dt><label>Hak Akses</label></dt><dd>
		  <select name='akses'>";
		  if($r['level']=='admin'){
			echo "
				<option value='admin' selected>Administrator</option>
				<option value='user'>Staff</option>
			";
		  }else{
			echo "
				<option value='admin'>Administrator</option>
				<option value='user' selected>Staff</option>
			";
		  }
			echo "
		  </select></dd>
          <dt><label>Disable</label></dt><dd>";
		  if($r['blokir']=='Y'){
		  echo "
			<input type=radio name='blokir' value='Y' checked>Ya
			<input type=radio name='blokir' value='N'>Tidak
		  ";
		  }else{
		  echo "
			<input type=radio name='blokir' value='Y'>Ya
			<input type=radio name='blokir' value='N' checked>Tidak
		  ";
		  }
		  echo "
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
