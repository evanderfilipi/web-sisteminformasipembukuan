<?php
include 'koneksi.php';

$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

if($bulan == "" || $tahun == "") {
header("location:laporan.php?pesan=kosong");
}
else {

$cekdata = mysql_query("SELECT * FROM rekening WHERE bulan = '$bulan' AND tahun = '$tahun'");
if(mysql_num_rows($cekdata) > 0) {
	$tampil = 1;
	header("location:laporan.php?tampilkan=$tampil&bulan=$bulan&tahun=$tahun");
} else {
	$tampil = 2;
	header("location:laporan.php?tampilkan=$tampil");
}
}

?>