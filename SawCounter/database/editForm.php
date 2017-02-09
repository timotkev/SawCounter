<?php
require 'connection.php';

$id = $_GET['idField'];
$nama = $_GET['nameField'];
$alamat = $_GET['addrField'];
$phone = $_GET['phoneField'];
$fax = $_GET['faxField'];


$sql = 'UPDATE supplier 
SET 
Id_Supplier="'. $id .'",
Nama_Supplier="'. $nama .'",
Address="'. $alamat .'",
Phone="'. $phone .'",
Fax="'. $fax .'"

WHERE
Id_Supplier="'. $id .'"
';

if(mysqli_query($conn, $sql))
{
	
	header("Location: http://localhost/SAW/Mockup/pemasok.php?sukses=1");
	//echo 'sukses edit';
}
else
{
	echo mysqli_error($conn);
}

mysqli_close($conn);


?>