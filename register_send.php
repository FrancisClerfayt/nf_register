<?php
	require('./inc/database_connection.php');

	$query = "INSERT INTO `register` (`date`, `time`, `lastname`, `firstname`, `email`, `phone`, `place_id`) VALUES (?, ?, ?, ?, ?, ?, ?);";

	$prep = $db->prepare($query);

	$cookie_options = array (
		'expires' => time() + 60 * 60 * 24 * 365, 		// 60s * 60m * 24h * 365d = nb seconds in a year. expires in a year.
		'secure' => true,															// true || false
		'httponly' => true,														// true || false
		'samesite' => 'Strict'												// None || Lax || Strict
	);

	setcookie('userLastname', $_POST['lastname'], $cookie_options);
	setcookie('userFirstname', $_POST['firstname'], $cookie_options);
	setCookie('userEmail', $_POST['email'], $cookie_options);
	setcookie('userPhone', $_POST['phone'], $cookie_options);

	$prep->bindValue(1, $_POST['date'], PDO::PARAM_STR);
	$prep->bindValue(2, $_POST['time'], PDO::PARAM_STR);
	$prep->bindValue(3, $_POST['lastname'], PDO::PARAM_STR);
	$prep->bindValue(4, $_POST['firstname'], PDO::PARAM_STR);
	$prep->bindValue(5, $_POST['email'], PDO::PARAM_STR);
	$prep->bindValue(6, $_POST['phone'], PDO::PARAM_STR);
	$prep->bindValue(7, $_POST['place_id'], PDO::PARAM_INT);

	$prep->execute();

	header('Location: http://localhost/Projets/nf_register/index.php');
	exit();