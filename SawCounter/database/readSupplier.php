<?php
$sql = 'SELECT * FROM Supplier';
$result = mysqli_query($conn, $sql);



echo '<table>';
	echo '<tr>';

		echo '<th>';
			echo 'Nama Pemasok';	
		echo '</th>';
		echo '<th>';
			echo 'Nilai SAW';	
		echo '</th>';
	echo '</tr>';


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
else
{
	//echo('error juga mas');
}

echo '</table>';
mysqli_close($conn);
?>