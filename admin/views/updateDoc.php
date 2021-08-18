<?php
	session_start();
	$_SESSION['currentAdmin'] = "list";
	if(!isset($_SESSION['docToUpdate'])){
		$id = $_GET['id'] ?? "";
		$type = $_GET['type'] ?? "";
		header("Location: /admin/controllers/getDocForUpdate.php?id=$id&type=$type");
		return;
	}
	include "./includes/auth.php";
?>
	<!DOCTYPE html>
	<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include "./includes/import.php" ?>
		<title>Modifier un document</title>
	</head>
	<body class="container-fluid">
	<?php include "./includes/header.php"; ?>
	<div class="row d-flex justify-content-center align-items-center min-vh-100">
		<div class="col-12 col-sm-10 col-md-8 col-lg-6 p-3 shadow" style="margin-top: 5rem; margin-bottom: 3rem">
			<?php if (isset($_SESSION['updateDocErr'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" data-bs-dismiss="alert" role="alert">
					<strong><?php echo $_SESSION['updateDocErr'] ?></strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php } ?>
			<h5 class="display-1 fw-bold text-center text-secondary mb-5">
				<i class="fa fa-pencil-alt"></i>
				<br>
				<span class="display-6 fw-bold">Modifier un doc</span>
			</h5>
			<form action="/admin/controllers/updateDoc.php" class="w-100 was-validated" method="post">
				<div class="my-3">
					<label for="doc_name" class="form-label fw-bold">Le nom du document</label>
					<input type="text" name="doc_name" id="doc_name" pattern="^[a-zA-Z0-9 '_-]+$"
					       class="form-control" placeholder="Nom du document" required>
					<small class="text-muted">A-Z a-z 0-9 espace _ -</small>
				</div>
				<div class="my-3">
					<label for="doc_desc" class="form-label fw-bold">Description du document</label>
					<textarea name="doc_desc" id="doc_desc" maxlength="255" class="form-control" placeholder="Description ...." required></textarea>
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
				<input type="hidden" name="doc_type" id="doc_type" required value="<?php echo $_GET['type']?>">
				<input type="hidden" name="doc_id" id="doc_id" required value="<?php echo $_SESSION['docToUpdate']['id']?>">
				<input type="hidden" name="doc_down" id="doc_down" required value="<?php echo $_GET['id']?>">
				<div class="my-3">
					<button type="submit" class="btn btn-secondary">
						Modifier <i class="fa fa-pencil-alt"></i>
					</button>
				</div>
			</form>
		</div>
	</div>
	<!--suppress JSUnresolvedFunction -->
	<script>
		$(function(){
			$("#doc_name").val("<?php echo $_SESSION['docToUpdate']['name'] ?>");
			$("#doc_desc").val("<?php echo $_SESSION['docToUpdate']['description'] ?>");
			let Mats = "<?php echo $_SESSION['docToUpdate']['mat'] ?>";
			let Series = "<?php echo $_SESSION['docToUpdate']['serie'] ?>";
			let Classes = "<?php echo ucfirst(strtolower($_SESSION['docToUpdate']['classe'])) ?>";
			$("#doc_mat").val(Mats.split('-'));
			$("#doc_serie").val(Series.split('-'));
			$("#doc_classe").val(Classes.split('-'));
		})
	</script>
	</body>
	</html>
<?php unset($_SESSION['updateDocErr'], $_SESSION['updateDocSuccess'], $_SESSION['docToUpdate']) ?>