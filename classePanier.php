<?php

class Panier {

	public $tabCDs = array();
	public $prixTotal;

	//Méthodes

	//Pour afficher 1 CD
	public function afficherCD($titre) {

		//récupération du nom de la vignette
		$vignette = $this->tabCDs[$titre]['image'];

		//affichage
		echo '<img src="Vignettes/thumb_'.substr($vignette, 10).'">';
		echo '  ';
		echo  $titre.' x '.$this->tabCDs[$titre]['quantite'];
		echo '<form><input type="button" value="Retirer" OnClick="window.location.href=\'retraitCDPanier.php?cd='.$titre.'\'"></form><br>';
	}


	//Pour afficher le panier entier
	public function afficher() {

		echo 'Le panier contient les CDs suivants<br/>';

		foreach ($this->tabCDs as $cd => $infosCD) {
			$this->afficherCD($cd);
		}

		echo 'Prix total : '.$this->prixTotal.'€<br/><br/>';

	}


	//Poursavoir si un CD est déjà dans le panier
	public function cdExiste($titreCherche) {

		$trouve = false;

		foreach ($this->tabCDs as $cd => $infosCD) {

			if($infosCD['titre'] == $titreCherche) {

				$trouve = true;
				break;
			}
		}

		return $trouve;
	}



	//Pour ajouter un CD au panier
	public function ajouterCD($titreAAjouter) {

		//Chargement du fichier XML
		$fichier = new DOMDocument;
		$fichier->load('CD.xml');
		$cds = $fichier->getElementsByTagName('cd');

		//parcours des CDs
		foreach ($cds as $cd) {
			$titre = $cd->getElementsByTagName('titre')[0]->nodeValue;
			if($titre == $titreAAjouter) {
				if($this->cdExiste($titreAAjouter)) {
					//Si le CD est déjà dans le panier
					foreach ($this->tabCDs as $cd => $infosCD) {
						if($infosCD['titre'] == $titreAAjouter) {
							//Incrémentation de la quantité
							$this->tabCDs[$titreAAjouter]['quantite']++;
						}
					}
				}
				else {
					//Si le CD n'est pas encore dans le panier
					//création d'un tableau contenant les infos du CD
					$cdAAjouter = array(
						"auteur-groupe" => $cd->getElementsByTagName('auteur-groupe')[0]->nodeValue,
						"titre" => $cd->getElementsByTagName('titre')[0]->nodeValue,
						"prix" => $cd->getElementsByTagName('prix')[0]->nodeValue,
						"image" => $cd->getElementsByTagName('image')[0]->nodeValue,
						"genre" => $cd->getElementsByTagName('genre')[0]->nodeValue,
						"quantite" => 1,
					);
					//ajout du CD au tableau de CDs
					$this->tabCDs[$titreAAjouter] = $cdAAjouter;
				}

				//Mise à jour du prix total
				$this->prixTotal = $this->prixTotal + floatval($this->tabCDs[$titreAAjouter]['prix']);
			}
		}
	}




	//Pour retirer un CD du panier
	public function retirerCD($titreARetirer) {

		//parcours des cds du panier
		foreach ($this->tabCDs as $cd => $infosCD) {

			if ($infosCD['titre'] == $titreARetirer) {

				//Mise à jour du prix
				$this->prixTotal = $this->prixTotal - floatval($infosCD['prix']);
				if($this->prixTotal < floatval(0.01)) {
					$this->prixTotal = floatval(0);
				}

				//Retrait du CD
				$this->tabCDs[$titreARetirer]['quantite']--;
				if($this->tabCDs[$titreARetirer]['quantite'] == 0) {
					unset($this->tabCDs[$titreARetirer]);
				}
			}
		}
	}


	//Pour vider le panier
	public function razPanier() {
		$this->tabCDs = array();
		$this->prixTotal = 0;
	}
}


?>
