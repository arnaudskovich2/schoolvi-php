<?php
	session_start();
	require_once "../../models/docs/autoload2.php";
	require_once "../../config/db.php";
	global $_DB;
	
	$old = isset($_GET['old']) ? (string) $_GET['old'] : '';
	$page = isset($_GET['page']) && preg_match("#^\d+$#", $_GET['page'])
		? (string) $_GET['page']
		: "";
	
	$current = (string) $_SESSION['current'];
	$_AUTH_FROM = ["epreuves", "annales", "cours"];
	
	//CASE COMING FROM A DOC TYPE PAGE
	if (isset($current) && in_array($current, $_AUTH_FROM, true)) {
		$_SESSION['search'] = [$current => []];
		//INITIALIZING MANAGERS FOR EACH TYPE OF DOC
		$_MANAGERS_ARRAY = [
			"epreuves" => new EpreuveManager($_DB),
			"annales" => new AnnaleManager($_DB),
			"cours" => new CoursManager($_DB)
		];
		
		//CASE NO OLD SEARCH WAS FOUND
		if ($old === "" && $page === "") {
			//REDIRECTING TO SEARCH FOR DEFAULT ON THE MAIN PAGE
			header("Location:./search.php");
			return;
		}
		
		//INITIALIZING NEW MANAGER TO PERFORM SEARCH
		$_MANAGER = $_MANAGERS_ARRAY[$current];
		
		//CASE COMING FROM MAIN PAGE OF THE DOC
		if ($old === "" && $page !== "" && (int) $page >= 0) {
			$from = 25 * (int) $page;
			$_result = $_MANAGER->searchForDefault([], $from);
			$_SESSION['search'][$current] = $_result[0];
			$_count = $_result[1][0];
			$_SESSION['pagination'] = [];
			if (ceil($_count / 25)>1) {
				for ($i = 0; $i < ceil((int) $_count / 25); $i++) {
					$_SESSION['pagination'][] = "/controllers/docs/pagination.php?page=" . $i;
				}
			}
			header('Location:/views/' . $current . '/index.php?page=' . $page);
			return;
		}
	}
	
	//NOT IN LOGIC
	header("Location: /views/notFound.php");
	return;
	