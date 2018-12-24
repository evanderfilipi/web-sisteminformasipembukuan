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
	
	
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/a.png" height="70" width="70"> Rekening Grup</p></font></h1>
	<br/>
	<h2 align="center"><span class="label label-info"><b>Data Grup Rekening</b></span></h2>
	<center>
	<div class="well" style="background:#e6e6fa; margin-top:20px; margin-bottom:50px; width:1200px;">
	<div class="table-responsive">
	<p align="center"><a href="data.php" class="btn btn-success"><span class="glyphicon glyphicon-list"></span> Master Data</a></p>
	<table id="datatable" class="display stripe">
	<thead>
		<tr>
			<th><font size="2">Kode Grup</font></th>
			<th><font size="2">Grup Rekening</font></th>
			<th><font size="2">Normal</font></th>
			<th><font size="2">Laporan</font></th>
		</tr>
	</thead>
	<tbody>
		<?php
		include 'koneksi.php'; 
		$query_mysql = mysql_query("SELECT * FROM rekgrup")or die(mysql_error());
		while($data = mysql_fetch_array($query_mysql)){
		?>
		<tr>
			<td><font size="2"><?php echo $data['kode_grup']; ?></font></td>
			<td><font size="2"><?php echo $data['grup_rekening']; ?></font></td>
			<td><font size="2"><?php echo $data['normal']; ?></font></td>
			<td><font size="2"><?php echo $data['laporan']; ?></font></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	</div>
	</div>		
	</center>	

    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

  </body>
  <br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>