<?php
	//WILL BE USED JUST BELOW FOR FORM ACTION AND VIEW RENDERING
  $_TO_USE = ($_SESSION['current'] === "search")
		? ["tout", "search"]
	  : [$_SESSION['current'], "docs"];
	?>
<div class="row my-3">
  <h4 class="fw-bold">Rechercher dans "<?php echo $_TO_USE[0] ?>":</h4>
  <form action="/controllers/<?php echo $_TO_USE[1] ?>/search_specific.php" method="post" class="col row">

    <div class="col-auto ms-2 text-cemx-1nter">
      <label for="s_classe" class="sr-only">Votre classe</label>
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
    <input type="hidden" name="s_type" value="<?php echo $_SESSION['current'] ?>" required>
    <div class="col me-2">
      <button type="submit" class="btn btn-success form-control">
        <i class="fa fa-search-plus"></i>
      </button>
    </div>
  </form>
</div>
