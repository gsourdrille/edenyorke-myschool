<?php


class Etablissement {
	
	var $idEtablissement;
	var $nom;
	var $adresse;
	var $codePostal;
	var $ville;
	var $telephone1;
	var $telephone2;
	var $fax;
	var $imagePrincipale;
	var $imageFond;

	
	public function afficher(){
			
		echo "idEtablissement : ". $this->idEtablissement .'<br>';
		echo "nom : ". $this->nom .'<br>';
		echo "adresse : ". $this->adresse .'<br>';
		echo "codePostal : ". $this->codePostal .'<br>';
		echo "ville : ". $this->ville .'<br>';
		echo "telephone1 : ". $this->telephone1 .'<br>';
		echo "telephone2 : ". $this->telephone2 .'<br>';
		echo "fax : ". $this->fax .'<br>';
		echo "imagePrincipale : ". $this->imagePrincipale .'<br>';
			
	}
	
	public function fullName(){
		return $this->nom." - ".$this->codePostal." ".$this->ville;
	}
	
	
}
?>