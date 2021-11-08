<head>
	<title>Paiement Panier</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="Css/Paiement.css">
</head>
<body>
<?php
echo'<div class ="Menu">';
echo '<center><H1>Données Banquaire</h1></center>';

echo '<center><form action="verif.php" method="post">';
	echo'<p>Numero carte : <input type="text" name="numcarte" /></p>';
	echo'<p>Date expiration :  <input type="date" name="datexp"/></p>';
	echo'<p><input type="submit" value="Confirme" ></p>';
 echo'</form></center>';
 echo '<center><input type="button" value="Retour" OnClick="window.location.href=\'monPanier.php\'"></center>';
echo '</div>';
?>
</body>
 
