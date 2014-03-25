<?php
session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/core/bean/TypeUtilisateur.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{

	$adminService = new AdminServiceImpl();
	//Recuperation des enseignants lies a l'etablissement
	$listeEnseignants = $adminService->getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],TypeUtilisateur::ENSEIGNANT);
	$listeClasseAndNiveau = $adminService->getAllClassesForEtablissement($_SESSION['ETABLISSEMENT_ID']);
	if(isset($_GET['action'])){
		$action = $_GET['action'];
		if($action == 'showEnseignant'){
			$enseignant = $adminService->getUserById($_GET['idUser']);
			$_SESSION['ENSEIGNANT_SELECTED'] = $enseignant->idUser;
			$listeClasseSelected = $adminService->getClassesByUser($enseignant->idUser);
			$showEnseignant = true;
		}
	}
	
	 if(isset($_POST['showAddEnseignant'])){
	 	$showEnseignant = true;
	 	$enseignant = new Utilisateur();
	 	$_SESSION['ENSEIGNANT_SELECTED'] = null;
	 }else if(isset($_POST['deleteEnseignant'])){
		$idEnseignant = $_SESSION['ENSEIGNANT_SELECTED'];
		$adminService->deleteEtablissementToUtilisateur($_SESSION['ETABLISSEMENT_ID'],$idEnseignant); 
		$showEnseignant = false;
		$listeEnseignants = $adminService->getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],TypeUtilisateur::ENSEIGNANT);
		$_SESSION['ENSEIGNANT_SELECTED'] = null;
	}else if(isset($_POST['saveEnseignant'])){
		$idEnseignant = $_POST['idEnseignant'];
		if($idEnseignant == null || trim($idEnseignant) == false){
			//Nouveau niveau
			$enseignant = new Utilisateur();
			$isnew = true;
		}else{
			$enseignant = $adminService->getUserById($idEnseignant);
			$isnew = false;
		}
		
		$error = false;
		$nom = $_POST['nom'];
		if($nom == null || trim($nom) == false){
			$error_nom="Le nom ne peut être vide";
			$error = true;
		}else{
			$enseignant->nom = $nom;   
		}
		$prenom = $_POST['prenom'];
		if($prenom == null || trim($prenom) == false){
			$error_prenom="Le prénom ne peut être vide";
			$error = true;
		}else{
			$enseignant->prenom = $prenom;
		}
		$login = $_POST['login'];
		if($login == null || trim($login) == false){
			$error_login="Le login ne peut être vide";
			$error = true;
		}else{
			if($adminService->validateLogin($login, $enseignant->idUser)){
				$enseignant->login = $login;
			}else{
				$error_login="Ce login est déjà utilisé, veuillez en choisir un autre";
				$error = true;
			}
		}
		
		$mdp = $_POST['mdp'];
		if($mdp != null && trim($mdp) == true){
			$mdpBis = $_POST['mdpBis'];
			if($mdpBis != null && trim($mdpBis) == true){
				if($mdp != $mdpBis){
					$error_password="Les mots de passe ne correspondent pas";
					$error = true;
				}else{
					$enseignant->mdp = sha1($mdp);
				}
			}
		}else{
			if($isnew){
				$error_password="Le mot de passe ne peut être vide";
				$error = true;
			}
		}
		$showEnseignant = true;
		if($error==false){
			$enseignant->active = 1;
			if($adminService->saveOrUpdateUtilisateur($enseignant,TypeUtilisateur::ENSEIGNANT, $_SESSION['ETABLISSEMENT_ID'])){
				if(isset($_POST['selectClasseto'])){
					$listeClasse = $_POST['selectClasseto'];
				}else{
					$listeClasse = null;
				}
				$adminService->addClassesToUser($enseignant->idUser, $listeClasse);
				$succes = "Vos informations ont été mises à jour";
				$_SESSION['ENSEIGNANT_SELECTED'] = $enseignant->idUser;
			}else{
				$succes = "Une erreur est survenue lors de la mise à jour";
			}
			$listeEnseignants = $adminService->getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],TypeUtilisateur::ENSEIGNANT);
			$listeClasseSelected = $adminService->getClassesByUser($_SESSION['ENSEIGNANT_SELECTED']);
		}
		
	}
	
	require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_enseignants/index.php");
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	header("location:/erreur/erreur500");
}