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
			$no_lama = "";
			$cekkode = mysql_query("SELECT * FROM jurnal WHERE no_jurnal='$no_jurnal'");
			while($data = mysql_fetch_array($cekkode)){
				$no_lama = $data['no_jurnal'];
			}
			if ($no_jurnal == $no_lama){
				echo "<script language='javascript'>window.alert('Nomor jurnal yang diinput sudah terdaftar! Silahkan input nomor jurnal lain.');</script>";
			}
			else {
				$simpan = mysql_query("INSERT INTO jurnal VALUES('$no_jurnal', '$tanggal','$kode_grup','$keterangan','$debet','$kredit')")or die(mysql_error());
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
	}
	?>
	
	<h1><font face="Bernard MT Condensed"><p align="center"><img src="img/jurnal.png" height="70" width="70"> Jurnal Transaksi</p></font></h1>
	<br/>

		<center>
			<div class="well" style="background:#FFFFFF; margin-top:50px; margin-bottom:50px; width:1000px;">
			<h2 align="center"><span class="label label-danger"><b>Tambah Data Jurnal Transaksi</b></span></h2>
			<br/>
			<form action="" enctype="multipart/form-data" method="post">
			<div class="form-group has-success">
			<table class="table">
			<tr>
			<td>
				<b>Nomor Jurnal</b>
			<p></p>
			<input type="text" class="form-control" name="no_jurnal" placeholder="contoh: JT-001, JT-010"></td>
			</tr>
			<tr>
			<td>
				<b>Tanggal</b>
			<p></p>
			<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="yyyy-mm-dd"></td>
			</tr>
			<tr>
			<td>
				<b>Grup Rekening</b>
			<p></p>
			<select name="kode_grup" class="btn btn-primary dropdown-toggle">
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
				<b>Keterangan</b>
			<p></p>
			<input type="text" class="form-control" name="keterangan" placeholder="contoh: Harta Bergerak"></td>
			</tr>
			<tr>
			<td>
				<b>Debet</b>
			<p></p>
			<input type="text" class="form-control" name="debet" placeholder="contoh: 100000"></td>
			</tr>
			<tr>
			<td>
				<b>Kredit</b>
			<p></p>
			<input type="text" class="form-control" name="kredit" placeholder="contoh: 100000"></td>
			</tr>
			</table>
			<br>
			<table align="center">
			<tr>
			<td align="center"><button type="submit" name="simpan" class="btn btn-success"><span class ="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
				<button type="reset" class="btn btn-warning"><span class ="glyphicon glyphicon-refresh"></span> Reset</button>
			</tr>
			</table>
			</div>
			</form>
			</div>
		</center>

	<h2 align="center"><span class="label label-info"><b>Data Jurnal Transaksi</b></span></h2>
	<center>
	<div class="well" style="background:#e6e6fa; margin-top:20px; margin-bottom:50px; width:1000px;">
	<div class="table-responsive">
	<p align="center"><a href="data.php" class="btn btn-success"><span class="glyphicon glyphicon-list"></span> Master Data</a></p>
	<table id="datatable" class="display stripe">
	<thead>
		<tr>
			<th><font size="2">No. Jurnal</font></th>
			<th><font size="2">Tanggal</font></th>
			<th><font size="2">Grup Rekening</font></th>
			<th><font size="2">Keterangan</font></th>
			<th><font size="2">Debet</font></th>
			<th><font size="2">Kredit</font></th>
			<th><div align="center"><font size="2">Aksi</font></div></th>
		</tr>
	</thead>
	<tbody>
		<?php
		include 'koneksi.php'; 
		$query_mysql = mysql_query("SELECT * FROM jurnal")or die(mysql_error());
		while($data = mysql_fetch_array($query_mysql)){
		?>
		<tr>
			<td><font size="2"><?php echo $data['no_jurnal']; ?></font></td>
			<td><font size="2"><?php echo $data['tanggal']; ?></font></td>
			<?php
				$kdgrup = $data['kode_grup'];
				$query_mysql2 = mysql_query("SELECT * FROM rekgrup WHERE kode_grup='$kdgrup'")or die(mysql_error());
				while($data2 = mysql_fetch_array($query_mysql2)){
				$namagrup = $data2['grup_rekening'];
			} ?>
			<td><font size="2"><?php echo $namagrup; ?></font></td>
			<td><font size="2"><?php echo $data['keterangan']; ?></font></td>
			<td><font size="2">Rp. <?php echo $data['debet']; ?></font></td>
			<td><font size="2">Rp. <?php echo $data['kredit']; ?></font></td>
			<td><center>
				<a class="btn btn-primary btn-xs" href="jurnal_trans_edit.php?no_jurnal=<?php echo $data['no_jurnal']; ?>"><span class ="glyphicon glyphicon-edit"></span> Edit</a>
				<a class="btn btn-danger btn-xs" onClick="return confirm('Anda yakin ingin menghapus data jurnal transaksi <?php echo $data['keterangan']; ?>?')" href="jurnal_trans_hapus.php?no_jurnal=<?php echo $data['no_jurnal']; ?>"><span class ="glyphicon glyphicon-trash"></span> Hapus</a>					
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
		if($pesan == "hapus"){
			echo "<script language='javascript'>window.alert('Data jurnal transaksi berhasil dihapus!');</script>";
		}
	}
	else if(isset($_GET['pesan_error'])){
		$pesan_error = $_GET['pesan_error'];
		if($pesan_error == "hapus"){
			echo "<script language='javascript'>window.alert('Data jurnal transaksi gagal dihapus!');</script>";
		}
	}
	?>
	
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