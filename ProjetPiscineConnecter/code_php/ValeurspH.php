<?php
	// information pour se connecter a la base de données
	$MYSQL['host'] = "localhost"; 	// nom de l'hote 
	$MYSQL['user'] = "admin"; 		// nom d'utilisateur
	$MYSQL['password'] = "snir2"; 	// mot de psse
	$MYSQL['database'] = "Piscine"; // nom base de données

	// Connection a la base de données
	$mysqli = mysqli_connect($MYSQL['host'],$MYSQL['user'],$MYSQL['password'],$MYSQL['database']);
	/*  Requete SQL qui selectionne les 5 dernieres id correspondant a la colonne pH
		du tableau mesures */
	$resultph = $mysqli->query("SELECT id, pH FROM mesures ORDER BY `id` DESC LIMIT 5");

	//declaration d'un tableau 
	$valeursPH = Array();
	// stockage des valeurs retourner par la requete dans le tableau
    while ($valeursPH[] = $resultph->fetch_assoc()){}
	// efface la derniers valeurs null du tableau
    array_pop($valeursPH);
	// inversion de l'ordre du tableau
	$valeursPH = array_reverse($valeursPH);
	// retour des resultat et deconnexion de la base de données
    $mysqli->close();
    header('Content-type: application/json');

	echo json_encode($valeursPH);
