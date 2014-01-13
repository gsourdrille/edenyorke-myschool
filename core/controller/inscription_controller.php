<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_POST)){
	$utilisateur = new Utilisateur();
	$error = false;
	$nom = $_POST['nom'];
	if($nom == null || trim($nom) == false){
		$error_nom="Le nom ne peut être vide";
		$error = true;
	}else{
		$utilisateur->nom = $nom;   
	}
	$prenom = $_POST['prenom'];
	if($prenom == null || trim($prenom) == false){
		$error_prenom="Le prénom ne peut être vide";
		$error = true;
	}else{
		$utilisateur->prenom = $prenom;
	}
	$login = $_POST['login'];
	if($login == null || trim($login) == false){
		$error_login="Le login ne peut être vide";
		$error = true;
	}else{
		if(validateLogin($login, $eleve->idUser)){
			$utilisateur->login = $login;
		}else{
			$error_login="Cet identifiant est déjà utilisé, veuillez en choisir un autre";
			$error = true;
		}
	}
	$mdp = $_POST['password'];
	if($mdp != null && trim($mdp) == true){
		$mdpBis = $_POST['password_bis'];
		if($mdpBis != null && trim($mdpBis) == true){
			if($mdp != $mdpBis){
				$error_password="Les mots de passe ne correspondent pas";
				$error = true;
			}else{
				$utilisateur->mdp = sha1($mdp);
			}
		}
	}else{
			$error_password="Le mot de passe ne peut être vide";
			$error = true;
	}
	if($error==false){
		if(saveUtilisateur($utilisateur)){
			$succes = "Vos informations ont été mises à jour";
		}else{
			$succes = "Une erreur est survenue lors de la mise à jour";
		}
	}
}