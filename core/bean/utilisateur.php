<?php


	class Utilisateur {
		
		var $idUser;
		var $nom;
		var $prenom;
		var $login;
		var $mdp;
		var $typesUtilisateurs= array();
	

		
		public function afficher(){
			
			echo "idUser : ". $this->idUser .'<br>';
			echo "nom : ". $this->nom .'<br>';
			echo "prenom : ". $this->prenom .'<br>';
			echo "login : ". $this->login .'<br>';
			echo "mdp : ". $this->mdp .'<br>';
			echo "types_utilisateurs : ". $this->typesUtilisateurs[0] .'<br>';
			
		}
		
	}

?>