<footer class="row page-footer pf-bg mt-5">
	<div class="col-12 col-md-6 py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="text-light fw-bold">Pour vos suggestions</p>
					<a href="https://wa.me/22896500836" title="whatsapp"
					   class="btn btn-outline-success rounded rounded-pill pt-2">
						<i class="fab fa-whatsapp"></i>
					</a>
					<a href="tel:+22896500836" title="telephone"
					   class="btn btn-outline-light rounded-circle rounded rounded-pill pt-2">
						<i class="fa fa-phone-alt"></i>
					</a>
					<a href="mailto:essowereoucharles@gmail.com" title="email"
					   class="btn btn-outline-danger rounded rounded-pill pt-2">
						<i class="fa fa-mail-bulk"></i>
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col mt-3">
					<a href="#" class="footer-link">A propos</a><br>
					<a href="#" class="footer-link">Nos conditions d'utilisation</a><br>
					<a href="#" class="footer-link">Devenir collaborateur</a><br>
					<?php if (!isset($_SESSION['isConnected']) || $_SESSION['isConnected'] !== true) { ?>
						<a href="/views/user/login.php" class="footer-link">Se connecter</a><br>
						<a href="/views/user/register.php" class="footer-link">Créer un compte</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-6 py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<div>
						<p>
							Idée et réalisation de <span class="text-primary">Charles Essowereou ASSIMTI</span>, Elève en Classe de
							Terminale C4 au
							Collège Notre Dame des Apôtres.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
		<p class="copyright">A. E. Charles © 2021</p>
	</div>
</footer>
