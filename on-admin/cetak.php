<?php
session_start();
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'admin' ) ) {
	header('location:./../login.php');
	exit();
}
	
include 'koneksi.php';
$bulan = $_GET['bulan'];
$tahun = $_GET['tahun'];

require('phpfpdf/fpdf.php');

class PDF extends FPDF
{

function Footer()
{
	$this->SetY(-15);
	$this->SetFont('Arial','',9);
	$this->Cell(0,10,$this->PageNo(),0,0,'C');
}

}

$tulisan = "Laporan Neraca dan Laba Rugi pada bulan $bulan tahun $tahun";
$text1 = "Tabel Neraca";
$text2 = "Tabel Laba Rugi";

$kdgrup1 = "1";
$kode_rek1 = "";
$saldo1 = "";
$keterangan1 = "";
$totalharta = "";

$kdgrup2 = "2";
$kode_rek2 = "";
$saldo2 = "";
$keterangan2 = "";
$kdgrup3 = "3";
$kode_rek3 = "";
$saldo3 = "";
$keterangan3 = "";
$total1 = "";
$total2 = "";
$totalkewajiban = "";

$kdgrup4 = "4";
$kode_rek4 = "";
$saldo4 = "";
$keterangan4 = "";
$totalpendapatan = "";

$kdgrup5 = "5";
$kode_rek5 = "";
$saldo5 = "";
$keterangan5 = "";
$totalbiaya = "";

$pdf = new PDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetMargins(15,15,15);

$pdf->Image('img/komp.jpg',20,10,30);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(40);
$pdf->Cell(140,9,'LAPORAN NERACA DAN LABA RUGI',0,1,'C');
$pdf->SetFont('Arial','B',18);
$pdf->Cell(37);
$pdf->Cell(140,8,'BULANAN',0,1,'C');
$pdf->SetFont('Arial','B',30);
$pdf->Cell(35);
$pdf->Cell(140,14,'PANGSIT PELITA',0,1,'C');
$pdf->Ln(10);
$pdf->SetLineWidth(0.2);
$pdf->Line(15,44,195,44);
$pdf->SetLineWidth(0.7);
$pdf->Line(15,45,195,45);

$pdf->SetLineWidth(0.3);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(180,7,$tulisan,0,1,'C');
$pdf->Cell(10,10,'',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,4,$text1,0,1,'C');
$pdf->Cell(3,3,'',0,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'Kode Rekening',1,0,'C');
$pdf->Cell(71,7,'Keterangan',1,0,'C');
$pdf->Cell(37,7,'Saldo',1,0,'C');
$pdf->Cell(37,7,'Total',1,1,'C');

$pdf->SetFont('Arial','B',11);
$query_mysql = mysql_query("SELECT SUM(debet) AS totaldeb FROM rekening WHERE kode_grup='$kdgrup1' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data = mysql_fetch_array($query_mysql)){
	$totalharta = $data['totaldeb'];
}
$pdf->Cell(35,7,'1',1,0);
$pdf->Cell(71,7,'Harta',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,'',1,1);

$pdf->SetFont('Arial','',11);
$query_mysql2 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup1' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data2 = mysql_fetch_array($query_mysql2)){
	$d1 = $data2['debet'];
	$pdf->Cell(35,7,$data2['kode_rekening'],1,0);
	$pdf->Cell(71,7,$data2['keterangan'],1,0);
	$pdf->Cell(37,7,"Rp. $d1",1,0);
	$pdf->Cell(37,7,'',1,1);
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'',1,0);
$pdf->Cell(71,7,'Total Harta',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,"Rp. $totalharta",1,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'---',1,0,'C');
$pdf->Cell(71,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,1,'C');

$query_mysql3 = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup2' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data3 = mysql_fetch_array($query_mysql3)){
	$total1 = $data3['totalkred'];
}
$query_mysql33 = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup3' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data33 = mysql_fetch_array($query_mysql33)){
	$total2 = $data33['totalkred'];
}
$totalkewajiban = $total1 + $total2;

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'2',1,0);
$pdf->Cell(71,7,'Kewajiban',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,'',1,1);

$pdf->SetFont('Arial','',11);
$query_mysql4 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup2' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data4 = mysql_fetch_array($query_mysql4)){
	$d2 = $data4['kredit'];
	$pdf->Cell(35,7,$data4['kode_rekening'],1,0);
	$pdf->Cell(71,7,$data4['keterangan'],1,0);
	$pdf->Cell(37,7,"Rp. $d2",1,0);
	$pdf->Cell(37,7,'',1,1);
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'3',1,0);
$pdf->Cell(71,7,'Modal',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,'',1,1);

$pdf->SetFont('Arial','',11);
$query_mysql5 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup3' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($data5 = mysql_fetch_array($query_mysql5)){
	$d3 = $data5['kredit'];
	$pdf->Cell(35,7,$data5['kode_rekening'],1,0);
	$pdf->Cell(71,7,$data5['keterangan'],1,0);
	$pdf->Cell(37,7,"Rp. $d3",1,0);
	$pdf->Cell(37,7,'',1,1);
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'',1,0);
$pdf->Cell(71,7,'Total Kewajiban',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,"Rp. $totalkewajiban",1,1);

$pdf->Cell(10,10,'',0,1);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(180,4,$text2,0,1,'C');
$pdf->Cell(3,3,'',0,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'Kode Rekening',1,0,'C');
$pdf->Cell(71,7,'Keterangan',1,0,'C');
$pdf->Cell(37,7,'Saldo',1,0,'C');
$pdf->Cell(37,7,'Total',1,1,'C');

$query_mysqla = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup4' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($row = mysql_fetch_array($query_mysqla)){
	$totalpendapatan = $row['totalkred'];
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'4',1,0);
$pdf->Cell(71,7,'Pendapatan',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,'',1,1);

$pdf->SetFont('Arial','',11);
$query_mysqlb = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup4' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($row2 = mysql_fetch_array($query_mysqlb)){
	$d4 = $row2['kredit'];
	$pdf->Cell(35,7,$row2['kode_rekening'],1,0);
	$pdf->Cell(71,7,$row2['keterangan'],1,0);
	$pdf->Cell(37,7,"Rp. $d4",1,0);
	$pdf->Cell(37,7,'',1,1);
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'',1,0);
$pdf->Cell(71,7,'Jumlah Seluruh Pendapatan',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,"Rp. $totalpendapatan",1,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'---',1,0,'C');
$pdf->Cell(71,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,1,'C');

$query_mysqlc = mysql_query("SELECT SUM(debet) AS totaldeb FROM rekening WHERE kode_grup='$kdgrup5' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($row3 = mysql_fetch_array($query_mysqlc)){
	$totalbiaya = $row3['totaldeb'];
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'5',1,0);
$pdf->Cell(71,7,'Biaya',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,'',1,1);

$pdf->SetFont('Arial','',11);
$query_mysqld = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup5' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
while($row4 = mysql_fetch_array($query_mysqld)){
	$d5 = $row4['debet'];
	$pdf->Cell(35,7,$row4['kode_rekening'],1,0);
	$pdf->Cell(71,7,$row4['keterangan'],1,0);
	$pdf->Cell(37,7,"Rp. $d5",1,0);
	$pdf->Cell(37,7,'',1,1);
}

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'',1,0);
$pdf->Cell(71,7,'Jumlah Seluruh Biaya',1,0);
$pdf->Cell(37,7,'',1,0);
$pdf->Cell(37,7,"Rp. $totalbiaya",1,1);

$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'---',1,0,'C');
$pdf->Cell(71,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,0,'C');
$pdf->Cell(37,7,'---',1,1,'C');

$laba = $totalpendapatan - $totalbiaya;
$pdf->SetFont('Arial','B',11);
$pdf->Cell(35,7,'',1,0);
$pdf->Cell(71,7,'Pendapatan - Biaya',1,0);
$pdf->Cell(37,7,'Laba',1,0);
$pdf->Cell(37,7,"Rp. $laba",1,1);

$pdf->SetAuthor('PANGSIT PELITA');
ob_end_clean();
$pdf->Output();
	
?>


<!-- Created and Modified by EVANDER -->