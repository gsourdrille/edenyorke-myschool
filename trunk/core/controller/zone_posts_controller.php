<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/core/service/admin_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");

//Recuperation de l'etablissement
$etablissementId = $_SESSION['ETABLISSEMENT_ID'];


if($_SESSION['TYPE_UTILISATEUR']==Type_Utilisateur::DIRECTION){
	//Recuperation de toutes les classes
	$listeClasse = getClassesByEtablissement($_SESSION['ETABLISSEMENT_ID']);
	//Recuperation de tous les niveaux
	$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
}else{ 
	//Recuperation des classes lies a l'utlisateur
	$listeClasse = getClassesIdByUser($utilisateur->idUser);
	//Recuperation des niveaux lies aux classes
	$listeNiveaux = getNiveauxIdByClasses($listeClasse);
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
$resultListePosts = getAllPost($etablissementId, $listeClasse, $listeNiveaux, Constants::DEFAUT_MAX_RESULT, $offset);
if($resultListePosts->hasMorePosts){
	$offset = $offset + Constants::DEFAUT_MAX_RESULT;
}


