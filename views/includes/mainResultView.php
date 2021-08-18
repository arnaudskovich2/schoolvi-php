<div class="row mt-4">
  <div class="col container-fluid flex-column">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 gx-2">
      <?php
        $results = $_SESSION['search'][$_SESSION['current']] ?? [];
        if (isset($results) && !empty($results)) {
          include "../includes/EntityResultHeader.php";
          foreach ($results as $value) {
          	$value['doc_type'] = $_SESSION['current'];
            include("../includes/DocEntityView.php");
          }
        } else {
          include "../includes/noResult.php";
        }
      ?>
    </div>
  </div>
</div>