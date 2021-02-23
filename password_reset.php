<?php

	session_start();

	$new_password = filter_var(trim($_POST['password']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$confirm = filter_var(trim($_POST['confirm']), FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$token = $_SESSION['token'];

	if (empty($new_password)) {
		header("Location: password_reset_form.php?token=$token&error=password");
		exit();
	} elseif ($new_password != $confirm) {
		header("Location: password_reset_form.php?token=$token&error=confirm");
		exit();
	} else {
		require('./inc/database_connection.php');

		$query = "SELECT * FROM `password_reset` WHERE `token` = '$token'";

		$stmt = $db->query($query);

		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		var_dump($result);

		$email = $result['email'];

		if ($email) {
			$password = hash('sha256', $new_password);

			$sql = "UPDATE `users` SET `password` = ? WHERE `email` = ?";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(1, $password, PDO::PARAM_STR);
			$stmt->bindParam(2, $email, PDO::PARAM_STR);

			$result = $stmt->execute();

			header('Location: login_form.php?pass_reset=true');
		}
	}