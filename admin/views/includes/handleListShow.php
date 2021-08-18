<?php
	$_SESSION['currentAdmin'] = "list";
	
	if (!isset($_SESSION['admin_docs']) && (isset($_GET['doc_type']) || isset($_GET['s_classe'])
		|| isset($_GET['s_serie']) || isset($_GET['s_mat'])
		|| isset($_GET['s_sort']) || isset($_GET['s_count'])
	)) {
		$params = implode("&",
			[
				"doc_type=" . ($_GET['doc_type'] ?? "any"),
				"s_classe=" . ($_GET['s_classe'] ?? "any"),
				"s_serie=" . ($_GET['s_serie'] ?? "any"),
				"s_mat=" . ($_GET['s_mat'] ?? "any"),
				"s_sort=" . ($_GET['s_sort'] ?? "new"),
				"s_count=" . ($_GET['s_count'] ?? "10"),
				"page=" . ($_GET['page'] ?? "0"),
				"type=".($_GET['type'] ?? "")
			]);
		header('Location: /admin/controllers/search_specific.php?' . $params);
		return;
	}
	
	if (!empty($_GET['search']) && !isset($_SESSION['admin_docs'])) {
		$s = $_GET['search'];
		$p = $_GET['page'] ?? '0';
		$type = "type=".($_GET['type'] ?? "");
		header('Location: /admin/controllers/search.php?search=' . $s . '&page=' . $p.'&'.$type);
		return;
	}
	
	if (!isset($_SESSION['admin_docs']) || empty($_SESSION['admin_docs'])) {
		$type = "type=".($_GET['type'] ?? "");
		header('Location: /admin/controllers/search.php?'.$type);
		return;
	}