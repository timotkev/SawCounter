<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'sawdb';

$autoId = 1;

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn)
{
	die('error mas' . mysqli_connect_error());
}
//echo('sukses');

?>