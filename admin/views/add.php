<?php
	session_start();
	$_SESSION['currentAdmin'] = "add";
	require "./includes/auth.php";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "./includes/import.php" ?>
	<title>Ajout - Admin</title>
</head>
<body class="container-fluid">
<?php include "./includes/header.php"; ?>
<div class="row min-vh-100 d-flex justify-content-center align-items-center">
	<div class="col-12 col-sm-10 col-md-8 col-lg-6 py-5">
		<form action="/admin/controllers/addDoc.php" class="was-validated my-5 shadow p-3" enctype="multipart/form-data"
					method="post">
			<?php if (isset($_SESSION['addDocError'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong><?php echo $_SESSION['addDocError'] ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<?php if (isset($_SESSION['addDocSuccess'])) { ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong><?php echo $_SESSION['addDocSuccess'] ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<h6 class="text-center text-dark display-3 pt-4">
				<i class="fa fa-plus-square"></i><br>
				Ajouter un doc
			</h6>
			<div class="my-3">
				<label for="doc_name" class="form-label fw-bold">Le nom du document</label>
				<input type="text" name="doc_name" id="doc_name" pattern="^[a-zA-Z0-9 '_-]+$"
							 class="form-control" placeholder="Nom du document" required>
				<small class="text-muted">A-Z a-z 0-9 espace _ -</small>
			</div>
			<div class="my-3">
				<label for="doc_type" class="form-label fw-bold">Le type du document</label>
				<select name="doc_type" id="doc_type" class="form-control" required>
					<option value="">Type de document</option>
					<option value="annales">Annale</option>
					<option value="epreuves">Epreuve</option>
					<option value="cours">Cours</option>
				</select>
			</div>
			<div class="my-3">
				<label for="epreuve_type" class="fw-bold form-label">Provenance de l'epreuve</label>
				<small class="text-muted">seulement si le document est une epreuve</small>
				<input id="epreuve_type" name="epreuve_type" type="text" class="form-control disabled" placeholder="Ex: L2F, NDA"
							 pattern="^[a-zA-Z0-9 ]+$" disabled required>
				<small class="text-muted">A-Z a-z 0-9 -</small>
			</div>
			<div class="my-3">
				<label for="doc_file" class="form-label fw-bold">Le fichier</label>
				<input type="file" name="doc_file" id="doc_file"
							 class="form-control" placeholder="Fichier" required>
			</div>
			<div class="my-3">
				<label for="doc_desc" class="form-label fw-bold">Description du document</label>
				<textarea name="doc_desc" id="doc_desc" maxlength="100" class="form-control" placeholder="Description ...." required></textarea>
			</div>
			<div class="my-3">
				<label for="doc_mat" class="form-label fw-bold">Matière(s)</label>
				<small class="text-muted">Choix multiple</small>
				<select class="form-select" id="doc_mat" name="doc_mat[]" multiple required>
					<option value="FR">FR</option>
					<option value="ANG">ANG</option>
					<option value="RUSSE">RUSSE</option>
					<option value="EPS">EPS</option>
					<option value="ALL">ALL</option>
					<option value="ECM">ECM</option>
					<option value="HG">HG</option>
					<option value="PHILO">PHILO</option>
					<option value="MATHS">MATHS</option>
					<option value="SP">SP</option>
					<option value="SVT">SVT</option>
					<option value="EM">EM</option>
					<option value="MUS">MUSIQUE</option>
					<option value="AGRI">AGRI</option>
					<option value="AUTRE">AUTRES</option>
				</select>
			</div>
			<div class="my-3">
				<label for="doc_serie" class="form-label fw-bold">Séries</label>
				<small class="text-muted">Choix multiple</small>
				<select class="form-select" id="doc_serie" name="doc_serie[]" multiple required>
					<option value="A">A</option>
					<option value="C">C</option>
					<option value="D">D</option>
					<option value="E">E</option>
					<option value="F">F</option>
					<option value="G">G</option>
				</select>
			</div>
			<div class="my-3">
				<label for="doc_classe" class="form-label fw-bold">Classes</label>
				<small class="text-muted">Choix multiple</small>
				<select class="form-select" id="doc_classe" name="doc_classe[]" multiple required>
					<option value="Tle">Tle</option>
					<option value="1ere">1ere</option>
					<option value="2nde">2nde</option>
				</select>
			</div>
			<div class="my-3">
				<button type="submit" class="btn btn-secondary">
					Ajouter <i class="fa fa-plus"></i>
				</button>
			</div>
		</form>
	</div>
</div>
<script>
	$(function(){
		let dt = $("#doc_type");
		let et = $("#epreuve_type");
		dt.change(function (e){
			if(e.target.value === 'epreuves'){
				et[0].disabled = false;
				return;
			}
			et[0].disabled = true;
		})
	});
</script>
<?php unset($_SESSION['addDocError'], $_SESSION['addDocSuccess']) ?>
</body>
</html>
