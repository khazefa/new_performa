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
							<a href="?menu=barang">
								<img src="images/eleganticons/barang.png" />
								<span>Barang</span>
							</a>
						</li>
						<li>
							<a href="?menu=customer">
								<img src="images/eleganticons/customer.png" />
								<span>Customer</span>
							</a>
						</li>
						<li>
							<a href="?menu=leader">
								<img src="images/eleganticons/lead.png" />
								<span>Leader</span>
							</a>
						</li>
						<li>
							<a href="?menu=transaksi">
								<img src="images/eleganticons/trans.png" />
								<span>Transaksi</span>
							</a>
						</li>
						<li>
							<a href="?menu=defek">
								<img src="images/eleganticons/config.png" />
								<span>Defect</span>
							</a>
						</li>
						<li>
							<a href="?menu=line">
								<img src="images/eleganticons/line.png" />
								<span>Line</span>
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
elseif ($_GET['menu']=='barang'){
    include "menu/barang/view.php";
}
elseif ($_GET['menu']=='customer'){
    include "menu/customer/view.php";
}
elseif ($_GET['menu']=='line'){
    include "menu/line/view.php";
}
elseif ($_GET['menu']=='leader'){
    include "menu/leader/view.php";
}
elseif ($_GET['menu']=='transaksi'){
    include "menu/transaksi/view.php";
}
elseif ($_GET['menu']=='defek'){
    include "menu/ekstra/view.php";
}
elseif ($_GET['menu']=='users'){
    include "menu/users/view.php";
}
elseif ($_GET['menu']=='laporan'){
    include "menu/laporan/view.php";
}
else{
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Halaman tidak ditemukan.</div>";
}
?>