<?php

include_once($_SERVER['DOCUMENT_ROOT']."/core/bean/Utilisateur.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/dao/impl/UtilisateurDaoImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/service/LoginService.php");

	class LoginServiceImpl implements LoginService {
		
		var $utilisateurDao;
		
		function __construct() {
			$this->utilisateurDao = new UtilisateurDaoImpl();
		}

		function connect($username,$password){
			$passwordSha1 = sha1($password);
			$utilisateur = $this->utilisateurDao->findUtilisateur($username, $passwordSha1);
			return $utilisateur;
		}
		
		function saveAutologin($utilisateur){
			$key = sha1($utilisateur->login.microtime());
			$this->utilisateurDao->saveAutologin($utilisateur,$key);
			// Création du cookie
			$succes = setcookie('mysauto', $key, time() + 3600 * 24 * 10, '/');
		}
		
		function getUtilisateurByLoginToken($key){
			return $this->utilisateurDao->getUtilisateurByLoginToken($key);
		}
	
	}
	



?>