<head>
	<title>Mon Panier</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/Suppression.css">
</head>
<body style="background-color:rgb(193,193,178);">
<?php

//ajout de la classe Panier
include 'classePanier.php';

//Démarrage de la session
session_id('sessionclient');
session_start();

//affichage du panier
echo'<div class="Panier"><center>';
$_SESSION['panier']->afficher();
echo'</center>';
//Vider
echo '<form><input type="button" value="Vider le panier" OnClick="window.location.href=\'viderPanier.php\'"></form>';

//Payer
echo '<form><input type="button" value="Payer" OnClick="window.location.href=\'paiement.php\'"></form>';

//Retourner à l'accueil
echo '<form><input type="button" value="Accueil" OnClick="window.location.href=\'accueil.php\'"></form>';
echo'<br/></div>';

?>
</body>
