<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<style>

.zoom {
    width: 70px;
    height: 70px;
    -webkit-transition: all .2s ease-in-out;
    -moz-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    -ms-transition: all .2s ease-in-out;
}
 
.transition {
    -webkit-transform: scale(1.2); 
    -moz-transform: scale(1.2);
    -o-transform: scale(1.2);
    transform: scale(1.2);
}
</style> 

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
			<li><a href="#"><span class="glyphicon glyphicon-user"></span> Member <?=$_SESSION['nama'];?></a></li>
			<li><a href="./../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
			</ul>
		</div>
	</nav>
	
	
	<h1><font face="Bernard MT Condensed"><p align="center">Master Data</p></font></h1>
	<br><br><br><br><br><br>

	<table align="center" width="50%" height="50%">
			<tr>
				<td align="center"><img src="img/a.png" class="zoom" height="70" width="70"></td>
				<td align="center"><img src="img/d.png" class="zoom" height="70" width="70"></td>	
				<td align="center"><img src="img/jurnal.png" class="zoom" height="70" width="70"></td>
			</tr>
			<tr>
				<td align="center"><b><a href="rekening_group.php">Rekening Group</a></b></td>
				<td align="center"><b><a href="buku_besar.php">Buku Besar</a></b></td>
				<td align="center"><b><a href="jurnal_transaksi.php">Jurnal Transaksi</a></b></td>	
			</tr>
	</table>
	
    <script src="assets/js/jquery-1.8.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    $('.zoom').hover(function() {
        $(this).addClass('transition');
    }, function() {
        $(this).removeClass('transition');
    });
});
</script>

  </body>
  <br><br><br><br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>