<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Netflix</title>
	<link rel="stylesheet" type="text/css" href="./../public/design/default.css">
	<link rel="icon" type="image/png" href="./../public/assets/favicon.png">
</head>
<body>

<header>
	<div id="brand"><img src="./../public/assets/logo.png" alt="Netflix"></div>
</header>	
	<section>
		<div id="login-body">

				<?php if(isset($_SESSION['connect'])) { ?>

					<h1>Bonjour !</h1>
					<?php
					if(isset($_GET['success'])){
						echo'<div class="alert success">Vous êtes maintenant connecté.</div>';
					} ?>
					<p>Qu'allez-vous regarder aujourd'hui ?</p>
					<small><a href="index.php?page=deconnexion">Déconnexion</a></small>

				<?php } else { ?>
					<h1>S'identifier</h1>

					<?php if(isset($_GET['error'])) {

						if(isset($_GET['message'])) {
							echo'<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';
						}

					} ?>

					<form method="post" action="index.php">
						<input type="email" name="email" placeholder="Votre adresse email" required />
						<input type="password" name="password" placeholder="Mot de passe" required />
						<button type="submit">S'identifier</button>
						<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>
					</form>
				

					<p class="grey">Première visite sur Netflix ? <a href="index.php?page=inscription">Inscrivez-vous</a>.</p>
				<?php } ?>
		</div>
	</section>

    <footer>
        <div class="container">
            <p>Des questions ? Appelez le 0800 917 813</p>
            <a href="#">Conditions des cartes cadeaux</a>
            <a href="#">Conditions d'utilisation</a>
            <a href="#">Déclaration de confidentialité</a>
        </div>
    </footer>
</body>
</html>