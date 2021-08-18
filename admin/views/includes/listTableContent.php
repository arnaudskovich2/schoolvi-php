<?php
	$_to_render = ['annales', 'cours', 'epreuves'];
	
	foreach ($_to_render as $case) {
		$type = in_array($_GET['doc_type'] ?? $_GET['type'] ?? "", $_to_render, true)
			? $_GET['doc_type'] ?? $_GET['type']
			: 'annales';
		$active = ($case === $type) ? "active show" : "";
		if (!empty($_SESSION['admin_docs'][$case])) {
			$_current = $_SESSION['admin_docs'][$case];
			?>
			<div class="tab-pane fade mb-4 <?php echo $active ?> table-responsive" id="<?php echo $case ?>"
			     role="tabpanel" aria-labelledby="<?php echo $case ?>-tab">
				<table class="table">
					<thead>
					<tr>
						<th>Nom</th>
						<th class="col-auto">Description</th>
						<th>Classe</th>
						<th>Serie</th>
						<th>Mat</th>
						<th style="max-width: 50px;">Mod</th>
						<th style="max-width: 50px;">Del</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach ($_current as $doc) { ?>
						<tr>
							<td><?php echo $doc['name'] ?></td>
							<td class="text-truncate"><?php echo substr($doc['description'], 0, 70) ?></td>
							<td><?php echo $doc['classe'] ?></td>
							<td><?php echo $doc['serie'] ?></td>
							<td><?php echo $doc['mat'] ?></td>
							<td>
								<a
									href="/admin/controllers/getDocForUpdate.php?<?php echo 'id=' . $doc['download'] . '&type=' . $case ?>"
									class="btn btn-outline-primary my-1">
									<i class="fa fa-pencil-alt"></i>
								</a>
							</td>
							<td>
								<a href="/admin/controllers/deleteDoc.php?<?php echo 'id=' . $doc['download'] . '&type=' . $case ?>"
								   class="btn btn-outline-danger my-1">
									<i class="fa fa-trash-alt"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
			<?php
		} else {
			?>
		<div class="tab-pane mb-4 fade <?php echo $active ?> show table-responsive" id="<?php echo $case ?>"
		     role="tabpanel" aria-labelledby="<?php echo $case ?>-tab">
				<table class="table">
					<thead>
					<tr>
						<th>Nom</th>
						<th class="col-auto">Description</th>
						<th>Classe</th>
						<th>Serie</th>
						<th>Mat</th>
						<th style="max-width: 50px;">Mod</th>
						<th style="max-width: 50px;">Del</th>
					</tr>
					</thead>
					<tbody>
					<tr><td colspan="7" class="w-100 text-center">Aucune correspondance</td></tr>
					</tbody>
				</table>
		</div>
			<?php
		}
	}