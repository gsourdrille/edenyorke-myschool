<?php

include("../include.php");
function validateLogin($username, $userId){
	$utilisaterDao = new UtilisateurDao();
	$utilisateur = $utilisaterDao->findUtilisateurByUsername($username);
	if($utilisateur == null || ($utilisateur != null && $utilisateur->idUser == $userId)){
		return false;
	}else{
		return true;
	}

}