<?php
require 'connection.php';
$sql = 'SELECT Id_Supplier FROM Supplier';
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		echo '<option>' . $row['Id_Supplier'] .'</option>';
	}
}

//mysqli_close();
?>
