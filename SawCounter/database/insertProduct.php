<?php
session_start();
require 'connection.php';
$sqlProduct = 'INSERT INTO product VALUES ("'. $_POST['skuField'] .'", "'. $_POST['nameField'] .'", "'. $_POST['typeField'] .'", "'. $_POST['priceField'] .'")';
//$sql = 'INSERT INTO `productavailable`(`Id_Supplier`, `Id_Produk`) VALUES ("", "")';

if(mysqli_query($conn, $sqlProduct))
{
	//echo 'sukses';
	$_SESSION['insertProductSuccess'] = 1;
	header("Location: http://localhost/SAW/Mockup/produk.php");
}
else
{
	echo mysqli_error($conn);
}

?>