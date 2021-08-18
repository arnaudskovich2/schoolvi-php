<?php
	session_start();
	$_SESSION['currentAdmin'] = "info";
	require "./includes/auth.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "./includes/import.php" ?>
	<title>Info - Admin</title>
</head>
<body class="container-fluid">
<?php include "./includes/header.php"; ?>
<div class="row d-flex justify-content-center align-items-center" style="padding-top: 50px">
	<h5 class="text-center display-3 mb-4">
		Bienvenue <strong><?php echo $_SESSION['admin']['identifier'] ?>!</strong>
	</h5>
	<div class="col shadow rounded m-3 p-3 bg-light" id="set_info">
		<h4><i class="fa fa-user-edit"></i> Modifier mes informations</h4>
		<form action="/admin/controllers/info.php" class="was-validated" method="post">
			<?php if (isset($_SESSION['set_admin_info_error'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 30px" role="alert">
					<?php echo $_SESSION['set_admin_info_error'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['set_admin_info_success'])) { ?>
				<div class="alert alert-success alert-dismissible fade show" style="margin-top: 30px" role="alert">
					<?php echo $_SESSION['set_admin_info_success'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<div class="my-4">
				<label for="identifier" class="sr-only">Identifiant</label>
				<input type="text" name="identifier" id="identifier" pattern="^[a-z0-9@_-]{6,30}$" autocomplete="off"
							 class="form-control" placeholder="Identifiant"
							 value="<?php echo $_SESSION['admin']['identifier'] ?>" required>
				<small class="text-muted">Identifiant</small><br>
				<small class="text-muted fw-bold">Utiliser: a-z 0-9 @ _ - (pas d'espace)</small><br>
			</div>
			<div class="my-4">
				<label for="alias" class="sr-only">Alias</label>
				<input type="text" name="alias" id="alias" pattern="^[a-z0-9]{4,8}$" autocomplete="off"
							 class="form-control" placeholder="Alias"
							 value="<?php echo $_SESSION['admin']['alias'] ?>" required>
				<small class="text-muted">Identifiant</small><br>
				<small class="text-muted fw-bold">Utiliser: a-z 0-9 (pas d'espace)</small><br>
			</div>
			<div class="my-4">
				<label for="code" class="sr-only">Mot de passe</label>
				<input type="password" name="code" pattern="^(.){6,}$" id="code" autocomplete="off"
							 class="form-control" placeholder="Mot de passe" required>
				<small class="text-muted fw-bold">
					Entrez votre mot de passe pour confirmer la modification
				</small>
			</div>
			<div class="my-4">
				<button type="submit" class="btn btn-success">
					Modifier
				</button>
			</div>
		</form>
	</div>
	<div class="w-100"></div>
	<?php #Password modification ?>
	<div class="col-10 col-md-5 bg-light shadow rounded m-3 p-3" id="set_password">
		<h3>Modifier le mot de passe</h3>
		<form action="/admin/controllers/password.php" class="was-validated" method="post">
			<?php if (isset($_SESSION['set_admin_pass_error'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" style="margin-top: 30px" role="alert">
					<?php echo $_SESSION['set_admin_pass_error'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['set_admin_pass_success'])) { ?>
				<div class="alert alert-success alert-dismissible fade show" style="margin-top: 30px" role="alert">
					<?php echo $_SESSION['set_admin_pass_success'] ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<label for="old_password" class="sr-only">Ancien mot de passe</label>
			<input class="form-control my-3" name="old_password" id="old_password"
						 autocomplete="off" pattern="^(.){6,}$" placeholder="Ancien mot de passe" required>
			<label for="new_password" class="sr-only">Nouveau mot de passe</label>
			<input class="form-control my-3" name="new_password" id="new_password"
						 autocomplete="off" pattern="^(.){6,}$" placeholder="Nouveau mot de passe" required>
			<button class="btn btn-info" type="submit">
				Modifier le mot de passe
			</button>
		</form>
	</div>
	<div class="col-10 col-md-5 bg-dark text-light shadow rounded mx-3 p-3 my-3">
		<h4><i class="fa fa-arrow-left"></i> Se déconnecter</h4>
		<form action="/admin/controllers/disconnect.php" method="post" class="mt-3">
			<button type="submit" class="btn btn-primary text-light my-2">
				Se déconnecter
			</button>
		</form>
	</div>
</div>
<?php
	unset(
		$_SESSION['set_admin_pass_error'],
		$_SESSION['set_admin_pass_success'],
		$_SESSION['set_admin_info_error'],
		$_SESSION['set_admin_info_success']
	);
	?>
</body>
</html>
