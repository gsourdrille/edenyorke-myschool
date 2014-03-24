<?php
@session_start();

require ($_SERVER['DOCUMENT_ROOT'].'/core/service/impl/LoginServiceImpl.php');
include_once($_SERVER['DOCUMENT_ROOT']."/core/utils/StringUtils.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));
$loginService = new LoginServiceImpl();

	try{
		// Récupération de la valeur du cookie
		if(isset($_COOKIE['mysauto'])){
		$key = $_COOKIE['mysauto'];
		if(isset($key) && StringUtils::isNotEmpty($key)){
			$utilisateur = $loginService->getUtilisateurByLoginToken($key);
			if($utilisateur != null){
				$_SESSION['USER'] = serialize($utilisateur);
				header("location:/core/controller/tableau_controller.php");
			}else{
				header("location:/html/html/login/index.php");
			}
		}
		}else {
			header("location:/html/html/login/index.php");
		}
	}catch (Exception $e){
		$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
		header("location:/core/controller/erreur_controller.php");
	}

