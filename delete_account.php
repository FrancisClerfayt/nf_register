<?php
	session_start();

	if(!isset($_SESSION["email"])){
		header("Location: login_form.php");
		exit(); 
	}

	require('./inc/database_connection.php');

	if (!isset($_GET['id'])) {
		header('Location: admin.php');
		exit();
	} else {
		$id = $_GET['id'];
		$query = "DELETE * FROM users WHERE id = $id";
		$stmt = $db->query($query);
		$result = $stmt->execute();
	}