<?php
  session_start();
  include "../includes/isAuth.php";
  $_SESSION['current'] = 'annales';
  //HANDLES SHOWING AND RESEARCH
  include "../includes/showingHandler.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--REQUIRED ASSETS FOR PAGE FORMATTING-->
  <?php include("../includes/import.php") ?>
	<title>Annales</title>
</head>

<body class="body-bg">
<div class="container-fluid">
	<!--PAGE HEADER, INCLUDING NAVBAR-->
	<?php include "../includes/header.php"; ?>
	<!--LARGE SEARCH BAR-->
  <?php include "../includes/search.php"; ?>
	<!--SPECIFIC SEARCH BAR-->
  <?php include "../includes/search_specific.php"; ?>
	<!--MAIN BODY, RESULTS TO SHOW-->
	<?php include "../includes/mainResultView.php"; ?>
	<!--PAGINATION HANDLER-->
  <?php include "../includes/paginationHandler.php"; ?>
	<!--PAGE FOOTER-->
  <?php include "../includes/footer.php"; ?>
	<!--RESET SESSION RESULT-->
	<?php include "../includes/sessionResultReset.php"; ?>
</div>
</body>
</html>
