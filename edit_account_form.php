<?php
	session_start();

	if(!isset($_SESSION["email"])){
		header("Location: login_form.php");
		exit(); 
	}

	$id = filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	require('./inc/database_connection.php');

	$query = "SELECT * FROM `users` WHERE `id` = $id;";

	$stmt = $db->query($query);

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

?>
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
	<header class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<p class="text-center">
				<?php echo "Connecté en tant que : " . $_SESSION['email']; ?>
			</p>
		</div>
	</header>
	<main class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<img class="logo" src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin">
		</div>
		<div class="row justify-content-center align-items-center">
			<form class="container form was-validated" id="sign_up_form" method="POST" action="edit_account.php">
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="place">Changez votre e-mail :</label>
						<input class="form-control" type="email" id="email" name="email" value="<?php echo $result['email']; ?>" required>
					</div>
				</div>
				<?php
					if ($_SESSION['isAdmin']) {
				?>
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="isAdmin">Ce compte a-t'il les droits administrateur :</label>
						<select class="form-select" name="isAdmin" id="isAdmin">
							<option value="0" <?php if ($result['isAdmin'] == '0') echo "selected"; ?>>non</option>
							<option value="1" <?php if ($result['isAdmin'] == '1') echo "selected"; ?>>oui</option>
						</select>
					</div>
				</div>
				<?php 
					} else {
				?>
				<div class="row justify-content-center align-items-center">
					<div class="col-6">
						<label class="form-label" for="password">Changez votre mot de passe (Laissez vide si vous ne voulez pas changer):</label>
						<input class="form-control" type="password" id="password" name="password">
					</div>
				</div>
				<?php
					}
				?>
				<div class="row justify-content-center align-items-center">
					<div class="col-6 offset-4">
						<input class="d-none" type="number" name="id" id="id" value="<?php echo $id; ?>">
					</div>
				</div>
				<div class="row justify-content-center align-items-center m-3">
					<input class="btn btn-nf btn-lg col-3" type="submit" value="Envoyer">
				</div>
			</form>
		</div>
	</main>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>