<?php

class Classe{
	
	var $idClasse;
	var $nom;
	var $idNiveau;
	var $codeEleve;
	var $codeEnseignant;
	
	public function afficher(){
			
		echo "idClasse : ". $this->idClasse .'<br>';
		echo "nom : ". $this->nom .'<br>';
		echo "idClasse : ". $this->idClasse .'<br>';
			
	}
	
}

?>