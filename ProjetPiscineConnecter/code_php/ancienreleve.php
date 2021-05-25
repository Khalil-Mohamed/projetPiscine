<?php
include 'function.php';
// connection a la bdd
$pdo = pdo_connect_mysql();
// Requete sql affichant le tableau mesures en fonction du nombre de mesures par pages
$requete = "SELECT * FROM mesures ORDER BY id LIMIT :page_actuelle, :mesure_par_page";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Nombre de ligne par page
$mesures_par_page = 10;
// Preparation de la requete SQL et recuperation des mesures de notre table, config de LIMIT
$stmt = $pdo->prepare($requete);
$stmt->bindValue(':page_actuelle', ($page - 1) * $mesures_par_page, PDO::PARAM_INT);
// attribution du nombre de mesures par pages
$stmt->bindValue(':mesure_par_page', $mesures_par_page, PDO::PARAM_INT);
$stmt->execute();
// recuperation des mesures pour les afficher dans notre page.
$mesures = $stmt->fetchAll(PDO::FETCH_ASSOC);
// recuperation du nombre total de mesures, pour determiner l'affichage de bouton suivant ou précédent
$num_mesures = $pdo->query('SELECT COUNT(*) FROM mesures')->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/jpg" href="images/pisine.jpg" />
	<link href="/static/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="/static/css/bootstrap.min.css" />
	<title>Historique</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
		<?=template_Navbar()?>
			<div class="content read">
				<div class="table-responsive">
					<h2>Votre Historique</h2>
					<!--tableau des valeurs-->
					<table class="table">
						<!--titre des colonnes-->
						<thead>
							<tr>
								<td>#</td>
								<td>pH</td>
								<td>Température</td>
								<td>Turbidité</td>
								<td>Date</td>
							</tr>
						</thead>
						<!--contenu du tableau-->
						<tbody>
							<!--fonction qui remplit le tableau pour chaque mesures-->
							<?php foreach ($mesures as $mesure) : ?>
								<tr>
									<td>
										<?= $mesure['id'] ?>
									</td>
									<td>
										<?= $mesure['pH'] ?>
									</td>
									<td>
										<?= $mesure['Température'] ?>
									</td>
									<td>
										<?= $mesure['Turbidité'] ?>
									</td>
									<td>
										<?= $mesure['Date'] ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<!--pagination des mesures-->
					<div class="pagination">
						<?php if ($page > 1) : ?>
							<a href="ancienreleve.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"><?= $page - 1  ?></i></a>
						<?php endif; ?>
						<?php if ($page * $mesures_par_page < $num_mesures) : ?>
							<a href="ancienreleve.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"><?= $page + 1  ?></i></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery-3.3.1.slim.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>