<?php
while (ob_get_level())
ob_end_clean();
header("Content-Encoding: None", true);

session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href=css/style.css rel=stylesheet type=text/css>";
  echo "<div class='error msg'>Untuk mengakses menu anda harus login.</div>";
}
else{	 
define('FPDF_FONTPATH','../../lib/fpdf/font/');
require('../../lib/fpdf/fpdf.php');
require('../../lib/koneksi.php');
require('../../lib/function_date_indo.php');
require('../../lib/function_settime.php');

$mulai=$_POST['thn_mulai'].'-'.$_POST['bln_mulai'].'-'.$_POST['tgl_mulai'];
$selesai=$_POST['thn_selesai'].'-'.$_POST['bln_selesai'].'-'.$_POST['tgl_selesai'];
$mulaiid=$_POST['tgl_mulai'].'-'.$_POST['bln_mulai'].'-'.$_POST['thn_mulai'];
$selesaiid=$_POST['tgl_selesai'].'-'.$_POST['bln_selesai'].'-'.$_POST['thn_selesai'];

	$tglmulai=tgl_indo($mulai);
	$tglselesai=tgl_indo($selesai);

$query = mysql_query("SELECT d.no_trans,l.grup_shift,t.tgl_trans,t.target_kerja,t.actual_kerja,t.efisiensi,t.jml_org,t.actual_jam,t.man_hour,t.stop_line,
							d.no_part,d.jml_target,d.OK,d.NG,df.nm_defect 
							FROM transaksi t,detail_trans d,lead_produksi l,defect df
							WHERE t.no_trans=d.no_trans 
							AND t.id_lead=l.id_lead
							AND d.id_defect=df.id_defect
							AND t.tgl_trans BETWEEN '$mulai' AND '$selesai'");

// Buat class PDF
class PDF extends FPDF
{
    // Buat fungsi untuk mengatur header halaman
    function Header()
    {
		$mulai=$_POST['thn_mulai'].'-'.$_POST['bln_mulai'].'-'.$_POST['tgl_mulai'];
		$selesai=$_POST['thn_selesai'].'-'.$_POST['bln_selesai'].'-'.$_POST['tgl_selesai'];
		$mulaiid=$_POST['tgl_mulai'].'-'.$_POST['bln_mulai'].'-'.$_POST['thn_mulai'];
		$selesaiid=$_POST['tgl_selesai'].'-'.$_POST['bln_selesai'].'-'.$_POST['thn_selesai'];

		$this->Image('../../images/logo.jpg',2,0.5);
        // Setting Font ('string family', 'string style', 'font size')
    	$this->SetFont('Arial','B',10);
        
        /* Cell : untuk menuliskan text kedalam cell
                  19  : menunjukan panjang Cell
                  0.7 : menunjukan tinggi cell
                  0   : yang pertama menunjukan Cell tanpa border, Isi 1 jika menginginkan Cell diberi border
                  0   : yang kedua menunjukan posisi text berikutnya disebelah kanan
                  C   : menunjukan text berada ditengah-tengah / Center
        */        
        $this->Ln(0.5);
        $this->SetFont('Arial','B',14);
        $this->Cell(0,0.5,'Sistem Informasi Pengolahan Data Produksi Plating',0,0,'C');
          
        // Line : untuk membuat garis              
        $this->Line(1,2.9,24,2.9);
        $this->Line(1,2.95,24,2.95);
        $this->Ln();
        $this->SetFont('Arial','B',9);
        $this->Cell(22,0.8,'Laporan Pengolahan Data Produksi Plating',0,0,'C');
		
        $this->Ln(1.2);
        $this->SetFont('Arial','',9);
        $this->Cell(3.2,0.5,'Periode',0,'LR', 'L');
        $this->Cell(7.9,0.5, ': '.$mulaiid ,0,'LR', 'L');
        
        $this->Ln();
        $this->Cell(3.2,0.5,'Sampai dengan',0,'LR', 'L');
        $this->Cell(7.9,0.5, ': '.$selesaiid,0,'LR', 'L');
    }
    
    // Buat fungsi untuk mengatur Footer halaman 
    function Footer()
    {		
		//atur posisi 1 cm dari bawah
		$this->SetY(-1);
		//buat garis horizontal
		$this->Line(0,$this->GetY(),200,$this->GetY());
		//Arial italic 9
		$this->SetFont('Arial','I',9);
		//nomor halaman
		$this->Cell(0,1,'Halaman '.$this->PageNo().' dari {nb}',0,0,'R');
    }
}

// Fungsi Konstruktor PDF
$pdf = new PDF("L","cm", array(22, 25));

// Fungsi untuk membuat halaman
$pdf->AddPage();

// Fungsi untuk setting margin halaman (kiri, atas, kanan)
$pdf->SetMargins(1,0.5,1);

$pdf->Ln();
$pdf->SetFont('Arial','',6);
//$pdf->Line(1   ,5.2,20,5.2);

$pdf->Cell(2.1,0.5,'N.F.',1,'LR', 'C');
$pdf->Cell(3,0.5,'KELOMPOK',1,'LR', 'L');
$pdf->Cell(2,0.5,'TGL.',1,'LR', 'L');
$pdf->Cell(1,0.5,'T.K.',1,'LR', 'C');
$pdf->Cell(1,0.5,'A.K.',1,'LR', 'C');
$pdf->Cell(1.5,0.5,'EFISIENSI',1,'LR', 'C');
$pdf->Cell(1.2,0.5,'JML ORG',1,'LR', 'C');
$pdf->Cell(1,0.5,'A.J.',1,'LR', 'C');
$pdf->Cell(1.5,0.5,'MAN HOUR',1,'LR', 'C');
$pdf->Cell(1,0.5,'S',1,'LR', 'C');
$pdf->Cell(2.5,0.5,'NO PART',1,'LR', 'C');
$pdf->Cell(1,0.5,'J.T.',1,'LR', 'C');
$pdf->Cell(1,0.5,'OK',1,'LR', 'C');
$pdf->Cell(1,0.5,'NG',1,'LR', 'C');
$pdf->Cell(1,0.5,'J.A.',1,'LR', 'C');
$pdf->Cell(2,0.5,'Defect',1,'LR', 'C');

//$pdf->Line(1   ,5.7, 20, 5.7);

// hasil query disini
$i          = 1;
$total		= mysql_num_rows($query);
while($data = mysql_fetch_object($query))
{  
	$jmlaktual = $data->OK + $data->NG;
    $pdf->Ln();
    $pdf->SetFont('Arial','',6);	
	$pdf->Cell(2.1,0.5,$data->no_trans,1,'LR', 'C');
	$pdf->Cell(3,0.5,$data->grup_shift,1,'LR', 'L');
	$pdf->Cell(2,0.5,$data->tgl_trans,1,'LR', 'L');
	$pdf->Cell(1,0.5,$data->target_kerja,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->actual_kerja,1,'LR', 'C');
	$pdf->Cell(1.5,0.5,$data->efisiensi.'%',1,'LR', 'C');
	$pdf->Cell(1.2,0.5,$data->jml_org,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->actual_jam,1,'LR', 'C');
	$pdf->Cell(1.5,0.5,$data->man_hour,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->stop_line,1,'LR', 'C');
	$pdf->Cell(2.5,0.5,$data->no_part,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->jml_target,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->OK,1,'LR', 'C');
	$pdf->Cell(1,0.5,$data->NG,1,'LR', 'C');
	$pdf->Cell(1,0.5,$jmlaktual,1,'LR', 'C');
	$pdf->Cell(2,0.5,$data->nm_defect,1,'LR', 'C');
    $i++;
}
$pdf->Ln(0.5);
$pdf->Cell(0 ,0.6,'Total Data: '.$total , 0,'LR', 'L');
$pdf->Ln(1);

$tgl=tgl_indo(date('Y-m-d'));

$pdf->Cell(0 ,0.6, 'Cikarang, '.$tgl , 0,'LR', 'R');
$pdf->Ln();
$pdf->Cell(22 ,0.3,'Staff',0,'LR', 'R');

$pdf->Ln(1);

$pdf->Ln();
$pdf->Cell(23.2 ,0.3,'(--------------------------------)',0,'LR', 'R');

// Generate PDF
$pdf->Output("Laporan Per tanggal:".$mulaiid." - ".$selesaiid, "I");
}
?>