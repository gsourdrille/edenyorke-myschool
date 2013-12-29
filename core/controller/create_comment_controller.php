<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");
 
$logger = new Logger(Constants::LOGGER_LOCATION);


if(isset($_POST)) {
	
	//Creation du post
	
	$contenu = $_POST['writeCommentArea'];
	$createur = $utilisateur->idUser;
	$idPost = $_POST['idPost'];
	
	$logger->log('succes', 'myschool', "CONTENU : ".$contenu , Logger::GRAN_VOID);
	$logger->log('succes', 'myschool', "CREATEUR : ".$createur , Logger::GRAN_VOID);
	$logger->log('succes', 'myschool', "POST : ".$idPost , Logger::GRAN_VOID);
	
	if($contenu != null && $createur != null && $idPost != null){
		$commentaire = new Commentaire();
		$commentaire->contenu = $contenu;
		$commentaire->idPost = $idPost;
		$commentaire->idUser = $createur;
		addCommentaireToPost($commentaire);
	}
	
}

$array['reponse'] = "ok";
echo json_encode($array);

?>