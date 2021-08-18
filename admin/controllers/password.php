<?php
	session_start();
	$_SESSION['currentAdmin'] = "controller";
	require "../views/includes/auth.php";
	require "../model/autoload4.php";
	require "../../config/db.php";
	global $_DB;
	
	$old_p = isset($_POST['old_password']) && preg_match("#^(.){6,40}$#", htmlspecialchars($_POST['old_password']))
		? htmlspecialchars($_POST['old_password'])
		: "";
	$new_p = isset($_POST['new_password']) && preg_match("#^(.){6,40}$#", htmlspecialchars($_POST['new_password']))
		? htmlspecialchars($_POST['new_password'])
		: false;
	
	if ($new_p !== false) {
		$ADMIN_MANAGER = new AdminManager($_DB);
		$ADMIN = new Admin($_SESSION['admin']);
		$NEW_ADMIN = new Admin(['code' => $new_p]);
		$_GET_ADMIN = new Admin($ADMIN_MANAGER->select($ADMIN));
		if($old_p === $_GET_ADMIN->getCode()){
			$update = $ADMIN_MANAGER->update($ADMIN, $NEW_ADMIN);
			if($update === true){
				$_SESSION['admin'] = $ADMIN_MANAGER->select($_GET_ADMIN);
				$_SESSION['set_admin_pass_success'] = "Modification effectuée";
				header('Location: /admin/views/info.php#set_password');
				return;
			}
			$_SESSION['set_admin_pass_error'] = "Une erreur est survenue! Réessayez";
			header('Location: /admin/views/info.php#set_password');
			return;
		}
		$_SESSION['set_admin_pass_error'] = "Ancien mot de passe incorrect";
		header('Location: /admin/views/info.php#set_password');
		return;
	}
	$_SESSION['set_admin_pass_error'] = "Formulaire mal rempli";
	header('Location: /admin/views/info.php#set_password');
	return;