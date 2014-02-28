<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
 
if(isset($_POST)) {
	if(isset($_POST['action'])){
		switch ($_POST['action']){
			case 'CREATE':
				//Creation du post
				$post = new Post();
				$post->contenu = $_POST['newPostArea'];
				$post->createur = $utilisateur->idUser;
				if(isset($_POST['allowComment'])){
					$post->commentairesActives = true;
				}else{
					$post->commentairesActives = false;
				}
				
				if(isset($_POST['onlyEnseignant'])){
					$post->seulementEnseignant = true;
					}else{
						$post->seulementEnseignant = false;
				}
				
				
				//Creation des associations
				if(isset($_POST['listPostDestinaires'])){
					$listeAssociations = $_POST['listPostDestinaires'];
					$listeAssociationDTO = new ArrayObject();
					foreach ($listeAssociations as $association){
						if($association != ""){
							$associationDTO = new AssociationDTO();
							if($association== "ALL"){
								$associationDTO->typePost= TypePost::ETABLISSEMENT;
								$associationDTO->id = $_SESSION['ETABLISSEMENT_ID'];
							}else{
								list($type, $id) = explode('_', $association);
								if($type=="NIVEAU"){
									$associationDTO->typePost= TypePost::NIVEAU;
								}else if($type=="CLASSE"){
									$associationDTO->typePost= TypePost::CLASSE;
								}
								$associationDTO->id = $id;
							}
							$listeAssociationDTO->append($associationDTO);
						}
					}
					$post->associations = $listeAssociationDTO;
					$post= savePost($post);
						
					if($post->idPost != null){
						//Creation des pieces jointes
						$listePiecesJointes = new ArrayObject();
						
						if(isset($_POST['postFile'])){
							foreach ($_POST['postFile'] as $file){
								$pieceJointe = processPieceJointe($post, $file);
								$listePiecesJointes->append($pieceJointe);
							}
						}
						if($listePiecesJointes->count()>0){
							setListePieceJointeToPost($post->idPost,$listePiecesJointes);
						}
						
						//envoi de la notification par email
						envoiMailNotification($post, $utilisateur);
					}
				}
			break;
			case 'EDIT':
				//Edition du post
				$idPost = $_POST['idPost'];
				$post = getPost($idPost);
				$post->contenu = $_POST['editPostArea'];
				if(isset($_POST['allowComment'])){
					$post->commentairesActives = true;
				}else{
					$post->commentairesActives = false;
				}
				
				if(isset($_POST['onlyEnseignant'])){
					$post->seulementEnseignant = true;
				}else{
					$post->seulementEnseignant = false;
				}
				
				//Creation des associations
				if(isset($_POST['listPostDestinaires'])){
					$listeAssociations = $_POST['listPostDestinaires'];
					$listeAssociationDTO = new ArrayObject();
					foreach ($listeAssociations as $association){
						if($association != ""){
							$associationDTO = new AssociationDTO();
							if($association== "ALL"){
								$associationDTO->typePost= TypePost::ETABLISSEMENT;
								$associationDTO->id = $_SESSION['ETABLISSEMENT_ID'];
							}else{
								list($type, $id) = explode('_', $association);
								if($type=="NIVEAU"){
									$associationDTO->typePost= TypePost::NIVEAU;
								}else if($type=="CLASSE"){
									$associationDTO->typePost= TypePost::CLASSE;
								}
								$associationDTO->id = $id;
							}
							$listeAssociationDTO->append($associationDTO);
						}
					}
					$post->associations = $listeAssociationDTO;
					$post= editPost($post);
						
					if($post->idPost != null){
						
						//Creation des pieces jointes
						$listePiecesJointes = new ArrayObject();
						
						if(isset($_POST['postFile'])){
							foreach ($_POST['postFile'] as $file){
								$pieceJointe = processPieceJointe($post, $file);
								$listePiecesJointes->append($pieceJointe);
							}
						}
						if($listePiecesJointes->count()>0){
							setListePieceJointeToPost($post->idPost,$listePiecesJointes);
						}
						
						//suppression des pieces jointes supprimees manuellement
						if(isset($_POST['postDeleteFile'])){
							$listePiecesJointeToDelete = $_POST['postDeleteFile'];
							updateListePieceJointe($post->idPost,$listePiecesJointeToDelete);
						}
					}
				}
				
			break;
			case 'DELETE':
				$idPost = $_POST['idPost'];
				deletePost($idPost);
			break;
		}
		
	}
}

//TODO gestion des erreurs
$array['reponse'] = "ok";
echo json_encode($array);
?>