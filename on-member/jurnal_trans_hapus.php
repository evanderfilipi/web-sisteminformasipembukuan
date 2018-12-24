<?php 
include 'koneksi.php';
$no = $_GET['no_jurnal'];
$hapus = mysql_query("DELETE FROM jurnal WHERE no_jurnal='$no'")or die(mysql_error());

if($hapus){
	header("location:jurnal_transaksi.php?pesan=hapus");
} else {
	header("location:jurnal_transaksi.php?pesanerror=hapus");
}

?>