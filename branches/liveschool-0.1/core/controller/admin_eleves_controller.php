<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/core/service/admin_service.php");
include($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");


//Recuperation des enseignants lies a l'etablissement
$listeEleves = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ELEVE);
$listeClasseAndNiveau = getAllClassesForEtablissement($_SESSION['ETABLISSEMENT_ID']);
if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'showEleve'){
		$eleve = getUserById($_GET['idUser']);
		$_SESSION['ELEVE_SELECTED'] = $eleve->idUser;
		$listeClasseSelected = getClassesByUser($eleve->idUser);
		$showEleve = true;
	}
}

 if(isset($_POST['showAddEleve'])){
 	$showEleve = true;
 	$eleve = new Utilisateur();
 	$_SESSION['ELEVE_SELECTED'] = null;
 }else if(isset($_POST['deleteEleve'])){
	$idEleve = $_SESSION['ELEVE_SELECTED'];
	deleteEtablissementToUtilisateur($_SESSION['ETABLISSEMENT_ID'],$idEleve);  
	$showEleve = false;
	$listeEleves = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ELEVE);
	$_SESSION['ELEVE_SELECTED'] = null;
}else if(isset($_POST['saveEleve'])){
	$idEleve = $_POST['idEleve'];
	if($idEleve == null || trim($idEleve) == false){
		//Nouveau niveau
		$eleve = new Utilisateur();
		$isnew = true;
	}else{
		$eleve = getUserById($idEleve);
		$isnew = false;
	}
	
	$error = false;
	$nom = $_POST['nom'];
	if($nom == null || trim($nom) == false){
		$error_nom="Le nom ne peut être vide";
		$error = true;
	}else{
		$eleve->nom = $nom;   
	}
	$prenom = $_POST['prenom'];
	if($prenom == null || trim($prenom) == false){
		$error_prenom="Le prénom ne peut être vide";
		$error = true;
	}else{
		$eleve->prenom = $prenom;
	}
	$login = $_POST['login'];
	if($login == null || trim($login) == false){
		$error_login="Le login ne peut être vide";
		$error = true;
	}else{
		if(validateLogin($login, $eleve->idUser)){
			$eleve->login = $login;
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
				$eleve->mdp = sha1($mdp);
			}
		}
	}else{
		if($isnew){
			$error_password="Le mot de passe ne peut être vide";
			$error = true;
		}
	}
	$showEleve = true;
	if($error==false){
		$eleve->active = 1;
		if(saveOrUpdateUtilisateur($eleve,Type_Utilisateur::ELEVE, $_SESSION['ETABLISSEMENT_ID'])){
			if(isset($_POST['selectClasseto'])){
				$listeClasse = $_POST['selectClasseto'];
			}else{
				$listeClasse = null;
			}
			addClassesToUser($eleve->idUser, $listeClasse);
			$succes = "Vos informations ont été mises à jour";
			$_SESSION['ELEVE_SELECTED'] = $eleve->idUser;
		}else{
			$succes = "Une erreur est survenue lors de la mise à jour";
		}
		$listeEleves = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ELEVE);
		$listeClasseSelected = getClassesByUser($_SESSION['ELEVE_SELECTED']);
	}
	
}

require ($_SERVER['DOCUMENT_ROOT']."/html/html/admin/admin_eleves/index.php");