<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="img/komp.jpg" type="image/jpg" />
    <title>Sistem Pembukuan</title>

    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/style.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="assets/js/jquery-1.8.0.min.js"></script>

  </head>
    <?php
session_start();
/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'member' ) ) {
	header('location:./../login.php');
	exit();
}
?>


<body>
	<nav class="navbar navbar-default" style="background-color: #FFCC00;">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Pangsit Pelita</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="data.php">Data</a></li>  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Member  <?=$_SESSION['nama'];?></a></li>
			<li><a href="./../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	
	
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/d.png" height="70" width="70"> Buku Besar</p></font></h1>
	<br/>
	<?php
	include 'koneksi.php';
	$tampilkan = "";
	if(isset($_GET['tampilkan'])){
		$tampilkan = $_GET['tampilkan'];
		}
	switch($tampilkan){
	case 1:
		$kdgrup = $_GET['kdg']; 
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
		$namarek = "";
		$query_mysqli = mysql_query("SELECT grup_rekening FROM rekgrup WHERE kode_grup='$kdgrup'")or die(mysql_error());
		while($row = mysql_fetch_array($query_mysqli)){
			$namarek = $row['grup_rekening'];
		}
	?>
		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
				<h2 align="center"><span class="label label-warning"><b>Tampilkan Data Buku Besar</b></span></h2>
				</br>
				<form action="cek.php" method="post">
				<div class="form-group has-success">
				<table class="table">
				<tr>
				<td>
					<b>Grup Rekening</b>
				<p></p>
				<select name="kode_grup" class="btn btn-danger dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="1">Harta</option>
				<option value="2">Kewajiban</option>
				<option value="3">Modal</option>
				<option value="4">Pendapatan</option>
				<option value="5">Biaya</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Bulan</b>
				<p></p>
				<select name="bulan" class="btn btn-primary dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="Januari">Januari</option>
				<option value="Februari">Februari</option>
				<option value="Maret">Maret</option>
				<option value="April">April</option>
				<option value="Mei">Mei</option>
				<option value="Juni">Juni</option>
				<option value="Juli">Juli</option>
				<option value="Agustus">Agustus</option>
				<option value="September">September</option>
				<option value="Oktober">Oktober</option>
				<option value="November">November</option>
				<option value="Desember">Desember</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Tahun</b>
				<p></p>
				<input type="text" maxlength="4" class="form-control" name="tahun" placeholder="contoh: 2018"></td>
				</tr>
				</table>
				</div>
				<table class="table">
				<tr>
				<td><a class="btn btn-danger" href="data.php"><span class ="glyphicon glyphicon-hand-left"></span> Kembali</a>
				<button type="submit" class="btn btn-info"><span class ="glyphicon glyphicon-eye-open"></span> Tampilkan</button></td>
				</tr>
				</table>
				</form>
			</div>
		</center>
		<br/>
		<center>
		<h4>Menampilkan data buku besar rekening <?php echo $namarek; ?> bulan <?php echo $bulan; ?> tahun <?php echo $tahun; ?></h4>
		<div class="well" style="background:#F5F5DC; margin-top:20px; margin-bottom:50px; width:1000px;">
		<div class="table-responsive">
		<p align="center"><a href="data.php" class="btn btn-success"><span class="glyphicon glyphicon-list"></span> Master Data</a></p>
		<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th><font size="2">Tanggal</font></th>
				<th><font size="2">Keterangan</font></th>
				<th><font size="2">No. Jurnal</font></th>
				<th><font size="2">Debet</font></th>
				<th><font size="2">Kredit</font></th>
				<th><font size="2">Saldo</font></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$kd_bln = "";
			$bln_rek = "";
			$thn_rek = "";

			if($bulan == "Januari"){
				$kd_bln = "01";
				$bln_rek = "Desember";
				$thn_rek = $tahun - 1;
			} else if ($bulan == "Februari"){
				$kd_bln = "02";
				$bln_rek = "Januari";
				$thn_rek = $tahun;
			} else if ($bulan == "Maret"){
				$kd_bln = "03";
				$bln_rek = "Februari";
				$thn_rek = $tahun;
			} else if ($bulan == "April"){
				$kd_bln = "04";
				$bln_rek = "Maret";
				$thn_rek = $tahun;
			} else if ($bulan == "Mei"){
				$kd_bln = "05";
				$bln_rek = "April";
				$thn_rek = $tahun;
			} else if ($bulan == "Juni"){
				$kd_bln = "06";
				$bln_rek = "Mei";
				$thn_rek = $tahun;
			} else if ($bulan == "Juli"){
				$kd_bln = "07";
				$bln_rek = "Juni";
				$thn_rek = $tahun;
			} else if ($bulan == "Agustus"){
				$kd_bln = "08";
				$bln_rek = "Juli";
				$thn_rek = $tahun;
			} else if ($bulan == "September"){
				$kd_bln = "09";
				$bln_rek = "Agustus";
				$thn_rek = $tahun;
			} else if ($bulan == "Oktober"){
				$kd_bln = "10";
				$bln_rek = "September";
				$thn_rek = $tahun;
			} else if ($bulan == "November"){
				$kd_bln = "11";
				$bln_rek = "Oktober";
				$thn_rek = $tahun;
			} else if ($bulan == "Desember"){
				$kd_bln = "12";
				$bln_rek = "November";
				$thn_rek = $tahun;
			} else {}

			$tanggal = "$tahun-$kd_bln";
			$deb = "";
			$kre = "";
			$query_mysql = mysql_query("SELECT SUM(debet) AS totaldeb, SUM(kredit) AS totalkre FROM rekening WHERE kode_grup='$kdgrup' AND bulan='$bln_rek' AND tahun='$thn_rek'")or die(mysql_error());
			while($data = mysql_fetch_array($query_mysql)){
				$deb = $data['totaldeb'];
				$kre = $data['totalkre'];
			}
			$saldoawal = $deb + $kre;
			?>
			<tr>
				<td><font size="2">Bulan Sebelumnya</font></td>
				<td><font size="2"><b>Saldo Awal</b></font></td>
				<td><font size="2">-</font></td>
				<td><font size="2">-</font></td>
				<td><font size="2">-</font></td>
				<td><font size="2"><b>Rp. <?php echo $saldoawal;?></b></font></td>
			</tr>
			<?php
			$query_mysql2 = mysql_query("SELECT * FROM jurnal WHERE tanggal LIKE '%$tanggal%' AND kode_grup='$kdgrup'")or die(mysql_error());
			while($data2 = mysql_fetch_array($query_mysql2)){
			?>
			<tr>
				<td><font size="2"><?php echo $data2['tanggal']; ?></font></td>
				<td><font size="2"><?php echo $data2['keterangan']; ?></font></td>
				<td><font size="2"><?php echo $data2['no_jurnal']; ?></font></td>
				<td><font size="2">Rp. <?php echo $data2['debet']; ?></font></td>
				<td><font size="2">Rp. <?php echo $data2['kredit']; ?></font></td>
				<td><font size="2">-</font></td>
			</tr>
			<?php }
			$dbt = "";
			$krd = ""; 
			$query_mysql3 = mysql_query("SELECT SUM(debet) AS debett, SUM(kredit) AS kreditt FROM jurnal WHERE tanggal LIKE '%$tanggal%' AND kode_grup='$kdgrup'")or die(mysql_error());
			while($data3 = mysql_fetch_array($query_mysql3)){
				$dbt = $data3['debett'];
				$krd = $data3['kreditt'];
			}
			$saldoakhir = ($saldoawal + $dbt) - $krd;
			?>
			<tr>
				<td><font size="2">-</font></td>
				<td><font size="2"><b>Saldo Akhir</b></font></td>
				<td><font size="2">-</font></td>
				<td><font size="2">-</font></td>
				<td><font size="2">-</font></td>
				<td><font size="2"><b>Rp. <?php echo $saldoakhir;?></b></font></td>
			</tr>
		</tbody>
		</table>
		</div>
		</div>		
		</center> 
	<?php
	break;

	case 2:
	?>
		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
				<h2 align="center"><span class="label label-warning"><b>Tampilkan Data Buku Besar</b></span></h2>
				</br>
				<form action="cek.php" method="post">
				<div class="form-group has-success">
				<table class="table">
				<tr>
				<td>
					<b>Grup Rekening</b>
				<p></p>
				<select name="kode_grup" class="btn btn-danger dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="1">Harta</option>
				<option value="2">Kewajiban</option>
				<option value="3">Modal</option>
				<option value="4">Pendapatan</option>
				<option value="5">Biaya</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Bulan</b>
				<p></p>
				<select name="bulan" class="btn btn-primary dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="Januari">Januari</option>
				<option value="Februari">Februari</option>
				<option value="Maret">Maret</option>
				<option value="April">April</option>
				<option value="Mei">Mei</option>
				<option value="Juni">Juni</option>
				<option value="Juli">Juli</option>
				<option value="Agustus">Agustus</option>
				<option value="September">September</option>
				<option value="Oktober">Oktober</option>
				<option value="November">November</option>
				<option value="Desember">Desember</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Tahun</b>
				<p></p>
				<input type="text" maxlength="4" class="form-control" name="tahun" placeholder="contoh: 2018"></td>
				</tr>
				</table>
				</div>
				<table class="table">
				<tr>
				<td><a class="btn btn-danger" href="data.php"><span class ="glyphicon glyphicon-hand-left"></span> Kembali</a>
				<button type="submit" class="btn btn-info"><span class ="glyphicon glyphicon-eye-open"></span> Tampilkan</button></td>
				</tr>
				</table>
				</form>
			</div>
			<br/>
			<h4>Data yang ingin ditampilkan tidak ditemukan!</h4>
		</center>
	<?php
	break;

	default:
	?>
		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
				<h2 align="center"><span class="label label-warning"><b>Tampilkan Data Buku Besar</b></span></h2>
				</br>
				<form action="cek.php" method="post">
				<div class="form-group has-success">
				<table class="table">
				<tr>
				<td>
					<b>Grup Rekening</b>
				<p></p>
				<select name="kode_grup" class="btn btn-danger dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="1">Harta</option>
				<option value="2">Kewajiban</option>
				<option value="3">Modal</option>
				<option value="4">Pendapatan</option>
				<option value="5">Biaya</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Bulan</b>
				<p></p>
				<select name="bulan" class="btn btn-primary dropdown-toggle">
				<option value="">--Pilih--</option>
				<option value="Januari">Januari</option>
				<option value="Februari">Februari</option>
				<option value="Maret">Maret</option>
				<option value="April">April</option>
				<option value="Mei">Mei</option>
				<option value="Juni">Juni</option>
				<option value="Juli">Juli</option>
				<option value="Agustus">Agustus</option>
				<option value="September">September</option>
				<option value="Oktober">Oktober</option>
				<option value="November">November</option>
				<option value="Desember">Desember</option>
				</select>
				</td>
				</tr>
				<tr>
				<td>
					<b>Tahun</b>
				<p></p>
				<input type="text" maxlength="4" class="form-control" name="tahun" placeholder="contoh: 2018"></td>
				</tr>
				</table>
				</div>
				<table class="table">
				<tr>
				<td><a class="btn btn-danger" href="data.php"><span class ="glyphicon glyphicon-hand-left"></span> Kembali</a>
				<button type="submit" class="btn btn-info"><span class ="glyphicon glyphicon-eye-open"></span> Tampilkan</button></td>
				</tr>
				</table>
				</form>
			</div>
		</center>

	<?php
	}
    if(isset($_GET['pesan'])){
		$pesan = $_GET['pesan'];
		if($pesan == "kosong"){
			echo "<script language='javascript'>window.alert('Pilih grup rekening, bulan, dan input tahun terlebih dahulu!');</script>";
		}
	}
	?>
	
	</div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

  </body>
  <br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>