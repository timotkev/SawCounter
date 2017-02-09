<?php



require 'connection.php';

$sql2 = 'SELECT Nama_Produk FROM product WHERE Id_Produk="P01"';
$result2 = mysqli_query($conn, $sql2);

if(mysqli_num_rows($result2) > 0)
{
	while($row2 = mysqli_fetch_assoc($result2))
	{
		echo 'Id Produk: ' . $row2['Nama_Produk'];
	}
}




?>