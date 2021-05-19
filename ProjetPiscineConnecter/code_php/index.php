<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--script permettant le fonctionnement de anychart-->
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-data-adapter.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-vml.min.js"></script>
	<link rel="shortcut icon" type="image/jpg" href="images/pisine.jpg" />
	<!--link permettant le fonctionnement de anychart-->
	<link rel="stylesheet" href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" />
	<link rel="stylesheet" href="https://cdn.anychart.com/releases/v8/fonts/css/anychart.min.css" />
	<!--liaison avec le css "default.css"-->
	<link href="/static/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<!--permet au site d'etre responsive-->
	<link rel="stylesheet" href="/static/css/bootstrap.min.css" />
	<title>Capteurs</title>
</head>

<body>
	<!--class qui permet le responsive-->
	<div class="container-fluid">
		<div class="row">
			<!--navbar responsive-->
			<?php
			include 'function.php';
			template_Navbar()
			?>
			<!--diagramme PH-->
			<div id="boxA">
				<script>
					// appel des données du fichier ValeurspH.php
					anychart.data.loadJsonFile("/ValeurspH.php", function(data) {
						// affichage des valeurs sous forme de diagramme en baton "column"
						var chart = anychart.column(data);
						// ordonnée y entre 0 et 14
						chart.yScale().minimum(0);
						chart.yScale().maximum(14);
						// nom de l'abscisse
						chart.xAxis().title('id');
						// nom de l'ordonnée
						chart.yAxis().title('pH');
						// titre du diagramme
						chart.title("dernieres valeurs du pH");
						// container dans laquel sera dessiner le diagramme
						chart.container("boxA");
						// affichage du diagramme
						chart.draw();

						// mise a jour du diagramme toute les 5 secondes
						setInterval(function() {
							// requete au serveur
							anychart.data.loadJsonFile("/ValeurspH.php", function(data) {
								chart.data(data);
							})
						}, 5000);
					});
				</script>
			</div>
			<!--diagramme Température-->
			<div id="boxA">
				<script>
					// appel des données du fichier ValeurTemp.php
					anychart.data.loadJsonFile("/ValeursTemp.php", function(data) {
						var chart = anychart.column(data);
						chart.yScale().minimum(0);
						chart.xAxis().title('id');
						chart.yAxis().title('Température');
						chart.title("dernieres valeurs de Température");
						chart.container("boxA");
						chart.draw();

						setInterval(function() {
							anychart.data.loadJsonFile("/ValeursTemp.php", function(data) {
								chart.data(data);
							})
						}, 5000);
					});
				</script>
			</div>
			<!--diagramme turbidité-->
			<div id="boxA">
				<script>
					// appel des données du fichier ValeursTurb.php
					anychart.data.loadJsonFile("/ValeursTurb.php", function(data) {
						var chart = anychart.column(data);
						chart.yScale().minimum(0);
						chart.xAxis().title('id');
						chart.yAxis().title('Turbidité');
						chart.title("dernieres valeurs de Turbidité");
						chart.container("boxA");
						chart.draw();

						setInterval(function() {
							anychart.data.loadJsonFile("/ValeursTurb.php", function(data) {
								chart.data(data);
							})
						}, 5000);
					});
				</script>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>