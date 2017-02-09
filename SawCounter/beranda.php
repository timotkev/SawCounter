<?php 
session_start();

if(isset($_POST['username']))
{
	$_SESSION['usernameSession'] = $_POST['username']; 
}
else
{
	//echo "hahaha";
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Pendukung Keputusan</title>
		<script type='text/javascript' src='js/jquery.js'></script>
		<script type='text/javascript' src='js/jquery-ui.js'></script>
		<script type='text/javascript' src='js/mainJS.js'></script>
		<link rel='stylesheet' type='text/css' href='main.css' />
		<link rel='stylesheet' type='text/css' href='css/jquery-ui.css' />
	</head>
	<body>
		<div class='logo'>
			<img src='img/identity-guidelines-bhinneka-com.png' width='303' height='27'>
		</div>
		<?php require 'menu.php' ?>
		<div class='mainBox'>
			<div class='help'>
				<img src='img/questionmark.png' />
			</div>
			<h1 class='berandaText'>BERANDA</h1>

			<br/>
			Selamat Datang, <?php echo $_SESSION['usernameSession'] ?>
			<br/><br/>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
		<div class='helpText' title='Menu Bantuan'>
		Kelola pemasok<br />
		<ul>
			<li>input SKU ---> akan tampil pemasok yang sudah di input melalui kelola produk</li>
			<li>ubah ---> mengubah data pemasok yang sudah di input di tambah pemasok</li>
			<li>hapus ---> menghapus data pemasok yang sudah di input di tambah pemasok</li>
			<li>nilai ---> akan tampil 17 pernyataan yang harus di nilai dengan skor 1-5</li>
		</ul>
		Tambah pemasok<br />
		<ul>
			<li>input nama pemasok</li>
			<li>input alamat pemasok</li>
			<li>input telepon pemasok</li>
			<li>input fax pemasok</li>
		</ul>
		Setelah di input semua klik submit<br />
		<br />
		Kelola produk<br />
		<ul>
			<li>input SKU</li>
			<li>input nama produk</li>
			<li>input pemasok</li>
		</ul>
		setelah di input semua klik submit<br />
		<br />
		Bobot pemasok<br />
		<ul>
			<li>input SKU ---> akan tampil nama pemasok dan nilai pemasok yang sudah di nilai</li>
		</ul>
		
		</div>
	</body>



</html>