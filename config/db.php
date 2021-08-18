<?php
	$DB_HOST = "localhost";
	$DB_USER = "root";
	$DB_NAME = "schoolvi";
	$DB_PASSWORD = "";
	try {
		$_DB = new PDO(
			"mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",
			$DB_USER,
			$DB_PASSWORD,
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);
	} catch (Exception $e) {
		die('COULD NOT CONNECT TO DB SET GOOD IDENTIFIERS' . $e->getMessage());
	}
