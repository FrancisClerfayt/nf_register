<?php
	ini_set('display_errors', 1);

	$db_host = 'localhost';			// Hôte de la BDD
	$db_port = '3306';					// Port d'accès
	$db_name = 'nf_register';		// nom de la BDD
	$db_user = 'userpop';				// nom d'utilisateur de la BDD
	$db_pswd = 'azerty12345!'; 	// mdp d'utilisateur de la BDD
	
	try {
		
		// connect to database
		$db = new \PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=UTF8", $db_user, $db_pswd);
		
	} catch(\PDOException $e) {
		echo $e->getMessage(); // display error message
		echo '<br> Dans le Fichier : <br>';
		echo $e->getFile(); // display in which file the error is
		echo '<br> A la ligne : ';
		echo $e->getLine(); // display on which line in the file the error is
	}