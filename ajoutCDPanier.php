<?php

//Ajout de la classe Panier
include "classePanier.php";

//démarrage session
session_start();

//ajout du cd au panier
$_SESSION['panier']->ajouterCD($_GET['cd']);

echo '<body onLoad="alert(\'CD ajouté au panier\')">';

echo '<meta http-equiv="refresh" content="0;URL=CDDetail.php?cd='.$_GET['cd'].'">';

?>
