<?php


	class Utilisateur {
		
		var $idUser;
		var $nom;
		var $prenom;
		var $login;
		var $mdp;
		var $avatar;
		var $type;
		var $active;

		public function __toString() {
			return $this->idUser;
		}
		
		public function afficher(){
			
			echo "idUser : ". $this->idUser .'<br>';
			echo "nom : ". $this->nom .'<br>';
			echo "prenom : ". $this->prenom .'<br>';
			echo "login : ". $this->login .'<br>';
			echo "mdp : ". $this->mdp .'<br>';
			echo "avatar : ". $this->avatar .'<br>';
		
		}
		
		public function fullName(){
			return $this->prenom." ".$this->nom;
		}
		
	}

?>