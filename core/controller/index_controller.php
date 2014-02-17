<?php
session_start();

require ($_SERVER['DOCUMENT_ROOT'].'/myschool/core/service/login_service.php');

	// Récupération de la valeur du cookie
	if(isset($_COOKIE['mysauto'])){
	$key = $_COOKIE['mysauto'];
	$logger = new Logger(Constants::LOGGER_LOCATION);
	$logger->log('succes', 'myschool', "LECTURE COOKIE", Logger::GRAN_VOID);
	
	if(isset($key) && StringUtils::isNotEmpty($key)){
		$utilisateur = getUtilisateurByLoginToken($key);
		if($utilisateur != null){
			$_SESSION['USER'] = serialize($utilisateur);
			header("location:/myschool/core/controller/tableau_controller.php");
		}else{
			header("location:/myschool/html/html/login/index.php");
		}
	}
	}else {
		header("location:/myschool/html/html/login/index.php");
	}

