<?php
session_start();

require 'connection.php';
$_SESSION['selectedProduct'] = $_GET['whatever'];
$sql = 'SELECT supplier.Id_Supplier, supplier.Nama_Supplier, supplier.Address, supplier.Phone, supplier.Fax
FROM productavailable
INNER JOIN supplier
ON productavailable.Id_Supplier = supplier.Id_Supplier
WHERE productavailable.Id_Produk = "'. $_SESSION['selectedProduct'] .'";';
$result = mysqli_query($conn, $sql);

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
	Keterangan
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
				echo '<a href="database/delete.php?tempID='. $row['Id_Supplier'] .'">Hapus</a>';
				echo '&nbsp';
				echo '&nbsp';
				echo '&nbsp';
				echo '<a href="kriteria.php?tempPemasok='. $row['Nama_Supplier'] .'">Nilai</a>';
				echo '&nbsp';
				echo '&nbsp';
				echo '&nbsp';

				echo '<a href="pemasok.php?editID='. $row['Id_Supplier'] .'&editNama='. $row['Nama_Supplier'] . '&editAddr='. $row['Address'] .'&editAddr='. $row['Address'] .'&editPhone='. $row['Phone'] .'&editFax='. $row['Fax'] .'"class="tombolUbah">Ubah</a>';
			echo '</td>';
		echo '</tr>';
	}
}

echo '</table>';
mysqli_close($conn);
?>