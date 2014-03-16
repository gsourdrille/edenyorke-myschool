<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");

if(isset($_POST)) {
	if(isset($_POST['action'])){
		switch ($_POST['action']){
			case 'CREATE':
				$contenu = $_POST['writeCommentArea'];
				$createur = $utilisateur->idUser;
				$idPost = $_POST['idPost'];
				
				if($contenu != null && $createur != null && $idPost != null){
					$commentaire = new Commentaire();
					$commentaire->contenu = $contenu;
					$commentaire->idPost = $idPost;
					$commentaire->idUser = $createur;
					addCommentaireToPost($commentaire);
				}
				break;
			case 'EDIT':
				$idCommentaire = $_POST['idCommentaire'];
				$commentaire = getCommentaire($idCommentaire);
				$commentaire->contenu =  $_POST['writeCommentArea'];;
				saveCommentaire($commentaire);
				break;
			case 'DELETE':
				$idCommentaire = $_POST['idCommentaire'];
				deleteCommentaire($idCommentaire);
			break;
		}
	}
	
}

$array['reponse'] = "ok";
echo json_encode($array);

?>