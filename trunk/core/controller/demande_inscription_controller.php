<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

$adminService = new AdminServiceImpl();
$response['error'] = false;
if(isset($_POST)){
	
	try{
		$utilisateur = new Utilisateur();
		$etablissement = new Etablissement();
		$nomEtablissement = $_POST['nom_etablissement'];
		if(StringUtils::isEmpty($nomEtablissement)){
			$response['error'] = true;
			$response['error_nom_etablissement'] = "Le nom de l'établissement ne peut être vide";
		}else {
			$etablissement->nom = $nomEtablissement;
		}
		
		$numeroTelephone = $_POST['numeroTelephone'];
		if(StringUtils::isEmpty($numeroTelephone)){
			$response['error'] = true;
			$response['error_tel'] = "Le numéro de téléphone de l'établissement ne peut être vide";
		}else {
			$etablissement->telephone1 = $numeroTelephone;
		}
		
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
			$response['error_prenom'] ="Le prénom ne peut être vide";
		}else{
			$utilisateur->prenom = $prenom;
		}
		$login = $_POST['username'];
		if(StringUtils::isEmpty($login)){
			$response['error'] = true;
			$response['error_login'] ="Le login ne peut être vide";
		}else{
			if(filter_var($login, FILTER_VALIDATE_EMAIL)){
				if($adminService->validateLogin($login, null)){
					$utilisateur->login = $login;
				}else{
					$response['error'] = true;
					$response['error_login']="Cet identifiant est déjà utilisé, veuillez en choisir un autre";
				}
			}else{
				$response['error'] = true;
				$response['error_login']="L'adresse email est incorrecte";
			}
		}
		$mdp = $_POST['password'];
		if(StringUtils::isNotEmpty($mdp)){
			$mdpBis = $_POST['password_bis'];
				if($mdp != $mdpBis){
					$response['error'] = true;
					$response['error_mdp']="Les mots de passe ne correspondent pas";
				}else{
					$utilisateur->mdp = sha1($mdp);
				}
		}else{
			$response['error'] = true;
			$response['error_mdp']="Le mot de passe ne peut être vide";
		}
		
		if(!$response['error']){
			if($adminService->inscriptionEtablissement($etablissement, $utilisateur)){
				$response['error'] = false;
			}else{
				$response['error'] = true;
				$response['error_generale'] = "Une erreur est survenue lors de la demande d'inscription";
			}
		}
	}catch (Exception $e){
		$response['error'] = true;
		$response['error_generale'] = "Une erreur est survenue lors de la demande d'inscription";
		$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	}

echo json_encode($response);
}