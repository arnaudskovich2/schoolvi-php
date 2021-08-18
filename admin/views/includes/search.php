<div class="row justify-content-center w-100 search" style="margin-top: 2rem;">
  <form action="/admin/controllers/search.php" method="POST" class="col row">
    <div class="col px-1">
      <label for="search" class="sr-only">Rechercher</label>
      <input type="search" name="search" id="search" class="form-control col" required
        placeholder="Rechercher..." value="<?php echo $_GET['old'] ?? '' ?>"
        title="Entrez quelque chose pour la recherche">
    </div>
    <div class="col-auto ps-1">
      <button type="submit" class="btn btn-primary d-block" title="Rechercher">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </form>
</div>
