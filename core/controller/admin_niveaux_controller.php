<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

require('../logs/Logger.class.php');

// Creation d'un objet Logger
$logger = new Logger(Constants::LOGGER_LOCATION);

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");


//Recuperation des niveaux lies a l'etablissement
$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'show'){
		$logger->log('succes', 'myschool', "admin_controller.php : action show ", Logger::GRAN_VOID);
		$niveau = getNiveauById($_GET['idNiveau']);
		$_SESSION['NIVEAU_SELECTED'] = $niveau->idNiveau;
		$showNiveau = true;
		$listeClasses = getClassesByNiveau($_GET['idNiveau']);
	}
}
if(isset($_POST['saveNiveau'])){
	$logger->log('succes', 'myschool', "admin_controller.php : action save" , Logger::GRAN_VOID);
	$idNiveau = $_POST['idNiveau'];
	$nomNiveau = $_POST['nomNiveau'];
	if($idNiveau == null || trim($idNiveau) == false){
		//Nouveau niveau
		$niveau = new Niveau();
		$niveau->idEtablissement = $_SESSION['ETABLISSEMENT_ID'];
		$isnew = true;
	}else{
		$niveau = getNiveauById($idNiveau);
		$isnew = false;
	}
	
	$error = false;
	if($nomNiveau == null || trim($nomNiveau) == false){
		$error_nom_niveau="Le nom ne peut être vide";
		$error = true;
	}else{
		//Verification que le nomn n'existe pas deja
		if(validateNiveau($nomNiveau, $niveau->idNiveau, $_SESSION['ETABLISSEMENT_ID'])){
			$niveau->nom = $nomNiveau;
		}else{
			$error_nom_niveau="Ce nom de niveau est déjà utilisé, veuillez en choisir un autre";
			$error = true;
		}
	}
	$showNiveau = true;
	if($error==false){
		if(saveOrUpdateNiveau($niveau)){
			$succesNiveau = "Vos informations ont été mises à jour";
			$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
		}else{
			$succesNiveau = "Une erreur est survnue lors de la mise à jour";
		}
			
	}
}else if(isset($_POST['deleteNiveau'])){
	$idNiveau = $_POST['idNiveau'];
	$niveau = getNiveauById($idNiveau);
	deleteNiveau($niveau);
	$showNiveau = false;
	$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
}else if(isset($_POST['showAddNiveau'])){
	$showNiveau = true;
	$nomNiveau="";
}else if(isset($_POST['showAddClasse'])){
	$niveau = getNiveauById($_SESSION['NIVEAU_SELECTED']);
	$showClasse = true;
	$showNiveau = true;
	$nomClasse="";
}else if(isset($_POST['saveClasse'])){
	
	$niveau = getNiveauById($_SESSION['NIVEAU_SELECTED']);
	$idClasse = $_POST['idClasse'];
	$nomClasse = $_POST['nomClasse'];
	if($idClasse == null || trim($idClasse) == false){
		//Nouvelle classe
		$classe = new Classe();
		$classe->idNiveau = $_SESSION['NIVEAU_SELECTED'];
		$isnew = true;
	}else{
		$classe = getClasseById($idNiveau);
		$isnew = false;
	}
	
	$error = false;
	if($nomClasse == null || trim($nomClasse) == false){
		$error_nom_classe="Le nom ne peut être vide";
		$error = true;
	}else{
		//Verification que le nomn n'existe pas deja
		if(validateClasse($nomClasse, $classe->idClasse, $_SESSION['NIVEAU_SELECTED'])){
			$classe->nom = $nomClasse;
		}else{
			$error_nom_classe="Ce nom de classe est déjà utilisée, veuillez en choisir un autre";
			$error = true;
		}
	}
	$showClasse = true;
	if($error==false){
		if(saveOrUpdateClasse($classe)){
			$succesClasse = "Vos informations ont été mises à jour";
		}else{
			$succesClasse = "Une erreur est survenue lors de la mise à jour";
		}
			
	}
	$listeClasses = getClassesByNiveau($_SESSION['NIVEAU_SELECTED']);
	$showClasse = true;
	$showNiveau = true;

}
require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_niveaux/index.php");