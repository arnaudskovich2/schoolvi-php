<?php
	$_to_render = ['annales', 'cours', 'epreuves'];
	$_to_active = in_array($_GET['doc_type'] ?? $_GET['type'] ?? "", $_to_render, true)
		? $_GET['doc_type'] ?? $_GET['type']
		: 'annales';
?>
<ul class="nav nav-fill nav-tabs" id="docs" role="tablist">
	<?php foreach ($_to_render as $type) { ?>
		<li class="nav-item" role="presentation">
			<button class="nav-link link-primary <?php echo ($type === $_to_active) ? 'active' : '' ?>"
			        id="<?php echo $type ?>-tab" data-bs-toggle="tab"
			        data-bs-target="#<?php echo $type ?>" type="button" role="tab" aria-controls="<?php echo $type ?>"
			        aria-selected="true">
				<?php echo ucfirst($type) ?>
				(<?php echo isset($_SESSION['admin_docs'][$type]) ? count($_SESSION['admin_docs'][$type]) : 0 ?>)
			</button>
		</li>
	<?php } ?>
</ul>