<?php
  if (isset($_SESSION['failed']) && !empty($_SESSION['failed'])) {
    ?>
	  <div class="alert alert-danger alert-dismissible fade show" style="margin-top: 30px" role="alert">
		  <?php echo $_SESSION['failed'] ?>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>
    <?php
  }

  if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
    ?>
	  <div class="alert alert-success alert-dismissible fade show" style="margin-top: 30px" role="alert">
		  <?php echo $_SESSION['success'] ?>
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>
    <?php
  }