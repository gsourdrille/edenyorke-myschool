<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

try{
	$postService = new PostServiceImpl();
	
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
						$postService->addCommentaireToPost($commentaire);
					}
					break;
				case 'EDIT':
					$idCommentaire = $_POST['idCommentaire'];
					$commentaire = $postService->getCommentaire($idCommentaire);
					$commentaire->contenu =  $_POST['writeCommentArea'];;
					$postService->saveCommentaire($commentaire);
					break;
				case 'DELETE':
					$idCommentaire = $_POST['idCommentaire'];
					$postService->deleteCommentaire($idCommentaire);
				break;
			}
		}
		
	}
	
	$array['reponse'] = "ok";
	echo json_encode($array);
}catch (Exception $e){
	$logger->error($e->getTraceAsString() ,$e);
	header("location:/erreur/erreur500");
}
?>