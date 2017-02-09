<?php 
session_start();
if(isset($_SESSION['insertProductSuccess']))
{
	
}
else
{
	$_SESSION['insertProductSuccess'] = 0;
}
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Pendukung Keputusan</title>
		<script src='js/jquery.js'></script>
		<script src='js/jquery-ui.js'></script>
		<script src='js/mainJS.js'></script>
		<link rel='stylesheet' type='text/css' href='main.css' />
		<link rel="stylesheet" href="css/jquery-ui.css">
	</head>
	<body>
		<div class='logo'>
			<img src='img/identity-guidelines-bhinneka-com.png' width='303' height='27'>
		</div>
		<?php require 'menu.php' ?>
		<?php
			if($_SESSION['insertProductSuccess'] === 1)
			{
				//echo 'bener';
				echo '<div id="dialog" title="Penambahan Berhasil">Data produk telah berhasil ditambahkan</div>';
				$_SESSION['insertProductSuccess'] = 0;
			}
			else
			{
				//echo 'salah';
				//echo $_SESSION['insertSuccess'];
			}
		
		?>
		<?php require 'database/connection.php' ?>
		<div class='mainBox'>
		<h1>TAMBAH PRODUK</h1>
			<form action='database/insertProduct.php' method='post'>
				
				<input type='text' placeholder='Input SKU' name='skuField'/><br/><br/>
				
				<input type='text' placeholder='Input Nama Produk' name = 'nameField'/><br/><br/>
				
				<input type='text' placeholder='Input Jenis Produk' name = 'typeField'/><br/><br/>
				
				<input type='text' placeholder='Input Harga' name = 'priceField'/><br/><br/>
				<!--
				<label class='tambah'>Tambah</label>
				<label class='kurang'>Hapus</label>
				<label id='oh'>Ini AJAX tes</label>-->
				<img src='img/pp.png' class='tambah'/>
				<img src='img/minus.png' class='kurang'/>
				<div id='selectBox'>
					<fieldset>
						<label id='insertPemasok'>Masukkan Pemasok:</label> 
						<select>
							<?php require 'database/selectOption.php' ?>
						</select>
						
					</fieldset>

				</div>
				
				<br/><br/>
				<input type='submit' class='submitButton'/>
				<input type='reset' class='submitButton'/><br/><br/>
			</form>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
	</body>



</html>