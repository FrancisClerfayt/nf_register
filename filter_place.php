<?php
	require('./inc/database_connection.php');

	$startingDate = $_GET['startingDate'];
	$endingDate = $_GET['endingDate'];
	$place = $_GET['place'];

	$query = "SELECT r.`date`, r.`time`, r.`lastname`, r.`firstname`, r.`email`, r.`phone`, p.`name` AS `place`
	FROM `register` AS r
	INNER JOIN `places` AS p
	ON p.`id` = r.`place_id`
	WHERE p.`name` = '$place'
	AND r.`date` BETWEEN '$startingDate' AND '$endingDate'
	ORDER BY r.`date` ASC;";

	$stmt = $db->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Document</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<header class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<div class="col-2 mx-2">
				<a class="btn btn-nf btn-lg" href="filter_name_form.php">Filtrer par date et par nom</a>
			</div>
			<div class="col-2 mx-2">
				<a class="btn btn-nf btn-lg" href="filter_place_form.php">Filtrer par date et par lieu</a>
			</div>
			<div class="col-2 mx-2">
				<img class="logo_2" src="./assets/logo_nf_2018.png" alt="logo Nouvelle Forge, 80 avenue Roland Moreno, 59410 Anzin">
			</div>
			<div class="col-2 mx-2">
				
			</div>
			<div class="col-2 mx-2">
				<?php
					$href = "test_export.php?startingDate=$startingDate&endingDate=$endingDate&place=$place";
				?>
				<a class="btn btn-nf btn-lg" href="<?php echo $href ?>">Export PDF</a>
			</div>
		</div>
	</header>
	<main class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Heure d'arrivée</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Téléphone</th>
						<th>Lieu</th>
					</tr>
				</thead>
				<tbody>
					<?php
						
						while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
							echo '<tr>';
							$date = explode('-', $result['date']);
							echo '<td>' . $date[2] . ' / ' . $date[1] . ' / ' . $date[0] . '</td>';
							$time = explode(':', $result['time']);
							echo '<td>' . $time[0] . ' : ' . $time[1] . '</td>';
							echo '<td>' . $result['lastname'] . '</td>';
							echo '<td>' . $result['firstname'] . '</td>';
							echo '<td>' . $result['email'] . '</td>';
							echo '<td>' . $result['phone'] . '</td>';
							echo '<td>' . $result['place'] . '</td>';
							echo '</tr>';
						}
						
					?>
				</tbody>
			</table>
		</div>
	</main>
	<script src="./js/bootstrap.bundle.js"></script>
</body>
</html>