<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/jpg" href="images/pisine.jpg" />
	<link href="/static/css/default.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" href="/static/css/bootstrap.min.css" />
	<title>Nous contactez</title>
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<?php
			include 'function.php';
			template_Navbar()
			?>
			<!-- section Formulaire-->
			<section class="mb-4">
				<!--Titre formulaire-->
				<h2 class="h1-responsive font-weight-bold text-center my-4">Un probleme ? contactez nous !!!</h2>
				<!--Description du formulaire-->
				<p class="text-center w-responsive mx-auto mb-5">Un problème dans votre piscine ? Votre système est en panne ? Les données relevées depuis nos capteurs vous paraissent erronées ?
					N'hésitez pas à nous contacter et nous interviendrons dans les plus brefs délais !</p>
				<div class="row">

					<div class="col-md-9 mb-md-0 mb-5">
						<form id="contact-form">

							<div class="row">

								<!--Champ Nom-->
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="name" name="name" class="form-control">
										<label for="name" class="">Votre Nom</label>
									</div>
								</div>
								<!--Fin champ Nom-->

								<!--Champ Email-->
								<div class="col-md-6">
									<div class="md-form mb-0">
										<input type="text" id="email" name="email" class="form-control">
										<label for="email" class="">Votre email</label>
									</div>
								</div>
								<!--Fin Champ Email-->

							</div>

							<div class="row">

								<!--Champ Objet-->
								<div class="col-md-12">
									<div class="md-form mb-0">
										<input type="text" id="subject" name="subject" class="form-control">
										<label for="subject" class="">Objet</label>
									</div>
								</div>
								<!--Fin Champ Objet-->
							</div>

							<div class="row">

								<!--Champ Message-->
								<div class="col-md-12">

									<div class="md-form">
										<textarea type="text" id="body" name="body" rows="2" class="form-control md-textarea"></textarea>
										<label for="body">Votre message</label>
									</div>

								</div>
								<!--Fin Champ Message-->
							</div>

						</form>
						<!--Boutton envoi-->
						<div class="text-center text-md-left">
							<a class="btn btn-primary" onclick="validateForm();">Envoyer</a>
						</div>
						<!--Message Popup-->
						<div class=" col-md-3 bg-warning status "></div>
					</div>

					<div class="col-md-3 text-center">

						<ul class="list-unstyled mb-0">
							<li>
								<!--localisation-->
								<a href="https://www.google.com/maps/place/Lyc%C3%A9e+G%C3%A9n%C3%A9ral+et+Technologique+du+Rempart/@43.2890491,5.3629886,17z/data=!3m1!4b1!4m5!3m4!1s0x12c9c0cf0874c3bb:0xa0b50a9303edf47c!8m2!3d43.2890491!4d5.3651773" target="_blank">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
										<path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
									</svg>
									<p>Lgt Rempart, Marseille, 13015</p>
								</a>
							</li>

							<li>
								<!--telephone-->
								<a href="tel:123-456-7890">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
										<path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
									</svg>
									<p>+33606060606</p>
								</a>
							</li>

							<li>
								<!--Mail-->
								<a href="mailto:ProjetPiscine@gmail.com">
									<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
										<path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z" />
									</svg>
									<p>ProjetPiscine@gmail.com</p>
								</a>
							</li>

						</ul>
					</div>

				</div>

			</section>
			<!--Fin section formulaire-->
		</div>
	</div>
	<script type="text/javascript">
		// fonction qui verifie si les champs sont vide ou incorrect
		function validateForm() {
			// verificaton si le champ nom est vide
			var name = document.getElementById('name').value;
			if (name == "") {
				// selection de la balise contenant dans sa class le terme status
				// ecriture en html d'un message si le champ name est vide
				document.querySelector('.status').innerHTML = "Champ nom Vide";
				return false;
			}

			var email = document.getElementById('email').value;
			if (email == "") {
				document.querySelector('.status').innerHTML = "Champ Email Vide";
				return false;
			} else {
				// variable contenant des charactere aidant a la verification
				var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				// verification si le champ email est au bon format.
				if (!re.test(email)) {
					document.querySelector('.status').innerHTML = "format Email Invalide";
					return false;
				}
			}

			var subject = document.getElementById('subject').value;
			if (subject == "") {
				document.querySelector('.status').innerHTML = "Champ Objet Vide";
				return false;
			}

			var body = document.getElementById('body').value;
			if (body == "") {
				document.querySelector('.status').innerHTML = "Champ message Vide";
				return false;
			}

			document.querySelector('.status').innerHTML = "Message Envoyer !";
			formData = {
				'name': $('input[name=name]').val(),
				'email': $('input[name=email]').val(),
				'subject': $('input[name=subject]').val(),
				'body': $('textarea[name=body]').val()
			};


			$.ajax({
				url: "sendEmail.php",
				type: "POST",
				data: formData,
				success: function(data, textStatus, jqXHR) {

					$('#status').text(data.message);
					if (data.code) //If mail was sent successfully, reset the form.
						$('#contact-form').closest('form').find("input[type=text], textarea").val("");
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$('#status').text(jqXHR);
				}
			});
		}
	</script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
</body>