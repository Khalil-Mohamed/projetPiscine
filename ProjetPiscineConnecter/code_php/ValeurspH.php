<?php
	// Define MySQL connection data
	$MYSQL['host'] = "localhost";
	$MYSQL['user'] = "admin";
	$MYSQL['password'] = "snir2";
	$MYSQL['database'] = "Piscine";

	// Connect to MySQL database
	$mysqli = mysqli_connect($MYSQL['host'],$MYSQL['user'],$MYSQL['password'],$MYSQL['database']);

	$resultph = $mysqli->query("SELECT id, pH FROM ValeursCapteurs ORDER BY `id` DESC LIMIT 5");

	// Loop through the result and populate an array
	$valeursPH = Array();
    while ($valeursPH[] = $resultph->fetch_assoc()){}
    array_pop($valeursPH);
	$valeursPH = array_reverse($valeursPH);
	// Return the result and close MySQL connection
    $mysqli->close();
    header('Content-type: application/json');

	echo json_encode($valeursPH);
