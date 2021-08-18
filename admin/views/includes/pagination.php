<?php
	if (isset($_SESSION['admin_docs']['pagination']) && !empty($_SESSION['admin_docs']['pagination'])) {
		$pagination = $_SESSION['admin_docs']['pagination'];
		$count = (int)($_GET['count'] ?? 15);
		$total = ((int) array_key_last($pagination)+1) * $count;
		?>
		<div class="col w-100 mh-100 py-3 d-inline-flex align-items-center
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