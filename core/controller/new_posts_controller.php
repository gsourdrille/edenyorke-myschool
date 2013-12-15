<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");


//Recuperation des classes lies a l'utlisateur
$listeClasse = getClassesIdByUser($utilisateur->idUser);
//Recuperation des niveaux lies aux classes
$listeNiveaux = getNiveauxIdByClasses($listeClasse);

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
