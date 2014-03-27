<?php
@session_start();
include_once ($_SERVER['DOCUMENT_ROOT']."/core/service/impl/AdminServiceImpl.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/controller/commun_controller.php");
include_once($_SERVER['DOCUMENT_ROOT']."/core/logs/Logger.php");

Logger::configure($_SERVER['DOCUMENT_ROOT']."/conf/log4php.xml");
$logger = Logger::getLogger("LiveSchool");

try{
	$adminService = new AdminServiceImpl();
	//Maj de la liste des classes
	$listeClasse = $adminService->getClassesByUser($utilisateur->idUser);
}catch (Exception $e){
	$logger->error($e->getTraceAsString() ,$e);
	header("location:/erreur/erreur500");
}