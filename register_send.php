<?php
	require('./inc/database_connection.php');

	// FILTER_SANITIZE_FULL_SPECIAL_CHARS

	$lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$date = trim($_POST['date']);
	$time = trim($_POST['time']);
	$place_id = filter_var(trim($_POST['place_id']), FILTER_VALIDATE_INT);

	$query = "INSERT INTO `register` (`date`, `time`, `lastname`, `firstname`, `email`, `phone`, `place_id`) 
	VALUES ($date, $time, $lastname, $firstname, $email, $phone, $place_id);";

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

	$prep->execute();

	header('Location: http://localhost/Projets/nf_register/index.php');
	exit();