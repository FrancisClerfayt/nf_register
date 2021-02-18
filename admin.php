<?php
	session_start();

	if(!isset($_SESSION["email"])){
		header("Location: login_form.php");
		exit(); 
	}

	require('./inc/database_connection.php');

	$query = "SELECT * FROM users;";

	$stmt = $db->query($query);
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
				<a href="data_display.php" class="btn btn-nf btn-lg">Retour</a>
			</div>
			<div class="col-2">
				<a href="data_display.php">
					<img class="logo_2" src="./assets/logo_nf_2018.png" alt="logo Nouvelle Forge, 80 avenue Roland Moreno, 59410 Anzin">
				</a>
			</div>
			<div class="col-2">
				<a href="create_account_form.php" class="btn btn-nf btn-lg">Ajouter un compte</a>
			</div>
		</div>
		<?php
			if(isset( $msg )) {
				echo "<div class=\"row justify-content-center align-items-center\">
					<p class=\"text-center text-warning\">" . @$msg . "</p>
				</div>";
			}
		?>
	</header>
	<main class="container-fluid">
		<div class="row justify-content-center align-items-center">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>E-mail</th>
						<th>est administrateur</th>
						<th colspan="2">Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
							echo '<tr>';
							echo '<td>' . $result['email'] . '</td>';
							if ($result['isAdmin'] == '0') {
								echo '<td>NON</td>';
							}
							if ($result['isAdmin'] == '1') {
								echo '<td>OUI</td>';
							}
							$id = $result['id'];
							echo "<td><a href=\"edit_account_form.php?id=$id\" class=\"btn btn-nf\">Modifier</a></td>";
							echo "<td><a href=\"delete_account.php?id=$id\" class=\"btn btn-danger\">Supprimer</a></td>";
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