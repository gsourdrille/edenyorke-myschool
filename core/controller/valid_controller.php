<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

$logger = new Logger(Config::getProperties(Key::LOGGER_LOCATION));

try{
	$adminService = new AdminServiceImpl();
	
	if(isset($_GET['token'])){
		$token = $_GET['token'];
		if($adminService->validToken($token)){
			$validInscription = true;
		}else{
			$validInscription = false;
		}
		
	}else{
		$validInscription = false;
	}
}catch (Exception $e){
	$logger->log('erreur', 'liveschool_error', $e->getTraceAsString() , Logger::GRAN_MONTH);
}
require ($_SERVER['DOCUMENT_ROOT']."/html/html/login/index.php");
