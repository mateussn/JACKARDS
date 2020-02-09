<?php
	$server = 'localhost:3306';
	$user = 'root';
	$password = '';
	$db_name = 'jackards_db';

    try {
        $connection = new mysqli($server, $user, $password, $db_name);
        $connection->set_charset('utf8mb4');
    }
    catch (Exception $exception) {
        die('Error connecting to database.');
    }
?>
