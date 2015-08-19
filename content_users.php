<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
<?php
// Bagian Home
if ($_GET['menu']=='home'){
  echo "<p><b>$_SESSION[namalengkap]</b>, Selamat datang di Control Panel $namaweb.<br>
          Silahkan klik menu pilihan untuk mengakses Control Panel.</p>";
          ?>
         <h2>Control Panel</h2>
				<section class="icons">
					<ul>
						<li>
							<a href="?menu=home">
								<img src="images/eleganticons/home.png" />
								<span>Home</span>
							</a>
						</li>				
						<li>
							<a href="?menu=ubahpassword">
								<img src="images/eleganticons/config.png" />
								<span>Akun Saya</span>
							</a>
						</li>
						<li>
							<a href="?menu=komentar">
								<img src="images/eleganticons/kontak.png" />
								<span>Tanya Jawab</span>
							</a>
						</li>						
						<li>
							<a href="logout.php">
								<img src="images/eleganticons/x.png" />
								<span>Logout</span>
							</a>
						</li>
					</ul>
                                </section>
  <?php
  echo "<p align=right>Login : $hari_ini,
  <span id='date'>".tgl_indo(date("Y m d"))."</span> | <span id='clock'>$jam_sekarang</span></p>";
}
elseif ($_GET['menu']=='laporan'){
    include "menu/laporan/view.php";
}
elseif ($_GET['menu']=='ubahpassword'){
    include "menu/profiluser/view.php";
}
elseif ($_GET['menu']=='komentar'){
    include "menu/komentar/view.php";
}

else{
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Halaman tidak ditemukan.</div>";
}
?>