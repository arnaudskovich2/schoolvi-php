<?php
	session_start();
	$_SESSION['currentAdmin'] = "list";
	require "./includes/auth.php";
	require "./includes/handleListShow.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "./includes/import.php" ?>
	<title>Docs - Admin</title>
</head>
<body class="container-fluid">
<?php include "./includes/header.php"; ?>
<?php include "./includes/search.php"; ?>
<?php include "./includes/search_specific.php"; ?>
<div class="row d-flex justify-content-center align-items-center">
	<?php include "./includes/listTableHeader.php" ?>
	<div class="tab-content" id="docsContent">
		<?php include "./includes/listTableContent.php" ?>
	</div>
	<?php include "./includes/pagination.php" ?>
</div>
</body>
<?php unset($_SESSION['admin_docs']) ?>
</html>
