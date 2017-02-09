<?php
session_start();
require 'connection.php';
//$sql = 'INSERT INTO Supplier (Id_Supplier, Nama_Supplier, Address, Phone, Fax) VALUES ('. $_POST['uname'] .', '. $_POST['uname'] .', '. $_POST['uname'] .', '. $_POST['uname'] .')';


$checkRows = 'SELECT * FROM Supplier';
$numRows = mysqli_num_rows(mysqli_query($conn, $checkRows)) + 1;



$sql = 'INSERT INTO Supplier (Id_Supplier, Nama_Supplier, Address, Phone, Fax) VALUES ("S'. $numRows .'", "'. $_POST['uname'] .'", "'. $_POST['addr'] .'", "'. $_POST['telp'] .'", "'. $_POST['fax'] .'")';

if(mysqli_query($conn, $sql))
{
	//echo '<script type="text/javascript">alert("ok");</script>';
	$_SESSION['insertSuccess'] = 1;
	header("Location: http://localhost/SAW/Mockup/bobot.php");
}
else
{
	echo mysqli_error($conn);
}

mysqli_close($conn);
?>