<?php
class Post{
	
	
	var $idPost;
	var $createur;
	var $dateCreation;
	var $dateModification;
	var $contenu;
	var $piecesJointes;
	
	public function afficher(){
			
		echo "idPost : ". $this->idPost .'<br>';
		echo "createur : ". $this->createur .'<br>';
		echo "dateCreation : ". $this->dateCreation .'<br>';
		echo "dateModification : ". $this->dateModification .'<br>';
		echo "contenu : ". $this->contenu .'<br>';
	}
	
}