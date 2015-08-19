<?php
session_start();
error_reporting(0);
include "timeout.php";

if($_SESSION[login]==1){
	if(!cek_login()){
		$_SESSION[login] = 0;
	}
}
if($_SESSION[login]==0){
  header('location:logout.php');
}
else{
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) AND $_SESSION['login']==0){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses Menu anda harus login.</div>";
}
else{

  include "lib/koneksi.php";
  include "lib/function_date_indo.php";
  include "lib/function_page.php";
  include "lib/function_date_combo.php";
  include "lib/function_settime.php";
  include "lib/function_oto.php";
  include "lib/config.php";
  
	$time=date("G");
	if ($time<12)
	{$status= "Selamat Pagi ";}
	else if ($time<15)
	{$status= "Selamat Siang ";}
	else if ($time<18)
	{$status= "Selamat Sore ";}
	else{$status= "Selamat Malam ";}
?>
<html>
<head>
<title><?php echo $judulweb;?></title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/pages.css">
<link rel="stylesheet" type="text/css" href="css/skins/gray.css" title="gray">

<link rel="alternate stylesheet" type="text/css" href="css/skins/orange.css" title="orange">
<link rel="alternate stylesheet" type="text/css" href="css/skins/red.css" title="red">
<link rel="alternate stylesheet" type="text/css" href="css/skins/green.css" title="green">
<link rel="alternate stylesheet" type="text/css" href="css/skins/purple.css" title="purple">
<link rel="alternate stylesheet" type="text/css" href="css/skins/yellow.css" title="yellow">
<link rel="alternate stylesheet" type="text/css" href="css/skins/black.css" title="black">
<link rel="alternate stylesheet" type="text/css" href="css/skins/blue.css" title="blue">

<link rel="stylesheet" type="text/css" href="css/superfish.css">
<link rel="stylesheet" type="text/css" href="css/uniform.default.css">
<link rel="stylesheet" type="text/css" href="css/jquery.wysiwyg.css">
<link rel="stylesheet" type="text/css" href="css/facebox.css">
<link rel="stylesheet" type="text/css" href="css/smoothness/jquery-ui-1.8.8.custom.css">

<script type="text/javascript" src="js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.8.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="js/jquery.uniform.min.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/Delicious_500.font.js"></script>
<script type="text/javascript" src="js/jquery.flot.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script type="text/javascript" src="js/clock.js"></script>

<script type="text/javascript" src="js/jquery.cookie.js"></script>
<script type="text/javascript" src="js/switcher.js"></script>

<link rel="shortcut icon" type="image/x-icon" href="images/logo.png">
<!--
<script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
		themes  : 'simple,advanced',
		languages : 'en',
		disk_cache : true,
		debug : false
});
</script>
<script language="javascript" type="text/javascript"
src="js/tinymcpuk/tiny_mce_src.js"></script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",
		theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
		theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
		theme_advanced_buttons3_add : "emotions,flash",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		apply_source_formatting : true
});
</script>
-->
<!-- /TinyMCE -->

</head>
<body onload="startclock()">
<header id="top">
	<div class="container_12 clearfix">
		<div id="logo" class="grid_5">
			<!-- replace with your website title or logo -->
			<a id="site-title" href="?menu=home"><span><?php echo $judulweb; ?></span><br><span><?php echo $namaweb; ?></span></a>
		</div>


		<div id="userinfo" class="grid_7">
			<?php
				echo "$status<a href='?menu=home'>$_SESSION[namalengkap]</a>";
			?>
		</div>
	</div>
</header>
<nav id="topmenu">
	<div class="container_12 clearfix">
		<div class="grid_12">
			<ul id="mainmenu" class="sf-menu">
				<li class="current"><a href="?menu=home">Beranda</a></li>
				<?php
				if($_SESSION['leveluser']=='admin'){
				echo "
				<li><a href='#'>Master</a>
					<ul>
						<li><a href='?menu=barang'>Data Barang</a></li>
						<li><a href='?menu=customer'>Data Customer</a></li>
						<li><a href='?menu=leader'>Data Leader</a></li>
						<li><a href='?menu=line'>Data Line</a></li>
					</ul>
				</li>
				<li><a href='#'>Transaksi</a>
				<ul>
					<li><a href='?menu=transaksi'>Input Performa</a></li>
				</ul>
				</li>
				<li><a href='#'>Ekstra</a>
					<ul>
						<li><a href='?menu=defek'>Data Kerusakan</a></li>
					</ul>
				</li>
				<li><a href='#'>Pengaturan</a>
					<ul>
						<li><a href='?menu=users'>Data Pengguna</a></li>
					</ul>
				</li>
				<li><a href='?menu=laporan'>Laporan</a></li>";
				}else{
				echo "
				<li><a href='#'>Pengaturan</a>
					<ul>
						<li><a href='?menu=ubahpassword'>Ubah Password</a></li>
					</ul>
				</li>			
				<li><a href='?menu=laporan'>Laporan</a></li>			
				";
				}
				?>
			</ul>
			<ul id="usermenu">				
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>

<section id="content">
	<section class="container_12 clearfix">
		<section id="main" class="grid_15">
			<article id="dashboard">
                <?php 
				if($_SESSION['leveluser']=='admin'){
					include "content.php";
				}else{
					include "content_users.php";
				}
				?>
		    </article>
		</section>			
    </section>
</section> 


<footer id="bottom">
	<section class="container_12 clearfix">
		
		<div class="grid_7 alignright">
			Copyright &copy; 2014 <a href="#"><?php echo $namacomp; ?></a>
		</div>
	</section>
</footer>

</body>
</html>
<?php
}
}
?>