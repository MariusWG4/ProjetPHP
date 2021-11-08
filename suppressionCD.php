<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/Suppression.css">
</head>
<body style="background-color:rgb(193,193,178);">
<?php

	include "classePanier.php";

	// On démarre la session
	session_start ();

	// On récupère nos variables de session
	if (isset($_SESSION['identifiant']) && isset($_SESSION['mot-de-passe'])) {
		
		//Vérif qu'un CD a bien été sélectionné.
		if($_POST['titre'] != "") {

			//Chargement du fichier XML
			$fichier = new DOMDocument;
			$fichier->load('CD.xml');
			$cds = $fichier->getElementsByTagName('cd');

			//Suppression si le titre correspond au titre sélectionné
			foreach ($cds as $cd) {
				$titre = $cd->getElementsByTagName('titre')[0]->nodeValue;
				if ($titre == $_POST['titre']) {
					$cd->parentNode->removeChild($cd);
				}
			}


			if(isset($_SESSION['panier']->tabCDs[$cd->getElementsByTagName('titre')[0]->nodeValue])) {
				//suppression du cd dans le panier
				while ($_SESSION['panier']->tabCDs[$cd->getElementsByTagName('titre')[0]->nodeValue]['quantite']>1) {
					$_SESSION['panier']->retirerCD($cd->getElementsByTagName('titre')[0]->nodeValue);
				}
				//le dernier car sinon le test dans le while renvoie une erreur au dernier tour de boucle
				
					$_SESSION['panier']->retirerCD($cd->getElementsByTagName('titre')[0]->nodeValue);
			}

			//Sauvegarde du XML
			$fichier->save('CD.xml');

			echo '<div class="supp"><center>';
			echo '<img src="Vignettes/rafiki.gif">';
			echo '<h2>Le CD a bien été supprimé.</h2>';

			echo '<form><input type="button" value="Retour" OnClick="window.location.href=\'backoffice.php\'"></form></center></div>';

		}
		else {
			//On alerte
			echo '<body onLoad="alert(\'Aucun CD n\\\'a été sélectionné\')">';
			// puis on le redirige vers la page de sélection
			header('Refresh: 0,URL="backoffice.php"');
		}

	}
	else {
		echo 'Les variable ne sont pas déclarées';
	}

?>
</body>
