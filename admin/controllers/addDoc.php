<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../../models/docs/autoload2.php";
	require "../../config/db.php";
	global $_DB;
	$name = htmlspecialchars($_POST['doc_name']) ?? "";
	$desc = htmlspecialchars($_POST['doc_desc']) ?? "";
	$type = htmlspecialchars($_POST['doc_type']) ?? false;
	$ep_type = isset($_POST['epreuve_type']) ? htmlspecialchars($_POST['epreuve_type']) : false;
	$file_name = htmlspecialchars($_FILES['doc_file']['name']) ?? "";
	$file_ext = pathinfo($_FILES['doc_file']['name'])['extension'] ?? "";
	$file_error = $_FILES['doc_file']['error'];
	$mats_ = isset($_POST['doc_mat']) && is_array($_POST['doc_mat']) ? $_POST['doc_mat'] : [];
	$serie_ = isset($_POST['doc_serie']) && is_array($_POST['doc_serie']) ? $_POST['doc_serie'] : [];
	$classe_ = isset($_POST['doc_classe']) && is_array($_POST['doc_classe']) ? $_POST['doc_classe'] : [];
	
	$_AUTH_EXT = ["pdf", "docx", "doc", "pptx", "odt"];
	$_AUTH_DOC_TYPE = ["epreuves", "cours", "annales"];
	if ($name !== "" && $desc !== "" && $type !== "" && !empty($mats_) && !empty($serie_)
		&& !empty($classe_) && $file_name !== "" && $file_error === 0
		&& in_array($file_ext, $_AUTH_EXT, true) && in_array($type, $_AUTH_DOC_TYPE, true)
	) {
		$filename = sha1(date('d.m.Y H:i:s')) . "." . $file_ext;
		$download = sha1($file_name);
		$move_state = move_uploaded_file($_FILES['doc_file']['tmp_name'], "../../upload/" . $filename);
		//DOCUMENT UPLOADED
		if ($move_state) {
			$doc_props = [
				'name'=>$name,
				'description'=>$desc,
				'mat'=>implode("-",$mats_),
				'serie'=>implode("-", $serie_),
				'classe'=>implode("-", $classe_),
				'type'=>$ep_type,
				'download'=>$download,
				'f_name'=>$filename,
				'by'=>$_SESSION['admin']['alias'],
				'date'=>date('Y-m-d')
			];
			if($type === "epreuves"){
				$_instance = new Epreuve($doc_props);
				$_manager = new EpreuveManager($_DB);
				$_exists = $_manager->select($_instance, ['name', 'download', 'f_name'], 0, 1, true)[1] === "0";
				$add_res = $_manager->add($_instance);
			}
			if($type === "cours"){
				$_instance = new Cours($doc_props);
				$_manager = new CoursManager($_DB);
				$_exists = $_manager->select($_instance, ['name', 'download', 'f_name'], 0, 1, true)[1] === "0";
				$add_res = $_manager->add($_instance);
			}
			if($type === "annales"){
				$_instance = new Annale($doc_props);
				$_manager = new AnnaleManager($_DB);
				$_exists = $_manager->select($_instance, ['name', 'download', 'f_name'], 0, 1, true)[1] === "0";
				$add_res = $_manager->add($_instance);
			}
			
			//IF ADD WAS SUCCESSFULLY DONE
			if(isset($add_res) && $add_res === true){
				$_SESSION['addDocSuccess'] = "Document ajouté";
				header('Location: /admin/views/add.php');
				return;
			}
			
			//IF DOC ALREADY EXIST BY NAME
			if(isset($_exists) && $_exists === false){
				$_SESSION['addDocError'] = "Un document porte le nom de celui-ci dans la table";
				unlink("../../upload/".$filename);
				header('Location: /admin/views/add.php');
				return;
			}
			
			//IF NONE WAS DONE
			unlink("../../upload/".$filename);
		}
	}
	$_SESSION['addDocError'] = "Formulaire mal rempli";
	header('Location: /admin/views/add.php');
	return;