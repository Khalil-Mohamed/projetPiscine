<?php
	// information pour se connecter a la base de données
	$MYSQL['host'] = "localhost"; 	// nom de l'hote 
	$MYSQL['user'] = "admin"; 		// nom d'utilisateur
	$MYSQL['password'] = "snir2"; 	// mot de psse
	$MYSQL['database'] = "Piscine"; // nom base de données

	// Connection a la base de données
	$mysqli = mysqli_connect($MYSQL['host'],$MYSQL['user'],$MYSQL['password'],$MYSQL['database']);
	/*  Requete SQL qui selectionne les 5 dernieres id correspondant a la colonne Température
		du tableau ValeursCapteurs */
	$resultTemperature = $mysqli->query("SELECT id, Température FROM ValeursCapteurs ORDER BY `id` DESC LIMIT 5");

	//declaration d'un tableau
	$valeursTemperature = Array();
	// stockage des vleurs retourner par la requete dans le tableau
    while ($valeursTemperature[] = $resultTemperature->fetch_assoc()){}
	// efface la derniers valeurs null du tableau
    array_pop($valeursTemperature);
	// inversion de l'ordre du tableau
	$valeursTemperature = array_reverse($valeursTemperature);
	// retour des resultat et deconnexion de la base de données
    $mysqli->close();
    header('Content-type: application/json');

	echo json_encode($valeursTemperature);
