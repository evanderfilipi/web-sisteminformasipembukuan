<?php
include 'koneksi.php';
$kode_rekening = $_POST['kode_rekening'];
$kodegrup = $_POST['kode_grup'];
$keterangan = $_POST['keterangan'];
$type = $_POST['type'];
$debet = $_POST['debet'];
$kredit = $_POST['kredit'];
$bulan = $_POST['bulan'];
$tahun = $_POST['tahun'];

if($kodegrup == "" || $keterangan == "" || $type == "" || $debet == "" || $kredit == "" || $bulan == "" || $tahun == "") {

header("location:rek_akuntansi_edit.php?pesan=kosong&kode_rekening=$kode_rekening");

} else {

$ketlama = "";
$bulanlama = "";
$tahunlama = "";
$semuaket = "";
$semuabulan = "";
$semuatahun = "";

$cekdata1 = mysql_query("SELECT * FROM rekening WHERE kode_rekening = '$kode_rekening'");
while($data1 = mysql_fetch_array($cekdata1)){
$ketlama = $data1['keterangan'];
$bulanlama = $data1['bulan'];
$tahunlama = $data1['tahun'];
}

$cekdata2 = mysql_query("SELECT * FROM rekening WHERE keterangan = '$keterangan' AND bulan = '$bulan' AND tahun = '$tahun'");
while($data2 = mysql_fetch_array($cekdata2)){
$semuaket = $data2['keterangan'];
$semuabulan = $data2['bulan'];
$semuatahun = $data2['tahun'];
}
if(($keterangan != $ketlama || $bulan != $bulanlama || $tahun != $tahunlama) && ($keterangan == $semuaket && $bulan == $semuabulan && $tahun == $semuatahun)){
$notif = "$keterangan pada bulan $bulan tahun $tahun";
header("location:rek_akuntansi_edit.php?notif=$notif&kode_rekening=$kode_rekening");
} 
else {
$update = mysql_query("UPDATE rekening SET kode_grup='$kodegrup', keterangan='$keterangan', type='$type', debet='$debet', kredit='$kredit', bulan='$bulan', tahun='$tahun' WHERE kode_rekening='$kode_rekening'");

if($update){
	header("location:rekening_akuntansi.php?pesan=update");
} else {
	header("location:rekening_akuntansi.php?pesanerror=update");
}
}
}

?>