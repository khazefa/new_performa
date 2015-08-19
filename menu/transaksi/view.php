<script>
function confirmdelete(delUrl) {
if (confirm("Anda yakin ingin menghapus?")) {
document.location = delUrl;
}
}
</script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
            var count = 0;
			var nomornya = document.getElementById("nomortrans").value;
            $("#add_btn").click(function(){
			
                count += 1;
				function showParts(){
				  $.ajax({
					type:"post",
					url:"get_data.php",
					data:"action=showparts",
					success:function(data){
						 $("#nopart_"+count).html(data);
					}
				  });
				}
				
				showParts();
				
				function showDefek(){
				  $.ajax({
					type:"post",
					url:"get_data.php",
					data:"action=showdefek",
					success:function(data){
						 $("#defek_"+count).html(data);
					}
				  });
				}
				
				showDefek();
								
                $('#container').append(
                           '<tr class="records">'
                         + '<td ><div id="'+count+'">' + count + '</div></td>'
                         + '<td><input id="notrans_' + count + '" name="notrans_' + count + '" type="text" size="15" value="'+ nomornya +'" readonly="readonly"></td>'
                         + '<td><select id="nopart_' + count + '" name="nopart_' + count + '"></select></td>'
                         + '<td><input id="jt_' + count + '" name="jt_' + count + '" type="text" size="5"></td>'
                         + '<td><input id="ok_' + count + '" name="ok_' + count + '" type="text" size="5"></td>'
                         + '<td><input id="ng_' + count + '" name="ng_' + count + '" type="text" size="5"></td>'
                         + '<td><select id="defek_' + count + '" name="defek_' + count + '"></select></td>'
                         + '<td><a class="remove_item button blue" href="#" >Hapus</a>'
                         + '<input id="rows_' + count + '" name="rows[]" value="'+ count +'" type="hidden"></td></tr>'
                    );
                });
 
                $(".remove_item").live('click', function (ev) {
                if (ev.type == 'click') {
                $(this).parents(".records").fadeOut();
                        $(this).parents(".records").remove();
            }
            });
        });
	</script>
	
	<script type="text/javascript">
		function calculateEfisiensi(t){

		var ef = document.getElementById("ef");
		var rege = /^[0-9]*$/;
		if ( rege.test(t.ak.value) && rege.test(t.tk.value) ) {
			var jml = (t.ak.value / t.tk.value)*100;
			ef.value = jml;
			}
		else {
			alert("Kesalahan inputan");
			}
		}
		
		function calculateManHour(m){

		var mh = document.getElementById("mh");
		var rege = /^[0-9]*$/;
		if ( rege.test(m.jo.value) && rege.test(m.aj.value) ) {
			var jml = m.jo.value * m.aj.value;
			mh.value = jml;
			}
		else {
			alert("Kesalahan inputan");
			}
		}
	</script>
	
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui/js/jquery-ui-1.8.11.custom.min.js"></script>        
<link rel="stylesheet" type="text/css" href="js/jquery-ui/css/ui-lightness/jquery-ui-1.8.11.custom.css" />   
<script type="text/javascript">
   jQuery.noConflict();
   jQuery(document).ready(function() {
      jQuery("#tglawal").datepicker({
         dateFormat: "yy-mm-dd",
         changeMonth: true,
         changeYear: true,
         yearRange: "-100:+0"
      });
      
      // Ubah nama singkat hari 
      jQuery("#tglawal").datepicker("option", "dayNamesMin", 
         [ "Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"] 
      );
      
      //  Ubah nama lengkap hari  
      jQuery("#tglawal").datepicker("option", "dayNames", 
         ["Minggu", "Senin", "Selasa", "Rabu", 
          "Kamis", "Jumat", "Sabtu"] 
      );
      
      // Ubah nama lengkap bulan
      jQuery("#tglawal").datepicker("option", "monthNamesShort",
         ["Jan","Feb","Mar","Apr","Mei","Jun","Jul",
          "Agu","Sep","Okt","Nov","Des"] 
      );
	  
      jQuery("#tglakhir").datepicker({
         dateFormat: "yy-mm-dd",
         changeMonth: true,
         changeYear: true,
         yearRange: "-100:+0"
      });
      
      // Ubah nama singkat hari 
      jQuery("#tglakhir").datepicker("option", "dayNamesMin", 
         [ "Mg", "Sn", "Sl", "Rb", "Km", "Jm", "Sb"] 
      );
      
      //  Ubah nama lengkap hari  
      jQuery("#tglakhir").datepicker("option", "dayNames", 
         ["Minggu", "Senin", "Selasa", "Rabu", 
          "Kamis", "Jumat", "Sabtu"] 
      );
      
      // Ubah nama lengkap bulan
      jQuery("#tglakhir").datepicker("option", "monthNamesShort",
         ["Jan","Feb","Mar","Apr","Mei","Jun","Jul",
          "Agu","Sep","Okt","Nov","Des"] 
      );
   });
</script>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{

$aksi="menu/transaksi/do_act.php";
switch($_GET[act]){
  // Tampil transaksi
  default:
      echo "<h2>Data Transaksi</h2><hr>
          <input type=button class='button gray' value='Input Data' onclick=\"window.location.href='?menu=transaksi&act=tambahtransaksi';\">
		  <span style='float:right;'>
		  <form method='post' action='?menu=transaksi'>
		  <fieldset>
			<legend>Filter Pencarian</legend>
			Tanggal Awal: <input type='text' name='tgl_awal' id='tglawal'><br>
			Tanggal Akhir: <input type='text' name='tgl_akhir' id='tglakhir'><br>
			<input type='submit' value='Cari'>
		  </fieldset>
		  </form>
		  </span>
		  <br><br>";
      echo "<table id='table1' class='gtable sortable'><thead>
          <tr><th>No</th><th>No Transaksi</th><th>Tanggal</th><th>Leader</th><th>TK</th><th>AK</th><th>AJ</th><th>S</th><th>Aksi</th></tr></thead>";

if(empty($_POST['tgl_awal']) && empty($_POST['tgl_akhir'])){
    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM transaksi ORDER BY no_trans DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r['tgl_trans']);
		$l = mysql_fetch_array(mysql_query("select * from lead_produksi where id_lead='$r[id_lead]'"));
       echo "<tr>
			 <td>$no</td>
             <td>$r[no_trans]</td>
             <td>$tgl</td>
             <td>$l[nm_lead]</td>
             <td>$r[target_kerja]</td>
             <td>$r[actual_kerja]</td>
             <td>$r[actual_jam]</td>
             <td>$r[stop_line]</td>
			 <td><a href='?menu=transaksi&act=detailtransaksi&id=$r[no_trans]' title='Lihat Detail'><img src='images/icons/information-octagon.png' alt='Lihat Detail' /></a>
                 <!--<a href=javascript:confirmdelete('$aksi?menu=transaksi&act=hapus&id=$r[no_trans]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>-->
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM transaksi"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
}else{
    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

    $tampil = mysql_query("SELECT * FROM transaksi WHERE tgl_trans BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]' ORDER BY no_trans DESC LIMIT $posisi,$batas");
  
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl = tgl_indo($r['tgl_trans']);
		$l = mysql_fetch_array(mysql_query("select * from lead_produksi where id_lead='$r[id_lead]'"));
       echo "<tr>
			 <td>$no</td>
             <td>$r[no_trans]</td>
             <td>$tgl</td>
             <td>$l[nm_lead]</td>
             <td>$r[target_kerja]</td>
             <td>$r[actual_kerja]</td>
             <td>$r[actual_jam]</td>
             <td>$r[stop_line]</td>
			 <td><a href='?menu=transaksi&act=detailtransaksi&id=$r[no_trans]' title='Edit'><img src='images/icons/information-octagon.png' alt='Edit' /></a>
                 <!--<a href=javascript:confirmdelete('$aksi?menu=transaksi&act=hapus&id=$r[no_trans]') title='Hapus'><img src='images/icons/cross.png' alt='Delete' /></a>-->
             </tr>";
      $no++;
      
    }
    echo "</table>";
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM transaksi WHERE tgl_trans BETWEEN '$_POST[tgl_awal]' AND '$_POST[tgl_akhir]'"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
}
	echo "<div class=pages>$linkHalaman</div>";
	
	
    break;
    
    case "tambahtransaksi":
	$notrans = trans_id();
    echo "<form method='POST' action='$aksi?menu=transaksi&act=input'>
          <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>No Transaksi</label></dt><dd><input type=text name='no_trans' id='nomortrans' size='20' value='$notrans' readonly='readonly'></dd>
          <dt><label>Tanggal</label></dt><dd><input type='text' name='tanggal' id='tglawal'></dd>
          <dt><label>ID Leader</label></dt><dd>
		  <select name='lead' id='lead'>
			<option value='0'>-Pilih Leader-</option>";
				$qry = mysql_query("select * from lead_produksi");
				while($j = mysql_fetch_array($qry)){
					echo "<option value='$j[id_lead]'>$j[grup_shift]</option>";
				}
			echo "
			</select>
		  </dd>
          <dt><label>Target Kerja</label></dt><dd><input type='text' name='tk' id='tk' size='20'></dd>
          <dt><label>Aktual Kerja</label></dt><dd><input type='text' name='ak' id='ak' size='20' onkeyup=\"calculateEfisiensi(this.form)\"></dd>
          <dt><label>Efisiensi</label></dt><dd><input type='text' name='ef' id='ef' size='20'>%</dd>
          <dt><label>Jumlah Orang</label></dt><dd><input type='text' name='jo' id='jo' size='20'></dd>
          <dt><label>Aktual Jam</label></dt><dd><input type='text' name='aj' id='aj' size='20' onkeyup=\"calculateManHour(this.form)\"></dd>
          <dt><label>Man Hour</label></dt><dd><input type='text' name='mh' id='mh' size='20'></dd>
          <dt><label>Stop Line</label></dt><dd><input type='text' name='s' id='s' size='20'></dd>
          </dl>
		  <form id='id_form'>
			<fieldset>
				<legend>Data Detail Transaksi</legend>
				<table id='table1' class='gtable'><thead>
				<tr><td colspan='5'><input type='button' name='add_btn' value='Add' id='add_btn' class='button blue'></td></tr>
				<tr>
					<th>No</th><th>No Transaksi</th><th>No Part</th><th>Jml Target</th><th>OK</th><th>NG</th><th>ID Defect</th><th>Aksi</th>
				</tr>
				</thead>
				<tbody id='container'>
				</tbody>
				</table>
			</fieldset>
			</form>
          <div class='buttons'>
          <input class='button blue' type=submit value=Simpan>
          <input class='button blue' type=button value=Batal onclick=self.history.back()>
          </div>
          </fieldset>
		  </form>";
    break;

    case "detailtransaksi":
    $tampil = mysql_query("SELECT * FROM transaksi WHERE no_trans = '$_GET[id]'");
    $r = mysql_fetch_array($tampil);
	$tgl = tgl_indo($r['tgl_trans']);
	
	$l = mysql_fetch_array(mysql_query("select * from lead_produksi where id_lead='$r[id_lead]'"));
	echo "<form>
		  <fieldset>
          <legend>Input Data</legend>
          <dl class='inline'>
          <dt><label>No Transaksi</label></dt><dd>$r[no_trans]</dd>
          <dt><label>Tanggal</label></dt><dd>$tgl</dd>
          <dt><label>ID Leader</label></dt><dd>$l[nm_lead]</dd>
          <dt><label>Target Kerja</label></dt><dd>$r[target_kerja]</dd>
          <dt><label>Aktual Kerja</label></dt><dd>$r[actual_kerja]</dd>
          <dt><label>Efisiensi</label></dt><dd>$r[efisiensi]%</dd>
          <dt><label>Jumlah Orang</label></dt><dd>$r[jml_org]</dd>
          <dt><label>Aktual Jam</label></dt><dd>$r[actual_jam]</dd>
          <dt><label>Man Hour</label></dt><dd>$r[man_hour]</dd>
          <dt><label>Stop Line</label></dt><dd>$r[stop_line]</dd>
          </dl>
		  <fieldset>
			<legend>Detail Transaksi</legend>
			<table id='table1' class='gtable sortable'>
				<thead><tr><th>No Part</th><th>Jml Target</th><th>OK</th><th>NG</th><th>Jml Aktual</th><th>Nama Defect</th></tr></thead>
				<tbody>";
				$qr = mysql_query("select * from detail_trans where no_trans='$r[no_trans]'");
				while($d = mysql_fetch_array($qr)){
				$jmlaktual = $d['OK'] + $d['NG'];
				$df = mysql_fetch_array(mysql_query("select * from defect where id_defect='$d[id_defect]'"));
					echo "<tr><td>$d[no_part]</td><td>$d[jml_target]</td><td>$d[OK]</td><td>$d[NG]</td><td>$jmlaktual</td><td>$df[nm_defect]</td></tr>";
				}
				echo "
				</tbody>
			</table>
		  </fieldset>
          </fieldset>
		  </form>
		  ";
    break;
}
}
?>
