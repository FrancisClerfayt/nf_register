<?php
	ini_set('display_errors', 1);
	try {

		$database_host = 'localhost';
		$database_port = '3306';
		$database_name = 'nf_register';
		$database_user = 'userpop';
		$database_pswd = 'azerty12345!';
		
		// connect to Database
		$db = new \PDO("mysql:host=$database_host;port=$database_port;dbname=$database_name", $database_user, $database_pswd);
		
	} catch(\PDOException $e) {
		echo $e->getMessage(); // display error message
		echo '<br> Dans le Fichier : <br>';
		echo $e->getFile(); // display in which file the error is
		echo '<br> A la ligne : ';
		echo $e->getLine(); // display on which line in the file the error is
	}