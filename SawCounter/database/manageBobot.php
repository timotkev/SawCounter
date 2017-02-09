<?php
session_start();

require 'connection.php';
$_SESSION['selectedProduct'] = $_GET['whatever'];
$sql = 'SELECT supplier.Id_Supplier, supplier.Nama_Supplier, supplier.Nilai
FROM productavailable
INNER JOIN supplier
ON productavailable.Id_Supplier = supplier.Id_Supplier
WHERE productavailable.Id_Produk = "'. $_SESSION['selectedProduct'] .'";';
//$sql2 = 'SELECT Nama_Produk FROM product WHERE Id_Produk ="'. $_SESSION['selectedProduct'] .'"';

$result = mysqli_query($conn, $sql);

//require 'readProduk.php';

$sql2 = 'SELECT Nama_Produk FROM product WHERE Id_Produk="'. $_SESSION['selectedProduct'] .'"';
$result2 = mysqli_query($conn, $sql2);

if(mysqli_num_rows($result2) > 0)
{
	while($row2 = mysqli_fetch_assoc($result2))
	{
		echo '<br/>';
		echo $row2['Nama_Produk'];
		echo '<br/>';
	}
}



echo '<br/><table><tr>

<th>
	Nama Pemasok
</th>
<th>
	Nilai SAW
</th>
</tr>';

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		echo '<tr>';
			
			echo '<td>';
				echo $row['Nama_Supplier'];
			
			echo '</td>';
			echo '<td>';
				echo $row['Nilai'];
			echo '</td>';
		echo '</tr>';
	}
}

echo '</table>';
mysqli_close($conn);
?>