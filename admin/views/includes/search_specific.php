<div class="row my-3">
	<form action="/admin/controllers/search_specific.php" method="post" class="col row">
		<div class="col-auto text-center">
			<label for="doc_type" class="sr-only">Le type du document</label>
			<select name="doc_type" id="doc_type" class="form-select" required>
				<option value="any">Tout</option>
				<option value="annales">Annale</option>
				<option value="epreuves">Epreuve</option>
				<option value="cours">Cours</option>
			</select>
			<small class="text-muted">Type de doc</small>
		</div>
		<div class="col-auto text-center">
			<label for="s_classe" class="sr-only">classe</label>
			<select name="s_classe" id="s_classe" class="form-select" required>
				<option value="any">Toutes</option>
				<option value="tle">Tle</option>
				<option value="1ere">1ere</option>
				<option value="2nde">2nde</option>
			</select>
			<small class="text-muted">Classe</small>
		</div>
		<div class="col-auto text-center">
			<label for="s_mat" class="sr-only">Matière</label>
			<select name="s_mat" id="s_mat" class="form-select" required>
				<option value="any">Toutes</option>
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
			<small class="text-muted">Matière</small>
		</div>
		<div class="col-auto text-center">
			<label for="s_serie" class="sr-only">Votre série</label>
			<select name="s_serie" id="s_serie" class="form-select" required>
				<option value="any">Toutes</option>
				<option value="A">A</option>
				<option value="C">C</option>
				<option value="D">D</option>
				<option value="E">E</option>
				<option value="F">F</option>
				<option value="G">G</option>
			</select>
			<small class="text-muted">Série</small>
		</div>
		<div class="col-auto text-center">
			<label for="s_sort" class="sr-only">Ordre de rangement des résultats</label>
			<select name="s_sort" id="s_sort" class="form-select" required>
				<option value="new">croissant</option>
				<option value="old">décroissant</option>
			</select>
			<small class="text-muted">Ordre</small>
		</div>
		<div class="col-auto text-center">
			<label for="s_count" class="sr-only">Nombre de résultats</label>
			<input type="number" name="s_count" id="s_count" class="form-control" min="5" max="35" value="10">
			<small class="text-muted">Nombre</small>
		</div>
		<div class="col">
			<button type="submit" class="btn btn-success form-control">
				<i class="fa fa-search-plus"></i>
			</button>
		</div>
	</form>
</div>
