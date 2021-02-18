<?php

	require('./inc/database_connection.php');

	session_start();

	if (isset($_POST['email'])) {
		$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
		$password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '" . hash('sha256', $password) . "';";

		$result = $db->query($query)->fetchAll();

		if (count($result) == 1) {
			
			$user_id = $result[0]['id'];
			$user_mail = $result[0]['email'];
			$user_isAdmin = $result[0]['isAdmin'];

			$_SESSION['id'] = $user_id;
			$_SESSION['email'] = $user_mail;
			if ($user_isAdmin == '1') {
				$_SESSION['isAdmin'] = true;
			} else {
				$_SESSION['isAdmin'] = false;
			}

			header('Location: data_display.php');
		} else {
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
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="card">
					<img class="card-img-top" src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin">
					<div class="card-body">
						<h1 class="card-title text-center">
							Une erreur s'est produite lors de la connexion à votre compte
						</h1>
						<a class="btn btn-nf btn-lg" href="login_form.php">
							Retour
						</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
		}
	}
?>