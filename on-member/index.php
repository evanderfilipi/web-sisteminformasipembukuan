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
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="data.php">Data</a></li> 
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Member <?=$_SESSION['nama'];?></a></li>
			<li><a href="./../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	
	
	<font face="Bernard MT Condensed"><h1><p align="center">Selamat Datang Di<br><br>
	Sistem Informasi Administrasi Pembukuan <br><br>
	<img src="img/komp.jpg" height="auto" width="auto"></p></h1></font>
 
		
    </div>

    <script src="assets/js/jquery-1.8.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

  </body>
  <br/><br/>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>