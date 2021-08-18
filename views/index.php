<?php
	session_start();
	$_SESSION['current'] = "";
	require_once "../config/db.php";
	require_once "../models/user/autoload_index.php";
	global $_DB;
	$_MANAGER = new UserManager($_DB);
	if (isset($_SESSION['isConnected'])) {
		$_INSTANCE = new User($_SESSION['user'] ?? []);
		if (!$_MANAGER->exists($_INSTANCE)) {
			unset($_SESSION['user'], $_SESSION['isConnected']);
		}
	}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "./includes/import.php" ?>
	<title>Accueil</title>
</head>

<body class="body-bg">
<div class="container-fluid">
	<header class="row vh-100">
		<?php include "./includes/nav.php"; ?>
		<?php include "./includes/welcome.php"; ?>
	</header>
	<!-- BODY -->
	<!-- FEATURES PRESENTATION -->
	<div class="row mt-4 d-flex justify-content-center pt-3">
		<h4 class="display-4 fw-bold text-center my-5 mx-2">CE QUE NOUS VOUS OFFRONS</h4>
		<div class="card col-12 col-sm-10 col-md-5 col-lg-3 shadow py-2 px-0 border-0 mx-1 mb-md-2 mt-1">
			<div class="card-header bg-transparent">
				<h5 class="card-title fw-bold text-primary">
					<i class="fas fa-book"></i> Annales
				</h5>
			</div>
			<div class="card-body">
				<div class="card-text">
					Dans la rubrique annale, nous vous proposons des annales dans les matières telles que:
					<br>
					<ul class="text-primary features-list">
						<li><a href="/controllers/search/search_specific.php?mat=hg">Histoire-Géographie</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=maths">Maths</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=sp">Sciences-Physiques</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=svt">SVT</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=ang">Anglais</a></li>
						<li><a href="/controllers/search/search_specific.php?classe=any&serie">..........</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card col-12 col-sm-10 col-md-5 col-lg-3 shadow py-2 px-0 border-0 mx-1 mb-md-2 mt-1">
			<div class="card-header bg-transparent">
				<h5 class="card-title fw-bold text-primary">
					<i class="fas fa-book-reader"></i> Cours
				</h5>
			</div>
			<div class="card-body">
				<div class="card-text">
					Nous vous proposons aussi des cours qui ne sont que des compléments de ce que vous recevez en classe.
					Entre autres dans les matières suivantes:
					<br>
					<ul class="text-primary features-list">
						<li><a href="/controllers/search/search_specific.php?mat=hg">Histoire-Géographie</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=maths">Maths</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=ang">Anglais</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=sp">Sciences-Physiques</a></li>
						<li><a href="/controllers/search/search_specific.php?mat=any">.........</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card col-12 col-sm-10 col-md-5 col-lg-3 shadow py-2 px-0 border-0 mx-1 mb-md-2 mt-1">
			<div class="card-header bg-transparent">
				<h5 class="card-title fw-bold text-primary">
					<i class="fas fa-file-pdf"></i> Epreuves
				</h5>
			</div>
			<div class="card-body">
				<div class="card-text">
					Se trouvent aussi sur ce site, des epreuves de divers examens et des épreuves d'entraînement
					pour vous aider a améliorer vos competences:
					<br>
					<ul class="text-primary features-list">
						<li><a href="/controllers/search/search.php?old=bac2">BAC 2</a></li>
						<li><a href="/controllers/search/search.php?old=bac1">BAC 1</a></li>
						<li><a href="/controllers/search/search.php?old=ls">LYCÉE SCIENTIFIQUE</a></li>
						<li><a href="/controllers/search/search.php?old=nda">NDA</a></li>
						<li><a href="/controllers/search/search_specific.php">.........</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- REGISTERING FORM && COMMENT FORM -->
	<div class="row py-5 first-block d-flex justify-content-center">
		<?php if (!isset($_SESSION['isConnected']) || $_SESSION['isConnected'] !== true) { ?>
			<div class="col-lg-4 col-md-6 col-sm-8 col-12 mt-4">
				<form action="/controllers/user/register.php" method="POST" class="shadow p-3 rounded was-validated">
					<div class="my-3">
						<h3 class="fw-bold text-primary">Inscrivez-vous</h3>
						<small class="text-muted form-text">
							Tous les champs sont obligatoires
						</small>
					</div>
					<?php include "./includes/registrationForm.php" ?>
				</form>
			</div>
		<?php } ?>
	
	</div>
	<?php include "./includes/footer.php" ?>
</div>
</body>

</html>
