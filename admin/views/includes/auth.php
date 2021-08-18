<?php
	if($_SESSION['currentAdmin'] !== "login") {
		if (!isset($_SESSION['adminConn']) || $_SESSION['adminConn'] !== true) {
			header('Location: /admin/views/login.php');
		}
	}
	return;