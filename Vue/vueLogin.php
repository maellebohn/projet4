<?php ob_start(); ?>

<div>
  <h1>Se connecter</h1>
	<form method="POST">

		<div class="form-group">
			<input id="username" class="form-control" name="username" type="text" placeholder="Votre nom" required />
		</div>

    <div class="form-group">
			<input id="password" class="form-control" name="password" type="password" placeholder="Votre mot de passe" required />
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Connexion" />
		</div>

	</form>
</div>

<?php if ($message==true) {
echo '<div class="error">Nom d\'utilisateur ou mot de passe erroné</div>';
} ?>

<?php $contenu = ob_get_clean(); ?>

<?php require 'template2.php'; ?>
