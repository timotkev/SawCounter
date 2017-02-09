<?php
session_start();

$_SESSION['tempPemasok'] = $_GET['tempPemasok'];

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
		<div class='kuesionerBox'>
		<?php echo $_GET['tempPemasok']?><br/><br/>
		
			<br/>
			<form action='database/prosesPenilaian.php'>
				<table style='max-width:700px' id='kuesionerTable'>
					<tr>
						<th>Statement</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
					</tr>
					<tr>
						<td>Pemasok ini mampu memberikan diskon dalam pembelian jumlah tertentu.</td>
						<td>
							<input type='radio' name='St1' value='1'/>
						</td>
						<td>
							<input type='radio' name='St1' value='2'/>
						</td>
						<td>
							<input type='radio' name='St1' value='3'/>
						</td>
						<td>
							<input type='radio' name='St1' value='4'/>
						</td>
						<td>
							<input type='radio' name='St1' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu memberikan harga miring untuk reseller yag menjadi rekanan lama.</td>
						<td>
							<input type='radio' name='St2' value='1'/>
						</td>
						<td>
							<input type='radio' name='St2' value='2'/>
						</td>
						<td>
							<input type='radio' name='St2' value='3'/>
						</td>
						<td>
							<input type='radio' name='St2' value='4'/>
						</td>
						<td>
							<input type='radio' name='St2' value='5'/>
						</td>
					</tr>
				<tr>
						<td>Pemasok dapat bertanggung jawab dalam hal kesesuaian unit yang terdapat dalam kemasan/box.</td>
						<td>
							<input type='radio' name='St3' value='1'/>
						</td>
						<td>
							<input type='radio' name='St3' value='2'/>
						</td>
						<td>
							<input type='radio' name='St3' value='3'/>
						</td>
						<td>
							<input type='radio' name='St3' value='4'/>
						</td>
						<td>
							<input type='radio' name='St3' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini dapat bertanggung jawab dalam hal ketepatan jumlah dalam pengiriman.</td>
						<td>
							<input type='radio' name='St4' value='1'/>
						</td>
						<td>
							<input type='radio' name='St4' value='2'/>
						</td>
						<td>
							<input type='radio' name='St4' value='3'/>
						</td>
						<td>
							<input type='radio' name='St4' value='4'/>
						</td>
						<td>
							<input type='radio' name='St4' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu memberikan kualitas yang sama dalam satu waktu pada reseller yang berbeda.</td>
						<td>
							<input type='radio' name='St5' value='1'/>
						</td>
						<td>
							<input type='radio' name='St5' value='2'/>
						</td>
						<td>
							<input type='radio' name='St5' value='3'/>
						</td>
						<td>
							<input type='radio' name='St5' value='4'/>
						</td>
						<td>
							<input type='radio' name='St5' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini bertanggung jawab dalam hal kesesuaian harga dengan kualitas barang.</td>
						<td>
							<input type='radio' name='St6' value='1'/>
						</td>
						<td>
							<input type='radio' name='St6' value='2'/>
						</td>
						<td>
							<input type='radio' name='St6' value='3'/>
						</td>
						<td>
							<input type='radio' name='St6' value='4'/>
						</td>
						<td>
							<input type='radio' name='St6' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini cepat tanggap dalam menyelesaikan keluhan Bhinneka sebagai reseller.</td>
						<td>
							<input type='radio' name='St7' value='1'/>
						</td>
						<td>
							<input type='radio' name='St7' value='2'/>
						</td>
						<td>
							<input type='radio' name='St7' value='3'/>
						</td>
						<td>
							<input type='radio' name='St7' value='4'/>
						</td>
						<td>
							<input type='radio' name='St7' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mudah dihubungi dalam memberikan informasi stok dan harga.</td>
						<td>
							<input type='radio' name='St8' value='1'/>
						</td>
						<td>
							<input type='radio' name='St8' value='2'/>
						</td>
						<td>
							<input type='radio' name='St8' value='3'/>
						</td>
						<td>
							<input type='radio' name='St8' value='4'/>
						</td>
						<td>
							<input type='radio' name='St8' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mudah dihubungi dalam memberikan informasi terkait barang yang perlu diinstall.</td>
						<td>
							<input type='radio' name='St9' value='1'/>
						</td>
						<td>
							<input type='radio' name='St9' value='2'/>
						</td>
						<td>
							<input type='radio' name='St9' value='3'/>
						</td>
						<td>
							<input type='radio' name='St9' value='4'/>
						</td>
						<td>
							<input type='radio' name='St9' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini bertanggung hawab dalam hal kerusakan unit.</td>
						<td>
							<input type='radio' name='St10' value='1'/>
						</td>
						<td>
							<input type='radio' name='St10' value='2'/>
						</td>
						<td>
							<input type='radio' name='St10' value='3'/>
						</td>
						<td>
							<input type='radio' name='St10' value='4'/>
						</td>
						<td>
							<input type='radio' name='St10' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mudah dihubungi dalam memberikan informasi terkait petunjuk cara penggunaan barang.</td>
						<td>
							<input type='radio' name='St11' value='1'/>
						</td>
						<td>
							<input type='radio' name='St11' value='2'/>
						</td>
						<td>
							<input type='radio' name='St11' value='3'/>
						</td>
						<td>
							<input type='radio' name='St11' value='4'/>
						</td>
						<td>
							<input type='radio' name='St11' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mempunyai beberapa kantor cabang yang mudah dikunjungi pihak reseller atau customer.</td>
						<td>
							<input type='radio' name='St12' value='1'/>
						</td>
						<td>
							<input type='radio' name='St12' value='2'/>
						</td>
						<td>
							<input type='radio' name='St12' value='3'/>
						</td>
						<td>
							<input type='radio' name='St12' value='4'/>
						</td>
						<td>
							<input type='radio' name='St12' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu meminimalisir biaya transportasi dan waktu respon saat ada pesanan yang mendadak.</td>
						<td>
							<input type='radio' name='St13' value='1'/>
						</td>
						<td>
							<input type='radio' name='St13' value='2'/>
						</td>
						<td>
							<input type='radio' name='St13' value='3'/>
						</td>
						<td>
							<input type='radio' name='St13' value='4'/>
						</td>
						<td>
							<input type='radio' name='St13' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu memelihara kebijakan persediaannya dan menjaga sparepart yang dimilikinya saat ada kebutuhan bahan baku yang mendadak.</td>
						<td>
							<input type='radio' name='St14' value='1'/>
						</td>
						<td>
							<input type='radio' name='St14' value='2'/>
						</td>
						<td>
							<input type='radio' name='St14' value='3'/>
						</td>
						<td>
							<input type='radio' name='St14' value='4'/>
						</td>
						<td>
							<input type='radio' name='St14' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu memberikan kebijakan masa tenggang waktu pembayaran maksimal 45 hari dengan mengetahui Bhinneka sebagai salah satu penyedia di LKPP dan mengetahui SOP dalam pembayaran di LKPP.</td>
						<td>
							<input type='radio' name='St15' value='1'/>
						</td>
						<td>
							<input type='radio' name='St15' value='2'/>
						</td>
						<td>
							<input type='radio' name='St15' value='3'/>
						</td>
						<td>
							<input type='radio' name='St15' value='4'/>
						</td>
						<td>
							<input type='radio' name='St15' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu dalam merespon perubahan permintaan dan memenuhi perubahan barang pesanan.</td>
						<td>
							<input type='radio' name='St16' value='1'/>
						</td>
						<td>
							<input type='radio' name='St16' value='2'/>
						</td>
						<td>
							<input type='radio' name='St16' value='3'/>
						</td>
						<td>
							<input type='radio' name='St16' value='4'/>
						</td>
						<td>
							<input type='radio' name='St16' value='5'/>
						</td>
					</tr>
					<tr>
						<td>Pemasok ini mampu untuk mengirimkan barang sesuai dengan tanggal yang telah disepakati bersama.</td>
						<td>
							<input type='radio' name='St17' value='1'/>
						</td>
						<td>
							<input type='radio' name='St17' value='2'/>
						</td>
						<td>
							<input type='radio' name='St17' value='3'/>
						</td>
						<td>
							<input type='radio' name='St17' value='4'/>
						</td>
						<td>
							<input type='radio' name='St17' value='5'/>
						</td>
					</tr>
					
				</table>
				<br/>
				<input type='submit' class='submitButton'/>
			</form>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
	</body>



</html>