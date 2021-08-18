<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	
	$typo = $_GET['type'] ?? '';
	
	//SETTING THE SEARCH STRING
	if (isset($_POST['search']) && preg_match("#^(.)+$#", $_POST['search'])) {
		$search = htmlspecialchars($_POST['search']);
	} else if (isset($_GET['search']) && preg_match("#^(.)+$#", $_GET['search'])) {
		$search = htmlspecialchars($_GET['search']);
	} else {
		$search = "";
	}
	
	$page = isset($_GET['page']) && preg_match("#^\d+$#", $_GET['page'])
		? (int) htmlspecialchars($_GET['page'])
		: 0;
	
	$_AM = new AnnaleManager($_DB);
	$_EM = new EpreuveManager($_DB);
	$_CM = new CoursManager($_DB);
	
	function paginate (int $num, string $search, int $count, string $typo) : array
	{
		$to_return = [];
		if (ceil($num / $count) > 1) {
			for ($i = 0; $i < ceil($num / $count); $i++) {
				$to_return[] = "/admin/controllers/search.php?&type=$typo&"."search=" . $search . "&page=" . $i;
			}
		}
		return $to_return;
	}
	
	if ($search !== "") {
		$from = $page * 15;
		$_AR = $_AM->searchWithString($search, $from);
		$_CR = $_CM->searchWithString($search, $from);
		$_ER = $_EM->searchWithString($search, $from);
	}else{
		$_AR = $_AM->searchForDefault([], $page * 25);
		$_CR = $_CM->searchForDefault([], $page * 25);
		$_ER = $_EM->searchForDefault([], $page * 25);
	}
	$_SESSION['admin_docs']['annales'] = $_AR[0];
	$_SESSION['admin_docs']['cours'] = $_CR[0];
	$_SESSION['admin_docs']['epreuves'] = $_ER[0];
	$total = max((int) $_AR[1][0], (int) $_CR[1][0], (int) $_ER[1][0]);
	$count = $search === "" ? 25 : 15;
	$_SESSION['admin_docs']['pagination'] = paginate($total, $search, $count, $typo);
	
	header('Location:/admin/views/list.php?&type='.$typo.'&search=' . $search . '&page=' . $page);
	return;