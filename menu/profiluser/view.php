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

$aksi="menu/profiluser/do_act.php";
switch($_GET[act]){
  default:
    $tampil = mysql_query("SELECT * FROM users WHERE username = '$_SESSION[username]'");
    $r = mysql_fetch_array($tampil);
	echo "<form method=POST action='$aksi?menu=ubahpassword&act=update'>
		  <input type='hidden' name='id' value='$r[username]'>
          <fieldset>
          <legend>Edit Data</legend>
          <dl class='inline'>
          <dt><label>Username</label></dt><dd><input type=text name='username' size='20' value='$r[username]' readonly='readonly'></dd>
          <dt><label>Password Saat Ini</label></dt><dd><input type=password name='password' size='20' value='$r[password]'></dd>
          <dt><label>Ubah Password</label></dt><dd><input type=password name='password_new' size='20'></dd>
          <dt><label>Nama Lengkap</label></dt><dd><input type=text name='nama' size='40' value='$r[nama_lengkap]'></dd>
          <dt><label>Email</label></dt><dd><input type=text name='email' size='40' value='$r[email]'></dd>
          <dt><label>No Telepon</label></dt><dd><input type=text name='tlp' size='40' value='$r[no_telp]'></dd>
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
