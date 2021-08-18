<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	
	unset(
		$_SESSION['adminConnErr'],
		$_SESSION['admin'],
		$_SESSION['adminConn'],
		$_SESSION['addDocError'],
		$_SESSION['addDocSuccess']
	);
	header('Location: /admin/views/login.php');