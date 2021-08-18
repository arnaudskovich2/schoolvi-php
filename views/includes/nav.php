<!-- NAVBAR -->
<div class="navbar navbar-expand-md navbar-light bg-light shadow">
	<a class="navbar-brand ps-2" href="../">
		<i class="fas fa-user-graduate"></i> <strong>SCHOOLVI</strong>
	</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="nav">
		<ul class="nav navbar-nav ps-2">
			<li class="nav-item">
				<a href="/views/annales/" class="nav-link <?php echo ($_SESSION['current']) === 'annales' ? "active" : "" ?>">
					<i class="fas fa-book"></i> Annales
				</a>
			</li>
			<li class="nav-item">
				<a href="/views/cours/" class="nav-link <?php echo ($_SESSION['current']) === 'cours' ? "active" : "" ?>">
					<i class="fas fa-book-reader"></i> Cours
				</a>
			</li>
			<li class="nav-item">
				<a href="/views/epreuves/" class="nav-link <?php echo ($_SESSION['current']) === 'epreuves' ? "active" : "" ?>">
					<i class="fas fa-file-pdf"></i> Epreuves
				</a>
			</li>
      <?php
        if (isset($_SESSION['isConnected']) && $_SESSION['isConnected'] === true) {
          ?>
					<li class="nav-item">
						<a href="/views/user/info.php" class="nav-link btn btn-dark text-light">
							<i class="fa fa-user-cog"></i> Mon compte
						</a>
					</li>
          <?php
        } else {
          ?>
					<li class="nav-item">
						<a href="/views/user/login.php" class="nav-link btn btn-primary text-light">
							<i class="fa fa-user"></i> Connexion
						</a>
					</li>
          <?php
        }
      ?>
		</ul>
	</div>
</div>
