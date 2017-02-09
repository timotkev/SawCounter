<?php

session_start();
if(isset($_SESSION['insertSuccess']))
{
	
}
else
{
	$_SESSION['insertSuccess'] = 0;
}

?>



<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Pendukung Keputusan</title>
		<link rel='stylesheet' type='text/css' href='main.css' />
		<link rel="stylesheet" href="css/jquery-ui.css">
		<script src='js/jquery.js'></script>
		<script src='js/jquery-ui.js'></script>
		<script type='text/javascript' src='js/mainJS.js'></script>
	</head>
	<body>
		<div class='logo'>
			<img src='img/identity-guidelines-bhinneka-com.png' width='303' height='27'>
		</div>
		<?php require 'menu.php' ?>
		<?php
			if($_SESSION['insertSuccess'] === 1)
			{
				//echo 'bener';
				echo '<div id="dialog" title="Penambahan Berhasil">Data pemasok telah berhasil ditambahkan</div>';
				$_SESSION['insertSuccess'] = 0;
			}
			else
			{
				//echo 'salah';
				//echo $_SESSION['insertSuccess'];
			}
		
		?>
		<div class='mainBox'>
		<br/>
		<?php require 'database/connection.php' ?>
		<?php //require 'database/readSupplier.php' ?>
		<input type='text' placeholder='Masukkan SKU' id='fieldSKU'/>
		<button id='tambahPemasok' onclick='loadBobot()'>Submit</button>
		<div id='textAjax'></div>
		<br/><br/>
		<a href='tambah.php'><button id='tambahPemasok'>Tambah Pemasok</button></a>
		<br/><br/>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
	</body>



</html>