<?php 
	// 데이터베이스 configuration 파일

	error_reporting(E_ALL);
	$user = 'root';
	$password = '****';
	$db = 'comento';
	$host = 'localhost';
	$port = 8889;

	$link = mysqli_init();
	$success = mysqli_real_connect(
	   $link,
	   $host,
	   $user,
	   $password,
	   $db,
	   $port
	) or die("DB Connection Error!");

	echo "DB Connection Success!" . "<br>";
	echo "=====================" . "<br>";
?>