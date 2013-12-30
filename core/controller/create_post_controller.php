<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");
 
$logger = new Logger(Constants::LOGGER_LOCATION);


if(isset($_POST)) {
	
	//Creation du post
	
	$post = new Post();
	$post->contenu = $_POST['newPostArea'];
	$post->createur = $utilisateur->idUser;
	$post->commentairesActives = true;
	
	$logger->log('succes', 'myschool', "CONTENU : ".$post->contenu , Logger::GRAN_VOID);
	$logger->log('succes', 'myschool', "CREATEUR : ".$post->createur , Logger::GRAN_VOID);
	
	//Creation des associations
	if(isset($_POST['listPostDestinaires'])){
		$listeAssociations = $_POST['listPostDestinaires'];
		$listeAssociationDTO = new ArrayObject();
		foreach ($listeAssociations as $association){
			$logger->log('succes', 'myschool', "ASSOCIATION : ".$association , Logger::GRAN_VOID);
			if($association != ""){
				$associationDTO = new AssociationDTO();
				if($association== "ALL"){
					$associationDTO->typePost= TypePost::ETABLISSEMENT;
					$associationDTO->id = $_SESSION['ETABLISSEMENT_ID'];
				}else{
					list($type, $id) = explode('_', $association);
					$logger->log('succes', 'myschool', "TYPE : ".$type , Logger::GRAN_VOID);
					$logger->log('succes', 'myschool', "ID : ".$id , Logger::GRAN_VOID);
					if($type=="NIVEAU"){
						$associationDTO->typePost= TypePost::NIVEAU;
					}else if($type=="CLASSE"){
						$associationDTO->typePost= TypePost::CLASSE;
						$logger->log('succes', 'myschool', "TYPE_POST : CLASSE " , Logger::GRAN_VOID);
					}
					$associationDTO->id = $id;
				}
				$listeAssociationDTO->append($associationDTO);
			}
		}
		$post->associations = $listeAssociationDTO;
		$post= savePost($post);
		$logger->log('succes', 'myschool', "ID_POST : ".$post->idPost , Logger::GRAN_VOID);
		
		if($post->idPost != null){
			//Creation des pieces jointes
			$listePiecesJointes = new ArrayObject();
			foreach ($_FILES['postfile']['name'] as $file => $name) {
				$logger->log('succes', 'myschool', "FILE_NAME : ".$name , Logger::GRAN_VOID);
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
						$path = FileUtils::createPostDir($post->idPost);
						move_uploaded_file($_FILES['postfile']['tmp_name'][$file], $path."/".$name);
						$pieceJointe = new PieceJointe();
						$pieceJointe->idPost = $post->idPost;
						$pieceJointe->contentType = $_FILES['postfile']['type'][$file];
						$pieceJointe->path = $name;
						$listePiecesJointes->append($pieceJointe);
					}
				}
			}
			if($listePiecesJointes->count()>0){
				setListePieceJointeToPost($post->idPost,$listePiecesJointes);
			}
		}
	}
	
	
}

$array['reponse'] = "ok";
echo json_encode($array);

?>