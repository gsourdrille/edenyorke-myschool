<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/core/service/post_service.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/core/service/admin_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");



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
