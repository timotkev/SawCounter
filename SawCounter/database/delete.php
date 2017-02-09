<?php
require 'connection.php';
//$tempID = $_POST['tempID'];
$sql = 'DELETE FROM Supplier WHERE Id_Supplier="' . $_GET['tempID'] .'"';

if(mysqli_query($conn, $sql))
{
	header("Location: http://localhost/SAW/Mockup/pemasok.php");
	//echo $_GET['tempID'];
}
else
{
	echo mysqli_error($conn);
}

mysqli_close($conn);



?>