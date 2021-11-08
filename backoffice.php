<head>
	<title>Gestionnaire</title>
<link rel="stylesheet" href="Css/Backoffice.css">
</head>

<body style="background-color:rgb(193,193,178);">
<?php

	// On démarre la session
	session_start ();

	echo '<h1 class="titrePage"><center>Gestionnaire des CD</center></h1>';

	// On récupère nos variables de session
	if (isset($_SESSION['identifiant']) && isset($_SESSION['mot-de-passe'])) {
		// On affiche un lien pour fermer notre session
		echo '<form class="Deconnexion"><input type="button" value="Déconnexion" OnClick="window.location.href=\'logout.php\'"></form>';


		//Formulaire d'ajout de CD

		echo '<div class="AjoutCD">';
		echo '<center><h1>Ajout de CD</h1></center> <form class="ajoutCD" action="ajoutCD.php" method="POST">';
		echo '<p>Auteur ou groupe : <input class="saisi" type="text" name="auteur-groupe"></p>';
		echo '<p>Titre : <input class="saisi" type="text" name="titre"></p>';
		echo '<p>Prix : <input class="saisi" type="text" name="prix"></p>';
		echo '<p>Image : <input class="saisi" type="text" name="image"></p>';
		echo '<p>Genre : <input class="saisi" type="text" name="genre"></p>';
		echo '<p><center><input class="bouton" type="submit" name="ajout" value="Ajouter"></center></p>';
		echo '</form></div>';

		//Formulaire de suppression de CD
		echo '<div class="SuppCD">';
		echo '<center><h1>Supprimer un CD</h1></center>';

		//affichage liste déroulante
		echo '<form class="suppressionCD" action="suppressionCD.php" method="POST">';
		echo '<p><center><select  name="titre" id="cd-select">';

		echo '<option value="">--Sélectionnez un CD--</option>';

		//ajout des valeurs de la liste

		//Chargement du fichier XML
		$fichier = 'CD.xml';
		$cds = simplexml_load_file($fichier);

		foreach ($cds as $cd) {
			echo '<option value="'.$cd->{'titre'}.'"">'.$cd->{'titre'}.'</option>';
		}

		echo '</select></center></p><br>';
		echo '<p><center><input type="submit" name="suppression" value="Supprimer"></center></p>';
		echo '</form></div>';



	}
	else {
		echo 'Les variable ne sont pas déclarées';
	}

?>
</body>
