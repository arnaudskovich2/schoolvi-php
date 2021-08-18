<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	
	$download = $_GET['id'] ?? "";
	$doc_type = $_GET['type'] ?? "";
	$_TYPES = ["epreuves", "cours", "annales"];
	$_TOOLS = [
		"annales" => [new AnnaleManager($_DB), new Annale(['download' => $download])],
		"cours" => [new CoursManager($_DB), new Cours(['download' => $download])],
		"epreuves" => [new EpreuveManager($_DB), new Epreuve(['download' => $download])]
	];
	$_SESSION['docToUpdate'] = [];
	if ($download !== "" && in_array($doc_type, $_TYPES, true)) {
		[$_MANAGER, $_INSTANCE] = $_TOOLS[$doc_type];
		$exists = $_MANAGER->select($_INSTANCE, ['download'], 0, 1, true);
		if (is_array($exists) && $exists[1] === "1") {
			$_SESSION['docToUpdate'] = $exists[0][0];
			header('Location: /admin/views/updateDoc.php?id='.$download.'&type='.$doc_type);
			return;
		}
		$_SESSION['updateDocErr'] = "Document inexistant";
		header('Location: /admin/views/updateDoc.php?id='.$download.'&type='.$doc_type);
		return;
	}
	$_SESSION['updateDocErr'] = "Document invalide";
	header('Location: /admin/views/updateDoc.php?id='.$download.'&type='.$doc_type);
	return;