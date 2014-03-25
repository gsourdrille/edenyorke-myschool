<?php

session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/LoginServiceImpl.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/CommunServiceImpl.php');
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");
	
	$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));
	$response['error'] = false;
	try{
		$username=trim($_POST['username']);
		$password=trim($_POST['password']);
	
		$loginService = new LoginServiceImpl();
		$communService = new CommunServiceImpl();
		
		$utilisateur = $loginService->connect($username,$password);
		if($utilisateur != null){
			$_SESSION['USER'] = serialize($utilisateur);
			$_SESSION['ETABLISSEMENT_ID'] = $communService->getFirstEtablissement($utilisateur);
			if(isset($_POST['autologin']) && $_POST['autologin']){
				$loginService->saveAutologin($utilisateur);
			}
		}else{
			$response['error'] = true;
			$response['error_login'] = "Utilisateur inconnu";
			
		}
	}catch (Exception $e){
		$response['error'] = true;
		$response['error_login'] = "Une erreur est survenue lors de l'authentification";
		$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
	}
	
	echo json_encode($response);