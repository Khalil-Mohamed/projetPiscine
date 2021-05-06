<?php
include 'function.php';
$pdo = pdo_connect_mysql();
$requete = "SELECT * FROM ValeursCapteurs ORDER BY id LIMIT :current_page, :record_per_page";
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;
// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare($requete);
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_contacts = $pdo->query('SELECT COUNT(*) FROM ValeursCapteurs')->fetchColumn();
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
			<div id="header-wrapper">
				<div id="header" class="container">
					<div id="logo">
						<<h1><a href="index.php">Votre Piscine</a></h1>
					</div>
					<div id="menu">
						<ul>
							<li><a href="index.php" title=>Accueil</a></li>
							<li><a href="ancienreleve.php" accesskey="2" title="">Historique des relevés</a></li>
							<li><a href="contact.php" accesskey="5" title="">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="content read">
				<div class="table-responsive">
					<h2>Votre Historique</h2>
					<table class="table">
						<thead>
							<tr>
								<td>#</td>
								<td>pH</td>
								<td>Température</td>
								<td>Turbidité</td>
								<td>Date</td>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($contacts as $contact) : ?>
								<tr>
									<td>
										<?= $contact['id'] ?>
									</td>
									<td>
										<?= $contact['pH'] ?>
									</td>
									<td>
										<?= $contact['Température'] ?>
									</td>
									<td>
										<?= $contact['Turbidité'] ?>
									</td>
									<td>
										<?= $contact['Date'] ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<div class="pagination">
						<?php if ($page > 1) : ?>
							<a href="ancienreleve.php?page=<?= $page - 1 ?>"><i class="fas fa-angle-double-left fa-sm"><?= $page  ?></i></a>
						<?php endif; ?>
						<?php if ($page * $records_per_page < $num_contacts) : ?>
							<a href="ancienreleve.php?page=<?= $page + 1 ?>"><i class="fas fa-angle-double-right fa-sm"><?= $page  ?></i></a>
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