<?php

	interface LoginService {

		function connect($username,$password);
		
		function saveAutologin($utilisateur);
		
		function getUtilisateurByLoginToken($key);
	
	}

?>