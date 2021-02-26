<!DOCTYPE html>
<html lang="fr">
<head>

	<meta charset="UTF-8">
	<meta name="robots" content="noindex">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Formulaire Mot de passe oublié</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<img class="logo" src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin">
		</div>
		<div class="row justify-content-center align-items-center">
			<form class="container form was-validated" id="forgotten_password_form" method="POST" action="forgotten_password.php">
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="place">Saisissez votre e-mail :</label>
						<input class="form-control" type="email" id="email" name="email" required>
						<?php
							if (isset($_GET['email'])) {
								echo "<p class=\"text-danger\">Votre email est nécessaire pour réinitialisé votre mot de passe</p>";
							}
						?>
					</div>
				</div>
				<div class="row justify-content-center align-items-center px-4 m-3">
					<input class="btn btn-nf btn-lg col-3" type="submit" value="Envoyer">
				</div>
			</form>
			<?php
				if (isset($_GET['error'])) {
					$email = $_GET['error'];
					echo "<div class=\"alert alert-danger\"> l'email $email n'apparaît pas dans notre système </div>";
				}
			?>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>