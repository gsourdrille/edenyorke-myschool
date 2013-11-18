<?php

include($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");

function validateLogin($username, $userId){
	$utilisaterDao = new UtilisateurDao();
	$utilisateur = $utilisaterDao->findUtilisateurByUsername($username);
	if($utilisateur == null || ($utilisateur != null && $utilisateur->idUser == $userId)){
		return true;
	}else{
		return false;
	}

}

function updateUtilisateur($utilisateur){
	$utilisaterDao = new UtilisateurDao();
	$utilisaterDao->updateUtilisateur($utilisateur);
}