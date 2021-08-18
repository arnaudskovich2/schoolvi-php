<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	
	$_TYPES = ['annales', 'cours', 'epreuves'];
	$_CLASSES = ['tle', '1ere', '2nde'];
	$_MATS = ["FR", "ANG", "RUSSE", "ALL", "ECM", "HG", "PHILO",
		"MATHS", "SP", "SVT", "MUS", "EM", "AGRI", "EPS", "AUTRE"];
	$_SERIES = ["A", "C", "D", "E", "F", "G"];
	$_ORDER = ["old", "new"];
	
	if (isset($_POST['doc_type'])) {
		$doc_type = isset($_POST['doc_type']) && in_array($_POST['doc_type'], $_TYPES, true)
			? htmlspecialchars($_POST['doc_type'])
			: "any";
		$classe = isset($_POST['s_classe']) && in_array($_POST['s_classe'], $_CLASSES, true)
			? htmlspecialchars($_POST['s_classe'])
			: "any";
		$mat = isset($_POST['s_mat']) && in_array($_POST['s_mat'], $_MATS, true)
			? htmlspecialchars($_POST['s_mat'])
			: "any";
		$serie = isset($_POST['s_serie']) && in_array($_POST['s_serie'], $_SERIES, true)
			? htmlspecialchars($_POST['s_serie'])
			: "any";
		$order = isset($_POST['s_sort']) && strtolower($_POST['s_sort']) === "old"
			? "old"
			: "new";
		$count = isset($_POST['s_count']) && preg_match("#^\d+$#", $_POST['s_count']) && (int) $_POST['s_count'] > 5
			? (int) $_POST['s_count']
			: 10;
	} else {
		$doc_type = isset($_GET['doc_type']) && in_array($_GET['doc_type'], $_TYPES, true)
			? htmlspecialchars($_GET['doc_type'])
			: "any";
		$classe = isset($_GET['s_classe']) && in_array($_GET['s_classe'], $_CLASSES, true)
			? htmlspecialchars($_GET['s_classe'])
			: "any";
		$mat = isset($_GET['s_mat']) && in_array($_GET['s_mat'], $_MATS, true)
			? htmlspecialchars($_GET['s_mat'])
			: "any";
		$serie = isset($_GET['s_serie']) && in_array($_GET['s_serie'], $_SERIES, true)
			? htmlspecialchars($_GET['s_serie'])
			: "any";
		$order = isset($_GET['s_sort']) && strtolower($_GET['s_sort']) === "old"
			? "old"
			: "new";
		$count = isset($_GET['s_count']) && preg_match("#^\d+$#", $_GET['s_count']) && (int) $_GET['s_count'] >= 5 && (int) $_GET['s_count'] <= 35
			? (int) $_GET['s_count']
			: 10;
	}
	
	$page = isset($_GET['page']) && preg_match("#^\d+$#", $_GET['page'])
		? (int) $_GET['page']
		: 0;
	$from = $page * $count;
	
	$specifications = [
		'classe' => $classe,
		'mat' => $mat,
		'serie' => $serie,
	];
	
	$_TOOLS = [
		"annales" => [new AnnaleManager($_DB), new Annale($specifications)],
		"cours" => [new CoursManager($_DB), new Cours($specifications)],
		"epreuves" => [new EpreuveManager($_DB), new Epreuve($specifications)]
	];
	
	$params = implode("&", [
		'doc_type=' . $doc_type,
		's_classe=' . $classe,
		's_serie=' . $serie,
		's_mat=' . $mat,
		's_sort=' . $order,
		's_count=' . $count
	]);
	
	function paginate (int $num, string $params, int $count) : array
	{
		$to_return = [];
		if (ceil($num / $count) > 1) {
			for ($i = 0; $i < ceil($num / $count); $i++) {
				$to_return[] = "/admin/controllers/search_specific.php?" . $params . "&page=" . $i;
			}
		}
		return $to_return;
	}
	
	if ($doc_type !== "any") {
		$_MANAGER = $_TOOLS[$doc_type][0];
		$_INSTANCE = $_TOOLS[$doc_type][1];
		$res = $_MANAGER->searchWithSpecification($_INSTANCE, $order, $count, $from);
		$_SESSION['admin_docs'][$doc_type] = $res[0];
		$_SESSION['admin_docs']['pagination'] = paginate((int) $res[1][0], $params, $count);
		$next = "/admin/views/list.php?" . $params . "&page=" . $page;
		header("Location:  $next");
		return;
	}
	
	$totals = [];
	foreach ($_TOOLS as $doc => $tool) {
		$res = $tool[0]->searchWithSpecification($tool[1], $order, $count, $from);
		$_SESSION['admin_docs'][$doc] = $res[0];
		$totals[] = (int) $res[1][0];
	}
	
	$max = max($totals);
	$_SESSION['admin_docs']['pagination'] = paginate((int) $max, $params, $count);
	$next = "/admin/views/list.php?" . $params . "&page=" . $page;
	header("Location: $next");
	return;