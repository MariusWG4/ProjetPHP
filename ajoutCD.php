<?php
	// On démarre la session
	session_start ();

	// On récupère nos variables de session
	if (isset($_SESSION['identifiant']) && isset($_SESSION['mot-de-passe'])) {

		// On affiche un lien pour fermer notre session
		echo '<form><input type="button" value="Déconnexion" OnClick="window.location.href=\'logout.php\'"></form>';

		if ($_POST['auteur-groupe'] != null && $_POST['titre'] != null && $_POST['prix'] != null && $_POST['image'] != null && $_POST['genre']) {
			
			//Chargement du xml
			$fichier = 'CD.xml';
			$cds = simplexml_load_file($fichier);
			$cd = $cds->addChild('cd');

			//Ajout du cd
			$cd->addChild('auteur-groupe', $_POST['auteur-groupe']);
			$cd->addChild('titre', $_POST['titre']);
			$cd->addChild('prix', $_POST['prix']);
			$cd->addChild('image', $_POST['image']);
			$cd->addChild('genre', $_POST['genre']);

			//On formate le XML pour le sauvegarder pas en une seule ligne
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($cds->asXML());

			//Sauvegarde du XML dans le fichier CD.xml
			$dom->save('CD.xml');

			echo '<h1>Le CD a bien été ajouté.</h1>';

			echo '<form><input type="button" value="Retour" OnClick="window.location.href=\'backoffice.php\'"></form>';

		}
		else {
			//On alerte
			echo '<body onLoad="alert(\'Il manque des données\')">';
			// puis on le redirige vers la page d'accueil
			echo '<meta http-equiv="refresh" content="0;URL=backoffice.php">';
		}
	}
	else {
		echo 'Les variable ne sont pas déclarées';
	}
?>
