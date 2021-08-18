<?php
	if (isset($_SESSION['pagination']) && !empty($_SESSION['pagination'])) {
		$pagination = $_SESSION['pagination'];
		$count = (int) ($_GET['count'] ?? 25);
		$total = ((int) array_key_last($pagination) + 1) * $count;
		?>
		<p class="text-center text-muted">
			<?php echo "Plus de résultats que sur la page courante."; ?>
		</p>
		<div class="col w-100 d-inline-flex align-items-center
        justify-content-center overflow-auto"
		>
			<?php foreach ($pagination as $link) {
				$num_page = explode("page=", $link)[1]; ?>
				<a href="<?php echo $link ?>"
				   class="btn btn-outline-primary m-1
             <?php if (isset($_GET['page']) && $num_page === $_GET['page']) {
					   echo 'active';
				   } ?>">
					<?php echo $num_page ?>
				</a>
			<?php } ?>
		</div>
		<?php
	}