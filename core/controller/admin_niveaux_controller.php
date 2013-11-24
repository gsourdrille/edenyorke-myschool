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
		$showNiveau = true;
	}
}
if(isset($_POST['save'])){
	$logger->log('succes', 'myschool', "admin_controller.php : action save" , Logger::GRAN_VOID);
	$idNiveau = $_POST['idNiveau'];
	$nom = $_POST['nom'];
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
	$nom = $_POST['nom'];
	if($nom == null || trim($nom) == false){
		$error_nom="Le nom ne peut être vide";
		$error = true;
	}else{
		//Verification que le nomn n'existe pas deja
		if(validateNiveau($nom, $niveau->idNiveau, $_SESSION['ETABLISSEMENT_ID'])){
			$niveau->nom = $nom;
		}else{
			$error_nom="Ce nom de niveau est déjà utilisé, veuillez en choisir un autre";
			$error = true;
		}
	}
	$showNiveau = true;
	if($error==false){
		if(saveOrUpdateNiveau($niveau)){
			$succes = "Vos informations ont été mises à jour";
			$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
		}else{
			$succes = "Une erreur est survnue lors de la mise à jour";
		}
			
	}
}else if(isset($_POST['delete'])){
	$idNiveau = $_POST['idNiveau'];
	$niveau = getNiveauById($idNiveau);
	deleteNiveau($niveau);
	$showNiveau = false;
	$listeNiveaux = getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
}else if(isset($_POST['showAdd'])){
	$showNiveau = true;
	$nom="";
}


require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_niveaux/index.php");