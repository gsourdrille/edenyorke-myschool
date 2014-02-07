<?php

include_once($_SERVER['DOCUMENT_ROOT']."/myschool/core/include.php");

	function connect($username,$password){
		
		$passwordSha1 = sha1($password);
		$utilisaterDao = new UtilisateurDao();
		$utilisateur = $utilisaterDao->findUtilisateur($username, $passwordSha1);
		return $utilisateur;
		
	}



?>