<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	$_AUTH_DOC_TYPE = ["epreuves", "cours", "annales"];
	$id = htmlspecialchars($_GET['id']) ?? "";
	$type = htmlspecialchars($_GET['type']) ?? "";
	$props_array = ['download' => $id];
	$_TOOLS = [
		"annales" => [new AnnaleManager($_DB), new Annale($props_array)],
		"cours" => [new CoursManager($_DB), new Cours($props_array)],
		"epreuves" => [new EpreuveManager($_DB), new Epreuve($props_array)]
	];
	
	if(!empty($id) && in_array($type, $_AUTH_DOC_TYPE)){
		[$MANAGER, $INSTANCE] = $_TOOLS[$type];
		$get_doc = $MANAGER->select($INSTANCE, ['download']);
		$delete_state = $MANAGER->delete($INSTANCE);
		$file_name = $get_doc[0][0]['f_name'];
		if($delete_state === true){
			$_SESSION['deletion_success'] = 'Action faite';
			unlink("../../upload/$file_name");
			header('Location: /admin/controllers/search.php?type='.$type);
			return;
		}
		$_SESSION['deletion_error'] = 'Une erreur est survenue';
		header('Location: /admin/controllers/search.php?type='.$type);
		return;
	}
	$_SESSION['deletion_error'] = 'Document non reconnu';
	header('Location: /admin/controllers/search.php?type='.$type);
	return;