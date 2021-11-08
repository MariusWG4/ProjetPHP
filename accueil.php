<!DOCTYPE html>
<html>
<head>
	<title>Projet PHP Accueil</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/Accueil.css">
</head>
<body style="background-color:rgb(193,193,178);">
<div class="Connexion">
	<!--Formulaire de connexion-->
	<form action="login.php" method="post">
		<div class="TextConnexion">Identifiant : </div><input class="boiteTexte" type="text" name="identifiant"><br>
		<div class="TextConnexion">Mot-de-passe :</div> <input class="boiteTexte" type="password" name="mot-de-passe"><br>
		<input class="bouton" type="submit" value="Connexion">
	</form>
</div>
<div>
	<input class="bouton" type="button" value="Mon panier" OnClick="window.location.href='monPanier.php'">
</div>
<div class="listeCD">
	<ul><center>
	<?php

	include "classePanier.php";

	//Démarrage session client et initialisation du panier
	session_start();

	if(!isset($_SESSION['panier'])) {
		$_SESSION['panier'] = new Panier;
	}

	//Chargement du fichier XML
	$fichier = 'CD.xml';
	$cds = simplexml_load_file($fichier);

	//affichage des cds
	foreach ($cds as $cd) {
		afficherCD($cd);
	}



	//--------------------------DÉCLARATION DES FONCTIONS--------------------------

	//Afficher tous les cds contenus dans le XML
	function afficherCD($cd) {
		echo'<li><center>';
		afficherVignette($cd->{'image'});
		echo'</center>';
		echo "<div class=\"resume\"><center><a href=\"CDDetail.php?cd=".$cd->{'titre'}."\">".$cd->{'titre'}."</a>"."<br>".$cd->{'auteur-groupe'}."</center></div>";
		//on a rendu le titre cliquable avec comma passage de paramètre le titre du cd
		echo'</li>';
	}

	//Générer et afficher les vignettes des cds à partir de leur image
	function afficherVignette($vignette) {
		//définition des paramètres
		$oldname = $vignette;
		$newname = "Vignettes/thumb_".substr("$vignette", 10);
		$newh = 100;

		//interpolation des dimensions
		$size = getImageSize($oldname);
		$w = $size[0];
		$h = $size[1];
		$neww = intval($newh * $w / $h);

		//recréation d'une image de taille inférieure
		$resimage = imagecreatefromjpeg($oldname);
		$newimage = imagecreatetruecolor($neww, $newh);
		imageCopyResampled($newimage, $resimage,0,0,0,0,$neww, $newh, getImageSize($vignette)[1], getImageSize($vignette)[0]);

		//sauvegarde de la nouvelle image
		imagejpeg($newimage, $newname, 30);

		//affichage de la nouvelle image
		echo "<div class=\"vignette\"><img src=\"$newname\" class=\"arrondie\"></div>";
	}

	?>
	</center></ul>
</div>
</body>
</html>
