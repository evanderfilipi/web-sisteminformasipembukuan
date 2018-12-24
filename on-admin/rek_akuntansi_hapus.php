<?php 
include 'koneksi.php';
$kode_rekening = $_GET['kode_rekening'];
$hapus = mysql_query("DELETE FROM rekening WHERE kode_rekening='$kode_rekening'")or die(mysql_error());

if($hapus){
	header("location:rekening_akuntansi.php?pesan=hapus");
} else {
	header("location:rekening_akuntansi.php?pesanerror=hapus");
}

?>