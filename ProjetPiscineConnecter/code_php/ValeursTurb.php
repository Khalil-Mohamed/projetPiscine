<?php
	// information pour se connecter a la base de données
	$MYSQL['host'] = "localhost"; 	// nom de l'hote 
	$MYSQL['user'] = "admin"; 		// nom d'utilisateur
	$MYSQL['password'] = "snir2"; 	// mot de psse
	$MYSQL['database'] = "Piscine"; // nom base de données

	// Connection a la base de données
	$mysqli = mysqli_connect($MYSQL['host'],$MYSQL['user'],$MYSQL['password'],$MYSQL['database']);
	/*  Requete SQL qui selectionne les 5 dernieres id correspondant a la colonne Turbidié
		du tableau mesures */
	$resultTurbidite = $mysqli->query("SELECT id, Turbidité FROM mesures ORDER BY `id` DESC LIMIT 5");

	//declaration d'un tableau
	$valeursTurbidite = Array();
	// stockage des valeurs retourner par la requete dans le tableau
    while ($valeursTurbidite[] = $resultTurbidite->fetch_assoc()){}
	// efface la derniers valeurs null du tableau
    array_pop($valeursTurbidite);
	// inversion de l'ordre du tableau
	$valeursTurbidite = array_reverse($valeursTurbidite);
	// retour des resultat et deconnexion de la base de données
    $mysqli->close();
    header('Content-type: application/json');

	echo json_encode($valeursTurbidite);
?>
