<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");
include($_SERVER['DOCUMENT_ROOT']."/myschool/core/controller/commun_controller.php");


//Recuperation des enseignants lies a l'etablissement
$listeEnseignants = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ENSEIGNANT);
if(isset($_GET['action'])){
	$action = $_GET['action'];
	if($action == 'showEnseignant'){
		$enseignant = getUserById($_GET['idUser']);
		$_SESSION['ENSEIGNANT_SELECTED'] = $enseignant->idUser;
		$showEnseignant = true;
	}
}

 if(isset($_POST['showAddEnseignant'])){
 	$showEnseignant = true;
 	$enseignant = new Utilisateur();
 }else if(isset($_POST['deleteEnseignant'])){
	$idEnseignant = $_SESSION['ENSEIGNANT_SELECTED'];
	deleteUser($idEnseignant);
	$showEnseignant = false;
	$listeEnseignants = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ENSEIGNANT);
	$_SESSION['ENSEIGNANT_SELECTED'] = null;
}else if(isset($_POST['saveEnseignant'])){
	$idEnseignant = $_POST['idEnseignant'];
	if($idEnseignant == null || trim($idEnseignant) == false){
		//Nouveau niveau
		$enseignant = new Utilisateur();
		$enseignant->idEtablissement = $_SESSION['ETABLISSEMENT_ID'];
		$isnew = true;
	}else{
		$enseignant = getUserById($idNiveau);
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
		if(validateLogin($login, $enseignant->idUser)){
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

	if($error==false){
		if(saveOrUpdateUtilisateur($enseignant,Type_Utilisateur::ENSEIGNANT)){
			$succes = "Vos informations ont été mises à jour";
			$_SESSION['ENSEIGNANT_SELECTED'] = $enseignant->idUser;
		}else{
			$succes = "Une erreur est survnue lors de la mise à jour";
		}
		$showEnseignant = true;
		$listeEnseignants = getUserByEtablissementAndType($_SESSION['ETABLISSEMENT_ID'],Type_Utilisateur::ENSEIGNANT);
	}
	
}

require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/admin/admin_enseignants/index.php");