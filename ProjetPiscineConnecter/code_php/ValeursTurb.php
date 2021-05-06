<?php
	// Define MySQL connection data
	$MYSQL['host'] = "localhost";
	$MYSQL['user'] = "admin";
	$MYSQL['password'] = "snir2";
	$MYSQL['database'] = "Piscine";

	// Connect to MySQL database
	$mysqli = mysqli_connect($MYSQL['host'],$MYSQL['user'],$MYSQL['password'],$MYSQL['database']);

	// Make SQL request
	$resultTurbidite = $mysqli->query("SELECT id, Turbidité FROM ValeursCapteurs ORDER BY `id` DESC LIMIT 5");

	// Loop through the result and populate an array
	$valeursTurbidite = Array();
    while ($valeursTurbidite[] = $resultTurbidite->fetch_assoc()){}
    array_pop($valeursTurbidite);
	$valeursTurbidite = array_reverse($valeursTurbidite);

	// Return the result and close MySQL connection
    $mysqli->close();
    header('Content-type: application/json');

	echo json_encode($valeursTurbidite);
?>
