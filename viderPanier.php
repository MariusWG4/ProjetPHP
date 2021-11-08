<?php

//ajout de la classe Panier
include 'classePanier.php';

//démarrage session
session_start();

//retrait
$_SESSION['panier']->razPanier();

echo '<h2>Le panier a bien été vidé.</h2>';
echo '<input type="button" value="Retour" OnClick="window.location.href=\'monPanier.php\'">';

?>
