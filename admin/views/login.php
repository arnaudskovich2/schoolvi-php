<?php
	session_start();
	$_SESSION['currentAdmin'] = "login";
	require "./includes/auth.php";
?>
	<!DOCTYPE html>
	<html lang="fr">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include "./includes/import.php" ?>
		<title>Connexion</title>
	</head>
	<body class="container-fluid">
	<div class="row d-flex justify-content-center align-items-center vh-100">
		<div class="col-10 col-sm-8 col-md-6 col-lg-4 p-4 shadow">
			<?php if (isset($_SESSION['adminConnErr'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" data-bs-dismiss="alert" role="alert">
					<strong><?php echo $_SESSION['adminConnErr'] ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<h5 class="display-1 fw-bold text-center text-secondary mb-5">
				<i class="fa fa-user-lock"></i>
				<br>
				<span class="sr-only">Connexion</span>
			</h5>
			<form action="/admin/controllers/login.php" class="w-100 was-validated" method="post">
				<div class="my-3">
					<label for="identifier" class="sr-only">Identifiant</label>
					<input type="text" name="identifier" id="identifier" class="form-control" pattern="^[a-z0-9@_]{6,}$"
								 placeholder="Identifiant" autocomplete="off" required>
				</div>
				<div class="my-4">
					<label for="password" class="sr-only">Identifiant</label>
					<input type="password" name="password" id="password" class="form-control" pattern="^(.){6,}$"
								 placeholder="Code" autocomplete="off" required>
				</div>
				<div class="my-4 text-center">
					<button type="submit" class="btn btn-primary">
						CONNEXION <i class="fa fa-arrow-right"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	</body>
	</html>
<?php unset($_SESSION['adminConnErr']) ?>