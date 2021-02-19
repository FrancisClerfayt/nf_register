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
<?php
	session_start();
	
	if(!isset($_SESSION["email"])){
		header("Location: login_form.php");
		exit(); 
	}

	$user_mail = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	$user_pswd = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$user_pswd = hash('sha256', $user_pswd);
	$user_isAdmin = $_POST['isAdmin'];

	require('./inc/database_connection.php');

	$res = false;

	$query = "INSERT INTO `users` (`email`, `password`, `isAdmin`) VALUES (?, ?, ?);";

	$prep = $db->prepare($query);

	$prep->bindParam(1, $user_mail, PDO::PARAM_STR);
	$prep->bindParam(2, $user_pswd, PDO::PARAM_STR);
	$prep->bindParam(3, $user_isAdmin, PDO::PARAM_BOOL);

	$res = $prep->execute();

	if ($res) {
		echo "
		<div class=\"container-fluid\">
			<div class=\"row justify-content-center align-items-center\">
				<div class=\"card col-4 mt-5 border\">
					<img class=\"card-img-top logo_2\" src=\"./assets/logo_nf_2018.png\" alt=\"logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin\">
					<div class=\"card-body\">
						<h1 class=\"card-title text-center\">
							Votre compte a été créé avec succès
						</h1>
						<a class=\"btn btn-nf btn-lg align-self-center\" href=\"admin.php\">
							Continuer
						</a>
					</div>
				</div>
			</div>
		</div>";
	} else {
		echo "
		<div class=\"container-fluid\">
			<div class=\"row justify-content-center align-items-center\">
				<div class=\"card col-4 mt-5 border\">
					<img class=\"card-img-top logo_2\" src=\"./assets/logo_nf_2018.png\" alt=\"logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin\">
					<div class=\"card-body\">
						<h1 class=\"card-title text-center\">
							Une erreur s'est produite lors de la création de votre compte
						</h1>
						<a class=\"btn btn-nf btn-lg align-self-center\" href=\"create_account_form.php.php\">
							Retour
						</a>
					</div>
				</div>
			</div>
		</div> ";
	}
	?>
	<script src="./js/bootstrap.bundle.js"></script>
</body>