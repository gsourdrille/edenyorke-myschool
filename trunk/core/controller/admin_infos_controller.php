<?php

require ('../service/admin_service.php');
session_start();

if(!isset($_SESSION['USER'])){
	session_destroy();
	header("location:/myschool/html/html/login/index.php");
}else{
	$utilisateur = unserialize($_SESSION['USER']);
	$error = false;
	$nom = $_POST['nom'];
	if($nom == null || trim($nom) == false){
		$logger->log('succes', 'myschool', "Fonction validte infos user() : le nom est vide", Logger::GRAN_VOID);
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
	if($ancienMdp != null && trim($ancienMdp) == false){
		if(sha1($ancienMdp) != $utilisateur->mdp){
			$error_password="L'ancien mot de passe n'est pas correct";
			$error = true;
		}else{
			$nouveauMdp = $_POST['nouveau_mdp'];
			if($nouveauMdp != null && trim($nouveauMdp) == false){
				$nouveauMdpBis = $_POST['nouveau_mdp_bis'];
				if($nouveauMdpBis != null && trim($nouveauMdpBis) == false){
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
	
	if($error=true){
		include ("../../html/html/admin/admin_infos.php");
	}else{
		echo "COOL";
	}
	
}