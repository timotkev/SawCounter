<?php
session_start();

require 'database/connection.php';

$sql = 'SELECT * FROM Karyawan WHERE User_Name = "'. $_POST['username'] .'" AND Password ="' . $_POST['passwd'] .'"';

//$sql2 = 'SELECT Id_Karyawan FROM Karyawan WHERE ';

if($result = mysqli_query($conn, $sql))
{
	if(mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$_SESSION['usernameSession'] = $_POST['username'];
			$_SESSION['IdSession'] = $row['Id_Karyawan'];
			//echo $_SESSION['usernameSession'];
			header('Location: beranda.php');
		}
	}
	else
	{
		$_SESSION['wrongPass'] = 1;
		header('Location: http://localhost/SAW/Mockup/');
		//echo 'password wrong';
	}
		
}



?>