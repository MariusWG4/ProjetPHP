<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/Suppression.css">
</head>
<body style="background-color:rgb(193,193,178);">
<?php
	// On démarre la session
	session_start();

	// On détruit les variables de notre session
	unset($_SESSION['identifiant']);
	unset($_SESSION['mot-de-passe']);


	//On affiche une petite image rigolote
	echo '<div class="supp"><center>';
	echo '<img src="Vignettes/pikachu128.png">';
	echo '<h2>Vous vous êtes déconnecté</h2></center>';
	echo '</div>';

	// On redirige le visiteur vers la page d'accueil
	header('Refresh: 1,URL="accueil.php"');
?>
</body>
