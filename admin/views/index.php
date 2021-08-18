<?php
	session_start();
	$_SESSION['currentAdmin'] = "home";
	require "./includes/auth.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "./includes/import.php" ?>
	<title>Accueil - Admin</title>
</head>
<body class="container-fluid">
	<?php include "./includes/header.php"; ?>
	<div class="row min-vh-100 d-flex justify-content-center align-items-center pt-5">
		<div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">
			<div class="card shadow bg-light" style="min-height: 200px">
				<div class="card-body d-flex flex-column justify-content-center p-0 rounded">
					<h5 class="text-light display-6 text-center bg-dark py-2">
						<i class="fas fa-plus-square"></i><br>
					</h5>
					<span class="text-uppercase display-6 my-3 text-center">
						Ajouter des documents
					</span>
					<a href="./add.php" class="btn btn-primary my-3 mx-5">
						Aller <i class="fa fa-hand-point-right"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">
			<div class="card shadow bg-light" style="min-height: 200px">
				<div class="card-body d-flex flex-column justify-content-center p-0 rounded">
					<h5 class="text-light display-6 text-center bg-dark py-2">
						<i class="fas fa-bookmark"></i><br>
					</h5>
					<span class="text-uppercase display-6 my-3 text-center">
						Voir les documents
					</span>
					<a href="./list.php" class="btn btn-primary my-3 mx-5">
						Aller <i class="fa fa-hand-point-right"></i>
					</a>
				</div>
			</div>
		</div>
		<div class="col-10 col-sm-6 col-md-4 col-lg-3 my-3">
			<div class="card shadow bg-light" style="min-height: 200px">
				<div class="card-body d-flex flex-column justify-content-center p-0 rounded">
					<h5 class="text-light display-6 text-center bg-dark py-2">
						<i class="fas fa-cogs"></i><br>
					</h5>
					<span class="text-uppercase display-6 my-3 text-center">
						Modifier vos infos
					</span>
					<a href="./info.php" class="btn btn-primary my-3 mx-5">
						Aller <i class="fa fa-hand-point-right"></i>
					</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
