<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	$_AUTH_DOC_TYPE = ["epreuves", "cours", "annales"];
	$type_ = htmlspecialchars($_POST['doc_type']) ?? "";
	$name_ = htmlspecialchars($_POST['doc_name']) ?? "";
	$desc_ = htmlspecialchars($_POST['doc_desc']) ?? "";
	$down_ = htmlspecialchars($_POST['doc_down']) ?? "";
	$mats_ = (isset($_POST['doc_mat']) && is_array($_POST['doc_mat'])) ? $_POST['doc_mat'] : [];
	$serie_ = (isset($_POST['doc_serie']) && is_array($_POST['doc_serie'])) ? $_POST['doc_serie'] : [];
	$classe_ = (isset($_POST['doc_classe']) && is_array($_POST['doc_classe'])) ? $_POST['doc_classe'] : [];
	$id_ = isset($_POST['doc_id']) && preg_match("#^\d+$#", $_POST['doc_id']) ? htmlspecialchars($_POST['doc_id']) : "";
	
	$props_array = [
		'id'=>$id_,
		'name' => $name_,
		'description' => $desc_,
		'mat' => implode('-', $mats_),
		'serie' => implode('-', $serie_),
		'classe' => implode('-', $classe_)
	];
	
	$_TOOLS = [
		"annales" => [new AnnaleManager($_DB), new Annale($props_array)],
		"cours" => [new CoursManager($_DB), new Cours($props_array)],
		"epreuves" => [new EpreuveManager($_DB), new Epreuve($props_array)]
	];
	
	if (
		!empty($desc_) && !empty($mats_) && !empty($serie_) && !empty($classe_) && !empty($down_) &&
		!empty($name_) && !empty($type_) && !empty($id_) && in_array($type_, $_AUTH_DOC_TYPE)
	) {
		[$_MANAGER, $_INSTANCE] = $_TOOLS[$type_];
		$update = $_MANAGER->update($_INSTANCE);
		if($update === true){
			header('Location: /admin/views/list.php');
			return;
		}
		$_SESSION['updateDocErr'] = 'Une erreur est survenue. Retentez.';
		header("Location: /admin/views/updateDoc.php?id=$down_&type=$type_");
		return;
	}
	$_SESSION['updateDocErr'] = 'Document non conventionnel';
	header("Location: /admin/views/updateDoc.php?id=$down_&type=$type_");
	return;
	