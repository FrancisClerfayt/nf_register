<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - En attente de réinitilisation du mot de passe</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<div class="card col-4 mt-5 border">
				<img class="card-img-top logo_2" src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin">
				<div class="card-body">
					<h1 class="card-title text-center">
						E-mail envoyé
					</h1>
					<p class="text-center">
						Nous vous avons envoyé un email à <?php echo $_GET['email'] ?> pour réinitialiser votre mot de passe.
					</p>
				</div>
			</div>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>	