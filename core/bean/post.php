<?php
class Post{
	
	
	var $idPost;
	var $createur;
	var $dateCreation;
	var $dateModification;
	var $contenu;
	var $commentairesActives;
	var $piecesJointes;
	var $commentaires;
	var $associations;
	var $fullCreateur;
	var $isCreateur;
	
	public function afficher(){
			
		echo "idPost : ". $this->idPost .'<br>';
		echo "createur : ". $this->createur .'<br>';
		echo "dateCreation : ". $this->dateCreation .'<br>';
		echo "dateModification : ". $this->dateModification .'<br>';
		echo "contenu : ". $this->contenu .'<br>';
		echo "commentairesActives : ". $this->commentairesActives .'<br>';
	}
	
}