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
						foreach ($_FILES['postfile']['name'] as $file => $name) {
							if ($_FILES['postfile']['error'][$file]) {
								switch ($_FILES['postfile']['error'][$file]){
									case 1: // UPLOAD_ERR_INI_SIZE
										$error_image = "Le fichier dépasse la limite autorisée par le serveur !";
										break;
									case 2: // UPLOAD_ERR_FORM_SIZE
										$error_image =  "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
										break;
									case 3: // UPLOAD_ERR_PARTIAL
										$error_image =  "L'envoi du fichier a été interrompu pendant le transfert !";
										break;
									case 4: // UPLOAD_ERR_NO_FILE
										$error_image =  "Le fichier que vous avez envoyé a une taille nulle !";
										break;
								}
							}
							else {
								if ((isset($_FILES['postfile']['tmp_name'][$file])&&($_FILES['postfile']['error'][$file] == UPLOAD_ERR_OK))) {
									$pieceJointe = processPieceJointe($_FILES['postfile'],$file,$post, $name);
									$listePiecesJointes->append($pieceJointe);
								}
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
						foreach ($_FILES['postfile']['name'] as $file => $name) {
							if ($_FILES['postfile']['error'][$file]) {
								switch ($_FILES['postfile']['error'][$file]){
									case 1: // UPLOAD_ERR_INI_SIZE
										$error_image = "Le fichier dépasse la limite autorisée par le serveur !";
										break;
									case 2: // UPLOAD_ERR_FORM_SIZE
										$error_image =  "Le fichier dépasse la limite autorisée dans le formulaire HTML !";
										break;
									case 3: // UPLOAD_ERR_PARTIAL
										$error_image =  "L'envoi du fichier a été interrompu pendant le transfert !";
										break;
									case 4: // UPLOAD_ERR_NO_FILE
										$error_image =  "Le fichier que vous avez envoyé a une taille nulle !";
										break;
								}
							}
							else {
								if ((isset($_FILES['postfile']['tmp_name'][$file])&&($_FILES['postfile']['error'][$file] == UPLOAD_ERR_OK))) {
									$pieceJointe = processPieceJointe($_FILES['postfile'],$file,$post, $name);
									$listePiecesJointes->append($pieceJointe);
								}
							}
						}
						//suppression des pieces jointes supprimees manuellement
						if(isset($_POST['pjToDelete'])){
							$listePiecesJointeToDelete = explode(',',$_POST['pjToDelete']);
							updateListePieceJointe($post->idPost,$listePiecesJointeToDelete);
						}
						
						if($listePiecesJointes->count()>0){
							setListePieceJointeToPost($post->idPost,$listePiecesJointes);
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