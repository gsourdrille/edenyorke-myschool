<?php

class Niveau{
	
	var $idNiveau;
	var $nom;
	var $idEtablissement;
	
	public function afficher(){
			
		echo "idNiveau : ". $this->idNiveau .'<br>';
		echo "nom : ". $this->nom .'<br>';
		echo "idEtablissement : ". $this->idEtablissement .'<br>';
			
	}
	
}

?>