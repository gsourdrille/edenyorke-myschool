<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_POST)){
	$utilisateur = new Utilisateur();
	$error = false;
	$nom = $_POST['nom'];
	if($nom == null || trim($nom) == false){
		$error="Le nom ne peut être vide";
	}else{
		$utilisateur->nom = $nom;   
	}
	$prenom = $_POST['prenom'];
	if($prenom == null || trim($prenom) == false){
		$error="Le prénom ne peut être vide";
	}else{
		$utilisateur->prenom = $prenom;
	}
	$login = $_POST['login'];
	if($login == null || trim($login) == false){
		$error="Le login ne peut être vide";
	}else{
		if(validateLogin($login, $eleve->idUser)){
			$utilisateur->login = $login;
		}else{
			$error="Cet identifiant est déjà utilisé, veuillez en choisir un autre";
		}
	}
	$mdp = $_POST['password'];
	if($mdp != null && trim($mdp) == true){
		$mdpBis = $_POST['password_bis'];
		if($mdpBis != null && trim($mdpBis) == true){
			if($mdp != $mdpBis){
				$error="Les mots de passe ne correspondent pas";
			}else{
				$utilisateur->mdp = sha1($mdp);
			}
		}
	}else{
			$error="Le mot de passe ne peut être vide";
	}
	
	$code = $_POST['code'];
	if(StringUtils::isNotEmpty($code)){
		//Recherche de la validité du code
		$classe = getClasseFromCode($code);
		if($classe==null){
			$error="Le code classe n'existe pas";
		}
	}else{
		$error="Le code classe ne peut être vide";
	}
	
	if(StringUtils::isEmpty($error)){
		if(saveUtilisateur($utilisateur, $classe)){
			$succes = "Vos informations ont été mises à jour";
			$array['reponse'] = "ok";
		}else{
			$succes = "Une erreur est survenue lors de la mise à jour";
			$array['reponse'] = "ko";
		}
	}else{
		$array['reponse'] = "ko";
		$array['error'] = $error;
	}

echo json_encode($array);
}