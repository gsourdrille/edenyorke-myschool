<?php
require ($_SERVER['DOCUMENT_ROOT']."/myschool/core/service/admin_service.php");
$logger = new Logger(Constants::LOGGER_LOCATION);


if(isset($_GET['token'])){
	$token = $_GET['token'];
	$logger->log('succes', 'myschool', $token , Logger::GRAN_VOID);
	if(validToken($token)){
		$validInscription = true;
	}else{
		$validInscription = false;
	}
	
}else{
	$validInscription = false;
}

require ($_SERVER['DOCUMENT_ROOT']."/myschool/html/html/login/index.php");