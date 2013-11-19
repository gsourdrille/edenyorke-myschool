<?php
session_start();
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/tableau_service.php");

require('../logs/Logger.class.php');

// Creation d'un objet Logger
$logger = new Logger(Constants::LOGGER_LOCATION);

if(!isset($_SESSION['USER'])){
	header("location:/myschool/html/html/login/index.php");
}else{
	
	$utilisateur = unserialize($_SESSION['USER']);
	$listeTypeUtilisateur = getTypeUtilisateur($utilisateur);
	if($listeTypeUtilisateur!= null && $listeTypeUtilisateur->count()>0){
		$_SESSION['TYPE_UTILISATEUR'] = $listeTypeUtilisateur[0];
	}
	$listeEtablissement = getListeEtabliseement($utilisateur);
	if($listeEtablissement!= null && $listeEtablissement->count()>0){
		$etablissement = getEtablissement($listeEtablissement[0]);
		if($etablissement != null){
			$_SESSION['ETABLISSEMENT_ID'] = $etablissement->idEtablissement;
		}
	}
}

if (isset($_POST['submit'])){
	
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
			if(validateLogin($login, $utilisateur->idUser)){
				$utilisateur->login = $login;
			}else{
				$error_login="Ce login est déjà utilisé, veuillez en choisir un autre";
				$error = true;
			}
		}
		$ancienMdp = $_POST['ancien_mdp'];
		$logger->log('succes', 'myschool', "Fonction validate infos user() : test ".$ancienMdp, Logger::GRAN_VOID);
		if($ancienMdp != null && trim($ancienMdp) == true){
			$logger->log('succes', 'myschool', "Fonction validate infos user() : ancienMdp ".sha1($ancienMdp), Logger::GRAN_VOID);
			$logger->log('succes', 'myschool', "Fonction validate infos user() : Mdp ".$utilisateur->mdp, Logger::GRAN_VOID);
			if(sha1($ancienMdp) != $utilisateur->mdp){
				$error_password="L'ancien mot de passe n'est pas correct";
				$error = true;
			}else{
				$nouveauMdp = $_POST['nouveau_mdp'];
				if($nouveauMdp != null && trim($nouveauMdp) == true){
					$nouveauMdpBis = $_POST['nouveau_mdp_bis'];
					if($nouveauMdpBis != null && trim($nouveauMdpBis) == true){
						if($nouveauMdp != $nouveauMdpBis){
							$error_new_password="Les mots de passe ne correspondent pas";
							$error = true;
						}else{
							$utilisateur->mdp = sha1($nouveauMdp);
							$changeMdp=true;
						}
					}
				}
			}
		}
		if($error==false){
			if(updateUtilisateur($utilisateur)){
				$_SESSION['USER'] = serialize($utilisateur);
				$succes = "Vos informations ont été mises à jour";
			}else{
				$succes = "Une erreur est survnue lors de la mise à jour";
			}
			
		}
	}

	
	


require ("../../html/html/admin/admin_infos/index.php");