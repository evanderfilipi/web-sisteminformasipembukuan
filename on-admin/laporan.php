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
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'admin' ) ) {
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
				<li><a href="setting.php">Setting</a></li> 
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Admin  <?=$_SESSION['nama'];?></a></li>
			<li><a href="./../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	
	
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/e.png" height="70" width="70"> Laporan</p></font></h1>
	<br/>
	<?php
	include 'koneksi.php';
	$tampilkan = "";
	if(isset($_GET['tampilkan'])){
		$tampilkan = $_GET['tampilkan'];
		}
	switch($tampilkan){
	case 1:
		$bulan = $_GET['bulan'];
		$tahun = $_GET['tahun'];
	?>
		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
				<h2 align="center"><span class="label label-warning"><b>Laporan Neraca dan Laba Rugi</b></span></h2>
				</br>
				<form action="cek2.php" method="post">
				<div class="form-group has-success">
				<table class="table">
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
		<p align="center">
			<a href="cetak.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>" class="btn btn-danger"><span class="glyphicon glyphicon-print"></span> Cetak Laporan</a>
			<a href="data.php" class="btn btn-success"><span class="glyphicon glyphicon-list"></span> Master Data</a>
		</p>
		<br/>
		<center>
		<h4>Menampilkan tabel laporan <b>Neraca</b> pada bulan <b><?php echo $bulan; ?></b> tahun <b><?php echo $tahun; ?></b></h4>
		<div class="well" style="background:#F0FFF0; margin-top:20px; margin-bottom:50px; width:1000px;">
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th><font size="2">Kode Rekening</font></th>
				<th><font size="2">Keterangan</font></th>
				<th><font size="2">Saldo</font></th>
				<th><font size="2">Total</font></th>
			</tr>
		</thead>
		<tbody>
			<?php
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
			$query_mysql = mysql_query("SELECT SUM(debet) AS totaldeb FROM rekening WHERE kode_grup='$kdgrup1' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data = mysql_fetch_array($query_mysql)){
				$totalharta = $data['totaldeb'];
			}
			
			?>
			<tr>
				<td><font size="2"><b>1</b></font></td>
				<td><font size="2"><b>Harta</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php
			$query_mysql2 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup1' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data2 = mysql_fetch_array($query_mysql2)){
			?>
			<tr>
				<td><font size="2"><?php echo $data2['kode_rekening']; ?></font></td>
				<td><font size="2"><?php echo $data2['keterangan']; ?></font></td>
				<td><font size="2">Rp. <?php echo $data2['debet']; ?></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php }
			?>
			<tr>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Total Harta</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Rp. <?php echo $totalharta; ?></b></font></td>
			</tr>
			<tr>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
			</tr>
			<?php
			$query_mysql3 = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup2' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data3 = mysql_fetch_array($query_mysql3)){
				$total1 = $data3['totalkred'];
			}
			$query_mysql33 = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup3' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data33 = mysql_fetch_array($query_mysql33)){
				$total2 = $data33['totalkred'];
			}
			$totalkewajiban = $total1 + $total2;
			?>
			<tr>
				<td><font size="2"><b>2</b></font></td>
				<td><font size="2"><b>Kewajiban</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php
			$query_mysql4 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup2' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data4 = mysql_fetch_array($query_mysql4)){
			?>
			<tr>
				<td><font size="2"><?php echo $data4['kode_rekening']; ?></font></td>
				<td><font size="2"><?php echo $data4['keterangan']; ?></font></td>
				<td><font size="2">Rp. <?php echo $data4['kredit']; ?></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php }
			?>
			<tr>
				<td><font size="2"><b>3</b></font></td>
				<td><font size="2"><b>Modal</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php
			$query_mysql5 = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup3' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($data5 = mysql_fetch_array($query_mysql5)){
			?>
			<tr>
				<td><font size="2"><?php echo $data5['kode_rekening']; ?></font></td>
				<td><font size="2"><?php echo $data5['keterangan']; ?></font></td>
				<td><font size="2">Rp. <?php echo $data5['kredit']; ?></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php }
			?>
			<tr>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Total Kewajiban</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Rp. <?php echo $totalkewajiban; ?></b></font></td>
			</tr>
		</tbody>
		</table>
		</div>
		</div>		
		</center>

		<br/>
		<center>
		<h4>Menampilkan tabel laporan <b>Laba Rugi</b> pada bulan <b><?php echo $bulan; ?></b> tahun <b><?php echo $tahun; ?></b></h4>
		<div class="well" style="background:#e6e6fa; margin-top:20px; margin-bottom:50px; width:1000px;">
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr>
				<th><font size="2">Kode Rekening</font></th>
				<th><font size="2">Keterangan</font></th>
				<th><font size="2">Saldo</font></th>
				<th><font size="2">Total</font></th>
			</tr>
		</thead>
		<tbody>
			<?php
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
			$query_mysqla = mysql_query("SELECT SUM(kredit) AS totalkred FROM rekening WHERE kode_grup='$kdgrup4' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($row = mysql_fetch_array($query_mysqla)){
				$totalpendapatan = $row['totalkred'];
			}
			
			?>
			<tr>
				<td><font size="2"><b>4</b></font></td>
				<td><font size="2"><b>Pendapatan</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php
			$query_mysqlb = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup4' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($row2 = mysql_fetch_array($query_mysqlb)){
			?>
			<tr>
				<td><font size="2"><?php echo $row2['kode_rekening']; ?></font></td>
				<td><font size="2"><?php echo $row2['keterangan']; ?></font></td>
				<td><font size="2">Rp. <?php echo $row2['kredit']; ?></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php }
			?>
			<tr>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Jumlah Seluruh Pendapatan</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Rp. <?php echo $totalpendapatan; ?></b></font></td>
			</tr>
			<tr>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
			</tr>
			<?php
			$query_mysqlc = mysql_query("SELECT SUM(debet) AS totaldeb FROM rekening WHERE kode_grup='$kdgrup5' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($row3 = mysql_fetch_array($query_mysqlc)){
				$totalbiaya = $row3['totaldeb'];
			}
			?>
			<tr>
				<td><font size="2"><b>5</b></font></td>
				<td><font size="2"><b>Biaya</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php
			$query_mysqld = mysql_query("SELECT * FROM rekening WHERE kode_grup='$kdgrup5' AND bulan='$bulan' AND tahun='$tahun'")or die(mysql_error());
			while($row4 = mysql_fetch_array($query_mysqld)){
			?>
			<tr>
				<td><font size="2"><?php echo $row4['kode_rekening']; ?></font></td>
				<td><font size="2"><?php echo $row4['keterangan']; ?></font></td>
				<td><font size="2">Rp. <?php echo $row4['debet']; ?></font></td>
				<td><font size="2"></font></td>
			</tr>
			<?php }
			$laba = $totalpendapatan - $totalbiaya;
			?>
			<tr>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Jumlah Seluruh Biaya</b></font></td>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Rp. <?php echo $totalbiaya; ?><b></font></td>
			</tr>
			<tr>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
				<td align="center"><font size="2">---</font></td>
			</tr>
			<tr>
				<td><font size="2"></font></td>
				<td><font size="2"><b>Pendapatan - Biaya</b></font></td>
				<td><font size="2"><b>Laba</b></font></td>
				<td><font size="2"><b>Rp. <?php echo $laba; ?></b></font></td>
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
				<h2 align="center"><span class="label label-warning"><b>Laporan Neraca dan Laba Rugi</b></span></h2>
				</br>
				<form action="cek2.php" method="post">
				<div class="form-group has-success">
				<table class="table">
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
			<h4>Tidak dapat menampilkan tabel Neraca dan Laba Rugi! Pastikan bulan dan tahun yang anda input sudah benar.</h4>
		</center>
	<?php
	break;

	default:
	?>
		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
				<h2 align="center"><span class="label label-warning"><b>Laporan Neraca dan Laba Rugi</b></span></h2>
				</br>
				<form action="cek2.php" method="post">
				<div class="form-group has-success">
				<table class="table">
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
			echo "<script language='javascript'>window.alert('Pilih bulan dan input tahun terlebih dahulu!');</script>";
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