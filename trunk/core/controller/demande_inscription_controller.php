<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");

if(isset($_POST)){
	$utilisateur = new Utilisateur();
	$error = false;
	$nom = $_POST['nom'];
	
	$nomEtablissement = $_POST['nomEtablissement'];
	if(StringUtils::isEmpty($nomEtablissement)){
		$error="Le nom de l'établissement ne peut être vide";
	}
	
	$numeroTelephone = $_POST['numeroTelephone'];
	if(StringUtils::isEmpty($numeroTelephone)){
		$error="Le numéro de téléphone de l'établissement ne peut être vide";
	}
	
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
	
	if(StringUtils::isEmpty($error)){
		//Envoyer mail
		//Faire une table provisoire? user provisoire?
		
	}else{
		$array['reponse'] = "ko";
		$array['error'] = $error;
	}

echo json_encode($array);
}