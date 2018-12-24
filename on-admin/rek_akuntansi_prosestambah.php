<?php
include 'koneksi.php';


$koderekening = $_POST['kode_rekening'];
$gruprekening = $_POST['kode_grup'];
$keterangan = $_POST['keterangan'];
$type = $_POST['type'];
$debet = $_POST['debet'];
$kredit = $_POST['kredit'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];
$kode_lama = "";


if($koderekening == "" || $gruprekening == "" || $keterangan == "" || $type == "" || $debet == "" || $kredit == "" || $bulan == "" || $tahun == "") {

header("location:rek_akuntansi_tambahdata.php?pesan=kosong");

}

else {
$cekkode = mysql_query("SELECT * FROM rekening WHERE kode_rekening = '$koderekening'");
while ($data = mysql_fetch_array($cekkode)){
	$kode_lama = $data['kode_rekening'];
}

if ($koderekening == $kode_lama){

header("location:rek_akuntansi_tambahdata.php?pesan=kodesama");
}

else {

$cekdata = mysql_query("SELECT * FROM rekening WHERE keterangan = '$keterangan' AND bulan = '$bulan' AND tahun = '$tahun'");
if(mysql_num_rows($cekdata) > 0) {
	$notif = "$keterangan pada bulan $bulan tahun $tahun";
	header("location:rek_akuntansi_tambahdata.php?notif=$notif");
}
else {
$simpan = mysql_query("INSERT INTO rekening  VALUES('$koderekening', '$gruprekening','$keterangan','$type','$debet','$kredit','$bulan','$tahun')")or die(mysql_error());
if($simpan) {

header("location:rekening_akuntansi.php?pesan=input");
} else {

header("location:rekening_akuntansi.php?pesanerror=input");
}
}
}
}

?>