<div class="row d-flex justify-content-center w-100 search" style="margin-top: 2rem;">
  <form action="/controllers/search/search.php" method="POST" class="col row">
    <div class="col mx-1">
      <label for="search" class="sr-only">Rechercher</label>
      <input type="search" name="search" id="search" class="form-control form-control-lg" required
        placeholder="Rechercher..." value="<?php echo isset($_GET['old'])
	      ? htmlspecialchars_decode($_GET['old'],ENT_HTML5) :
	      '' ?>"
        title="Entrez quelque chose pour la recherche">
    </div>
    <div class="col-auto p-0">
      <button type="submit" class="btn btn-primary btn-lg d-block" title="Rechercher">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </form>
</div>
