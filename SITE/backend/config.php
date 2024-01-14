<?php
$server="localhost";
$dbname="bluejack";
$username="";
$password="";

try{
	$connection = new PDO("mysql:host=$server;dbname=$dbname", $username, $password); 
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Success!";
} catch (PDOException $e){
	
	echo "For some reason, we failed while trying to connect to the database...<br>";
	// echo "Couldn't connect to the database: " . $e->getMessage();
}

