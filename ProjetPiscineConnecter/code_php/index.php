<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-base.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-data-adapter.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-exports.min.js"></script>
	<script src="https://cdn.anychart.com/releases/v8/js/anychart-vml.min.js"></script>
	<link rel="shortcut icon" type="image/jpg" href="images/pisine.jpg" />
	<link rel="stylesheet" href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" />
	<link rel="stylesheet" href="https://cdn.anychart.com/releases/v8/fonts/css/anychart.min.css" />
	<link href="/static/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="/static/css/bootstrap.min.css" />
	<title>Capteurs</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
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
			<div id="boxA">
				<script>
					anychart.data.loadJsonFile("/ValeurspH.php", function(data) { // init and draw chart
						var chart = anychart.line(data);
						chart.yScale().minimum(0);
						chart.xAxis().title('id');
						chart.yAxis().title('pH');
						chart.title("dernieres valeurs du pH");
						chart.container("boxA");
						chart.draw();

						// update chart from server every 5 seconds
						setInterval(function() {
							// make request to server
							// to use loadJsonFile function you must include data-adapter.min.js to your page
							anychart.data.loadJsonFile("/ValeurspH.php", function(data) {
								chart.data(data);
							})
						}, 5000);
					});
				</script>
			</div>
			<div id="boxA">
				<script>
					anychart.data.loadJsonFile("/ValeursTemp.php", function(data) { // init and draw chart
						var chart = anychart.line(data);
						chart.yScale().minimum(0);
						chart.xAxis().title('id');
						chart.yAxis().title('Température');
						chart.title("dernieres valeurs de Température");
						chart.container("boxA");
						chart.draw();

						// update chart from server every 5 seconds
						setInterval(function() {
							// make request to server
							// to use loadJsonFile function you must include data-adapter.min.js to your page
							anychart.data.loadJsonFile("/ValeursTemp.php", function(data) {
								chart.data(data);
							})
						}, 5000);
					});
				</script>
			</div>
			<div id="boxA">
				<script>
					anychart.data.loadJsonFile("/ValeursTurb.php", function(data) { // init and draw chart
						var chart = anychart.column(data);
						chart.yScale().minimum(0);
						chart.xAxis().title('id');
						chart.yAxis().title('Turbidité');
						chart.title("dernieres valeurs de Turbidité");
						chart.container("boxA");
						chart.draw();

						// update chart from server every 5 seconds
						setInterval(function() {
							// make request to server
							// to use loadJsonFile function you must include data-adapter.min.js to your page
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