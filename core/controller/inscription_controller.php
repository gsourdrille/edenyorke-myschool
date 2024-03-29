<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

$adminService = new AdminServiceImpl();
$response['error'] = false;
if(isset($_POST)){
	try{
		$utilisateur = new Utilisateur();
		$nom = $_POST['nom'];
		if(StringUtils::isEmpty($nom)){
			$response['error'] = true;
			$response['error_nom'] = "Le nom ne peut être vide";
		}else{
			$utilisateur->nom = $nom;   
		}
		$prenom = $_POST['prenom'];
		if(StringUtils::isEmpty($prenom)){
			$response['error'] = true;
			$response['error_prenom'] = "Le prénom ne peut être vide";
		}else{
			$utilisateur->prenom = $prenom;
		}
		$login = $_POST['username'];
		if(StringUtils::isEmpty($login)){
			$response['error'] = true;
			$response['error_login'] = "Le login ne peut être vide";
		}else{
			if(filter_var($login, FILTER_VALIDATE_EMAIL)){
				if($adminService->validateLogin($login, null)){
					$utilisateur->login = $login;
				}else{
					$response['error'] = true;
					$response['error_login'] = "Cet identifiant est déjà utilisé, veuillez en choisir un autre";
				}
			}else{
				$response['error'] = true;
				$response['error_login'] = "L'adresse email est incorrecte";
			}
		}
		$mdp = $_POST['password'];
		if(StringUtils::isNotEmpty($mdp)){
			$mdpBis = $_POST['password_bis'];
			if($mdp != $mdpBis){
				$response['error'] = true;
				$response['error_mdp'] = "Les mots de passe ne correspondent pas";
			}else{
				$utilisateur->mdp = sha1($mdp);
			}
		}else{
				$response['error'] = true;
				$response['error_mdp'] = "Le mot de passe ne peut être vide";
		}
		
		$code = $_POST['code'];
		if(StringUtils::isNotEmpty($code)){
			//Recherche de la validité du code
			$classe = $adminService->getClasseFromCode($code);
			if($classe==null){
				$response['error'] = true;
				$response['error_code'] = "Le code classe n'existe pas";
			}
		}else{
			$response['error'] = true;
			$response['error_code'] = "Le code classe ne peut être vide";
		}
		
		if(!$response['error']){
			$utilisateur->active = 0;
			if($adminService->saveUtilisateur($utilisateur, $classe, $code)){
				$response['error'] = false;
			}else{
				$response['error'] = true;
				$response['error_generale'] = "Une erreur est survenue lors de l'inscription";
			}
		}
	}catch (Exception $e){
		$response['error'] = true;
		$response['error_generale'] = "Une erreur est survenue lors de l'inscription";
		$logger->error($e->getTraceAsString() , $e);
	}

echo json_encode($response);
}