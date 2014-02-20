<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/include.php");

	function connect($username,$password){
		$passwordSha1 = sha1($password);
		$utilisateurDao = new UtilisateurDao();
		$utilisateur = $utilisateurDao->findUtilisateur($username, $passwordSha1);
		return $utilisateur;
	}
	
	function saveAutologin($utilisateur){
		$key = sha1($utilisateur->login.microtime());
		$utilisateurDao = new UtilisateurDao();
		$utilisateurDao->saveAutologin($utilisateur,$key);
		// Création du cookie
		$succes = setcookie('mysauto', $key, time() + 3600 * 24 * 10, '/');
	}
	
	function getUtilisateurByLoginToken($key){
		$utilisateurDao = new UtilisateurDao();
		return $utilisateurDao->getUtilisateurByLoginToken($key);
	}
	



?>