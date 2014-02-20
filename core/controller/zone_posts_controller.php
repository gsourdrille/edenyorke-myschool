<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");


//Recuperation des classes lies a l'utlisateur
$listeClasse = getClassesIdByUser($utilisateur->idUser);
//Recuperation des niveaux lies aux classes
$listeNiveaux = getNiveauxIdByClasses($listeClasse);
//Recuperation de l'etablissement
$etablissementId = $_SESSION['ETABLISSEMENT_ID'];

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
