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

	<script type="text/javascript">
        $(document).ready(function () {
        $('#datatable').dataTable();
        });
    </script>
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
	<br/>
	<h2 align="center"><span class="label label-info"><b>Data Rekening Akuntansi</b></span></h2>
	<center>
	<div class="well" style="background:#e6e6fa; margin-top:20px; margin-bottom:50px; width:1200px;">
	<div class="table-responsive">
	<p align="center"><a href="rek_akuntansi_tambahdata.php" class="btn btn-warning"><span class="glyphicon glyphicon-plus"></span> Tambah Data</a>
		<a href="data.php" class="btn btn-success"><span class="glyphicon glyphicon-list"></span> Master Data</a></p>
	<table id="datatable" class="display stripe">
	<thead>
		<tr>
			<th><font size="2">Kode Rekening</font></th>
			<th><font size="2">Grup Rekening</font></th>
			<th><font size="2">Keterangan</font></th>
			<th><font size="2">Type</font></th>
			<th><font size="2">Debet</font></th>
			<th><font size="2">Kredit</font></th>
			<th><font size="2">Bulan</font></th>
			<th><font size="2">Tahun</font></th>
			<th><div align="center"><font size="2">Aksi</font></div></th>
		</tr>
	</thead>
	<tbody>
		<?php
		include 'koneksi.php'; 
		$query_mysql = mysql_query("SELECT * FROM rekening")or die(mysql_error());
		while($data = mysql_fetch_array($query_mysql)){
		?>
		<tr>
			<td><font size="2"><?php echo $data['kode_rekening']; ?></font></td>
			<?php
				$kdgrup = $data['kode_grup'];
				$query_mysql2 = mysql_query("SELECT * FROM rekgrup WHERE kode_grup='$kdgrup'")or die(mysql_error());
				while($data2 = mysql_fetch_array($query_mysql2)){
				$namagrup = $data2['grup_rekening'];
			} ?>
			<td><font size="2"><?php echo $namagrup; ?></font></td>
			<td><font size="2"><?php echo $data['keterangan']; ?></font></td>
			<td><font size="2"><?php echo $data['type']; ?></font></td>
			<td><font size="2">Rp. <?php echo $data['debet']; ?></font></td>
			<td><font size="2">Rp. <?php echo $data['kredit']; ?></font></td>
			<td><font size="2"><?php echo $data['bulan']; ?></font></td>
			<td><font size="2"><?php echo $data['tahun']; ?></font></td>
			<td><center>
				<a class="btn btn-primary btn-xs" href="rek_akuntansi_edit.php?kode_rekening=<?php echo $data['kode_rekening']; ?>"><span class ="glyphicon glyphicon-edit"></span> Edit</a>
				<a class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data rekening <?php echo $data['keterangan']; ?>?')" href="rek_akuntansi_hapus.php?kode_rekening=<?php echo $data['kode_rekening']; ?>"><span class ="glyphicon glyphicon-trash"></span> Hapus</a>					
			</center></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	</div>
	</div>		
	</center> 

	<?php
    if(isset($_GET['pesan'])){
		$pesan = $_GET['pesan'];
		if($pesan == "input"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi berhasil disimpan!');</script>";
		}
		else if($pesan == "update"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi berhasil diubah!');</script>";
		}
		else if($pesan == "hapus"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi berhasil dihapus!');</script>";
		}
	}
	else if(isset($_GET['pesan_error'])){
		$pesan_error = $_GET['pesan_error'];
		if($pesan_error == "input"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi gagal disimpan!');</script>";
		}
		else if($pesan_error == "update"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi gagal diubah!');</script>";
		}
		else if($pesan_error == "hapus"){
			echo "<script language='javascript'>window.alert('Data rekening akuntansi gagal dihapus!');</script>";;
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