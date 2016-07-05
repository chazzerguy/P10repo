<?php
	$dsn = 'mysql:host=localhost; dbname=work';
	$username = 'root';
	$password = '';
	
	try {
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
		echo 'ERROR connecting to database!!!' . $e->getMessage();
		exit();
	}
?>