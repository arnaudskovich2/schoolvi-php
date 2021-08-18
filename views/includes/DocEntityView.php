<?php
	if (!isset($value)) {
		return;
	} ?>
<div class="col my-2 px-1">
	<div class="card">
		<div class="card-body p-0">
			<div class="bg-secondary d-flex align-items-center"
			     style="width: 100%;height: 180px;">
				<h5 class="card-title px-1 text-center w-100 text-light">
					<?php echo strtoupper($value['name']); ?>
				</h5>
			</div>
			<div class="bg-light pt-3 pb-2 px-2">
				<div class="w-100">
					<h6 class="col d-flex fw-bold">
						<span class="col"><?php echo $value['mat'] ?></span>
						<span class="col text-end">
							<?php echo $value['classe'] . '<br><span class="mt-1" style="color:#6434c9">' . $value['serie'] . '</span>' ?>
						</span>
					</h6>
				</div>
				<div class="w-100"></div>
				<div class="w-100 d-flex">
					<h6 class="col text-muted text-wrap">
						<?php echo $value['description'] ?>
					</h6>
					<a href="/controllers/download/download.php?id=<?php echo $value['download'] ?>&type=
						<?php echo $value['doc_type'] ?>"
					   title="Télécharger"
					   class="btn btn-primary" style="height: 40px; width:40px;">
						<i class="fa fa-download"></i>
					</a>
				</div>
				<?php if (isset($value['type'])) { ?>
					<div class="w-100 d-flex mt-1 fw-light">
						<h6 class="col-auto">De: </h6>
						<h6 class="col text-end text-success fw-bold"><?php echo $value['type'] ?></h6>
					</div>
				<?php } ?>
				<div class="w-100 text-muted d-flex mt-1">
					<h6 class="col-auto">Ajouté le: </h6>
					<h6 class="col text-end"><?php echo $value['date'] ?></h6>
				</div>
			</div>
		</div>
	</div>
</div>
