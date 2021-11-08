<?php

//ajout de la classe Panier
include 'classePanier.php';

//démarrage session
session_start();

//retrait
$_SESSION['panier']->retirerCD($_GET['cd']);

echo '<h2>Le CD a bien été supprimé.</h2>';
echo '<form><input type="button" value="Retour" OnClick="window.location.href=\'monPanier.php\'"></form>';


?>
