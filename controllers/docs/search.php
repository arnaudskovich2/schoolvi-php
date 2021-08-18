<?php
	session_start();
	require_once "../../models/docs/autoload2.php";
	require_once "../../config/db.php";
	global $_DB;
	
	$current = (string)( $_SESSION['current'] ?? '');
	$_AUTH_FROM = ["epreuves", "annales", "cours"];
	//DO RESEARCH FOR DEFAULT
	if (isset($current) && in_array($current, $_AUTH_FROM, true)) {
		$_SESSION['search'] = [$current => []];
		$_MANAGERS_ARRAY = [
			"epreuves" => new EpreuveManager($_DB),
			"annales" => new AnnaleManager($_DB),
			"cours" => new CoursManager($_DB)
		];
		$_MANAGER = $_MANAGERS_ARRAY[$current];
		
		if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true) {
			$_filter = ['classe' => $_SESSION['user']['classe'], 'serie' => $_SESSION['user']['serie']];
			$_to_return = $_MANAGER->searchForDefault($_filter);
		} else {
			$_to_return = $_MANAGER->searchForDefault([]);
		}
		
		$_SESSION['search'][$current] = $_to_return[0];
		$_SESSION['pagination'] = [];
		$_count = (int) $_to_return[1][0];
		//IF NUMBER OF RESULTS IS GREATER THAN THE COUNT VAR WE CREATE PAGINATION LINKS
		if (ceil($_count / 25) > 1) {
			for ($i = 0; $i < ceil($_count / 25); $i++) {
				$_SESSION['pagination'][] = "/controllers/docs/pagination.php?page=" . $i;
			}
		}
		$_next = "Location:/views/$current/index.php?page=0";
		header($_next);
		return;
	}
	
	//NOT IN LOGIC
	header("Location: /views/index.php");
	return;
