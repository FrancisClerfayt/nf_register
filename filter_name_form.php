<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Filtre par nom</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
<header class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<div class="col-2 mx-2">
				<img class="logo_2" src="./assets/logo_nf_2018.png" alt="logo Nouvelle Forge, 80 avenue Roland Moreno, 59410 Anzin">
			</div>
		</div>
	</header>
	<main class="container-fluid">
		<div>
			<form class="form row justify-content-center align-items-center" action="filter_name.php" method="GET">
				<div class="col-4 mx-5 offset-4">
					<label class="form-label" for="startingDate">Choisissez la date de début :</label>
					<input class="form-control" type="date" name="startingDate" id="startingDate">
				</div>
				<div class="col-4 mx-5 offset-4">
					<label class="form-label" for="endingDate">Choisissez la date de fin :</label>
					<input class="form-control" type="date" name="endingDate" id="endingDate">
				</div>
				<div class="col-4 mx-5 offset-4">
					<label class="form-label" for="lastname">Entrez le nom de la personne :</label>
					<input class="form-control" type="text" name="lastname" id="lastname">
				</div>
				<div class="col-4 mx-5 offset-4">
					<label class="form-label" for="firstname">Entrez le nom de la personne :</label>
					<input class="form-control" type="text" name="firstname" id="firstname">
				</div>
				<div class="col-6 mx-auto my-4 offset-3 py-2 px-4">
					<div class="row justify-content-center">
						<input class="btn btn-nf btn-lg w-50" type="submit" value="Filtrer">
					</div>
				</div>
			</form>
		</div>
	</main>
</body>
</html>