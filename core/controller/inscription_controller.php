<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_POST)){
	$utilisateur = new Utilisateur();
	$error = false;
	$nom = $_POST['nom'];
	if(StringUtils::isEmpty($nom)){
		$error="Le nom ne peut être vide";
	}else{
		$utilisateur->nom = $nom;   
	}
	$prenom = $_POST['prenom'];
	if(StringUtils::isEmpty($prenom)){
		$error="Le prénom ne peut être vide";
	}else{
		$utilisateur->prenom = $prenom;
	}
	$login = $_POST['username'];
	if(StringUtils::isEmpty($login)){
		$error="Le login ne peut être vide";
	}else{
		if(filter_var($login, FILTER_VALIDATE_EMAIL)){
			if(validateLogin($login, null)){
				$utilisateur->login = $login;
			}else{
				$error="Cet identifiant est déjà utilisé, veuillez en choisir un autre";
			}
		}else{
			$error="L'adresse email est incorrecte";
		}
	}
	$mdp = $_POST['password'];
	if(StringUtils::isNotEmpty($mdp)){
		$mdpBis = $_POST['password_bis'];
		if(StringUtils::isNotEmpty($mdpBis)){
			if($mdp != $mdpBis){
				$error="Les mots de passe ne correspondent pas";
			}else{
				$utilisateur->mdp = sha1($mdp);
			}
		}else{
			$error="Le mot de passe ne peut être vide";
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
		if(saveUtilisateur($utilisateur, $classe, $code)){
			$succes = "Vos informations ont été mises à jour";
			$array['reponse'] = "ok";
		}else{
			$array['error'] = "Une erreur est survenue lors de la mise à jour";
			$array['reponse'] = "ko";
		}
	}else{
		$array['reponse'] = "ko";
		$array['error'] = $error;
	}

echo json_encode($array);
}