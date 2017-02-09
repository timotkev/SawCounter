<?php 
session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Pendukung Keputusan</title>
		<link rel='stylesheet' type='text/css' href='main.css' />
	</head>
	<body>
		<?php
			session_unset();
			
			session_destroy();
		
		?>
		<div class='logo'>
			<img src='img/identity-guidelines-bhinneka-com.png' width='303' height='27'>
		</div>
		<br/><br/>
		<div class='mainBox'>
			<h1>Logout Sukses</h1>
			<a href='http://localhost/SAW/Mockup/'><button id='tambahPemasok'>Klik di sini untuk Login</button></a><br/><br/>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
	</body>



</html>