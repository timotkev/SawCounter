<?php 
session_start();

if(isset($_SESSION['wrongPass']))
{
	
}
else
{
	$_SESSION['wrongPass'] = 0;
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
	<br/>
	<div class='mainBox'>
		<h1>VENDOR SCORING SYSTEM</h1>
			
		<form action='processLogin.php' method='post'>
			Masukkan User Name: <br/>
			<input type='text' placeholder='UserName'/ name='username' class='inputText'><br/>
			Masukkan Password:<br/>
			<input type='password' placeholder='Password' id='passField'class='inputText' name='passwd'/><br/>
			<input type='checkbox' class='checkbox' onChange='showPass()'/>
			<div class='smallBlueText'>Show Password</div>
			<!--<a href='lupaPass.php' id='lupaPass'>Lupa Kata Sandi?</a> -->
			<br/>
			
			<?php
			
				if($_SESSION['wrongPass'] === 1)
				{
					echo '<div class="wrongPass">Maaf, password anda salah</div>';
					//echo $_SESSION['wrongPass'];
				}
				else
				{
					//echo $_SESSION['wrongPass'];
				}
				
			?>
			
			
			<div id='question'>
				<img src='img/aboutUs.png' />
			</div>
			<br />
			<input type='submit' class='submitButton' id='indexInput'/>
			<input type='reset' class='submitButton'/>
			
			
			
		</form>
		<br/>
		
	</div>
	<div id='copyright'>
		<h5>@Copyright GugukGanteng 2016</h5>
	</div>

	<div id='about-us' title='About Vendor Scoring System'>
		<p>
			Vendor Scoring System dibangun untuk mambantu staff Bhinneka dalam menilai dan memilih pemasok terbaik untuk produk-produk yang paling laris, yang paling banyak diserbu oleh ratusan konsumen Bhinneka. 
		</p>
		<p>
			Seperti yang kita (staff Bhinneka) lihat selama ini, SIS (Sales Information Support) hanya menampilkan nama pemasok dan nomor teleponnya saja, kita tidak diberi kesempatan untuk menilai para pemasok-pemasok tersebut, kita tidak punya pilihan lain selain menghubungi yang tertera di SIS atau meminta bantuan PSG (Product Specialist Group).
		</p>
		<p>
			VSS ini masih berupa prototype, namun diharapkan mampu meminimalisir kesulitan staff Bhinneka dalam memilih pemasok terbaik. Kami berharap untuk kedepannya sistem VSS ini bisa dapat dikembangkan lagi menjadi sistem yang lebih sempurna dan maksimal fungsi serta penggunaannya. Kritik dan saran penggunaan sistem ini akan dengan senang hati kami terima.
		</p>
	</div>
	</body>



</html>