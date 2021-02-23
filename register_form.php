<?php
	require('./inc/database_connection.php');

	if (isset($_GET['place'])) {
		$place = filter_var($_GET['place'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	} else {
		$place = 'reception';
	}

	$query = "SELECT * FROM `places` WHERE `parameter` = '$place';";

	$stmt = $db->query($query);

	$result = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Registre</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<img class="logo" src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin">
			<h1 class="text-center">Merci de remplir le registre des visites</h1>
		</div>
		<div class="row justify-content-center align-items-center">
			<form class="container form was-validated" id="registerForm" method="POST" action="register_send.php">
				<div class="row justify-content-center align-items-center">
					<div class="col">
						<label class="form-label" for="place">Vous êtes ici :</label>
						<input class="form-control" type="text" value="<?php echo $result['name']; ?>" disabled>
						<input class="d-none" type="text" name="place" id="place" value="<?php echo $result['id']; ?>">
					</div>
				</div>
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="date">Choisir la date :</label>
						<input class="form-control" type="date" name="date" id="date" required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="time">Choisir l'heure d'arrivé :</label>
						<input class="form-control" type="time" name="time" id="time" required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
				</div>
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="lastname">Entrer votre nom :</label>
						<input class="form-control" type="text" name="lastname" id="lastname" <?php if(isset($_COOKIE['userLastname'])) echo 'value="' . $_COOKIE['userLastname'] . '"'; ?> required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="firstname">Entrer votre prénom :</label>
						<input class="form-control" type="text" name="firstname" id="firstname" <?php if (isset($_COOKIE['userFirstname'])) echo 'value="' . $_COOKIE['userFirstname'] . '"'; ?> required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
				</div>
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="email">Entrer votre adresse mail :</label>
						<input class="form-control" type="email" name="email" id="email" <?php if(isset($_COOKIE['userEmail'])) echo 'value="' . $_COOKIE['userEmail'] . '"'; ?> required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
					<div class="col-lg-6 col-sm-12 mt-2">
						<label class="form-label" for="phone">Entrer votre numéro de téléphone :</label>
						<input class="form-control" type="tel" name="phone" id="phone"  <?php if (isset($_COOKIE['userPhone'])) echo 'value="' . $_COOKIE['userPhone'] . '"'; ?> required>
						<div class="invalid-feedback">Ce champ est obligatoire</div>
					</div>
				</div>
				<div class="row justify-content-center align-items-center form-check my-2">
					<div class="col">
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
				<div class="row justify-content-center align-items-center px-4 mb-3">
					<input class="btn btn-nf btn-lg" type="submit" value="Envoyer">
				</div>
			</form>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
	<script src="./js/register_form.js"></script>
</body>
</html>