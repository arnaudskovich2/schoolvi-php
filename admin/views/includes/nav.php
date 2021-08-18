<!-- NAVBAR -->
<div class="navbar navbar-expand-md navbar-light bg-light shadow">
	<a class="navbar-brand ps-2" href="/admin/">
		<i class="fas fa-user-shield"></i> <strong>ADMIN</strong>
	</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="nav">
		<ul class="nav navbar-nav ps-2">
			<li class="nav-item">
				<a href="/admin/views/index.php" class="nav-link <?php echo ($_SESSION['currentAdmin']) === 'home' ? "active" : "" ?>">
					<i class="fas fa-home"></i> Accueil
				</a>
			</li>
			<li class="nav-item">
				<a href="/admin/views/add.php"
					 class="nav-link <?php echo ($_SESSION['currentAdmin']) === 'add' ? "active" : "" ?>">
					<i class="fas fa-plus-square"></i> Ajouter
				</a>
			</li>
			<li class="nav-item">
				<a href="/admin/views/list.php"
					 class="nav-link <?php echo ($_SESSION['currentAdmin']) === 'list' ? "active" : "" ?>">
					<i class="fas fa-bookmark"></i> Docs
				</a>
			</li>
			<li class="nav-item">
				<a href="/admin/views/info.php"
					 class="nav-link <?php echo ($_SESSION['currentAdmin']) === 'info' ? "active" : "" ?>">
					<i class="fas fa-cogs"></i> Mes infos
				</a>
			</li>
		</ul>
	</div>
</div>
