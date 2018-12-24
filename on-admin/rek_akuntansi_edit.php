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
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/b.png" height="70" width="70"> Rekening Akuntansi</p></font></h1>
	
	
		<?php
			include 'koneksi.php';
			$kode = $_GET['kode_rekening'];
			$query_mysql = mysql_query("SELECT * FROM rekening WHERE kode_rekening='$kode'")or die(mysql_error());
			while($data = mysql_fetch_array($query_mysql)){
		?>
			
			<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:800px;">
			<h2 align="center"><span class="label label-success"><b>Edit Data Rekening Akuntansi</b></span></h2>
			<br/>
			<form action="rek_akuntansi_prosesedit.php" method="post">
			<div class="form-group has-success">
			<table class="table">
			<tr>
			<td>
				<b>Kode Rekening</b>
			<p></p>
			<input type="text" readonly class="form-control" name="kode_rekening" value="<?php echo $data['kode_rekening'] ?>"></td>
			</tr>
			<tr>
			<td>
				<b>Grup Rekening</b>
			<p></p>
			<?php if ($data['kode_grup'] == "1") : ?>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['kode_grup'] ?>">Harta</option>
			<option value="2">Kewajiban</option>
			<option value="3">Modal</option>
			<option value="4">Pendapatan</option>
			<option value="5">Biaya</option>
			</select>
			<?php elseif ($data['kode_grup'] == "2") : ?>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['kode_grup'] ?>">Kewajiban</option>
			<option value="1">Harta</option>
			<option value="3">Modal</option>
			<option value="4">Pendapatan</option>
			<option value="5">Biaya</option>
			</select>
			<?php elseif ($data['kode_grup'] == "3") : ?>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['kode_grup'] ?>">Modal</option>
			<option value="1">Harta</option>
			<option value="2">Kewajiban</option>
			<option value="4">Pendapatan</option>
			<option value="5">Biaya</option>
			</select>
			<?php elseif ($data['kode_grup'] == "4") : ?>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['kode_grup'] ?>">Pendapatan</option>
			<option value="1">Harta</option>
			<option value="2">Kewajiban</option>
			<option value="3">Modal</option>
			<option value="5">Biaya</option>
			</select>
			<?php elseif ($data['kode_grup'] == "5") : ?>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['kode_grup'] ?>">Biaya</option>
			<option value="1">Harta</option>
			<option value="2">Kewajiban</option>
			<option value="3">Modal</option>
			<option value="4">Pendapatan</option>
			</select>
			<?php endif; ?>
			</td>
			</tr>
			<tr>
			<td>
				<b>Keterangan</b>
			<p></p>
			<input type="text" class="form-control" name="keterangan" value="<?php echo $data['keterangan'] ?>"></td>
			</tr>
			<tr>
			<td>
				<b>Type</b>
			<p></p>
			<?php if ($data['type'] == "Detail") : ?>
			<select name="type" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['type'] ?>"><?php echo $data['type'] ?></option>
			<option value="Header">Header</option>
			</select>
			<?php elseif ($data['type'] == "Header") : ?>
			<select name="type" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['type'] ?>"><?php echo $data['type'] ?></option>
			<option value="Detail">Detail</option>
			</select>
			<?php endif; ?>
			</td>
			</tr>
			<tr>
			<td>
				<b>Debet</b>
			<p></p>
			<input type="text" class="form-control" name="debet" value="<?php echo $data['debet'] ?>"></td>
			</tr>
			<tr>
			<td>
				<b>Kredit</b>
			<p></p>
			<input type="text" class="form-control" name="kredit" value="<?php echo $data['kredit'] ?>"></td>
			</tr>
			<tr>
			<td>
				<b>Bulan</b>
			<p></p>
			<?php if ($data['bulan'] == "Januari") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
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
			<?php elseif ($data['bulan'] == "Februari") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
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
			<?php elseif ($data['bulan'] == "Maret") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
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
			<?php elseif ($data['bulan'] == "April") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Mei") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Juni") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Juli") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Agustus") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="September">September</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "September") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="Oktober">Oktober</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Oktober") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
			<option value="Januari">Januari</option>
			<option value="Februari">Februari</option>
			<option value="Maret">Maret</option>
			<option value="April">April</option>
			<option value="Mei">Mei</option>
			<option value="Juni">Juni</option>
			<option value="Juli">Juli</option>
			<option value="Agustus">Agustus</option>
			<option value="September">September</option>
			<option value="November">November</option>
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "November") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
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
			<option value="Desember">Desember</option>
			</select>
			<?php elseif ($data['bulan'] == "Desember") : ?>
			<select name="bulan" class="btn btn-primary dropdown-toggle">
			<option value="<?php echo $data['bulan'] ?>"><?php echo $data['bulan'] ?></option>
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
			</select>
			<?php endif; ?>
			</td>
			</tr>
			<tr>
			<td>
				<b>Tahun</b>
			<p></p>
			<input type="text" maxlength="4" class="form-control" name="tahun" value="<?php echo $data['tahun'] ?>"></td>
			</tr>
			</table>
			<br>
			<table align="center">
			<tr>
			<td align="center"><button type="submit" class="btn btn-success"><span class ="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
				<a class="btn btn-danger" href="rekening_akuntansi.php"><span class ="glyphicon glyphicon-remove"></span> Batal</a></td>
			</tr>
			</table>
			</div>
			</form>
			</div>
			</center>	
    <?php } 

    if(isset($_GET['pesan'])){
		$pesan = $_GET['pesan'];
		if($pesan == "kosong"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi tidak boleh ada yang kosong!');</script>";
		}
	} else if (isset($_GET['notif'])){
		$notif = $_GET['notif'];
		echo "<script language='javascript'>window.alert('Data rekening $notif sudah ada!');</script>";
	}

    ?>

    <script src="assets/js/jquery-1.8.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
  <br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>