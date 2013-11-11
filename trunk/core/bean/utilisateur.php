<?php


	class Utilisateur {
		
		var $idUser;
		var $nom;
		var $prenom;
		var $login;
		var $mdp;
		var $listeTypesUtilisateurs;
	
		function __construct() {
			$this->listeTypesUtilisateurs = new ArrayObject();
		}
		
		public function addTypeUtilisateur($typeUtilisateur){
			$iterator = $this->listeTypesUtilisateurs->getIterator();
			$find = false;
			while ($iterator->valid()) {
				if($iterator->current() == $typeUtilisateur){
					$find = true;
				}
				$iterator->next();
			}
			if(!$find){
				$this->listeTypesUtilisateurs->append($typeUtilisateur);
			}
		}

		
		public function afficher(){
			
			echo "idUser : ". $this->idUser .'<br>';
			echo "nom : ". $this->nom .'<br>';
			echo "prenom : ". $this->prenom .'<br>';
			echo "login : ". $this->login .'<br>';
			echo "mdp : ". $this->mdp .'<br>';
			echo "listeTypesUtilisateurs : ". $this->listeTypesUtilisateurs->count() .'<br>';
			
		}
		
	}

?>