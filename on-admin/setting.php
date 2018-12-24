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
				<li><a href="data.php">Data</a></li>
				<li class="active"><a href="setting.php">Setting</a></li>  
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Admin  <?=$_SESSION['nama'];?></a></li>
			<li><a href="./../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>

			<h1><font face="Bernard MT Condensed"><p align="center">Tambah User</p></font></h1>
			<center>
			<div class="well" style="background:#FFFFFF; margin-top:30px; margin-bottom:20px; width:1000px;">
			<form action="tambah_user.php" method="post">
			<div class="form-group has-success">
			<table class="table">
			<tr>
			<td>
				<b>Nama</b>
			<p></p>
			<input type="text" class="form-control" name="nama" placeholder="Nama User"></td>
			</tr>
			<tr>
			<td>
				<b>Username</b>
			<p></p>
			<input type="text" class="form-control" name="username" placeholder="Username untuk Login"></td>
			</tr>
			<tr>
			<td>
				<b>Password</b>
			<p></p>
			<input type="password" class="form-control" name="password" placeholder="Password untuk Login"></td>
			</tr>
			<tr>
			<td>
				<b>Level User</b>
			<p></p>
			<select name="level_user" class="btn btn-primary dropdown-toggle">
			<option value="">--Pilih--</option>
			<option value="admin">Admin</option>
			<option value="member">Member</option>
			</select>
			</td>
			</tr>
			</table>
			<br>
			<table align="center">
			<tr>
			<td align="center"><button type="submit" class="btn btn-success"><span class ="glyphicon glyphicon-user"></span> Daftar</button>
				<button type="reset" class="btn btn-warning"><span class ="glyphicon glyphicon-refresh"></span> Reset</button></td>
			</tr>
			</table>
			</div>
			</form>
			</div>
			</center>	

	<br/>
	<center>
	<div class="well" style="background:#e6e6fa; margin-top:20px; margin-bottom:50px; width:1000px;">
	<div class="table-responsive">
	<table id="datatable" class="display stripe">
	<thead>
		<tr>
			<th><font size="2">ID User</font></th>
			<th><font size="2">Nama</font></th>
			<th><font size="2">Username</font></th>
			<th><font size="2">Level User</font></th>
		</tr>
	</thead>
	<tbody>
		<?php
		include 'koneksi.php'; 
		$query_mysql = mysql_query("SELECT * FROM users")or die(mysql_error());
		while($data = mysql_fetch_array($query_mysql)){
		?>
		<tr>
			<td><font size="2"><?php echo $data['id_user']; ?></font></td>
			<td><font size="2"><?php echo $data['nama']; ?></font></td>
			<td><font size="2"><?php echo $data['username']; ?></font></td>
			<td><font size="2"><?php echo $data['level_user']; ?></font></td>
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
		if($pesan == "berhasil"){
			echo "<script language='javascript'>window.alert('User berhasil ditambahkan!');</script>";
		}
		else if($pesan == "gagal"){
			echo "<script language='javascript'>window.alert('User gagal ditambahkan!');</script>";
		}
		else if($pesan == "kosong"){
			echo "<script language='javascript'>window.alert('Lengkapi data user terlebih dahulu!');</script>";
		}
		else if($pesan == "userada"){
			echo "<script language='javascript'>window.alert('Username sudah ada! Silahkan input username lain.');</script>";
		}
	}
	?>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

  </body>
  <br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>