<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$databaseName = 'watches';

$con = mysqli_connect($hostname,$username,$password,$databaseName);

if(!$con){
	die('<h1>DataBase is not connected</h1>');
}
?>