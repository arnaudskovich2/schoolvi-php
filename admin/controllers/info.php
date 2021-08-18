<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../model/autoload4.php";
	require "../../config/db.php";
	global $_DB;
	
	$code = isset($_POST['code']) && preg_match("#^(.){6,}$#", htmlspecialchars($_POST['code']))
		? htmlspecialchars($_POST['code'])
		: "";
	$identifier = isset($_POST['identifier']) && preg_match("#^(.){6,30}$#", htmlspecialchars($_POST['identifier']))
		? htmlspecialchars($_POST['identifier'])
		: "";
	$alias = isset($_POST['alias']) && preg_match("#^(.){4,8}$#", htmlspecialchars($_POST['alias']))
		? htmlspecialchars($_POST['alias'])
		: "";
	
	$_update_array = [
		'alias' => $alias,
		'identifier' => $identifier
	];
	
	if(!in_array("", $_update_array)){
		$_ADMIN_MANAGER = new AdminManager($_DB);
		$_OLD = new Admin($_SESSION['admin']);
		$_NEW = new Admin($_update_array);
		if($_OLD->getCode() === $code){
			$state = $_ADMIN_MANAGER->update($_OLD, $_NEW);
			$_SESSION['admin'] = $_ADMIN_MANAGER->select($_NEW);
			if($state===true){
				$_SESSION['set_admin_info_success'] = "Informations modifiées";
				header('Location: /admin/views/info.php#set_info');
				return;
			}
			$_SESSION['set_admin_info_error'] = "Une erreur est survenue! Réessayez";
			header('Location: /admin/views/info.php#set_info');
			return;
		}
		$_SESSION['set_admin_info_error'] = "Mot de passe incorrect";
		header('Location: /admin/views/info.php#set_info');
		return;
	}
	$_SESSION['set_admin_info_error'] = "Formulaire mal rempli";
	header('Location: /admin/views/info.php#set_info');
	return;