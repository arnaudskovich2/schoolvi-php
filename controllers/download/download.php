<?php
	session_start();
	require_once "../../models/docs/autoload2.php";
	require_once "../../models/user/autoload3.php";
	require_once "../../config/db.php";
	global $_DB;
	
	$id = $_GET['id'] ?? '';
	$doc_type = $_GET['type'] ?? '';
	$props_array = ['download' => $id];
	$_AUTH_DOC_TYPE = ["epreuves", "cours", "annales"];
	$_TOOLS = [
		"annales" => [new AnnaleManager($_DB), new Annale($props_array)],
		"cours" => [new CoursManager($_DB), new Cours($props_array)],
		"epreuves" => [new EpreuveManager($_DB), new Epreuve($props_array)]
	];
	
	if (in_array($doc_type, $_AUTH_DOC_TYPE, true)) {
		[$MANAGER, $INSTANCE] = $_TOOLS[$doc_type];
		$DOC = $MANAGER->select($INSTANCE, ['download']);
		$file_name = $DOC[0][0]['f_name'] ?? '';
		if ($file_name !== '' && is_file('../../upload/' . $file_name)) {
			/*if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true) {
				$_link = "/controllers/download/download.php?type=$doc_type&id=$id";
				$down_manager = new DownloadManager($_DB);
				$old_data = ($down_manager->select(new Download(['user_id' => $_SESSION['user']['id']])))[0] ?? [];
				$full_down = new Download($old_data);
				$full_down->setDownloads($DOC[0][0]['name'] . '=>' . $_link);
				$derby = $down_manager->update($full_down);
				$c = (new Download(($down_manager->select($full_down))[0]))->getDownloads();
				$_SESSION['user']['downloads'] = (new Download(($down_manager->select($full_down))[0]))->getDownloads();
				return;
			}*/
			header('Location: ../../upload/' . $file_name);
		}
	}
	return;