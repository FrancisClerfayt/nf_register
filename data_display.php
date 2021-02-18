<?php
	session_start();

	if(!isset($_SESSION["email"])){
		header("Location: login_form.php");
		exit(); 
	}

	if (isset($_GET['page'])){
		$page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
	} else {
		$page = 1;
	}

	$number_of_lines_to_display = 15;

	$data_offset = ($page - 1) * $number_of_lines_to_display;

	require('./inc/database_connection.php');

	$query = 
	"SELECT 
		r.`date`,
		r.`time`,
		r.`lastname`,
		r.`firstname`,
		r.`email`,
		r.`phone`,
		p.`name` AS `place`
	FROM `register` AS r
	INNER JOIN `places` AS p
	ON p.`id` = r.`place_id`
	ORDER BY r.`date` ASC
	LIMIT $data_offset, $number_of_lines_to_display;";

	$stmt = $db->query($query);

	$counter = $db->query("SELECT COUNT(*) AS nb_lines FROM register")->fetch();
	$size = (int) $counter['nb_lines'];

	$last_data = $data_offset + $number_of_lines_to_display;
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Nouvelle Forge - Administration registre</title>

	<link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="./css/bootstrap.css">
	<link rel="stylesheet" href="./css/fonts.css">
	<link rel="stylesheet" href="./css/style.css">

</head>
<body>
	<header class="container-fluid">
		<div class="row justify-content-around align-items-center">
			<div class="col-2">
				<a href="data_display.php">
					<img class="logo_2" src="./assets/logo_nf_2018.png" alt="logo Nouvelle Forge, 80 avenue Roland Moreno, 59410 Anzin">
				</a>
			</div>
			<div class="col-2">
				<a href="filter_name_form.php" class="btn btn-nf">Filtrer par date et par nom</a>
			</div>
			<div class="col-2">
				<a href="filter_place_form.php" class="btn btn-nf">Filtrer par date et par lieu</a>
			</div>
			<div class="col-2">
				<?php 
					if ($page > 1) {
						$previous = $page - 1;
						echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $previous . " class=\"btn btn-nf mr-1\">Page précédente</a>";
					}
				?>
				<?php
					if ($last_data < $size) {
						$next = $page + 1;
						echo "<a href=" . $_SERVER['PHP_SELF'] . "?page=" . $next . " class=\"btn btn-nf ml-1\">Page suivante</a>";
					}
				?>
			</div>
			<div class="col-2">
				<?php
					if ($_SESSION['isAdmin']){
						echo "<a href=\"admin.php\" class=\"btn btn-nf\">Admin. comptes</a>";
					} else {
						$email = $_SESSION['email'];
						$q = "SELECT * FROM `users` WHERE `email` = '$email'";
						$r = $db->query($query)->fetch(PDO::FETCH_ASSOC);
						$id = $r['id'];
						echo "<a href=\"edit_account_form.php?id=$id\" class=\"btn btn-nf\">Mon compte</a>";
					}
				?>
			</div>
			<div class="col-2">
				<a href="logout.php" class="btn btn-danger">Quitter</a>
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