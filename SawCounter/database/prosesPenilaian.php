<?php
session_start();
require 'connection.php';



$mintaIDPemasok = 'SELECT Id_Supplier FROM supplier WHERE Nama_Supplier="'. $_SESSION['tempPemasok'] .'"';
//SELECT Id_Supplier FROM supplier WHERE Nama_Supplier='sate bebek'
$result = mysqli_query($conn, $mintaIDPemasok);

if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_assoc($result))
	{
		$IDPemasok = $row['Id_Supplier'];
		
	}
}
else
{
	//echo('error juga mas');
}
$totalEuy = $_GET['St1'] + $_GET['St2'] + $_GET['St3'] + $_GET['St4'] + $_GET['St5'] + $_GET['St6'] + $_GET['St7'] + $_GET['St8'] + $_GET['St9'] + $_GET['St10']+ $_GET['St11']+ $_GET['St12'] + $_GET['St13'] + $_GET['St14'] + $_GET['St15'] + $_GET['St16'] + $_GET['St17'];


$sql = 'INSERT INTO penilaian VALUES ('. $_SESSION['IdSession'] .',"'. $IDPemasok .'",'
. $_GET['St1'] .','
. $_GET['St2'] .','
. $_GET['St3'] .','
. $_GET['St4'] .','
. $_GET['St5'] .','
. $_GET['St6'] .','
. $_GET['St7'] .','
. $_GET['St8'] .','
. $_GET['St9'] .','
. $_GET['St10'] .','
. $_GET['St11'] .','
. $_GET['St12'] .','
. $_GET['St13'] .','
. $_GET['St14'] .','
. $_GET['St15'] .','
. $_GET['St16'] .','
. $_GET['St17'] .')';


if(mysqli_query($conn, $sql))
{
	//ini perhitungan SAW
	
	$countMaxSt1 = 0;
	$countMaxSt2 = 0;
	$countMaxSt3 = 0;
	$countMaxSt4 = 0;
	$countMaxSt5 = 0;
	$countMaxSt6 = 0;
	$countMaxSt7 = 0;
	$countMaxSt8 = 0;
	$countMaxSt9 = 0;
	$countMaxSt10 = 0;
	$countMaxSt11 = 0;
	$countMaxSt12 = 0;
	$countMaxSt13 = 0;
	$countMaxSt14 = 0;
	$countMaxSt15 = 0;
	$countMaxSt16 = 0;
	$countMaxSt17 = 0;
	
	$sqlSelectAllSupplier = 'SELECT DISTINCT (Id_Supplier) FROM penilaian';
	$resultSelectAllSupplier = mysqli_query($conn, $sqlSelectAllSupplier);
	if(mysqli_num_rows($resultSelectAllSupplier) > 0)
	{
		while($rowSelectAllSupplier = mysqli_fetch_assoc($resultSelectAllSupplier))
		{
			$selectedSupplier = $rowSelectAllSupplier['Id_Supplier'];
			$sqlBacaDataKuesioner = 'SELECT * FROM penilaian WHERE Id_Supplier = "'. $rowSelectAllSupplier['Id_Supplier'] .'"';
			
			//test
			//echo $sqlBacaDataKuesioner - correct;
			
			$resultBacaDataKuesioner = mysqli_query($conn, $sqlBacaDataKuesioner);
			if(mysqli_num_rows($resultBacaDataKuesioner) > 0)
			{
				//$countTotal = 0;
				$countSt1 = 0;
				$countSt2 = 0;
				$countSt3 = 0;
				$countSt4 = 0;
				$countSt5 = 0;
				$countSt6 = 0;
				$countSt7 = 0;
				$countSt8 = 0;
				$countSt9 = 0;
				$countSt10 = 0;
				$countSt11 = 0;
				$countSt12 = 0;
				$countSt13 = 0;
				$countSt14 = 0;
				$countSt15 = 0;
				$countSt16 = 0;
				$countSt17 = 0;
				
				while($rowBacaDataKuesioner = mysqli_fetch_assoc($resultBacaDataKuesioner))
				{
					//1st count
					$countSt1 = $countSt1 + $rowBacaDataKuesioner['St1'];
					$countSt2 = $countSt2 + $rowBacaDataKuesioner['St2'];
					$countSt3 = $countSt3 + $rowBacaDataKuesioner['St3'];
					$countSt4 = $countSt4 + $rowBacaDataKuesioner['St4'];
					$countSt5 = $countSt5 + $rowBacaDataKuesioner['St5'];
					$countSt6 = $countSt6 + $rowBacaDataKuesioner['St6'];
					$countSt7 = $countSt7 + $rowBacaDataKuesioner['St7'];
					$countSt8 = $countSt8 + $rowBacaDataKuesioner['St8'];
					$countSt9 = $countSt9 + $rowBacaDataKuesioner['St9'];
					$countSt10 = $countSt10 + $rowBacaDataKuesioner['St10'];
					$countSt11 = $countSt11 + $rowBacaDataKuesioner['St11'];
					$countSt12 = $countSt12 + $rowBacaDataKuesioner['St12'];
					$countSt13 = $countSt13 + $rowBacaDataKuesioner['St13'];
					$countSt14 = $countSt14 + $rowBacaDataKuesioner['St14'];
					$countSt15 = $countSt15 + $rowBacaDataKuesioner['St15'];
					$countSt16 = $countSt16 + $rowBacaDataKuesioner['St16'];
					$countSt17 = $countSt17 + $rowBacaDataKuesioner['St17'];
					
					$countTotal++;
					
					//test
					//echo $countSt1 . 'X' . $countTotal . '<br/>' - correct;
					
				}
				
				//2nd count
				$count2St1 = $countSt1/(5*$countTotal);
				$count2St2 = $countSt2/(5*$countTotal);
				$count2St3 = $countSt3/(5*$countTotal);
				$count2St4 = $countSt4/(5*$countTotal);
				$count2St5 = $countSt5/(5*$countTotal);
				$count2St6 = $countSt6/(5*$countTotal);
				$count2St7 = $countSt7/(5*$countTotal);
				$count2St8 = $countSt8/(5*$countTotal);
				$count2St9 = $countSt9/(5*$countTotal);
				$count2St10 = $countSt10/(5*$countTotal);
				$count2St11 = $countSt11/(5*$countTotal);
				$count2St12 = $countSt12/(5*$countTotal);
				$count2St13 = $countSt13/(5*$countTotal);
				$count2St14 = $countSt14/(5*$countTotal);
				$count2St15 = $countSt15/(5*$countTotal);
				$count2St16 = $countSt16/(5*$countTotal);
				$count2St17 = $countSt17/(5*$countTotal);
				
				//test
				//echo $count2St1 . '<br/>' - correct;
				
				
				//3rd count
				$count3St1 = $count2St1 * 100;
				$count3St2 = $count2St2 * 100;
				$count3St3 = $count2St3 * 100;
				$count3St4 = $count2St4 * 100;
				$count3St5 = $count2St5 * 100;
				$count3St6 = $count2St6 * 100;
				$count3St7 = $count2St7 * 100;
				$count3St8 = $count2St8 * 100;
				$count3St9 = $count2St9 * 100;
				$count3St10 = $count2St10 * 100;
				$count3St11 = $count2St11 * 100;
				$count3St12 = $count2St12 * 100;
				$count3St13 = $count2St13 * 100;
				$count3St14 = $count2St14 * 100;
				$count3St15 = $count2St15 * 100;
				$count3St16 = $count2St16 * 100;
				$count3St17 = $count2St17 * 100;
				
				//save 3rd count to database
				$sqlSaveCount3 = 'INSERT INTO penilaiantemp VALUES
				(
					"'. $rowSelectAllSupplier['Id_Supplier'] .'",
					'. $count3St1 .',
					'. $count3St2 .',
					'. $count3St3 .',
					'. $count3St4 .',
					'. $count3St5 .',
					'. $count3St6 .',
					'. $count3St7 .',
					'. $count3St8 .',
					'. $count3St9 .',
					'. $count3St10 .',
					'. $count3St11 .',
					'. $count3St12 .',
					'. $count3St13 .',
					'. $count3St14 .',
					'. $count3St15 .',
					'. $count3St16 .',
					'. $count3St17 .'
				)';
				mysqli_query($conn, $sqlSaveCount3);
				
				
				if($countMaxSt1 < $count3St1)
				{
					$countMaxSt1 = $count3St1;
				}
				else
				{}
			
				if($countMaxSt2 < $count3St2)
				{
					$countMaxSt2 = $count3St2;
				}
				else
				{}
			
				if($countMaxSt3 < $count3St3)
				{
					$countMaxSt3 = $count3St3;
				}
				else
				{}
			
				if($countMaxSt4 < $count3St4)
				{
					$countMaxSt4 = $count3St4;
				}
				else
				{}
			
				if($countMaxSt5 < $count3St5)
				{
					$countMaxSt5 = $count3St5;
				}
				else
				{}
			
				if($countMaxSt6 < $count3St6)
				{
					$countMaxSt6 = $count3St6;
				}
				else
				{}
			
				if($countMaxSt7 < $count3St7)
				{
					$countMaxSt7 = $count3St7;
				}
				else
				{}
			
				if($countMaxSt8 < $count3St8)
				{
					$countMaxSt8 = $count3St8;
				}
				else
				{}
			
				if($countMaxSt9 < $count3St9)
				{
					$countMaxSt9 = $count3St9;
				}
				else
				{}
			
				if($countMaxSt10 < $count3St10)
				{
					$countMaxSt10 = $count3St10;
				}
				else
				{}
			
				if($countMaxSt11 < $count3St11)
				{
					$countMaxSt11 = $count3St11;
				}
				else
				{}
			
				if($countMaxSt12 < $count3St12)
				{
					$countMaxSt12 = $count3St12;
				}
				else
				{}
			
				if($countMaxSt13 < $count3St13)
				{
					$countMaxSt13 = $count3St13;
				}
				else
				{}
			
				if($countMaxSt14 < $count3St14)
				{
					$countMaxSt14 = $count3St14;
				}
				else
				{}
			
				if($countMaxSt15 < $count3St15)
				{
					$countMaxSt15 = $count3St15;
				}
				else
				{}
			
				if($countMaxSt16 < $count3St16)
				{
					$countMaxSt16 = $count3St16;
				}
				else
				{}
			
				if($countMaxSt17< $count3St17)
				{
					$countMaxSt17 = $count3St17;
				}
				else
				{}
			
			
				//test
				//echo $countMaxSt1 . '<br/><br/><br/>' - correct;
			}
			//trouble? please don't

			else
			{
				echo 'gagal';
			}
			
			//echo $count3St1 . 'and' . $countMaxSt1 - trouble;
		}
		//echo $count3St1 . 'and' . $countMaxSt1;
		$sqlReadSupplier = 'SELECT DISTINCT (Id_Supplier) FROM penilaian';
		$resultReadSupplier = mysqli_query($conn, $sqlReadSupplier);
		if(mysqli_num_rows($resultReadSupplier) > 0)
		{
			while($rowReadSupplier = mysqli_fetch_assoc($resultReadSupplier))
			{
				$sqlUpdateMax = 'INSERT INTO penilaianmax VALUES 
				(
					"'. $rowReadSupplier['Id_Supplier'] .'",
					'. $countMaxSt1 .',
					'. $countMaxSt2 .',
					'. $countMaxSt3 .',
					'. $countMaxSt4 .',
					'. $countMaxSt5 .',
					'. $countMaxSt6 .',
					'. $countMaxSt7 .',
					'. $countMaxSt8 .',
					'. $countMaxSt9 .',
					'. $countMaxSt10 .',
					'. $countMaxSt11 .',
					'. $countMaxSt12 .',
					'. $countMaxSt13 .',
					'. $countMaxSt14 .',
					'. $countMaxSt15 .',
					'. $countMaxSt16 .',
					'. $countMaxSt17 .'
				)';
				mysqli_query($conn, $sqlUpdateMax);
				
				$sqlTakeValue3 = 'SELECT * FROM penilaiantemp WHERE Id_Supplier = "'. $rowReadSupplier['Id_Supplier'] .'"';
				$resultTakeValue3 = mysqli_query($conn, $sqlTakeValue3);
				if(mysqli_num_rows($resultTakeValue3) > 0)
				{
					while($rowTakeValue3 = mysqli_fetch_assoc($resultTakeValue3))
					{
						//4th count 
						$count4St1 = $rowTakeValue3['St1Temp'] / $countMaxSt1;
						$count4St2 = $rowTakeValue3['St2Temp'] / $countMaxSt2;
						$count4St3 = $rowTakeValue3['St3Temp'] / $countMaxSt3;
						$count4St4 = $rowTakeValue3['St4Temp'] / $countMaxSt4;
						$count4St5 = $rowTakeValue3['St5Temp'] / $countMaxSt5;
						$count4St6 = $rowTakeValue3['St6Temp'] / $countMaxSt6;
						$count4St7 = $rowTakeValue3['St7Temp'] / $countMaxSt7;
						$count4St8 = $rowTakeValue3['St8Temp'] / $countMaxSt8;
						$count4St9 = $rowTakeValue3['St9Temp'] / $countMaxSt9;
						$count4St10 = $rowTakeValue3['St10Temp'] / $countMaxSt10;
						$count4St11 = $rowTakeValue3['St11Temp'] / $countMaxSt11;
						$count4St12 = $rowTakeValue3['St12Temp'] / $countMaxSt12;
						$count4St13 = $rowTakeValue3['St13Temp'] / $countMaxSt13;
						$count4St14 = $rowTakeValue3['St14Temp'] / $countMaxSt14;
						$count4St15 = $rowTakeValue3['St15Temp'] / $countMaxSt15;
						$count4St16 = $rowTakeValue3['St16Temp'] / $countMaxSt16;
						$count4St17 = $rowTakeValue3['St17Temp'] / $countMaxSt17;
						//echo 'nilai 4: ' . $count4St1;
						
						//5th count
						
						//1st
						if($rowTakeValue3['St1Temp'] <= 100)
						{
							if($rowTakeValue3['St1Temp'] < 85)
							{
								if($rowTakeValue3['St1Temp'] < 69)
								{
									if($rowTakeValue3['St1Temp'] < 53)
									{
										if($rowTakeValue3['St1Temp'] < 37)
										{
											if($rowTakeValue3['St1Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta1 = 1;
											}
										}
										else
										{
											$konstanta1 = 2;
										}
									}
									else
									{
										$konstanta1 = 3;
									}
								}
								else
								{
									$konstanta1 = 4;
								}
							}
							else
							{
								$konstanta1 = 5;
							}
						}
						$count5St1 = $count4St1 * $konstanta1;
						//echo $count5St1 . '<br/>' - correct;
						
						
						//2nd
						if($rowTakeValue3['St2Temp'] <= 100)
						{
							if($rowTakeValue3['St2Temp'] < 85)
							{
								if($rowTakeValue3['St2Temp'] < 69)
								{
									if($rowTakeValue3['St2Temp'] < 53)
									{
										if($rowTakeValue3['St2Temp'] < 37)
										{
											if($rowTakeValue3['St2Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta2 = 1;
											}
										}
										else
										{
											$konstanta2 = 2;
										}
									}
									else
									{
										$konstanta2 = 3;
									}
								}
								else
								{
									$konstanta2 = 4;
								}
							}
							else
							{
								$konstanta2 = 5;
							}
						}
						$count5St2 = $count4St2 * $konstanta2;
						
						
						//3rd
						if($rowTakeValue3['St3Temp'] <= 100)
						{
							if($rowTakeValue3['St3Temp'] < 85)
							{
								if($rowTakeValue3['St3Temp'] < 69)
								{
									if($rowTakeValue3['St3Temp'] < 53)
									{
										if($rowTakeValue3['St3Temp'] < 37)
										{
											if($rowTakeValue3['St3Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta3 = 1;
											}
										}
										else
										{
											$konstanta3 = 2;
										}
									}
									else
									{
										$konstanta3 = 3;
									}
								}
								else
								{
									$konstanta3 = 4;
								}
							}
							else
							{
								$konstanta3 = 5;
							}
						}
						$count5St3 = $count4St3 * $konstanta3;						
						
						//4th
						if($rowTakeValue3['St4Temp'] <= 100)
						{
							if($rowTakeValue3['St4Temp'] < 85)
							{
								if($rowTakeValue3['St4Temp'] < 69)
								{
									if($rowTakeValue3['St4Temp'] < 53)
									{
										if($rowTakeValue3['St4Temp'] < 37)
										{
											if($rowTakeValue3['St4Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta4 = 1;
											}
										}
										else
										{
											$konstanta4 = 2;
										}
									}
									else
									{
										$konstanta4 = 3;
									}
								}
								else
								{
									$konstanta4 = 4;
								}
							}
							else
							{
								$konstanta4 = 5;
							}
						}
						$count5St4 = $count4St4 * $konstanta4;	
						
						
						//5th
						if($rowTakeValue3['St5Temp'] <= 100)
						{
							if($rowTakeValue3['St5Temp'] < 85)
							{
								if($rowTakeValue3['St5Temp'] < 69)
								{
									if($rowTakeValue3['St5Temp'] < 53)
									{
										if($rowTakeValue3['St5Temp'] < 37)
										{
											if($rowTakeValue3['St5Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta5 = 1;
											}
										}
										else
										{
											$konstanta5 = 2;
										}
									}
									else
									{
										$konstanta5 = 3;
									}
								}
								else
								{
									$konstanta5 = 4;
								}
							}
							else
							{
								$konstanta5 = 5;
							}
						}
						$count5St5 = $count4St5 * $konstanta5;							


						//6th
						if($rowTakeValue3['St6Temp'] <= 100)
						{
							if($rowTakeValue3['St6Temp'] < 85)
							{
								if($rowTakeValue3['St6Temp'] < 69)
								{
									if($rowTakeValue3['St6Temp'] < 53)
									{
										if($rowTakeValue3['St6Temp'] < 37)
										{
											if($rowTakeValue3['St6Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta6 = 1;
											}
										}
										else
										{
											$konstanta6 = 2;
										}
									}
									else
									{
										$konstanta6 = 3;
									}
								}
								else
								{
									$konstanta6 = 4;
								}
							}
							else
							{
								$konstanta6 = 5;
							}
						}
						$count5St6 = $count4St6 * $konstanta6;							

						
						//7th
						if($rowTakeValue3['St7Temp'] <= 100)
						{
							if($rowTakeValue3['St7Temp'] < 85)
							{
								if($rowTakeValue3['St7Temp'] < 69)
								{
									if($rowTakeValue3['St7Temp'] < 53)
									{
										if($rowTakeValue3['St7Temp'] < 37)
										{
											if($rowTakeValue3['St7Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta7 = 1;
											}
										}
										else
										{
											$konstanta7 = 2;
										}
									}
									else
									{
										$konstanta7 = 3;
									}
								}
								else
								{
									$konstanta7 = 4;
								}
							}
							else
							{
								$konstanta7 = 5;
							}
						}
						$count5St7 = $count4St7 * $konstanta7;							

						
						//8th
						if($rowTakeValue3['St8Temp'] <= 100)
						{
							if($rowTakeValue3['St8Temp'] < 85)
							{
								if($rowTakeValue3['St8Temp'] < 69)
								{
									if($rowTakeValue3['St8Temp'] < 53)
									{
										if($rowTakeValue3['St8Temp'] < 37)
										{
											if($rowTakeValue3['St8Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta8 = 1;
											}
										}
										else
										{
											$konstanta8 = 2;
										}
									}
									else
									{
										$konstanta8 = 3;
									}
								}
								else
								{
									$konstanta8 = 4;
								}
							}
							else
							{
								$konstanta8 = 5;
							}
						}
						$count5St8 = $count4St8 * $konstanta8;
						
						//9th
						if($rowTakeValue3['St9Temp'] <= 100)
						{
							if($rowTakeValue3['St9Temp'] < 85)
							{
								if($rowTakeValue3['St9Temp'] < 69)
								{
									if($rowTakeValue3['St9Temp'] < 53)
									{
										if($rowTakeValue3['St9Temp'] < 37)
										{
											if($rowTakeValue3['St9Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta9 = 1;
											}
										}
										else
										{
											$konstanta9 = 2;
										}
									}
									else
									{
										$konstanta9 = 3;
									}
								}
								else
								{
									$konstanta9 = 4;
								}
							}
							else
							{
								$konstanta9 = 5;
							}
						}
						$count5St9 = $count4St9 * $konstanta9;						
						
						
						//10th
						if($rowTakeValue3['St10Temp'] <= 100)
						{
							if($rowTakeValue3['St10Temp'] < 85)
							{
								if($rowTakeValue3['St10Temp'] < 69)
								{
									if($rowTakeValue3['St10Temp'] < 53)
									{
										if($rowTakeValue3['St10Temp'] < 37)
										{
											if($rowTakeValue3['St10Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta10 = 1;
											}
										}
										else
										{
											$konstanta10 = 2;
										}
									}
									else
									{
										$konstanta10 = 3;
									}
								}
								else
								{
									$konstanta10 = 4;
								}
							}
							else
							{
								$konstanta10 = 5;
							}
						}
						$count5St10 = $count4St10 * $konstanta10;

						
						
						//11th
						if($rowTakeValue3['St11Temp'] <= 100)
						{
							if($rowTakeValue3['St11Temp'] < 85)
							{
								if($rowTakeValue3['St11Temp'] < 69)
								{
									if($rowTakeValue3['St11Temp'] < 53)
									{
										if($rowTakeValue3['St11Temp'] < 37)
										{
											if($rowTakeValue3['St11Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta11 = 1;
											}
										}
										else
										{
											$konstanta11 = 2;
										}
									}
									else
									{
										$konstanta11 = 3;
									}
								}
								else
								{
									$konstanta11 = 4;
								}
							}
							else
							{
								$konstanta11 = 5;
							}
						}
						$count5St11 = $count4St11 * $konstanta11;						
						
						
						//12th
						if($rowTakeValue3['St12Temp'] <= 100)
						{
							if($rowTakeValue3['St12Temp'] < 85)
							{
								if($rowTakeValue3['St12Temp'] < 69)
								{
									if($rowTakeValue3['St12Temp'] < 53)
									{
										if($rowTakeValue3['St12Temp'] < 37)
										{
											if($rowTakeValue3['St12Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta12 = 1;
											}
										}
										else
										{
											$konstanta12 = 2;
										}
									}
									else
									{
										$konstanta12 = 3;
									}
								}
								else
								{
									$konstanta12 = 4;
								}
							}
							else
							{
								$konstanta12 = 5;
							}
						}
						$count5St12 = $count4St12 * $konstanta12;							
						
						
						
						//13th
						if($rowTakeValue3['St13Temp'] <= 100)
						{
							if($rowTakeValue3['St13Temp'] < 85)
							{
								if($rowTakeValue3['St13Temp'] < 69)
								{
									if($rowTakeValue3['St13Temp'] < 53)
									{
										if($rowTakeValue3['St13Temp'] < 37)
										{
											if($rowTakeValue3['St13Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta13 = 1;
											}
										}
										else
										{
											$konstanta13 = 2;
										}
									}
									else
									{
										$konstanta13 = 3;
									}
								}
								else
								{
									$konstanta13 = 4;
								}
							}
							else
							{
								$konstanta13 = 5;
							}
						}
						$count5St13 = $count4St13 * $konstanta13;						
						
						
						//14th
						if($rowTakeValue3['St14Temp'] <= 100)
						{
							if($rowTakeValue3['St14Temp'] < 85)
							{
								if($rowTakeValue3['St14Temp'] < 69)
								{
									if($rowTakeValue3['St14Temp'] < 53)
									{
										if($rowTakeValue3['St14Temp'] < 37)
										{
											if($rowTakeValue3['St14Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta14 = 1;
											}
										}
										else
										{
											$konstanta14 = 2;
										}
									}
									else
									{
										$konstanta14 = 3;
									}
								}
								else
								{
									$konstanta14 = 4;
								}
							}
							else
							{
								$konstanta14 = 5;
							}
						}
						$count5St14 = $count4St14 * $konstanta14;					
						
						
						//15th
						if($rowTakeValue3['St15Temp'] <= 100)
						{
							if($rowTakeValue3['St15Temp'] < 85)
							{
								if($rowTakeValue3['St15Temp'] < 69)
								{
									if($rowTakeValue3['St15Temp'] < 53)
									{
										if($rowTakeValue3['St15Temp'] < 37)
										{
											if($rowTakeValue3['St15Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta15 = 1;
											}
										}
										else
										{
											$konstanta15 = 2;
										}
									}
									else
									{
										$konstanta15 = 3;
									}
								}
								else
								{
									$konstanta15 = 4;
								}
							}
							else
							{
								$konstanta15 = 5;
							}
						}
						$count5St15 = $count4St15 * $konstanta15;

						//16th
						if($rowTakeValue3['St16Temp'] <= 100)
						{
							if($rowTakeValue3['St16Temp'] < 85)
							{
								if($rowTakeValue3['St16Temp'] < 69)
								{
									if($rowTakeValue3['St16Temp'] < 53)
									{
										if($rowTakeValue3['St16Temp'] < 37)
										{
											if($rowTakeValue3['St16Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta16 = 1;
											}
										}
										else
										{
											$konstanta16 = 2;
										}
									}
									else
									{
										$konstanta16 = 3;
									}
								}
								else
								{
									$konstanta16 = 4;
								}
							}
							else
							{
								$konstanta16 = 5;
							}
						}
						$count5St16 = $count4St16 * $konstanta16;						

						//17th
						if($rowTakeValue3['St17Temp'] <= 100)
						{
							if($rowTakeValue3['St17Temp'] < 85)
							{
								if($rowTakeValue3['St17Temp'] < 69)
								{
									if($rowTakeValue3['St17Temp'] < 53)
									{
										if($rowTakeValue3['St17Temp'] < 37)
										{
											if($rowTakeValue3['St17Temp'] < 20)
											{
												
											}
											else
											{
												$konstanta17 = 1;
											}
										}
										else
										{
											$konstanta17 = 2;
										}
									}
									else
									{
										$konstanta17 = 3;
									}
								}
								else
								{
									$konstanta17 = 4;
								}
							}
							else
							{
								$konstanta17 = 5;
							}
						}
						$count5St17 = $count4St17 * $konstanta17;							
						
						$totalCountSAW = $count5St1 + $count5St2 + $count5St3 + $count5St4 + $count5St5 + $count5St6 + $count5St7 + $count5St8 + $count5St9 + $count5St10 + $count5St11 + $count5St12 + $count5St13 + $count5St14 + $count5St15 + $count5St16 + $count5St17;
						$roundSAW = round($totalCountSAW, 2);
						//echo 'total SAW: ' . $totalCountSAW . '<br/>';
						
						$sqlUpdateNilaiSAW = 'UPDATE supplier SET Nilai = '. $roundSAW .' WHERE Id_Supplier = "'. $rowReadSupplier['Id_Supplier'] .'"';
						
						
						
						if(mysqli_query($conn, $sqlUpdateNilaiSAW))
						{
							echo 'perhitungan sukses. Data telah dimasukkan';
							echo '<a href="http://localhost/SAW/Mockup">Back</a>';
						}
						else
						{
							echo 'perhitungan gagal';
						}
						//echo $sqlUpdateNilaiSAW;
						
						
						
						//header();
					}
				}
				else
				{
					
				}
			}
		}
		else
		{
			
		}
		
	}
	else
	{
		
	}
	

		/*
		$sql2 = 'UPDATE supplier SET Nilai = ' . $nilaiSAW .' WHERE Id_Supplier = "' . $IDPemasok . '"';
		if(mysqli_query($conn, $sql2))
		{
			echo 'sukses';
		}
		else
		{
			echo 'update nilai saw gagal';
		}
		*/
}
else
{
	//echo 'gagal';
	echo $sql;
}



//-----------------------------------------------------------------------------//
//--------------------------------iteration 2----------------------------------//



?>