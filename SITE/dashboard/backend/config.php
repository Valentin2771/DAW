<?php
$server = "localhost";
$dbname = "bluejack";
$username = "root";
$password = "Technique2Argesis65";

try{
	$connection = new PDO("mysql:host=$server;dbname=$dbname", $username, $password); 
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Success!";
} catch (PDOException $e){
	
	echo "For some reason, we failed while trying to connect to the database...<br>";
	// echo "Couldn't connect to the database: " . $e->getMessage();
}

