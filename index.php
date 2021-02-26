<?php
	// getting the database connection
	require('./inc/database_connection.php');

	// query for getting all places from database 
	$query = 'SELECT * FROM `places`';

	// executing query
	$stmt = $db->query($query);
?>
<!DOCTYPE html>
<html lang="fr">
<head>

	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Formulaire registre</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<div class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<img src="./assets/logo_nf_2018.png" alt="logo de la nouvelle forge, 80 avenue roland moreno 59410 anzin" class="logo">
			<h1 class="text-center">Merci de sélectionner le lieu de votre visite</h1>
		</div>
		<div class="row justify-content-center align-items-center px-4">
			<?php
				// its possible to get a result
				while($result = $stmt->fetch(PDO::FETCH_ASSOC)){

					// display a link with a custom href and text taken in the database
					echo '<a href="register_form.php?place=' . $result['parameter'] . '" class="btn btn-nf my-2">' . $result['name'] . '</a>';
				}
			?>
		</div>
	</div>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>