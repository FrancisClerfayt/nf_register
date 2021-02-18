<?php
	session_start();
	$_SESSION["email"] = "";
	if (empty($_SESSION['email'])) {
		header('Location: login_form.php');
	}