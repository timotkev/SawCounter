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
			<h1>TAMBAH PEMASOK</h1>
			<form action='database/insert.php' method='post'>
				
				<input type='text' placeholder='Input Nama Pemasok' name='uname'/><br/><br/>
				
				<input type='text' placeholder='Input Alamat Pemasok' name = 'addr'/><br/><br/>
				
				<input type='text' placeholder='Input Telepon Pemasok' name = 'telp'/><br/><br/>
				
				<input type='text' placeholder='Input Fax Pemasok' name = 'fax'/><br/><br/>
					
				<input type='submit' class='submitButton'/>
				<input type='reset' class='submitButton'/><br/><br/>
			</form>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
	</body>



</html>