<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8"/>
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
		<link rel="stylesheet" href="css/style2.css"/>
		<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
		<script>
		tinymce.init({
			selector: '#content'
		});
		</script>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<meta name="description" content="Découvrez le dernier roman de Jean Forteroche.">
		<title>Le blog de Jean Forteroche</title>
	</head>

	<body>

		<div class="container-fluid">

			<header>
				<nav class="navbar navbar-default navbar-fixed-top" role = "navigation">
					<div class="navbar-header">
						<button type = "button" class = "navbar-toggle" data-toggle = "collapse" data-target = "#navcollapse">
							<span class = "sr-only">Navigation</span>
							<span class = "icon-bar"></span>
							<span class = "icon-bar"></span>
							<span class = "icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/">
							<span class="auteur">Jean Forteroche</span>
						</a>
					</div>
					<div class = "collapse navbar-collapse" id = "navcollapse">
						<ul class="nav navbar-nav pull-right">
							<li><a href="/#"><span class="fas fa-home"></span>Accueil</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fas fa-file-alt"></span>Chapitres<span class="fas fa-caret-down"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/index.php?action=post&id=5">Chapitre 1</a></li>
									<li><a href="#">Chapitre 2</a></li>
									<li><a href="#">Chapitre 3</a></li>
									<li><a href="#">Chapitre 4</a></li>
									<li><a href="#">Chapitre 5</a></li>
								</ul>
							</li>

							<?php if (!empty($_SESSION['username'])): ?>      
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fas fa-unlock"></span>Admin<span class="fas fa-caret-down"></span></a>
								<ul class="dropdown-menu">
									<li><a href="/index.php?action=connect">Administration</a></li>
									<li><a href="/index.php?action=redaction">Rédaction</a></li>
									<li><a href="/index.php?action=modifyUser">Profil</a></li>
									<li><a href="/index.php?action=deconnect">Déconnexion</a></li>
								</ul>
							</li>
							<?php else: ?>
							<li><a href="/index.php?action=login"><span class="fas fa-sign-in-alt"></span>S'identifier</a></li>
						<?php endif; ?>
						</ul>
					</div>
				</nav>
			</header>

			<div id="wrapper">

				<div id="main" class="col-xs-12 col-md-12">
					<?php echo $contenu; ?>
				</div>

			</div>

		</div>

		<footer>
			<div id="reseaux" class="text-center">
				<a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/">
					<span class="fab fa-facebook"></span>
				</a>
				<a class="btn btn-social-icon btn-twitter" href="https://twitter.com/">
					<span class="fab fa-twitter"></span>
				</a>
				<a class="btn btn-social-icon btn-amazon" href="https://www.amazon.fr/">
					<span class="fab fa-amazon"></span>
				</a>
			</div>
		</footer>


	<script src="jquery-3.2.1.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="table.js"></script>

	</body>

</html>
