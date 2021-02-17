<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Inscription Registre</title>

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
			<form class="container form was-validated" id="sign_up_form" method="POST" action="signup.php">
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="place">Saisissez votre e-mail :</label>
						<input class="form-control" type="email" id="email" name="email" required>
					</div>
				</div>
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="password">Saisissez votre mot de passe :</label>
						<input class="form-control" type="password" id="password" name="password" required>
					</div>
				</div>
				<!-- <div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="confirm">Confirmez votre mot de passe :</label>
						<input class="form-control" type="password" id="confirm" name="confirm" required>
					</div>
				</div> -->
				<div class="row justify-content-center align-items-center form-check my-2">
					<div class="col-6 offset-4">
						<input class="form-check-input" type="checkbox" name="rgpd" id="rgpd" required>
						<label class="form-check-label" for="rgpd">
							J'accepte la 
							<a href="https://www.nouvelleforge.fr/politique-de-confidentialite/" target="_blank">
								politique confidentialité et données personnelles
							</a>
							de Nouvelle Forge.
						</label>
						<div class="invalid-feedback">Merci de cochez la case pour valider le formulaire</div>
					</div>
				</div>
				<div class="row justify-content-center align-items-center mb-3">
					<input class="btn btn-nf btn-lg col-3" type="submit" value="Envoyer">
				</div>
			</form>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>