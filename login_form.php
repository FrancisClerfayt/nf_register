<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Connexion Registre</title>

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
		<?php if (isset($_GET['pass_reset']) && $_GET['pass_reset'] == 'true'){ ?>
		<div class="row justify-content-center align-items-center">
			<p class="alert alert-success text-center w-50">Votre mot de passe a été changé avec succès</p>
		</div>
		<?php	}	?>
		<div class="row justify-content-center align-items-center">
			<form class="container form was-validated" id="login_form" method="POST" action="login.php">
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
						<a href="forgotten_password_form.php">Mot de passe oublié ?</a>
					</div>
				</div>
				<div class="row justify-content-center align-items-center px-4 m-3">
					<input class="btn btn-nf btn-lg col-3" type="submit" value="Connexion">
				</div>
			</form>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>