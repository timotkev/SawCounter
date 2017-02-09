<?php 
session_start();

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sistem Pendukung Keputusan</title>
		<script src='js/jquery.js'></script>
		<script src='js/jquery-ui.js'></script>
		<script src='js/mainJS.js'></script>
		<link rel='stylesheet' type='text/css' href='main.css' />
		<link rel='stylesheet' type='text/css' href='css/jquery-ui.css' />
	</head>
	<?php
	if(isset($_GET['editID']))
	{
		$_SESSION['editID'] = $_GET['editID'];
		$_SESSION['editNama'] = $_GET['editNama'];
		$_SESSION['editAddr'] = $_GET['editAddr'];
		$_SESSION['editPhone'] = $_GET['editPhone'];
		$_SESSION['editFax'] = $_GET['editFax'];
		
		echo '<body onload="ubahFunction()">';
	}
	else
	{
			echo '<body>';
	}
	
	if(isset($_GET['sukses']))
	{
		echo '<body onload="editSukses()">';
	}
	else
	{
		echo '<body>';
	}
	
	?>
	
		<div class='logo'>
			<img src='img/identity-guidelines-bhinneka-com.png' width='303' height='27'>
		</div>
		<?php require 'menu.php' ?>
		<?php //require 'database/connection.php' ?>
		<div class='mainBox'>
		<br/>
		<input type='text' placeholder='Masukkan SKU' id='fieldSKU'/>
		<button id='tambahPemasok' onclick='loadPemasok()'>Submit</button>
		<div id='textAjax'></div>
		<?php 
		if(isset($_GET['editID']))
		{
			//echo 'ada di set';
			echo '<div id="editForm" title="Edit Form">';
			echo '<form id="myForm" action="database/editForm.php?">';
			echo '<input type="text" name="idField" value="'. $_SESSION['editID'] .'"/><label>ID</label><br/><br/>';
			echo '<input type="text" name="nameField" value="'. $_SESSION['editNama'] .'"/><label>Nama</label><br/><br/>';
			echo '<input type="text" name="addrField" value="'. $_SESSION['editAddr'] .'" /><label>Alamat</label><br/><br/>';
			echo '<input type="text" name="phoneField" value="'. $_SESSION['editPhone'] .'"/><label>Telp</label><br/><br/>';
			echo '<input type="text" name="faxField" value="'. $_SESSION['editFax'] .'" /><label>Fax</label><br/><br/>';
				
			echo '</form></div>';
			//echo '<div onclick="ubahFunction()">Ada</div>';
		}
		else
		{
			//echo '<div onclick="ubahFunction()">gak ada</div>';
		}
		
		
		?>
		<!--
			<table>
				<tr>
					<th>
						No.
					</th>
					<th>
						Nama Pemasok
					</th>
					<th>
						Keterangan
					</th>
				</tr>
				<?php //require 'database/managePemasok.php' ?>
			
			</table>
		-->
			<br/>
			<!--<a href='tambah.php' ><button id='tambahPemasok'>Tambah Pemasok</button></a>-->
			<br/>
			<br/>
		</div>
		<div id='copyright'>
			<h5>@Copyright GugukGanteng 2016</h5>
		</div>
		<div id='dialogEditSukses' title='Edit Berhasil'>
			Edit telah berhasil dilakukan
		</div>
	</body>



</html>