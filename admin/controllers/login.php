<?php
	session_start();
	if (isset($_SESSION['adminConn']) && $_SESSION['adminConn'] === true){
		header('Location: /admin/views/index.php');
		return;
	}
	$_SESSION['currentAdmin'] = "controller";
	require "../model/autoload4.php";
	require "../../config/db.php";
	global $_DB;
	$id = htmlspecialchars($_POST['identifier']) ?? "";
	$code = htmlspecialchars($_POST['password']) ?? "";
	
	if($code !=="" && $id!==""){
		$_admin = new Admin(['identifier'=>$id, 'code'=>$code]);
		$_ADMIN_MANAGER = new AdminManager($_DB);
		if($_ADMIN_MANAGER->exists($_admin)){
			$_admin_props = $_ADMIN_MANAGER->select($_admin);
			$_true_admin = new Admin($_admin_props);
			if($_true_admin->getCode() === $_admin->getCode()){
				$_SESSION['admin'] = $_admin_props;
				$_SESSION['adminConn'] = true;
				unset($_SESSION['adminConnErr']);
				header('Location: /admin/views/index.php');
				return;
			}
		}
	}
	$_SESSION['adminConnErr'] = "Identifiants incorrects";
	header('Location: /admin/views/login.php');
	return;