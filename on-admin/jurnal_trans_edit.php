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

	<link rel="stylesheet" type="text/css" media="all" href="../jsdatepick-calendar/jsDatePick_ltr.min.css" />
   	<script type="text/javascript" src="../jsdatepick-calendar/jsDatePick.jquery.min.1.3.js"></script>

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
	
	<?php
	include 'koneksi.php';
	if(isset($_POST['simpan'])){
		$no_jurnal = $_POST['no_jurnal'];
		$tanggal = $_POST['tanggal'];
		$kode_grup = $_POST['kode_grup'];
		$keterangan = $_POST['keterangan'];
		$debet = $_POST['debet'];
		$kredit = $_POST['kredit'];

		if($no_jurnal == "" || $tanggal == "" || $kode_grup == "" || $keterangan == "" || $debet == "" || $kredit == "") {
			echo "<script language='javascript'>window.alert('Mohon isi data jurnal transaksi dengan lengkap!');</script>";
		}
		else {
			$simpan = mysql_query("UPDATE jurnal SET tanggal='$tanggal', kode_grup='$kode_grup', keterangan='$keterangan', debet='$debet', kredit='$kredit' WHERE no_jurnal='$no_jurnal'")or die(mysql_error());
			if($simpan) {
				echo "<script language='javascript'>
				window.alert('Data jurnal transaksi berhasil disimpan!');
				window.location.href='jurnal_transaksi.php';
				</script>";
			} else {
				echo "<script language='javascript'>
				window.alert('Data jurnal transaksi gagal disimpan!');
				window.location.href='jurnal_transaksi.php';
				</script>";
			}
			
		}
	}
	?>
	
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/jurnal.png" height="70" width="70"> Jurnal Transaksi</p></font></h1>
	<br/>
		<?php
			include 'koneksi.php';
			$no = $_GET['no_jurnal'];
			$query_mysql = mysql_query("SELECT * FROM jurnal WHERE no_jurnal='$no'")or die(mysql_error());
			while($data = mysql_fetch_array($query_mysql)){
		?>

		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
			<h2 align="center"><span class="label label-danger"><b>Edit Data Jurnal Transaksi</b></span></h2>
			<br/>
			<form action="" enctype="multipart/form-data" method="post">
			<div class="form-group has-success">
			<table class="table">
			<tr>
			<td>
				<b>Nomor Jurnal</b>
			<p></p>
			<input type="text" readonly class="form-control" name="no_jurnal" value="<?php echo $data['no_jurnal'] ?>"></td>
			</tr>
			<tr>
			<td>
				<b>Tanggal</b>
			<p></p>
			<input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php echo $data['tanggal'] ?>" placeholder="yyyy-mm-dd"></td>
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
			</table>
			<br>
			<table align="center">
			<tr>
			<td align="center"><button type="submit" name="simpan" class="btn btn-success"><span class ="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
				<a class="btn btn-danger" href="jurnal_transaksi.php"><span class ="glyphicon glyphicon-remove"></span> Batal</a>
			</tr>
			</table>
			</div>
			</form>
			</div>
		</center>

	<?php } ?>
	
	</div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
		window.onload = function () {
			new JsDatePick({
				useMode: 2,
				target: "tanggal",
				dateFormat: "%Y-%m-%d",
				yearsRange: [1960, 2060]
			});
		};
	</script>

  </body>
  <br><br><br>
  <p align="center"><b>Copyright &copy; 2018 - DSA Project</b></p>
</html>