<?php

class Paging{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['halaman'])){
	$posisi=0;
	$_GET['halaman']=1;
}
else{
	$posisi = ($_GET['halaman']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 (untuk admin)
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=1 class=nextprev><< First</a>
                    <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$prev class=nextprev>< Prev</a>";
}
else{ 
	$link_halaman .= "<span class=nextprev><< First</span><span class=nextprev>< Prev</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "<span class=nextprev>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$i class=current>$i</a>";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$i class=nextprev>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class=nextprev>...</span><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$jmlhalaman class=nextprev>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$next class=nextprev>Next ></a>
                     <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&halaman=$jmlhalaman class=nextprev>Last >></a> ";
}
else{
	$link_halaman .= "<span class=nextprev>Next ></span><span class=nextprev>Last >></span>";
}
return $link_halaman;
}
}

// class paging untuk halaman berita (menampilkan semua berita) 
class Paging2{
// Fungsi untuk mencek halaman dan posisi data
function cariPosisi($batas){
if(empty($_GET['productpage'])){
	$posisi=0;
	$_GET['productpage']=1;
}
else{
	$posisi = ($_GET['productpage']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=1 class=nextprev><< First</a>
                    <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$prev class=nextprev>< Prev</a>";
}
else{ 
	$link_halaman .= "<span class=nextprev><< First</span><span class=nextprev>< Prev</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "<span class=nextprev>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$i class=current>$i</a>";
  }
	  $angka .= " <span class=current><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$i class=nextprev>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? "<span class=nextprev>...</span><a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$jmlhalaman class=nextprev>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$next class=nextprev>Next ></a> 
                     <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&productpage=$jmlhalaman class=nextprev>Last >></a> ";
}
else{
	$link_halaman .= "<span class=nextprev>Next ></span><span class=nextprev>Last >></span>";
}
return $link_halaman;
}
}


// class paging untuk halaman kategori (menampilkan berita per kategori)
class Paging3{
function cariPosisi($batas){
if(empty($_GET['categorypage'])){
	$posisi=0;
	$_GET['categorypage']=1;
}
else{
	$posisi = ($_GET['categorypage']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=1 class=nextprev><< First</a> 
                    <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$prev class=nextprev>< Prev</a>";
}
else{ 
	$link_halaman .= "<span class=nextprev><< First</span><span class=nextprev>< Prev</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "<span class=nextprev>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$i class=current>$i</a>";
  }
	  $angka .= "<span class=current><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$i class=nextprev>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class=nextprev>...</span> <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$jmlhalaman class=nextprev>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$next class=nextprev>Next ></a> 
                     <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&categorypage=$jmlhalaman class=nextprev>Last >></a> ";
}
else{
	$link_halaman .= "<span class=nextprev>Next ></span><span class=nextprev> Last >></span>";
}
return $link_halaman;
}
}


// class paging untuk halaman merk (menampilkan semua merk) 
class Paging4{
function cariPosisi($batas){
if(empty($_GET['merckpage'])){
	$posisi=0;
	$_GET['merckpage']=1;
}
else{
	$posisi = ($_GET['merckpage']-1) * $batas;
}
return $posisi;
}

// Fungsi untuk menghitung total halaman
function jumlahHalaman($jmldata, $batas){
$jmlhalaman = ceil($jmldata/$batas);
return $jmlhalaman;
}

// Fungsi untuk link halaman 1,2,3 
function navHalaman($halaman_aktif, $jmlhalaman){
$link_halaman = "";

// Link ke halaman pertama (first) dan sebelumnya (prev)
if($halaman_aktif > 1){
	$prev = $halaman_aktif-1;
	$link_halaman .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=1 class=nextprev><< First</a> 
                    <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$prev class=nextprev>< Prev</a>";
}
else{ 
	$link_halaman .= "<span class=nextprev><< First</span><span class=nextprev>< Prev</span>";
}

// Link halaman 1,2,3, ...
$angka = ($halaman_aktif > 3 ? "<span class=nextprev>...</span>" : " "); 
for ($i=$halaman_aktif-2; $i<$halaman_aktif; $i++){
  if ($i < 1)
  	continue;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$i class=current>$i</a>";
  }
	  $angka .= "<span class=current><b>$halaman_aktif</b></span>";
	  
    for($i=$halaman_aktif+1; $i<($halaman_aktif+3); $i++){
    if($i > $jmlhalaman)
      break;
	  $angka .= "<a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$i class=nextprev>$i</a>";
    }
	  $angka .= ($halaman_aktif+2<$jmlhalaman ? " <span class=nextprev>...</span> <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$jmlhalaman class=nextprev>$jmlhalaman</a>" : " ");

$link_halaman .= "$angka";

// Link ke halaman berikutnya (Next) dan terakhir (Last) 
if($halaman_aktif < $jmlhalaman){
	$next = $halaman_aktif+1;
	$link_halaman .= " <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$next class=nextprev>Next ></a> 
                     <a href=$_SERVER[PHP_SELF]?menu=$_GET[menu]&id=$_GET[id]&merckpage=$jmlhalaman class=nextprev>Last >></a> ";
}
else{
	$link_halaman .= "<span class=nextprev>Next ></span><span class=nextprev> Last >></span>";
}
return $link_halaman;
}
}
?>
