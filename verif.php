<link rel="stylesheet" href="Css/Verif.css">
<body style="background-color:rgb(193,193,178);">
  <div class="Menu">
    <?php
    
      //ajout de la classe Panier
      include 'classePanier.php';

      //démarrage session
      session_start();
    
      //Récupération de valeur saisies dans le formulaires
      $dateexpi = $_POST['datexp'];
      $numcarte = $_POST['numcarte'];

      //Vérification si les valeurs sont vide ou non

      if($dateexpi != "" && $numcarte != ""){ // si les saisies ne sont pas vides

        //Appelle des fonctions de vérif
        $ValidationDate = verifDate($dateexpi) ;
        $ValidationNum = verifCarte($numcarte) ;

        //Affichage des résultats suite a l'appelle
        if($ValidationDate && $ValidationNum )
        {
          echo '<center><h1>Paiement accepté</h1></center>';
          $_SESSION['panier']->razPanier();
        }
        else if(!$ValidationDate && $ValidationNum)
        {
          echo '<center><h1>Paiement refusé</h1>';
          echo 'La date est mauvaise</center>';
        }
        else if (!$ValidationDate && !$ValidationNum)
        {
          echo '<center><h1>Paiement refusé</h1>';
          echo 'La date et le numero de carte sont mauvais</center>';
        }
        else
        {
          echo '<center><h1>Paiement refusé</h1>';
          echo 'Le numero de carte est mauvais</center>';
        }

        //Bouton de retour soit a l'accueil soit a la page précédente
        echo '<center><div class="Nav"><form action="monPanier.php">';
        echo'<p><input type="submit" value="Retour" ></p>';
        echo'</form>';
        echo'<form action="accueil.php">';
        echo'<p><input type="submit" value="Accueil" ></p>';
        echo'</form></div></center>';
      }
      else
      {
        //on revient a la page précédetnes en réinitialisant le formulaire
        echo '<meta http-equiv="refresh" content="0;URL=paiement.php">';
      }




    //-----------------Déclaration des fonctions----------------------------

    //Fonction de vérification de la date d'expiration saisi
    function verifDate ($dateexp){



      //Récupération de la date du jour

      $DateDuJour = date("d-m-Y");

      //Ajout des 3 mois pour l'expiration

      $DateExpiration = date("d-m-Y" ,strtotime("+3 months",strtotime($DateDuJour)));

      //Mise a jour de l'année si nécessaire

      if (strtotime($dateexp)>=strtotime($DateExpiration))
      {
        return True;
      }
      else
      {
        return False ;
      }
    }


    //Fonction de vérification des numéros de la carte saisi
    function verifCarte ($numcarte)
    {
      $nombreTotal = strlen($numcarte);
      if($nombreTotal == 16 )
      {
        if($numcarte[0] != $numcarte[$nombreTotal-1])
        {
          return False;
        }
        else
        {
          return True;
        }
      }
      else
      {
        Return False;
      }


    }


    ?>
  </div>
</body>
