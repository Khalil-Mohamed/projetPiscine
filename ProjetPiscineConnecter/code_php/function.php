<?php
function pdo_connect_mysql() 		// fonction qui permet la connection a la base de données
{
	$DATABASE_HOST = 'localhost'; 	// nom de l'hote
	$DATABASE_USER = 'admin'; 		// nom d'utilisateur
	$DATABASE_PASS = 'snir2'; 		// mot de psse 
	$DATABASE_NAME = 'Piscine'; 	// nom base de données
	// tentative de connexion a la bdd 
	try {
		return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
	} catch (PDOException $exception) {
		// si la connexion est une echec, arret du script est affichage d'un message d'erreur.
		exit('echec connexion a la base de données!');
	}
}
function template_Navbar()
{
	echo <<<EOT
	<div id="header-wrapper">
				<div id="header" class="container">
					<div id="logo">
						<h1><a href="index.php">Votre Piscine</a></h1>
					</div>
					<div id="menu">
						<ul>
							<li><a href="index.php" title=>Accueil</a></li>
							<li><a href="ancienreleve.php" title=>Historique des relevés</a></li>
							<li><a href="contact.php" accesskey="5" title="">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
	EOT;
}
