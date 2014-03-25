<?php
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/bean/TypeUtilisateur.php");
//Recuperation de l'utilisateur
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$adminService = new AdminServiceImpl();
	$postService = new PostServiceImpl();
	
	//Recuperation de l'etablissement
	$etablissementId = $_SESSION['ETABLISSEMENT_ID'];
	
	
	if($_SESSION['TYPE_UTILISATEUR']==TypeUtilisateur::DIRECTION){
		//Recuperation de toutes les classes
		$listeClasse = $adminService->getClassesByEtablissement($_SESSION['ETABLISSEMENT_ID']);
		//Recuperation de tous les niveaux
		$listeNiveaux = $adminService->getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
	}else{ 
		//Recuperation des classes lies a l'utlisateur
		$listeClasse = $postService->getClassesIdByUser($utilisateur->idUser);
		//Recuperation des niveaux lies aux classes
		$listeNiveaux = $postService->getNiveauxIdByClasses($listeClasse);
	}
	
	
	//Construction de la liste de droits
	$listeDroitsPost = new ArrayObject();
	foreach($listeNiveaux as $niveau){
		$listClassePost = new ArrayObject();
		foreach($listeClasse as $classe){
			if($classe->idNiveau == $niveau->idNiveau){
				$listClassePost->append($classe);
			}
		}
		$listeDroitsPost[$niveau->idNiveau] = $listClassePost;
	}
	
	//Gestion de la pagination
	if(isset($_GET['offset'])){
		$offset = $_GET['offset'];
	}else {
		$offset = Constants::DEFAUT_OFFSET;
	}
	
	//Recuperation des uniques posts de l'etablissement/niveaux/classes max 15 debut 0 order by date
	$resultListePosts = $postService->getAllPost($etablissementId, $listeClasse, $listeNiveaux, Constants::DEFAUT_MAX_RESULT, $offset);
	if($resultListePosts->hasMorePosts){
		$offset = $offset + Constants::DEFAUT_MAX_RESULT;
	}
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	header("location:/erreur/erreur500");
}
	

