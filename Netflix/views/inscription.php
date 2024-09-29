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
			<h1>S'inscrire</h1>

			<?php if(isset($_GET['error']) && isset($_GET['message'])) {

				echo '<div class="alert error">'.htmlspecialchars($_GET['message']).'</div>';

			} else if(isset($_GET['success'])) {

				echo '<div class="alert success">Vous êtes désormais inscrit. <a href="index.php">Connectez-vous</a>.</div>';

			} ?>

			<form method="post" action="index.php?page=inscription">
				<input type="text" name="name" placeholder="Votre nom complet" required />
				<input type="text" name="pseudo" placeholder="Votre pseudo" required />
				<input type="email" name="email" placeholder="Votre adresse email" required />
				<input type="password" name="password" placeholder="Mot de passe" required />
				<input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />
				<button type="submit">S'inscrire</button>
			</form>

			<p class="grey">Déjà sur Netflix ? <a href="/?page=accueil">Connectez-vous</a>.</p>
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