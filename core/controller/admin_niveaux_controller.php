<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$adminService = new AdminServiceImpl();
	
	
	//Recuperation des niveaux lies a l'etablissement
	$listeNiveaux = $adminService->getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == 'showNiveau'){
			$niveau = $adminService->getNiveauById($_GET['idNiveau']);
			$listeClasses = $adminService->getClassesByNiveau($_GET['idNiveau']);
			$_SESSION['NIVEAU_SELECTED'] = $niveau->idNiveau;
			$showNiveau = true;
			$showListeClasses = true;
		}else if($action == 'showClasse'){
			$classe = $adminService->getCLasseById($_GET['idClasse']);
			$niveau = $adminService->getNiveauById($_SESSION['NIVEAU_SELECTED']);
			$listeClasses = $adminService->getClassesByNiveau($_SESSION['NIVEAU_SELECTED']);
			$_SESSION['CLASSE_SELECTED'] = $classe->idClasse;
			$showNiveau = true;
			$showListeClasses = true;
			$showClasse = true;
		}
	}
	if(isset($_POST['saveNiveau'])){
		$idNiveau = $_POST['idNiveau'];
		$nomNiveau = $_POST['nomNiveau'];
		if($idNiveau == null || trim($idNiveau) == false){
			//Nouveau niveau
			$niveau = new Niveau();
			$niveau->idEtablissement = $_SESSION['ETABLISSEMENT_ID'];
			$isnew = true;
		}else{
			$niveau = $adminService->getNiveauById($idNiveau);
			$isnew = false;
		}
		
		$error = false;
		if($nomNiveau == null || trim($nomNiveau) == false){
			$error_nom_niveau="Le nom ne peut être vide";
			$error = true;
		}else{
			//Verification que le nomn n'existe pas deja
			if($adminService->validateNiveau($nomNiveau, $niveau->idNiveau, $_SESSION['ETABLISSEMENT_ID'])){
				$niveau->nom = $nomNiveau;
			}else{
				$error_nom_niveau="Ce nom de niveau est déjà utilisé, veuillez en choisir un autre";
				$error = true;
			}
		}
		$showNiveau = true;
		$showListeClasses = true;
		if($error==false){
			if($adminService->saveOrUpdateNiveau($niveau)){
				$succesNiveau = "Vos informations ont été mises à jour";
				$listeNiveaux = $adminService->getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
				$_SESSION['NIVEAU_SELECTED'] = $niveau->idNiveau;
			}else{
				$succesNiveau = "Une erreur est survnue lors de la mise à jour";
			}
				
		}
	}else if(isset($_POST['deleteNiveau'])){
		$idNiveau = $_POST['idNiveau']; 
		$adminService->deleteNiveau($idNiveau);
		$showNiveau = false;
		$showListeClasses = false;
		$listeNiveaux = $adminService->getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
	}else if(isset($_POST['showAddNiveau'])){
		$showNiveau = true;
		$showListeClasses = false;
		$nomNiveau="";
	}else if(isset($_POST['showAddClasse'])){
		$niveau = $adminService->getNiveauById($_SESSION['NIVEAU_SELECTED']);
		$listeClasses = $adminService->getClassesByNiveau($_SESSION['NIVEAU_SELECTED']);
		$showClasse = true;
		$showNiveau = true;
		$showListeClasses = true;
		$nomClasse="";
	}else if(isset($_POST['saveClasse'])){
		$niveau = $adminService->getNiveauById($_SESSION['NIVEAU_SELECTED']);
		$idClasse = $_POST['idClasse'];
		$nomClasse = $_POST['nomClasse'];
		if($idClasse == null || trim($idClasse) == false){
			//Nouvelle classe
			$classe = new Classe();
			$classe->idNiveau = $_SESSION['NIVEAU_SELECTED'];
			$isnew = true;
		}else{
			$classe = $adminService->getClasseById($idClasse);
			$isnew = false;
		}
		
		$error = false;
		if($nomClasse == null || trim($nomClasse) == false){
			$error_nom_classe="Le nom ne peut être vide";
			$error = true;
		}else{
			//Verification que le nomn n'existe pas deja
			if($adminService->validateClasse($nomClasse, $classe->idClasse, $_SESSION['NIVEAU_SELECTED'])){
				$classe->nom = $nomClasse;
			}else{
				$error_nom_classe="Ce nom de classe est déjà utilisée, veuillez en choisir un autre";
				$error = true;
			}
		}
		$showClasse = true;
		if($error==false){
			if($adminService->saveOrUpdateClasse($classe)){
				$succesClasse = "Vos informations ont été mises à jour";
				$_SESSION['CLASSE_SELECTED'] = $classe->idClasse;
			}else{
				$succesClasse = "Une erreur est survenue lors de la mise à jour";
			}
				
		}
		$listeClasses = $adminService->getClassesByNiveau($_SESSION['NIVEAU_SELECTED']);
		$showClasse = true;
		$showNiveau = true;
		$showListeClasses = true;
	
	}else if(isset($_POST['deleteClasse'])){
		$idClasse = $_POST['idClasse'];
		$niveau = $adminService->getNiveauById($_SESSION['NIVEAU_SELECTED']);
		$listeNiveaux = $adminService->getNiveauxByEtablissement($_SESSION['ETABLISSEMENT_ID']);
		$adminService->deleteClasse($idClasse);
		$showNiveau = true;
		$showListeClasses = true;
		$showClasse = false;
		$listeClasses = $adminService->getClassesByNiveau($_SESSION['NIVEAU_SELECTED']);
	}
	require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_niveaux/index.php");
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	header("location:/erreur/erreur500");
}