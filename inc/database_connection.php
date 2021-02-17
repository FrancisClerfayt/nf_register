<?php
	ini_set('display_errors', 1);

	$db_host = 'localhost';
	$db_port = '3306';
	$db_name = 'nf_register';
	$db_user = 'userpop';
	$db_pswd = 'azerty12345!';
	
	try {
		
		// connect to database
		$db = new \PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_pswd);
		
	} catch(\PDOException $e) {
		echo $e->getMessage(); // display error message
		echo '<br> Dans le Fichier : <br>';
		echo $e->getFile(); // display in which file the error is
		echo '<br> A la ligne : ';
		echo $e->getLine(); // display on which line in the file the error is
	}