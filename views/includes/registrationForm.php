<div class="my-4">
	<label for="name" class="sr-only">Nom et Prénoms</label>
	<input type="text" name="name" id="name" pattern="^[a-zA-Z]{2,}(['-][a-zA-Z]{2,})?( [a-zA-Z]{2,}(['-][a-zA-Z]{2,})?)+$"
	       autocomplete="off" class="form-control" placeholder="Nom et Prénoms"
	       maxlength="30" required>
</div>
<div class="my-4">
	<label for="message" class="sr-only">Classe et Série</label>
	<div class="row px-3">
		<label for="classe" class="sr-only">Votre classe</label>
		<select name="classe" id="classe" class="form-control col me-1" required>
			<option value="">--Classe--</option>
			<option value="tle">Tle</option>
			<option value="1ere">1ere</option>
			<option value="2nde">2nde</option>
		</select>
		<label for="serie" class="sr-only">Votre série</label>
		<select name="serie" id="serie" class="form-control col ms-1" required>
			<option value="">--Série--</option>
			<option value="A">A</option>
			<option value="C">C</option>
			<option value="D">D</option>
			<option value="E">E</option>
			<option value="F">F</option>
			<option value="G">G</option>
		</select>
	</div>
</div>
<div class="my-4">
	<label for="state" class="sr-only">Votre statut</label>
	<select name="state" id="state" class="form-control" required>
		<option value="">--Votre statut--</option>
		<option value="Elève">Elève</option>
		<option value="Enseignant">Enseignant</option>
	</select>
</div>
<div class="my-4">
	<label for="school" class="sr-only">École</label>
	<input type="text" name="school" id="school" pattern="^[a-zA-Z0-9 -]{3,30}$" autocomplete="off" class="form-control"
	       placeholder="Nom de votre école" required>
	<small class="text-muted fw-bold">Utiliser: A-Z a-z 0-9 @ _ -</small>
</div>
<div class="my-4">
	<label for="username" class="sr-only">Nom d'utilisateur</label>
	<input type="text" name="username" id="username" pattern="^[a-z0-9@_-]{6,30}$" autocomplete="off"
	       class="form-control" placeholder="Votre nom d'utilisateur" required>
	<small class="text-muted fw-bold">Utiliser: a-z 0-9 @ _ - (pas d'espace)</small><br>
	<small class="form-text text-success fw-bold">
		<i class="fa fa-info-circle"></i>
		Retenez-le! Important lors de la connexion.
	</small>
</div>

<div class="my-4">
	<label for="password" class="sr-only">Mot de passe</label>
	<input type="password" name="password" pattern="^(.){6,40}$" id="password" autocomplete="off"
	       class="form-control" placeholder="Mot de passe" required>
	<small class="form-text text-success fw-bold">
		<i class="fa fa-info-circle"></i>
		Retenez-le! Important lors de la connexion.
	</small>
</div>

<div class="my-4">
	<label for="tel" class="sr-only">Contact</label>
	<input type="tel" name="tel" id="tel" pattern="^[0-9]{8,20}$" autocomplete="off" class="form-control"
	       placeholder="Numéro de téléphone" required>
	<small class="text-muted fw-bold">Utiliser: 0-9</small>
</div>
<div class="my-4">
	<label for="email" class="sr-only">Email</label>
	<input type="email" name="email" id="email" autocomplete="off" class="form-control" placeholder="Email"
	       pattern="^[a-z0-9._-]{1,30}@[a-z]{2,20}((-\.)?[a-z]{2,30})?\.[a-z]{2,6}$" required>
</div>
<div class="my-4 form-check text-primary">
	<input type="checkbox" name="condition" id="condition" class="form-check-input" required>
	<label for="condition" class="form-check-label"> J'accepte les conditions du site</label>
</div>
<div class="my-4">
	<button type="submit" class="btn btn-success">
		S'inscrire <i class="fa fa-user-plus"></i>
	</button>
</div>
<div class="my-2 text-center">
	<small class="text-muted">
		<a href="/views/user/login.php">Ou connectez-vous si vous avez déjà un compte</a>
	</small>
</div>
