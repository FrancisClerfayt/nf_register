<?php
	require('./inc/database_connection.php');

	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

	if (empty($email)) {
		header('Location: forgotten_password.php?email=false');
		exit();
	} else {
		$token = bin2hex(random_bytes(50));

		$query = "SELECT `email` FROM `users` WHERE `email` = '$email'";

		$stmt = $db->query($query);

		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (count($result) <= 0) {
			header("Location: forgotten_password.php?error=$email");
			exit();
		} else {
			$sql = "INSERT INTO `password_reset` (`email`, `token`) VALUES (?, ?)";

			$stmt = $db->prepare($sql);

			$stmt->bindParam(1, $email, PDO::PARAM_STR);
			$stmt->bindParam(2, $token, PDO::PARAM_STR);

			$result = $stmt->execute();

			$to = $email;
			$subject = "Réinitialisation mot de passe registre des visites Nouvelle Forge";
			$href = "http://localhost/Projets/nf_register/password_reset_form.php?token =" . $token;
			$msg = "Bonjour,\npour réinitialiser votre mot de passe cliquez sur :\n<a href=\"$href\" >Lien de réinitialisation</a>";
			$msg = wordwrap($msg, 70);
			
			// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';
 
			// En-têtes additionnels
			$headers[] = "To: <$email>";
			$headers[] = 'From: Nouvelle Forge <noreply@nouvelleforge.fr>';

			mail($to, $subject, $msg, implode("\r\n", $headers));

			header("Location: pending.php?email=$email");
		}
	}