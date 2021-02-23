<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Modifier compte</title>

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

	require('./inc/database_connection.php');

	$id = intval($_POST['id']);

	$query = "SELECT * FROM `users` WHERE `id` = $id";
	$stmt = $db->query($query);
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	$user_email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	if ($user_email == $result['email']){
		$email = $result['email'];
	} else {
		$email = $user_mail;
	}

	if ($_SESSION['isAdmin']) {
		$user_isAdmin = $_POST['isAdmin'];
		if ($user_isAdmin == '1') {
			$isAdmin = true;
		} else {
			$isAdmin = false;
		}
		$password = $_POST['old_pass'];
	} else {
		$user_password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if (empty($user_password)) {
			$password = $result['password'];
		} else {
			$password = hash('sha256', $user_password);
		}
		$isAdmin = $result['isAdmin'];
	}
	
	require('./inc/database_connection.php');

	$query = "UPDATE `users` SET `email` = ?, `password` = ?, `isAdmin` = ? WHERE `id` = ?";

	$prep = $db->prepare($query);

	$prep->bindParam(1, $email, PDO::PARAM_STR);
	$prep->bindParam(2, $password, PDO::PARAM_STR);
	$prep->bindParam(3, $isAdmin, PDO::PARAM_BOOL);
	$prep->bindParam(4, $id, PDO::PARAM_INT);

	$res = $prep->execute();

	if ($res) {
		if ($_SESSION['isAdmin']) {
			echo "
			<div class=\"container-fluid\">
				<div class=\"row justify-content-center align-items-center\">
					<div class=\"card col-4 mt-5 border\">
						<img class=\"card-img-top logo_2\" src=\"./assets/logo_nf_2018.png\" alt=\"logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin\">
						<div class=\"card-body\">
							<h1 class=\"card-title text-center\">
								Les modifications ont été effectuées avec succès
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
								Les modifications ont été effectuées avec succès
							</h1>
							<a class=\"btn btn-nf btn-lg align-self-center\" href=\"data_display.php\">
								Continuer
							</a>
						</div>
					</div>
				</div>
			</div>";
		}
	} else {
		if ($_SESSION['isAdmin']) {
			echo "
			<div class=\"container-fluid\">
				<div class=\"row justify-content-center align-items-center\">
					<div class=\"card col-4 mt-5 border\">
						<img class=\"card-img-top logo_2\" src=\"./assets/logo_nf_2018.png\" alt=\"logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin\">
						<div class=\"card-body\">
							<h1 class=\"card-title text-center\">
								Une erreur s'est produite lors de la modification du compte
							</h1>
							<a class=\"btn btn-nf btn-lg align-self-center\" href=\"admin.php\">
								Retour
							</a>
						</div>
					</div>
				</div>
			</div> ";
		} else {
			echo "
			<div class=\"container-fluid\">
				<div class=\"row justify-content-center align-items-center\">
					<div class=\"card col-4 mt-5 border\">
						<img class=\"card-img-top logo_2\" src=\"./assets/logo_nf_2018.png\" alt=\"logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin\">
						<div class=\"card-body\">
							<h1 class=\"card-title text-center\">
								Une erreur s'est produite lors de la modification du compte
							</h1>
							<a class=\"btn btn-nf btn-lg align-self-center\" href=\"data_display.php\">
								Retour
							</a>
						</div>
					</div>
				</div>
			</div> ";
		}
	}
	?>
	<script src="./js/bootstrap.bundle.js"></script>
</body>