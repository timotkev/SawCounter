<?php

$sql2 = 'SELECT DISTINCT Id_Supplier FROM penilaian';

$result2 = mysqli_query($conn, $sql2);
$i = 1;
$S = 'S';
if(mysqli_num_rows($result2) > 0)
{
	while($row2 = mysqli_fetch_assoc($result2))
	{
		//echo $row2['Id_Karyawan'];
		//$S . $i = $row2['Id_Supplier'];
		
		//echo $S . $i;
		//$i++;
		
		$sql3 = 'SELECT * FROM penilaian WHERE Id_Supplier = "'. $row2['Id_Supplier'] .'"';
		$result3 = mysqli_query($conn, $sql3);
		if(mysqli_num_rows($result3) > 0)
		{
			while($row3 = mysqli_fetch_assoc($result3))
			{
				
				echo $row3['St1'];
				echo $row3['St2'];
				echo $row3['St3'];
				echo $row3['St4'];
				echo $row3['St5'];
				echo $row3['St6'];
				echo $row3['St7'];
				echo $row3['St8'];
				echo $row3['St9'];
				echo $row3['St10'];
				echo $row3['St11'];
				echo $row3['St12'];
				echo $row3['St13'];
				echo $row3['St14'];
				echo $row3['St15'];
				echo $row3['St16'];
				echo $row3['St17'];
				
			}			
		}
		else
		{
			echo 'something wrong';
			echo $S . $i;
		}
		
		
	}
}
else
{
	echo('error juga mas');
}





?>