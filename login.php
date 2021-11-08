<?php
	// On définit un login et un mot de passe de base
	$login_valide = "admin";
	$pwd_valide = "admin";

	// on teste si nos variables sont définies
	if (isset($_POST['identifiant']) && isset($_POST['mot-de-passe'])) {
		// on vérifie les informations saisies
		if ($login_valide == $_POST['identifiant'] && $pwd_valide == $_POST['mot-de-passe']) {
			session_start ();
			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd)
			$_SESSION['identifiant'] = $_POST['identifiant'];
			$_SESSION['mot-de-passe'] = $_POST['mot-de-passe'];
			// on redirige notre visiteur vers une page de notre section membre
			header ('location: backoffice.php');
		}
		else {
			echo '<body onLoad="alert(\'Admin non reconnu...\')">';
			// puis on le redirige vers la page d'accueil
			echo '<meta http-equiv="refresh" content="0;URL=accueil.php">';
		}
	} 
	else {
		echo 'Les variables du formulaire ne sont pas déclarées.';
	}
?>
