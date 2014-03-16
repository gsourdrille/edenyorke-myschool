<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/PostServiceImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/admin_service.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/bean/TypeUtilisateur.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");



if($_SESSION['TYPE_UTILISATEUR']==TypeUtilisateur::DIRECTION){
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
