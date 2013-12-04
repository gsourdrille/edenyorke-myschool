<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/post_service.php");
//Recuperation de l'utilisateur
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");


//Recuperation des classes lies a l'utlisateur
$listeClasseId = getClassesIdByUser($utilisateur->idUser);
//Recuperation des niveaux lies aux classes
$listeNiveauxId = getNiveauxIdByUser($utilisateur->idUser);
//Recuperation de l'etablissement
$etablissementId = $utilisateur->etablissement;

//Gestion de la pagination
if(isset($_POST['offset'])){
	$offset = $_POST['offset'];
}else {
	$offset = Constants::DEFAUT_OFFSET;
}

//Recuperation des uniques posts de l'etablissement/niveaux/classes max 15 debut 0 order by date
$listePosts = getAllPost($etablissementId, $listeClasseId, $listeNiveauxId, Constants::DEFAUT_MAX_RESULT, $offset);
