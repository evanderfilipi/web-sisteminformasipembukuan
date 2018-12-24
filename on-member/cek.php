<?php
include 'koneksi.php';


$gruprekening = $_POST['kode_grup'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$kd_bln = "";
if($bulan == "Januari"){
	$kd_bln = "01";
} else if ($bulan == "Februari"){
	$kd_bln = "02";
} else if ($bulan == "Maret"){
	$kd_bln = "03";
} else if ($bulan == "April"){
	$kd_bln = "04";
} else if ($bulan == "Mei"){
	$kd_bln = "05";
} else if ($bulan == "Juni"){
	$kd_bln = "06";
} else if ($bulan == "Juli"){
	$kd_bln = "07";
} else if ($bulan == "Agustus"){
	$kd_bln = "08";
} else if ($bulan == "September"){
	$kd_bln = "09";
} else if ($bulan == "Oktober"){
	$kd_bln = "10";
} else if ($bulan == "November"){
	$kd_bln = "11";
} else if ($bulan == "Desember"){
	$kd_bln = "12";
} else {}

if($gruprekening == "" || $bulan == "" || $tahun == "") {
header("location:buku_besar.php?pesan=kosong");
}
else {
$tanggal = "$tahun-$kd_bln";
$cekdata = mysql_query("SELECT * FROM jurnal WHERE kode_grup = '$gruprekening' AND tanggal LIKE '%$tanggal%'");
if(mysql_num_rows($cekdata) > 0) {
	$tampil = 1;
	header("location:buku_besar.php?tampilkan=$tampil&kdg=$gruprekening&bulan=$bulan&tahun=$tahun");
} else {
	$tampil = 2;
	header("location:buku_besar.php?tampilkan=$tampil");
}
}

?>