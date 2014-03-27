<?php
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

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
	$logger->error($e->getTraceAsString() , $e);
}
require ($_SERVER['DOCUMENT_ROOT']."/html/html/login/index.php");
