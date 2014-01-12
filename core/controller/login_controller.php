<?php

session_start();

require ('../service/login_service.php');


	// Creation d'un objet Logger
	$logger = new Logger(Constants::LOGGER_LOCATION);

	$username=$_POST['username'];
	$password=$_POST['password'];

	$utilisateur = connect($username,$password);
	if($utilisateur != null){
		$logger->log('succes', 'myschool', "Fonction connect() : l'authentification a reussi", Logger::GRAN_VOID);
		$_SESSION['USER'] = serialize($utilisateur);
		header("location:/myschool/core/controller/tableau_controller.php");
	}else{
		$logger->log('error', 'myschool', "Fonction connect() : l'authentification a echouee", Logger::GRAN_VOID);
		$error = "Utilisateur inconnu";
		require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/login/index.php");
	}
