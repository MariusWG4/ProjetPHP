<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/CdDetail.css">
</head>
<body style="background-color:rgb(193,193,178);">
	<?php
	if(isset($_GET['cd'])) { //Vérification de l'existence de la variable
		//Chargement du fichier XML
		$fichier = 'CD.xml';
		$cds = simplexml_load_file($fichier);


		foreach ($cds as $cd) {
			//Affichage du cd correspondant ou titre passé en paramètre
			if($cd->{'titre'} == $_GET['cd']) {
				echo"<title>".$cd->{'titre'} ."</title>";

				echo "<center><div class=\"image\"><img src=\"".$cd->{'image'}."\"></div></center><br>";
				echo "<center><div class=\"proprietes\">Titre :".$cd->{'titre'}."<br>";
				echo "Auteur/groupe : ".$cd->{'auteur-groupe'}."<br>";
				echo "Genre : ".$cd->{'genre'}."<br>";
				echo "Prix : ".$cd->{'prix'}."€</div></center>";
			}
		}
		//Bouton pour ajouter au panier
		echo '<center><form><input class="bouton" type="button" value="Ajout au panier" OnClick="window.location.href=\'ajoutCDPanier.php?cd='.$_GET['cd'].'\'"></form></center>';

		//Bouton pour aller sur l'accueil
		echo '<center><form><input class="bouton" type="button" value="Accueil" OnClick="window.location.href=\'accueil.php\'"></form></center>';

	}
	else {
		echo '<h1>Cette page est censée être atteinte depuis l\'accueil, comment êtes-vous arrivés là ???</h1>';
	}
	?>
</body>
</html>
